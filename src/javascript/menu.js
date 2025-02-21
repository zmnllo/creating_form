document.addEventListener('DOMContentLoaded', function () {

    // Sélection des éléments
    const burgerBtn = document.querySelector('.burger-button');
    const menu = document.querySelector('.menu');
    console.log(burgerBtn);
    // Toggle du menu
    burgerBtn.addEventListener('click', () => {
        burgerBtn.classList.toggle('open');
        menu.classList.toggle('active');
    });

});