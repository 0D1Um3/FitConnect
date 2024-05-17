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


//Окна авторизации и регистрации

document.addEventListener("DOMContentLoaded", function() {
    const openLoginModalBtn = document.getElementById("open-login-modal");
    const authModal = new bootstrap.Modal(document.getElementById('auth-modal'));
    const modalContent = document.getElementById("modal-content");

    function loadLoginForm() {
        fetch("/login")
            .then(response => response.text())
            .then(data => {
                modalContent.innerHTML = data;
                authModal.show(); // Отображаем модальное окно
                document.body.style.overflow = "hidden"; // Запрещаем прокрутку фона при открытом модальном окне

                // Добавляем обработчик события после загрузки формы
                const openRegistrModalBtn = document.getElementById("reg-link");
                openRegistrModalBtn.addEventListener("click", function(event) {
                    event.preventDefault();
                    loadRegistrationForm();
                });
            })
            .catch(error => console.error('Ошибка загрузки формы:', error));
    }

    function loadRegistrationForm() {
        fetch("/register")
            .then(response => response.text())
            .then(data => {
                modalContent.innerHTML = data;
                authModal.show(); // Отображаем модальное окно
                document.body.style.overflow = "hidden"; // Запрещаем прокрутку фона при открытом модальном окне

                // Добавляем обработчик события после загрузки формы
                const openLoginModalBtn = document.getElementById("login-link");
                openLoginModalBtn.addEventListener("click", function(event) {
                    event.preventDefault();
                    loadLoginForm();
                });
            })
            .catch(error => console.error('Ошибка загрузки формы:', error));
    }

    openLoginModalBtn.addEventListener("click", function(event) {
        event.preventDefault();
        loadLoginForm();
    });

    // Закрытие модального окна при клике на кнопку закрытия или вне модального окна
    authModal._element.addEventListener("click", function(event) {
        if (event.target === authModal._element || event.target.classList.contains("btn-close")) {
            authModal.hide(); // Скрываем модальное окно
            document.body.style.overflow = ""; // Восстанавливаем прокрутку фона
        }
    });

    // Дополнительно можно добавить закрытие модального окна при нажатии на клавишу Escape
    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape" && authModal._isShown) {
            authModal.hide(); // Скрываем модальное окно
            document.body.style.overflow = ""; // Восстанавливаем прокрутку фона
        }
    });
});








