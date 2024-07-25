<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/iconsfont.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title>Доступ заборонено</title>
</head>

<body>
    <div class="menu--mobile">
        <div class="menu--mobile__content __container">
            <ul class="menu--mobile__list">
                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-home"></p>
                        <a href="index.html" class="menu--mobile__link">Головна</a>
                    </li>
                </div>

                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-cargo-menu"></p>Вантажі
                    </li>
                    <div class="menu--mobile__subitem-wrap">
                        <li class="menu--mobile__subitem"><a href="cargos.html">Біржа вантажів</a></li>
                        <li class="menu--mobile__subitem"><a href="new-cargo.html">Додати вантаж</a></li>
                    </div>
                </div>

                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-cars-tab"></p>Транспорт
                    </li>
                    <div class="menu--mobile__subitem-wrap">
                        <li class="menu--mobile__subitem"><a href="cars.html">Біржа транспорту</a></li>
                        <li class="menu--mobile__subitem"><a href="new-car.html">Додати транспорт</a></li>
                    </div>
                </div>

            </ul>

            <div class="menu--mobile__footer">
                <!-- <a href="" class="navbar__user navbar__user--mobile">
                    <img class="navbar__user-image" src="img/user.jpg" alt="">
                    <div class="navbar__user-text">
                        <p class="navbar__user-subtitle">Фізична особа</p>
                        <p class="navbar__user-headline">Ковальчук О. І.</p>
                    </div>
                </a> -->
                <a class="navbar__item-btn menu--mobile__footer-btn navbar__item" href="/sign-in">Увійти</a>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <header class="header">
            <div class="__container header__wrapper">
                <a href=""><img class="navbar__logo" src="/public/img/logo.svg"></a>
                <nav class="navbar">
                    <ul class="navbar__list">
                        <li class="navbar__item"><a href="/">Головна</a></li>
                        <li class="navbar__item navbar__dropdown-container">
                            <p class="navbar__dropdown-headline">Вантажі</p>
                            <div class="navbar__dropdown-content">
                                <a href="/cargos">Біржа вантажів</a>
                                <a href="/cargo/create">Додати вантаж</a>
                            </div>
                        </li>
                        <li class="navbar__item navbar__dropdown-container">
                            <p class="navbar__dropdown-headline">Транспорт</p>
                            <div class="navbar__dropdown-content">
                                <a href="cars.html">Біржа транспорту</a>
                                <a href="new-car.html">Додати транспорт</a>
                            </div>
                        </li>
                        <li class="navbar__item"><a class="navbar__item-btn" href="/account/sign-in">Увійти</a></li>
                        <!-- <a href="" class="navbar__user">
                            <img class="navbar__user-image" src="img/user.jpg" alt="">
                            <div class="navbar__user-text">
                                <p class="navbar__user-subtitle">Фізична особа</p>
                                <p class="navbar__user-headline">Ковальчук О. І.</p>
                            </div>
                        </a> -->
                    </ul>
                </nav>
                <p class="navbar__menu-start __icon-menu "></p>
            </div>
        </header>

        <main class="main">
            <section class="no-access main__section-page __left-container">
                <div class="no-access__text">
                    <h2>Авторизуйтесь або створіть профіль</h2>
                    <p class="no-access__description">Авторизація дозволить вам користуватися всіма перевагами нашої
                        платформи
                        та мати можливість налаштувати персоналізовані параметри.</p>
                    <a href="/sign-in" class="no-access__btn">Увійти</a>
                    <a href="/sign-up/select" class="no-access__btn">Створити профіль</a>
                </div>
                <div class="no-access__image"></div>
            </section>
        </main>

        <footer class="footer">
            <div class="footer__wrapper __container">
                <div class="footer__left">
                    <a href=""><img class="navbar__logo" src="/public/img/logo.svg"></a>
                    <p class="footer__copyright">2024 © HTTP-Logistic Service</p>
                </div>

                <div class="footer__right">
                    <ul class="footer__list">
                        <li class="footer__item-head"><a href="">Головна</a></li>
                        <li class="footer__item"><a href="">Правила платформи</a></li>
                        <li class="footer__item"><a href="">Політика конфіденційності</a></li>
                    </ul>

                    <ul class="footer__list">
                        <li class="footer__item-head">Вантажі</li>
                        <li class="footer__item"><a href="">Біржа вантажів</a></li>
                        <li class="footer__item"><a href="">Додати вантаж</a></li>
                    </ul>

                    <ul class="footer__list">
                        <li class="footer__item-head">Транспорт</li>
                        <li class="footer__item"><a href="">Біржа транспорту</a></li>
                        <li class="footer__item"><a href="">Додати транспорт</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>