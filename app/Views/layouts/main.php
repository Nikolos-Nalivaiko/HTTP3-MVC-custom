<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/iconsfont.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <title><?= $title ?></title>
</head>

<body>

    <div class="overlay-rules" id="rules">
        <div class="overlay-rules__body">
            <p class="overlay-rules__title">Вас вітає платформа HTTP - Logistic service</p>
            <p class="overlay-rules__subtitle">Наша веб-платформа — це місце, де кожен крок і дія важливі. Ми докладаємо
                максимум зусиль, щоб забезпечити зручність, надійність та безпеку наших користувачів. Тому, ми розробили
                спеціальні правила використання, які допомагають створити відмінне враження та забезпечити комфортну
                взаємодію для всіх.</p>
            <div class="overlay-rules__btns">
                <p class="overlay-rules__btn overlay-rules__btn--accept">Згоден з правилами</p>
                <a href="" class="overlay-rules__btn">Переглянути правила</a>
            </div>
        </div>
    </div>

    <div class="overlay overlay--success">
        <div class="overlay__body">
            <p class="overlay__icon overlay__icon--success __icon-success"></p>
            <p class="overlay__headline">Профіль створено</p>
            <p class="overlay__description">Ваш профіль було успішно створено</p>
            <p class="overlay__btn overlay__close">Закрити</p>
        </div>
    </div>

    <div class="overlay overlay--warning">
        <div class="overlay__body">
            <p class="overlay__icon overlay__icon--warning __icon-warning"></p>
            <p class="overlay__headline">Видалити вантаж ?</p>
            <p class="overlay__description">Процес, який призведе до видалення всіх даних</p>
            <div class="overlay__wrap-btn--warning">
                <p class="overlay__btn overlay__btn--warning overlay__close">Закрити</p>
                <p class="overlay__btn overlay__btn--warning overlay__delete">Видалити</p>
            </div>
        </div>
    </div>

    <div class="overlay overlay--error">
        <div class="overlay__body">
            <p class="overlay__icon overlay__icon-error __icon-close"></p>
            <p class="overlay__headline">Виникла помилка</p>
            <p class="overlay__description">Будь ласка, перевірте введені дані</p>
            <p class="overlay__btn overlay__close">Закрити</p>
        </div>
    </div>

    <div class="menu--mobile">
        <div class="menu--mobile__content __container">
            <ul class="menu--mobile__list">
                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-home"></p>
                        <a href="/" class="menu--mobile__link">Головна</a>
                    </li>
                </div>

                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-cargo-menu"></p>Вантажі
                    </li>
                    <div class="menu--mobile__subitem-wrap">
                        <li class="menu--mobile__subitem"><a href="/cargos/1">Біржа вантажів</a></li>
                        <li class="menu--mobile__subitem"><a href="/cargo/create">Додати вантаж</a></li>
                    </div>
                </div>

                <div class="menu--mobile__block">
                    <li class="menu--mobile__item">
                        <p class="menu--mobile__icon __icon-cars-tab"></p>Транспорт
                    </li>
                    <div class="menu--mobile__subitem-wrap">
                        <li class="menu--mobile__subitem"><a href="/cars/1">Біржа транспорту</a></li>
                        <li class="menu--mobile__subitem"><a href="/car/create">Додати транспорт</a></li>
                    </div>
                </div>

            </ul>

            <div class="menu--mobile__footer">
                <a class="navbar__item-btn menu--mobile__footer-btn navbar__item" href="sign-in.html">Увійти</a>
            </div>
        </div>
    </div>
    <!-- 
    <div class="load-page">
        <div class="load-page__body">
            <div class="loader"></div>
        </div>
    </div> -->

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
                                <a href="/cargos/1">Біржа вантажів</a>
                                <a href="/cargo/create">Додати вантаж</a>
                            </div>
                        </li>
                        <li class="navbar__item navbar__dropdown-container">
                            <p class="navbar__dropdown-headline">Транспорт</p>
                            <div class="navbar__dropdown-content">
                                <a href="/cars/1">Біржа транспорту</a>
                                <a href="/car/create">Додати транспорт</a>
                            </div>
                        </li>
                        <?php
                        if($user)
                        {
                        ?>
                        <a href="/account/profile" class="navbar__user">
                            <img class="navbar__user-image" src="/public/usersImages/<?= $user['image']?>"
                                alt="user_image">
                            <div class="navbar__user-text">
                                <p class="navbar__user-subtitle"><?= $user['type'] ?></p>
                                <p class="navbar__user-headline"><?= $user['last_name'] ?> <?= $user['user_name'] ?>
                                    <?= $user['middle_name'] ?></p>
                            </div>
                        </a>
                        <?php
                        } else
                        {
                            echo '<li class="navbar__item"><a class="navbar__item-btn" href="/sign-in">Увійти</a></li>';
                        }
                        ?>
                    </ul>
                </nav>
                <p class="navbar__menu-start __icon-menu "></p>
            </div>
        </header>

        <?= $content ?>

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
    <script type="text/javascript" src="/public/js/script.js"></script>
    <script type="text/javascript" src="/public/js/jquery.mask.min.js"></script>
    <script>
    phoneMask();
    userSignUpValidateForm('.sign-up__form', '/sign-up/user');
    logInValidate('.sign-in__form', '/sign-in');
    fileView('.sign-up__form');
    RegionChange('#region', '#city', '/sign-up/user');
    visiblePass();
    </script>
</body>

</html>