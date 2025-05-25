@extends('layouts.app')

@section('content')
    <!-- Menu mobile componentizado -->
    <x-mobile-menu />

    <!-- Conteúdo principal -->
    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded shadow-md mb-4 flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>{{ session('success') }}</span>
                <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-md mb-4 flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span>{{ session('error') }}</span>
                <button class="ml-auto focus:outline-none" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif
    
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded shadow-md mb-4">
                <div class="flex items-center mb-2">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <span class="font-semibold">Por favor, corrija os erros abaixo:</span>
                    <button class="ml-auto focus:outline-none" onclick="this.parentElement.parentElement.remove()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <ul class="list-disc ml-8">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Compartilhe seus livros em PDF</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Ajude a comunidade e a biblioteca a crescer. Compartilhe conhecimento e faça parte dessa rede de leitores apaixonados.</p>
        </div>
    
        <!-- Formulário de upload de PDF -->
        <div class="bg-white p-8 rounded-lg shadow-lg max-w-2xl mx-auto transition-all duration-300 hover:shadow-xl">
            <div class="mb-6 border-b pb-4">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-upload text-blue-500 mr-2"></i> Upload de Livro
                </h2>
                <p class="text-sm text-gray-500 mt-1">Preencha todos os campos para compartilhar seu livro com a comunidade</p>
            </div>
            
            <form action="{{ route('pdf.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Título do Livro <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-book absolute left-2 top-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            class="mt-1 block w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" 
                            placeholder="Ex: Como fazer amigos e influenciar pessoas" 
                            value="{{ old('title') }}"
                            required
                        >
                        <div class="text-xs text-gray-500 mt-1 ml-2">
                            <i class="fas fa-info-circle mr-1"></i> Insira o título completo do livro
                        </div>
                    </div>
                </div>
    
                <div class="mb-6">
                    <label for="author" class="block text-sm font-medium text-gray-700 mb-1">
                        Autor <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-user-edit absolute left-2 top-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <input 
                            type="text" 
                            id="author" 
                            name="author" 
                            class="mt-1 block w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" 
                            placeholder="Ex: Dale Carnegie" 
                            value="{{ old('author') }}"
                            required
                        >
                    </div>
                </div>
    
                <x-category-select :selected="old('category')" />    
                <div class="mb-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Descrição <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <i class="fas fa-align-left absolute left-2 top-3 text-gray-400 group-hover:text-blue-500 transition-colors"></i>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="4" 
                            class="mt-1 block w-full pl-10 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-200" 
                            placeholder="Ex: Um clássico sobre relacionamentos interpessoais, com dicas práticas para melhorar sua comunicação e influência no dia a dia."
                            required
                        >{{ old('description') }}</textarea>
                        <div class="flex justify-between text-xs text-gray-500 mt-1 ml-2">
                            <span><i class="fas fa-info-circle mr-1"></i> Descreva brevemente o conteúdo do livro</span>
                            <span id="charCount">0/500</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="pdf" class="block text-sm font-medium text-gray-700 mb-1">
                        Arquivo PDF <span class="text-red-500">*</span>
                    </label>
                    <div 
                        class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-all duration-200 cursor-pointer" 
                        id="dropzone"
                    >
                        <input 
                            type="file" 
                            id="pdf" 
                            name="pdf_file" 
                            accept="application/pdf" 
                            class="hidden" 
                            required
                        >
                        <i class="fas fa-file-pdf text-5xl text-gray-400 mb-3"></i>
                        <div class="text-gray-700">
                            <p class="font-medium">Arraste e solte um arquivo PDF aqui</p>
                            <p class="text-sm text-gray-500 mt-1">ou</p>
                            <button type="button" id="browseButton" class="mt-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200">
                                Procurar arquivo
                            </button>
                        </div>
                        <div id="file-name" class="mt-3 text-blue-500 font-medium hidden"></div>
                        <div id="preview-container" class="mt-4 hidden">
                            <p class="text-sm font-medium text-gray-600 mb-2">Pré-visualização da primeira página:</p>
                            <div class="relative">
                                <div id="pdf-preview" class="mx-auto max-w-xs border border-gray-300 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center min-h-[300px]">
                                    <div class="text-center p-4">
                                        <i class="fas fa-spinner fa-spin text-blue-500 text-2xl mb-2"></i>
                                        <p class="text-gray-600">Carregando pré-visualização...</p>
                                    </div>
                                </div>
                                <div class="bg-gray-100 text-center py-1 text-sm text-gray-600">
                                    Visualização da capa - Página 1/1
                                </div>
                            </div>
                        </div>
                        
                        <!-- Progresso de upload -->
                        <div id="upload-progress-container" class="mt-4 w-full hidden">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Enviando arquivo...</span>
                                <span id="upload-progress-text">0%</span>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2.5">
                                <div id="upload-progress-bar" class="bg-blue-500 h-2.5 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4 px-3 py-2 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded">
                    <div class="flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        <p class="text-sm">
                            Ao enviar este arquivo, você confirma que possui os direitos necessários para compartilhá-lo ou que o conteúdo está em domínio público.
                        </p>
                    </div>
                </div>
                    
                <div class="text-center">
                    <button 
                        type="submit" 
                        id="submitButton"
                        class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <i class="fas fa-cloud-upload-alt mr-2"></i>
                        Compartilhar Livro
                    </button>
                </div>
            </form>
        </div>
        <div id="successModal" class="success-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Upload realizado com sucesso!</h3>
                    <button class="close-modal" onclick="closeSuccessModal()">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="modal-body">
                    <div class="book-thumbnail">
                        <!-- Adicione este container para a miniatura -->
                        <div id="bookThumbnailModal"></div>
                    </div>
                    
                    <div class="book-info">
                        <!-- Adicione estes elementos para mostrar as informações -->
                        <p><strong>Título:</strong> <span id="modalBookTitle"></span></p>
                        <p><strong>Autor:</strong> <span id="modalBookAuthor"></span></p>
                        <p><strong>Categoria:</strong> <span id="modalBookCategory"></span></p>
                        <!-- Adicione este elemento oculto para o ID do livro -->
                        <span id="modalBookId" style="display: none;"></span>
                    </div>
                    
                    <div class="success-actions">
                        <button class="action-btn view-book" onclick="viewUploadedBook()">
                            <i class="fas fa-eye"></i> Visualizar Livro
                        </button>
                        <button class="action-btn new-upload" onclick="window.location.href='/share-pdf'; closeSuccessModal();">
                            <i class="fas fa-plus-circle"></i> Adicionar Outro
                        </button>
                    </div>
                </div>
            </div>
        </div>
                
                <!-- ... (restante do modal permanece igual) ... -->
            </div>
        </div>
