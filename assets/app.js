// Слайдер
document.addEventListener('DOMContentLoaded', function() {
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
        dot.addEventListener('click', function() {
            currentIndex = index;
            updateSlider();
        });
    });
});

//Кнопка вверх

document.addEventListener('DOMContentLoaded', function() {
     let scrollTopBtn = document.getElementById("scrollTopBtn");

    window.addEventListener("scroll", function() {
        // Показать кнопку "Вверх" после прокрутки на определенную высоту страницы
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            scrollTopBtn.style.display = "block";
        } else {
            scrollTopBtn.style.display = "none";
        }
    });

    // Плавная прокрутка страницы вверх при нажатии на кнопку "Вверх"
    scrollTopBtn.addEventListener("click", function() {
        document.body.scrollTop = 0; // Для Safari
        document.documentElement.scrollTop = 0; // Для Chrome, Firefox, IE и Opera
    });
});

//Страница сравнения












