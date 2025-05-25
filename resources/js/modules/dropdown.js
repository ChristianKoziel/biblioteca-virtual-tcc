// resources/js/modules/dropdown.js
export function initDropdown() {
    const avatar = document.getElementById('avatar');
    const dropdown = document.getElementById('dropdown');

    if (avatar && dropdown) {
        avatar.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.classList.toggle('hidden');
        });

        // Fechar ao clicar fora
        document.addEventListener('click', function() {
            dropdown.classList.add('hidden');
        });

        // Não fechar ao clicar no dropdown
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
}