</main>
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
    <script>
        // Configura o worker do PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js';

        // Contador de caracteres para descrição
        const descriptionField = document.getElementById('description');
        const charCountDisplay = document.getElementById('charCount');
        
        descriptionField.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCountDisplay.textContent = `${currentLength}/500`;
            
            if (currentLength > 500) {
                charCountDisplay.classList.add('text-red-500');
                charCountDisplay.classList.remove('text-gray-500');
            } else {
                charCountDisplay.classList.remove('text-red-500');
                charCountDisplay.classList.add('text-gray-500');
            }
        });
        
        // Drag and drop para o arquivo PDF
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('pdf');
        const fileNameDisplay = document.getElementById('file-name');
        const previewContainer = document.getElementById('preview-container');
        const pdfPreview = document.getElementById('pdf-preview');
        const browseButton = document.getElementById('browseButton');
        
        dropzone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropzone.classList.add('border-blue-500', 'bg-blue-50');
        });
        
        dropzone.addEventListener('dragleave', function() {
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        });
        
        dropzone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            
            if (e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                updateFilePreview();
            }
        });
        
        browseButton.addEventListener('click', function() {
            fileInput.click();
        });
        
        fileInput.addEventListener('change', function() {
            updateFilePreview();
        });
        
        async function updateFilePreview() {
            const file = fileInput.files[0];
            
            if (file) {
                // Mostrar nome do arquivo
                fileNameDisplay.textContent = "Arquivo selecionado: " + file.name;
                fileNameDisplay.classList.remove('hidden');
                previewContainer.classList.remove('hidden');
                
                try {
                    // Criar objeto URL para o arquivo
                    const pdfUrl = URL.createObjectURL(file);
                    
                    // Carregar o PDF com PDF.js
                    const pdf = await pdfjsLib.getDocument(pdfUrl).promise;
                    const page = await pdf.getPage(1);
                    
                    // Configurar o viewport
                    const viewport = page.getViewport({ scale: 0.8 });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    
                    // Renderizar a página
                    await page.render({
                        canvasContext: context,
                        viewport: viewport
                    }).promise;
                    
                    // Limpar e adicionar o canvas à pré-visualização
                    pdfPreview.innerHTML = '';
                    pdfPreview.appendChild(canvas);
                    
                    // Adicionar animação suave
                    pdfPreview.style.opacity = '0';
                    setTimeout(() => {
                        pdfPreview.style.transition = 'opacity 0.3s ease-in';
                        pdfPreview.style.opacity = '1';
                    }, 100);
                    
                    // Liberar o objeto URL
                    URL.revokeObjectURL(pdfUrl);
                } catch (error) {
                    console.error("Erro ao carregar PDF:", error);
                    // Fallback para iframe caso PDF.js falhe
                    const fileReader = new FileReader();
                    fileReader.onload = function() {
                        pdfPreview.innerHTML = `
                            <iframe 
                                src="${fileReader.result}#page=1&view=FitH&toolbar=0&statusbar=0&navpanes=0" 
                                class="w-full h-64" 
                                title="Primeira página do PDF"
                            ></iframe>
                        `;
                    };
                    fileReader.readAsDataURL(file);
                }
            } else {
                fileNameDisplay.classList.add('hidden');
                previewContainer.classList.add('hidden');
            }
        }
        
        // Simulação de progresso de upload
        const uploadForm = document.getElementById('uploadForm');
        const submitButton = document.getElementById('submitButton');
        const progressContainer = document.getElementById('upload-progress-container');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressText = document.getElementById('upload-progress-text');

