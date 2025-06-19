<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Smalot\PdfParser\Parser;
use App\Models\Upload;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf as PdfToImage;
use \Imagick;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    // Download de livros
    public function download($id)
    {
        $book = Upload::findOrFail($id);
        
        // Verifica se o arquivo existe
        $filePath = storage_path('app/public/' . $book->file_path);
        
        if (!file_exists($filePath)) {
            // Tenta o caminho alternativo caso esteja usando link simbólico
            $altPath = public_path('storage/' . $book->file_path);
            
            if (!file_exists($altPath)) {
                abort(404, 'Arquivo não encontrado');
            }
            
            $filePath = $altPath;
        }
        
        // Define o nome do arquivo para download
        $downloadName = Str::slug($book->title) . '.pdf';
        
        // Força o download
        return response()->download($filePath, $downloadName);
    }

    // Página home
    public function saude(Request $request)
    {
        $agent = new Agent();
        $isMobile = $agent->isMobile();
        
        return view('saude', ['isMobile' => $isMobile]);
    }
    public function home(Request $request) 
    {
        $filter = $request->input('filter');
        $value = $request->input('value');
        $search = $request->input('search');

        $pdfs = Upload::query();

        if ($filter && $value) {
            $pdfs->where($filter, $value);
        }

        if ($search) {
            $pdfs->where(function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('author', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $pdfs = $pdfs->latest()->paginate(18);

        $categories = Upload::select('category')->distinct()->orderBy('category')->pluck('category');
        $authors = Upload::select('author')->distinct()->orderBy('author')->pluck('author');

        return view('home', [
            'pdfs' => $pdfs,
            'categories' => $categories,
            'authors' => $authors,
            'search' => $search
        ]);
    }

    // Página de compartilhar PDF
    public function sharePdf()
    {
        return view('share-pdf');
    }

    // Upload de PDF
    public function upload(Request $request)
    {
        // Validação
        $request->validate([
            'pdf_file' => 'required|file|mimes:pdf|max:10485760',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255'
        ]);
        
        try {
            // Fazendo o upload do PDF
            $file = $request->file('pdf_file');
            
            // Gerar nome personalizado para o arquivo
            $userId = auth()->id();
            $bookTitle = Str::slug($request->title);
            $fileName = "{$bookTitle}_{$userId}_" . time() . ".pdf";
            
            // Salvar o arquivo com o nome personalizado
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
            
            // Gerar imagem da capa (primeira página)
            $imagePath = $this->generatePdfCover($file);
            
            // Salvar os dados no banco
            $upload = new Upload();
            $upload->user_id = $userId;
            $upload->file_path = $filePath;
            $upload->title = $request->title;
            $upload->author = $request->author;
            $upload->description = $request->description;
            $upload->image_path = $imagePath;
            $upload->category = $request->category;
            $upload->save();
            
            // Retornar os dados do livro em JSON
            return response()->json([
                'success' => true,
                'id' => $upload->id,
                'title' => $upload->title,
                'author' => $upload->author,
                'category' => $upload->category,
                'description' => $upload->description,
                'image_path' => $upload->image_path
            ]);
        } catch (\Exception $e) {
            // Log do erro
            \Log::error('Erro ao fazer upload do PDF: ' . $e->getMessage());
            
            return back()->with('error', 'Erro ao enviar o PDF: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Atualizar livro via AJAX
    public function updateBookAjax(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:10485760'
        ]);
        
        $book = Upload::findOrFail($id);
        
        // Atualiza os dados
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->category = $request->category;
        
        if ($request->hasFile('pdf_file')) {
            // Remove o PDF antigo
            \Storage::delete('public/' . $book->file_path);
            
            // Faz o upload do novo PDF
            $file = $request->file('pdf_file');
            $bookTitle = Str::slug($request->title);
            $fileName = "{$bookTitle}_" . time() . ".pdf";
            $filePath = $file->storeAs('pdfs', $fileName, 'public');
            
            // Gera nova imagem de capa
            $imagePath = $this->generatePdfCover($file);
            
            $book->file_path = $filePath;
            $book->image_path = $imagePath;
        }
        
        $book->save();
        
        // Retornar JSON para o AJAX
        return response()->json([
            'success' => true,
            'message' => 'Livro atualizado com sucesso'
        ]);
    }

    // Gerar capa do PDF
    private function generatePdfCover($pdfFile)
    {
        // Criar diretório se não existir
        $coverDir = storage_path('app/public/images');
        if (!file_exists($coverDir)) {
            mkdir($coverDir, 0755, true);
        }

        // Nome do arquivo para a imagem
        $imagePath = 'images/' . time() . '';
        $fullImagePath = storage_path('app/public/' . $imagePath);

        try {
            // Salvar o PDF temporariamente
            $tempPdfPath = storage_path('app/temp_' . time() . '.pdf');
            copy($pdfFile->getRealPath(), $tempPdfPath);

            // Converter primeira página do PDF em imagem usando Poppler (pdftoppm)
            $command = "pdftoppm -jpeg -f 1 -singlefile " . escapeshellarg($tempPdfPath) . " " . escapeshellarg($fullImagePath);
            exec($command, $output, $returnVar);

            // Remover arquivo temporário do PDF
            @unlink($tempPdfPath);

            // Verificar se a conversão funcionou
            if ($returnVar !== 0 || !file_exists($fullImagePath . ".jpg")) {
                throw new \Exception("Erro ao converter PDF para imagem.");
            }

            return $imagePath;
        } catch (\Exception $e) {
            throw new \Exception("Erro ao gerar a capa do PDF: " . $e->getMessage());
        }
    }

    /**
     * Mostra o perfil do usuário
     */
    public function show(Request $request): View
    {
        $user = Auth::user();
        
        // Busca os livros do usuário com paginação
        $userBooks = Upload::where('user_id', $user->id)
                         ->latest()
                         ->paginate(12);

        // Buscar categorias para o modal de edição
        $categories = Upload::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('profile.show', [
            'user' => $user,
            'books' => $userBooks,
            'categories' => $categories // Adiciona as categorias para o modal
        ]);
    }

    /**
     * Mostra o formulário de edição do perfil do usuário
     */
    public function edit(): View
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }

    /**
     * Atualiza as informações do perfil do usuário
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        // Processamento do avatar
        if ($request->hasFile('avatar')) {
            // Remove a imagem antiga se existir
            if ($request->user()->avatar) {
                Storage::delete('public/'.$request->user()->avatar);
            }
            
            // Armazena a nova imagem
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $path;
        }

        // Adiciona a bio aos dados validados
        $validated['bio'] = $request->bio;

        $request->user()->fill($validated);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Excluir conta do usuário
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Excluir livro
     */
    public function deleteBook(Request $request, $id)
    {
        $book = Upload::findOrFail($id);

        // Verifica se o usuário logado é o dono do livro
        if (Auth::id() !== $book->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para excluir este livro.'
            ], 403);
        }

        try {
            // Remove o arquivo PDF do storage
            \Storage::delete('public/' . $book->file_path);

            // Remove a imagem de capa (se existir)
            if ($book->image_path) {
                \Storage::delete('public/' . $book->image_path);
            }

            // Exclui o registro do banco de dados
            $book->delete();

            return response()->json([
                'success' => true,
                'message' => 'Livro excluído com sucesso!'
            ]);

        } catch (\Exception $e) {
            \Log::error("Erro ao excluir livro: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao excluir o livro. Tente novamente.'
            ], 500);
        }
    }

    /**
     * Buscar dados do livro para edição (AJAX)
     */
    public function editBook($id)
    {
        $book = Upload::findOrFail($id);
        
        // Verifica se o usuário é o dono do livro
        if (Auth::id() !== $book->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para editar este livro.'
            ], 403);
        }
        
        return response()->json($book);
    }

    /**
     * Atualizar livro (AJAX)
     */
    public function updateBook(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255'
        ]);

        $book = Upload::findOrFail($id);
        
        // Verifica se o usuário é o dono do livro
        if (Auth::id() !== $book->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'Você não tem permissão para editar este livro.'
            ], 403);
        }

        $book->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Livro atualizado com sucesso!'
        ]);
    }
}