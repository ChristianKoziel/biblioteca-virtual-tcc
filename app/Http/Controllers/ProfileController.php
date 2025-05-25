<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Smalot\PdfParser\Parser;
use App\Models\Upload;
use Illuminate\Support\Str;
use Spatie\PdfToImage\Pdf as PdfToImage;
use \Imagick;

class ProfileController extends Controller
{
    // função home
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
        'search' => $search // Passa o termo de pesquisa para a view
    ]);
}
    // funçao do deepseek
    public function sharePdf()
    {
        // O middleware 'auth' já garantiu que o usuário está logado
        return view('share-pdf'); // Retorna a view de compartilhamento de PDF
    }

    //  upload antigo funcionando ok so precisa reajustar o return
public function upload(Request $request)
{
    // Validação
    $request->validate([
        'pdf_file' => 'required|file|mimes:pdf|max:10485760', // Aumentei o limite para 10GB
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
        $bookTitle = Str::slug($request->title); // Converte o título em um formato seguro para URL
        $fileName = "{$bookTitle}_{$userId}_" . time() . ".pdf"; // Nome do arquivo: titulo_do_livro_id_usuario_timestamp.pdf
        
        // Salvar o arquivo com o nome personalizado
        $filePath = $file->storeAs('pdfs', $fileName, 'public');
        
        // Gerar imagem da capa (primeira página)
        $imagePath = $this->generatePdfCover($file);
        
        // Salvar os dados no banco
        $upload = new Upload(); // Verifique se a tabela "uploads" tem o nome do modelo correto (Upload)
        $upload->user_id = $userId;
        $upload->file_path = $filePath; // O caminho do arquivo PDF
        $upload->title = $request->title;
        $upload->author = $request->author;
        $upload->description = $request->description;
        $upload->image_path = $imagePath; // Caminho da imagem gerada
        $upload->category = $request->category;
        $upload->save();
        
        // return back()->with('success', 'PDF enviado com sucesso!');
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

public function updateBookAjax(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required|string|max:255',
        'pdf_file' => 'nullable|file|mimes:pdf|max:10485760' // PDF opcional
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

        return $imagePath; // Retornar o caminho da imagem gerada
    } catch (\Exception $e) {
        throw new \Exception("Erro ao gerar a capa do PDF: " . $e->getMessage());
    }
}

    // Método para criar uma capa padrão caso a conversão falhe
    // private function generateDefaultCover($imagePath, $pdfFile = null)
    // {
    //     $fullImagePath = storage_path('app/public/' . $imagePath);
        
    //     // Obter título do PDF (usamos o que foi enviado no formulário)
    //     $title = request()->title ?? 'PDF';
        
    //     // Gerar cores baseadas no título para tornar capas visualmente distintas
    //     $hash = md5($title);
    //     $r = hexdec(substr($hash, 0, 2));
    //     $g = hexdec(substr($hash, 2, 2));
    //     $b = hexdec(substr($hash, 4, 2));
        
    //     // Criar uma imagem padrão com texto
    //     $img = Image::canvas(200, 280, "rgb($r,$g,$b)");
        
    //     // Adicionar título como texto na imagem
    //     $img->text(strtoupper(substr($title, 0, 20)), 100, 140, function($font) {
    //         $font->size(20);
    //         $font->color('#ffffff');
    //         $font->align('center');
    //         $font->valign('middle');
    //     });
        
    //     $img->save($fullImagePath);
    //     return $imagePath;
    // }

    /**
     * Display the user's profile form.
     */

    
    // Adicione este método no seu ProfileController
    public function editBook($id)
    {
        $book = Upload::findOrFail($id); // Busca o livro pelo ID
        return view('booksedit', compact('book')); // Retorna a view de edição
    }


    public function updateBook(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'category' => 'required|string|max:255',
        'pdf_file' => 'nullable|file|mimes:pdf|max:10485760' // PDF opcional
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
    
    return redirect()->route('home')->with('success', 'Livro atualizado com sucesso!');
}



    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
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
}