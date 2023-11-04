document.addEventListener('DOMContentLoaded', () => {
    eventListeners();
});

// Mobile Menu
function eventListeners() {
    const mobileMenu = document.querySelector('.mobile-menu');
    mobileMenu.addEventListener('click', responsiveMenu);
}

function responsiveMenu() {
    console.log('click');
    const navigation = document.querySelector('.navigation');
    navigation.classList.toggle('show');
}