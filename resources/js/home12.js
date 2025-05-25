// resources/js/home12.js

// Exporte as funções que serão usadas no HTML
export function openPopup(title, author, description, pdfPath, imagePath) {
    // ... mantém todo o código atual da função ...
}

export function closePopup() {
    // ... mantém todo o código atual ...
}

export function openEpubDevPopup() {
    // ... mantém todo o código atual ...
}

export function closeEpubDevPopup() {
    // ... mantém todo o código atual ...
}

// Funções que não precisam ser chamadas do HTML podem ficar sem export
function setupEventListeners() {
    // Todo o código de event listeners que estava no DOMContentLoaded
    document.getElementById('book-popup')?.addEventListener('click', function(event) {
        if (event.target === this) {
            closePopup();
        }
    });
    
    // ... todos os outros event listeners ...
}

// Inicialização quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', setupEventListeners);