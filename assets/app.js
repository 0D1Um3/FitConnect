// Слайдер
document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    let items = document.querySelectorAll('.slider-item');
    let dots = document.querySelectorAll('.slider-dot');

    function updateSlider() {
        let targetX = -currentIndex * (100 / 1.5); /* 100 / 3 - процент ширины карточки */
        document.querySelector('.slider').style.transform = 'translateX(' + targetX + '%)';
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', function () {
            currentIndex = index;
            updateSlider();
        });
    });
});

//Кнопка вверх

document.addEventListener('DOMContentLoaded', function () {
    let scrollTopBtn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", function () {
        // Показать кнопку "Вверх" после прокрутки на определенную высоту страницы
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
        }
    });

    // Плавная прокрутка страницы вверх при нажатии на кнопку "Вверх"
    scrollTopBtn.addEventListener("click", function () {
        document.body.scrollTop = 0; // Для Safari
        document.documentElement.scrollTop = 0; // Для Chrome, Firefox, IE и Opera
    });
});

//поп ап профиля

document.addEventListener('DOMContentLoaded', (event) => {
    const accountButton = document.getElementById('accountButton');
    const collapseMenu = document.getElementById('collapseMenu');
    const arrowIcon = document.getElementById('arrowIcon');
    const catalogButton = document.getElementById('catalogButton');
    const cityButton = document.getElementById('cityButton');
    const catalogOverlay = document.getElementById('catalogOverlay');
    const cityOverlay = document.getElementById('cityOverlay');
    const body = document.body;

    // Function to open or close overlay
    function toggleOverlay(overlay) {
        if (overlay.style.display === 'block') {
            closeOverlay(overlay);
        } else {
            openOverlay(overlay);
        }
    }

    function openOverlay(overlay) {
        overlay.style.display = 'block';
        body.style.overflow = 'hidden';
    }

    function closeOverlay(overlay) {
        overlay.style.display = 'none';
        body.style.overflow = 'auto';
    }

    // Account dropdown handling
    accountButton.addEventListener('click', (e) => {
        e.preventDefault();
        collapseMenu.classList.toggle('show');
        arrowIcon.classList.toggle('rotate');
    });

    // Закрытие меню при клике вне его области
    document.addEventListener('click', (e) => {
        if (!accountButton.contains(e.target) && !collapseMenu.contains(e.target)) {
            collapseMenu.classList.remove('show');
            arrowIcon.classList.remove('rotate');
        }
    });

    // Handling overlay buttons
    catalogButton.addEventListener('click', function (e) {
        e.preventDefault();
        toggleOverlay(catalogOverlay);
    });

    cityButton.addEventListener('click', function (e) {
        e.preventDefault();
        toggleOverlay(cityOverlay);
    });

    // Close overlays when clicking outside of them
    catalogOverlay.addEventListener('click', function (e) {
        if (!catalogOverlay.querySelector('.overlay-content').contains(e.target)) {
            closeOverlay(catalogOverlay);
        }
    });

    cityOverlay.addEventListener('click', function (e) {
        if (!cityOverlay.querySelector('.overlay-content').contains(e.target)) {
            closeOverlay(cityOverlay);
        }
    });
});

//Отзывы



















