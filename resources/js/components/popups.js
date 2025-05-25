

    // Função para abrir o popup principal (com animação)
    function openPopup(title, author, description, pdfPath, imagePath) {
    // Configurar o conteúdo
    document.getElementById('popup-title').textContent = title;
    document.getElementById('popup-author').textContent = `Por: ${author}`;
    document.getElementById('popup-description').textContent = description;
    document.getElementById('popup-image').src = imagePath;
    
    // Configurar os links de download
    const pdfLink = document.getElementById('popup-download-pdf');
    pdfLink.href = pdfPath;
    pdfLink.setAttribute('download', title + '.pdf');
    
    // Mostrar o popup com animação
    const popup = document.getElementById('book-popup');
    popup.classList.remove('hidden');
    
    // Pequeno efeito de entrada com setTimeout
    const popupContent = popup.querySelector('div');
    popupContent.style.opacity = '0';
    popupContent.style.transform = 'scale(0.95)';
    setTimeout(() => {
        popupContent.style.opacity = '1';
        popupContent.style.transform = 'scale(1)';
    }, 50);
}


    // Função para fechar o popup principal (com animação)
    function closePopup() {
        const popup = document.getElementById('book-popup');
        const popupContent = popup.querySelector('div');
        
        // Animar a saída
        popupContent.style.opacity = '0';
        popupContent.style.transform = 'scale(0.95)';
        
        // Esconder após a animação
        setTimeout(() => {
            popup.classList.add('hidden');
            // Resetar para a próxima abertura
            popupContent.style.opacity = '1';
            popupContent.style.transform = 'scale(1)';
        }, 200);
    }

    // Função para abrir o popup de EPUB em desenvolvimento (com animação)
    function openEpubDevPopup() {
        const popup = document.getElementById('epub-dev-popup');
        popup.classList.remove('hidden');
        
        // Adicionar efeitos de animação similares ao popup principal
        const popupContent = popup.querySelector('div');
        popupContent.style.opacity = '0';
        popupContent.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            popupContent.style.opacity = '1';
            popupContent.style.transform = 'scale(1)';
        }, 50);
    }

    // Função para fechar o popup de EPUB em desenvolvimento (com animação)
    function closeEpubDevPopup() {
        const popup = document.getElementById('epub-dev-popup');
        const popupContent = popup.querySelector('div');
        
        // Animar a saída
        popupContent.style.opacity = '0';
        popupContent.style.transform = 'scale(0.95)';
        
        // Esconder após a animação
        setTimeout(() => {
            popup.classList.add('hidden');
            // Resetar para a próxima abertura
            popupContent.style.opacity = '1';
            popupContent.style.transform = 'scale(1)';
        }, 200);
    }

    // Adicionar event listeners quando o DOM estiver carregado
    document.addEventListener('DOMContentLoaded', function() {
        // Fechar o popup principal quando clicar fora dele
        document.getElementById('book-popup').addEventListener('click', function(event) {
            if (event.target === this) {
                closePopup();
            }
        });
        
        // Fechar o popup de EPUB em desenvolvimento quando clicar fora dele
        document.getElementById('epub-dev-popup').addEventListener('click', function(event) {
            if (event.target === this) {
                closeEpubDevPopup();
            }
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
    // Toggle do menu mobile
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Toggle do dropdown do usuário
    const avatar = document.getElementById('avatar');
    const dropdown = document.getElementById('dropdown');

    if (avatar && dropdown) {
        avatar.addEventListener('click', function(event) {
            event.stopPropagation(); // Impede que o clique propague para o documento
            dropdown.classList.toggle('hidden');
        });

        // Fechar o dropdown ao clicar fora dele
        document.addEventListener('click', function(event) {
            if (!dropdown.contains(event.target) && !avatar.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }

    // Fechar o menu mobile ao clicar em um link
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            mobileMenu.classList.add('hidden');
        });
    });
});
