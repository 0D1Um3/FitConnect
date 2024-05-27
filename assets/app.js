// Слайдер
document.addEventListener('DOMContentLoaded', function () {
    let currentIndex = 0;
    let items = document.querySelectorAll('.slider-item');
    let dots = document.querySelectorAll('.slider-dot');

    let startX = 0;
    let endX = 0;

    function updateSlider() {
        let targetX = -currentIndex * (100 / 1.5); /* 100 / 1.5 - процент ширины карточки */
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

    // Add touch events
    let slider = document.querySelector('.slider-container');

    slider.addEventListener('touchstart', function (event) {
        startX = event.touches[0].clientX;
    });

    slider.addEventListener('touchmove', function (event) {
        endX = event.touches[0].clientX;
    });

    slider.addEventListener('touchend', function (event) {
        let diffX = startX - endX;

        if (diffX > 50) { // Swipe left
            if (currentIndex < items.length - 1) {
                currentIndex++;
                updateSlider();
            }
        } else if (diffX < -50) { // Swipe right
            if (currentIndex > 0) {
                currentIndex--;
                updateSlider();
            }
        }
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

    // Функция для закрытия и открытия оверлея
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

    // Проверка существования элементов перед добавлением обработчиков
    if (accountButton && collapseMenu && arrowIcon) {
        // Обработка выпадающего меню аккаунта
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
    }

    if (catalogButton && catalogOverlay) {
        // Обработка кнопок оверлея
        catalogButton.addEventListener('click', function (e) {
            e.preventDefault();
            toggleOverlay(catalogOverlay);
        });

        // Закрытие оверлея при клике вне его области
        catalogOverlay.addEventListener('click', function (e) {
            if (!catalogOverlay.querySelector('.overlay-content').contains(e.target)) {
                closeOverlay(catalogOverlay);
            }
        });
    }

    if (cityButton && cityOverlay) {
        cityButton.addEventListener('click', function (e) {
            e.preventDefault();
            toggleOverlay(cityOverlay);
        });

        // Закрытие оверлея при клике вне его области
        cityOverlay.addEventListener('click', function (e) {
            if (!cityOverlay.querySelector('.overlay-content').contains(e.target)) {
                closeOverlay(cityOverlay);
            }
        });
    }
});























