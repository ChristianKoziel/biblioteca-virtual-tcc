export function openBookPopup(title, author, description, pdfUrl, imageUrl) {
    console.log('Tentando abrir popup com:', {title, author, description, pdfUrl, imageUrl});
    
    const popup = document.getElementById('book-popup');
    if (!popup) {
        console.error('Erro: Elemento book-popup não encontrado!');
        return;
    }

    // Preenche os dados
    const titleEl = document.getElementById('popup-title');
    const authorEl = document.getElementById('popup-author');
    const descEl = document.getElementById('popup-description');
    const imgEl = document.getElementById('popup-image');
    const downloadEl = document.getElementById('popup-download-pdf');

    if (!titleEl || !authorEl || !descEl || !imgEl || !downloadEl) {
        console.error('Erro: Elementos do popup não encontrados!');
        return;
    }

    titleEl.textContent = title;
    authorEl.textContent = `por ${author}`;
    descEl.textContent = description;
    imgEl.src = imageUrl;
    downloadEl.href = pdfUrl;

    // Mostra o popup
    popup.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

export function closePopup() {
    const popup = document.getElementById('book-popup');
    if (popup) popup.classList.add('hidden');
    document.body.style.overflow = 'auto';
}