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
                authModal.show();
                document.body.style.overflow = "hidden";

                const loginForm = document.getElementById("login-form");
                loginForm.addEventListener("submit", function(event) {
                    event.preventDefault();
                    submitForm(loginForm, "/login");
                });

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
                authModal.show();
                document.body.style.overflow = "hidden";

                const registerForm = document.querySelector("form[name='registration_form']");
                registerForm.addEventListener("submit", function(event) {
                    event.preventDefault();
                    submitForm(registerForm, "/register");
                });

                const openLoginModalBtn = document.getElementById("login-link");
                openLoginModalBtn.addEventListener("click", function(event) {
                    event.preventDefault();
                    loadLoginForm();
                });
            })
            .catch(error => console.error('Ошибка загрузки формы:', error));
    }

    function submitForm(form, url) {
        const formData = new FormData(form);
        fetch(url, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                modalContent.innerHTML = data;
                // Проверяем, если на странице снова форма, значит произошла ошибка валидации
                if (modalContent.querySelector("form")) {
                    authModal.show();
                    document.body.style.overflow = "hidden";
                } else {
                    authModal.hide();
                    document.body.style.overflow = "";
                    location.reload(); // Перезагружаем страницу для обновления состояния
                }
            })
            .catch(error => console.error('Ошибка отправки формы:', error));
    }

    if (openLoginModalBtn) {
        openLoginModalBtn.addEventListener("click", function(event) {
            event.preventDefault();
            loadLoginForm();
        });
    }
    authModal._element.addEventListener("click", function(event) {
        if (event.target === authModal._element || event.target.classList.contains("btn-close")) {
            authModal.hide();
            document.body.style.overflow = "";
        }
    });

    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape" && authModal._isShown) {
            authModal.hide();
            document.body.style.overflow = "";
        }
    });
});










