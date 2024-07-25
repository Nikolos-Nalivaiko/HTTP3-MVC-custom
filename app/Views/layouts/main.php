<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.min.css?_v=20240710224117">
    <link rel="stylesheet" href="/files/iconsfont.css?_v=20240710224117">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css?_v=20240710224117" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js?_v=20240710224117"></script>
    <title><?= $title ?></title>
</head>

<body>

    <div class="popup__overlay popup__overlay--success">
        <div class="popup">
            <p class="popup__icon popup__icon--success __icon-success"></p>
            <p class="popup__headline">Профіль створено</p>
            <p class="popup__description">Ваш профіль було успішно створено</p>
            <p class="popup__btn">Закрити</p>
        </div>
    </div>
    
    <div class="popup__overlay popup__overlay--error">
        <div class="popup">
            <p class="popup__icon popup__icon--error __icon-error"></p>
            <p class="popup__headline">Виникла помилка</p>
            <p class="popup__description">Будь ласка, перевірте введені дані</p>
            <p class="popup__btn">Закрити</p>
        </div>
    </div>

    <div class="wrapper">
        <header class="header">
            <div class="header__inner container">
                <a href="index.html"><img src="/img/logo.svg" class="logo" alt="logo"></a>

                <nav class="navbar">
                    <ul class="navbar__menu">
                        <li class="navbar__menu-item">
                            <a href="index.html" class="navbar__menu-link">Головна</a>
                        </li>
                        <li class="navbar__menu-item dropdown">
                            <p class="navbar__menu-link">Вантажі</p>
                            <ul class="navbar__menu-dropdown">
                                <li class="navbar__menu-dropdown-item"><a href="cargos.html"
                                        class="navbar__menu-dropdown-link">Біржа вантажів</a></li>
                                <li class="navbar__menu-dropdown-item"><a href="create-cargo.html"
                                        class="navbar__menu-dropdown-link">Додати вантаж</a></li>
                            </ul>
                        </li>
                        <li class="navbar__menu-item dropdown">
                            <p class="navbar__menu-link">Транспорт</p>
                            <ul class="navbar__menu-dropdown">
                                <li class="navbar__menu-dropdown-item"><a href="cars.html"
                                        class="navbar__menu-dropdown-link">Біржа транспорту</a></li>
                                <li class="navbar__menu-dropdown-item"><a href="create-car.html"
                                        class="navbar__menu-dropdown-link">Додати транспорт</a></li>
                            </ul>
                        </li>
                        <li class="navbar__menu-item">
                            <?php
                            if($user)
                            {
                                echo "<a href='/profile' class='navbar__btn'>Профіль</a>";
                            } else
                            {
                                echo "<a href='/sign-in' class='navbar__btn'>Увійти</a>";
                            }
                            ?>
                        </li>
                    </ul>
                </nav>

                <p class="navbar__menu--mobile"></p>
            </div>
        </header>

        <?= $content ?>

        <footer class="footer">
            <div class="footer__inner container">
                <div class="footer__logo-wrapper">
                    <a href=""><img src="/img/logo.svg" alt="footer-logo" class="footer__logo logo"></a>
                    <p class="footer__copyright">2024 © HTTP-Logistic Service</p>
                </div>

                <div class="footer__navbar">
                    <ul class="footer__navbar-list">
                        <li class="footer__navbar-item--main">Головна</li>
                        <li class="footer__navbar-item"><a href="rules.html">Правила платформи</a></li>
                        <li class="footer__navbar-item"><a href="policy.html">Політика конфіденційності</a></li>
                    </ul>
                    <ul class="footer__navbar-list">
                        <li class="footer__navbar-item--main">Вантажі</li>
                        <li class="footer__navbar-item"><a href="cargos.html">Біржа вантажів</a></li>
                        <li class="footer__navbar-item"><a href="create-cargo.html">Додати вантаж</a></li>
                    </ul>
                    <ul class="footer__navbar-list">
                        <li class="footer__navbar-item--main">Транспорт</li>
                        <li class="footer__navbar-item"><a href="cars.html">Біржа транспорту</a></li>
                        <li class="footer__navbar-item"><a href="create-car.html">Додати транспорт</a></li>
                    </ul>
                </div>

            </div>
        </footer>
    </div>
    <!-- <script src="/js/app.min.js?_v=20240710224117"></script> -->
    <script type="module" src="/js/app.js?_v=20240710221905"></script>
</body>

</html>