// Adicione estas funções ao seu script

// Função para abrir o modal com scroll bloqueado na página
function openSuccessModal() {
    document.getElementById('successModal').style.display = 'flex';
    document.body.classList.add('modal-open');
}

// Função para fechar o modal e restaurar o scroll
function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
    document.body.classList.remove('modal-open');
}

// Adicione um listener para fechar o modal ao clicar fora dele
document.getElementById('successModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuccessModal();
    }
});

// Garante que a miniatura do PDF seja transferida corretamente para o modal
function transferPdfPreviewToModal() {
    const pdfPreview = document.querySelector('#pdf-preview canvas');
    const thumbnailModal = document.getElementById('bookThumbnailModal');
    
    if (pdfPreview && thumbnailModal) {
        thumbnailModal.innerHTML = '';
        const clone = pdfPreview.cloneNode(true);
        thumbnailModal.appendChild(clone);
    }
}
// Função para fechar o modal
function closeSuccessModal() {
    document.getElementById('successModal').style.display = 'none';
}

// Função para visualizar o livro enviado
function viewUploadedBook() {
    const bookId = document.getElementById('modalBookId').textContent;
    window.location.href = `/livros/${bookId}`;
}

// Funções de compartilhamento
function shareBook(socialNetwork) {
    const bookId = document.getElementById('modalBookId').textContent;
    const url = `${window.location.origin}/livros/${bookId}`;
    const title = document.getElementById('modalBookTitle').textContent;
    
    switch(socialNetwork) {
        case 'facebook':
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`, '_blank');
            break;
        case 'twitter':
            window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`, '_blank');
            break;
        case 'whatsapp':
            window.open(`https://wa.me/?text=${encodeURIComponent(`${title} - ${url}`)}`, '_blank');
            break;
    }
}


// Função para copiar o link
function copyBookLink() {
    const bookId = document.getElementById('modalBookId').textContent;
    const url = `${window.location.origin}/livros/${bookId}`;
    
    navigator.clipboard.writeText(url).then(() => {
        alert('Link copiado para a área de transferência!');
    }).catch(err => {
        alert('Não foi possível copiar o link: ' + err);
    });
}

// Atualize a função de submit para preencher todos os campos
uploadForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const file = fileInput.files[0];
    if (file) {
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enviando...';
        progressContainer.classList.remove('hidden');
        
        const formData = new FormData(uploadForm);
        fetch(uploadForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Verifique se os elementos existem antes de acessá-los
                const modalBookTitle = document.getElementById('modalBookTitle');
                const modalBookAuthor = document.getElementById('modalBookAuthor');
                const modalBookCategory = document.getElementById('modalBookCategory');
                const modalBookId = document.getElementById('modalBookId');
                
                if (modalBookTitle) modalBookTitle.textContent = data.title || 'Não informado';
                if (modalBookAuthor) modalBookAuthor.textContent = data.author || 'Não informado';
                if (modalBookCategory) modalBookCategory.textContent = data.category || 'Não informado';
                if (modalBookId) modalBookId.textContent = data.id || '';
                
                // Atualiza a miniatura
                const thumbnailContainer = document.getElementById('bookThumbnailModal');
                const previewCanvas = document.getElementById('pdf-preview').querySelector('canvas');
                
                if (thumbnailContainer) {
                    thumbnailContainer.innerHTML = '';
                    
                    if (previewCanvas) {
                        const clone = previewCanvas.cloneNode(true);
                        thumbnailContainer.appendChild(clone);
                    } else if (data.image_path) {
                        const img = document.createElement('img');
                        img.src = `/storage/${data.image_path}`;
                        img.alt = `Capa do livro ${data.title}`;
                        thumbnailContainer.appendChild(img);
                    } else {
                        thumbnailContainer.innerHTML = `
                            <div class="default-thumbnail">
                                <i class="fas fa-book-open"></i>
                                <p>Sem pré-visualização</p>
                            </div>
                        `;
                    }
                }
                
                // Mostra o modal
                openSuccessModal();
                
                // Limpa o formulário
                uploadForm.reset();
                previewContainer.classList.add('hidden');
                fileNameDisplay.classList.add('hidden');
            }
        })
        .catch(error => {
            console.error('Erro na conexão:', error);
            alert('Erro na conexão: ' + error.message);
        })
        .finally(() => {
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-cloud-upload-alt mr-2"></i> Compartilhar Livro';
            progressContainer.classList.add('hidden');
        });
    }
});
    </script>
    <style>
        .social-share {
            @apply text-white p-3 rounded-full w-12 h-12 flex items-center justify-center transition-all duration-200 transform hover:scale-110;
        }
        #pdf-preview {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #pdf-preview canvas {
            max-width: 100%;
            height: auto;
        }
        /* Modal de Sucesso Melhorado */
