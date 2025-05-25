import { initDropdown } from './modules/dropdown';
import { initMobileMenu } from './modules/mobile-menu';
import { openBookPopup, closePopup } from './modules/popups';

// Inicialização
document.addEventListener('DOMContentLoaded', () => {
    initDropdown();
    initMobileMenu();
});

// Torna as funções globais
window.openBookPopup = openBookPopup;
window.closePopup = closePopup;

// Menu mobile (três riscos)
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            mobileMenu.classList.toggle('translate-y-0');
            mobileMenu.classList.toggle('opacity-100');
        });
        
        // Fechar menu ao clicar nos links
        const menuItems = mobileMenu.querySelectorAll('a, button');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
                mobileMenu.classList.remove('translate-y-0');
                mobileMenu.classList.remove('opacity-100');
            });
        });
    }
});