.success-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content {
    background: white;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    overflow: hidden;
}

.modal-header {
    background: #4CAF50;
    color: white;
    padding: 20px;
    position: relative;
    text-align: center;
}

.modal-header h3 {
    margin: 10px 0 0;
    font-size: 1.4rem;
}

.success-icon {
    font-size: 50px;
    color: white;
}

.close-modal {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    color: white;
    font-size: 1.2rem;
    cursor: pointer;
}

.modal-body {
    padding: 20px;
    text-align: center;
}

.book-thumbnail {
    width: 150px;
    height: 200px;
    background: #f5f5f5;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    overflow: hidden;
}

.book-thumbnail i {
    font-size: 40px;
    color: #777;
}

.book-info {
    text-align: left;
    margin-bottom: 20px;
    background: #f9f9f9;
    padding: 15px;
    border-radius: 5px;
}

.book-info p {
    margin: 8px 0;
    color: #333;
}

.book-info strong {
    color: #222;
}

.success-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 15px;
}

.action-btn {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.action-btn i {
    font-size: 16px;
}

.view-book {
    background: #2196F3;
    color: white;
}

.view-book:hover {
    background: #0b7dda;
}

.new-upload {
    background: #e0e0e0;
    color: #333;
}

.new-upload:hover {
    background: #d0d0d0;
}

.modal-footer {
    background: #f5f5f5;
    padding: 15px;
    border-top: 1px solid #eee;
}

.share-text {
    margin: 0 0 10px;
    font-size: 0.9rem;
    color: #666;
}

.share-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.share-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: none;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: transform 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.share-btn:hover {
    transform: scale(1.1);
}

.facebook { background: #3b5998; }
.twitter { background: #1da1f2; }
.whatsapp { background: #25d366; }
.link {
    background: #9e9e9e;
    border-radius: 20px;
    width: auto;
    padding: 0 15px;
    font-size: 14px;
    gap: 5px;
}
.book-thumbnail {
    width: 150px;
    height: 200px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    overflow: hidden;
    background: #f5f5f5;
    position: relative;
}

.book-thumbnail img,
.book-thumbnail canvas {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

.default-thumbnail {
    text-align: center;
    color: #777;
    padding: 20px;
}

.default-thumbnail i {
    font-size: 40px;
    margin-bottom: 10px;
    display: block;
}

.default-thumbnail p {
    font-size: 12px;
    margin: 0;
}
<!-- Adicione este CSS no bloco <style> -->
.success-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    animation: fadeIn 0.3s ease;
    overflow-y: auto;
    padding: 20px 0;
}

.modal-content {
    background: white;
    border-radius: 10px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.2);
    overflow: hidden;
    margin: auto;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
}

.modal-body {
    padding: 20px;
    text-align: center;
    overflow-y: auto;
}

/* Corrige a altura do container da imagem para melhor visualização */
.book-thumbnail {
    width: 150px;
    height: 200px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    overflow: hidden;
    background: #f5f5f5;
    position: relative;
    border: 1px solid #e0e0e0;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Melhora a visualização da imagem/canvas */
.book-thumbnail img,
.book-thumbnail canvas {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain;
    display: block;
}

/* Corrige o problema de scroll dentro do modal */
body.modal-open {
    overflow: hidden;
}
    </style>
@endsection