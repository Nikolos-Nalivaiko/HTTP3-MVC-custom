<!-- <?php

use Core\View;

View::setLayout('main');

?> -->

<main class="main">
    <section class="offer no-containerRight">
        <div class="offer__text">
            <h1 class="offers__block-headline">Відправляйся в подорож з нами</h1>
            <p class="offer__description">Інноваційний сервіс, який забезпечує ефективне та комфортне планування
                маршрутів, відкриваючи нові горизонти для ваших подорожей</p>
            <div class="offer__btn-wrapper">
                <a href="" class="offer__btn">Для фізичних осіб</a>
                <a href="" class="offer__btn">Для підприємців</a>
            </div>
        </div>
        <div class="offer__image"></div>
    </section>

    <section class="section service container">
        <h2 class="section__headline">Наші послуги</h2>
        <p class="section__description">Ми пропонуємо вам не просто послуги, а найвищий ступінь задоволення ваших
            очікувань</p>
        <div class="service__blocks">
            <div class="service__block">
                <p class="service__block-icon __icon-cargo"></p>
                <h4 class="service__block-headline">Новий вантаж</h4>
                <p class="service__block-description">Маєте власний вантаж але не знаете як його перевезти? Просто
                    додайте вантаж та очікуйте на відповід</p>
                <a href="create-cargo.html" class="service__block-btn __icon-right-arrow-slider">Додати вантаж</a>
            </div>

            <div class="service__block">
                <p class="service__block-icon __icon-cargo-check"></p>
                <h4 class="service__block-headline">Біржа вантажів</h4>
                <p class="service__block-description">Маєте власний транспорт але не знаете де знайти вантаж? Наша біржа
                    допоможе вам з цим питанням</p>
                <a href="cargos.html" class="service__block-btn __icon-right-arrow-slider">Біржа вантажів</a>
            </div>

            <div class="service__block">
                <p class="service__block-icon __icon-truck-list"></p>
                <h4 class="service__block-headline">Новий транспорт</h4>
                <p class="service__block-description">Хочете здавати транспорт в аренду? Просто додайте його на нашу
                    платформу та очікуйте клієнтів</p>
                <a href="create-car.html" class="service__block-btn __icon-right-arrow-slider">Додати транспорт</a>
            </div>

            <div class="service__block">
                <p class="service__block-icon __icon-truck-new"></p>
                <h4 class="service__block-headline">Біржа транспорту</h4>
                <p class="service__block-description">Хочете знайти транспорт в аренду? Наша транспортна біржа допоможе
                    з цим питанням</p>
                <a href="cars.html" class="service__block-btn __icon-right-arrow-slider">Біржа транспорту</a>
            </div>
        </div>
    </section>

    <section class="section about container">
        <div class="section__header">
            <div class="section__header-text">
                <h2 class="section__headline">Для кого підходить</h2>
                <p class="section__description">Наша платформа - це універсальний інструмент для всіх, хто цінує
                    зручність та ефективність</p>
            </div>

            <div class="section__header-arrows">
                <p class="section__header-arrow __icon-left-arrow-slider about__prev"></p>
                <p class="section__header-arrow __icon-right-arrow-slider about__next"></p>
            </div>
        </div>

        <swiper-container class="about__swiper" space-between="15" speed="900" navigation-next-el=".about__next"
            navigation-prev-el=".about__prev">
            <swiper-slide class="about__swiper-slide">
                <div class="about__swiper-slide-text">
                    <p class="about__swiper-headline">Водіям</p>
                    <p class="about__swiper-description">Забезпечує швидкий пошук та додаткові можливості для водіїв у
                        логістичній сфері перевезень</p>
                </div>
            </swiper-slide>
            <swiper-slide class="about__swiper-slide">
                <div class="about__swiper-slide-text">
                    <p class="about__swiper-headline">Фізичним особам</p>
                    <p class="about__swiper-description">Спрощує організацію перевезень, дозволяючи швидко знаходити
                        вантаж або транспорт</p>
                </div>
            </swiper-slide>
            <swiper-slide class="about__swiper-slide">
                <div class="about__swiper-slide-text">
                    <p class="about__swiper-headline">Підприємствам</p>
                    <p class="about__swiper-description">Сприяє ефективному управлінню логістикою, знаходить швидкі та
                        вигідні перевезення або транспорт</p>
                </div>
            </swiper-slide>
        </swiper-container>
    </section>

    <section class="section container reviews">
        <div class="section__header">
            <div class="section__header-text">
                <h2 class="section__headline">Відгуки про платформу</h2>
                <p class="section__description">Відгуки про користувача – це не просто слова, а реальні враження та
                    досвід</p>
            </div>

            <div class="section__header-arrows">
                <p class="section__header-arrow __icon-left-arrow-slider reviews__prev"></p>
                <p class="section__header-arrow __icon-right-arrow-slider reviews__next"></p>
            </div>
        </div>

        <swiper-container class="reviews__slider" navigation-next-el=".reviews__next"
            navigation-prev-el=".reviews__prev" init="false">
            <swiper-slide>
                <div class="reviews__block">
                    <div class="reviews__block-header">
                        <div class="reviews__block-user">
                            <picture>
                                <source srcset="img/userImage.webp" type="image/webp"><img src="img/userImage.jpg"
                                    alt="" class="reviews__block-image">
                            </picture>
                            <div class="reviews__block-text">
                                <p class="reviews__block-name">Ковальчук О. І.</p>
                                <p class="reviews__block-type">Фізична особа</p>
                            </div>
                        </div>
                        <p class="reviews__block-rating __icon-star-fill">4,8</p>
                    </div>
                    <p class="reviews__block-description">
                        Наша компанія з великим задоволенням використовує логічну платформу для організації перевезень.
                        Цей інноваційний інструмент дозволяє нам ефективно керувати нашим транспортним парком та
                        знаходити оптимальні маршрути для доставки вантажів. Легка навігація, надійність та зручність
                        взаємодії з іншими учасниками ринку роблять цю платформу незамінною для наших потреб.
                    </p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="reviews__block">
                    <div class="reviews__block-header">
                        <div class="reviews__block-user">
                            <picture>
                                <source srcset="img/userImage.webp" type="image/webp"><img src="img/userImage.jpg"
                                    alt="" class="reviews__block-image">
                            </picture>
                            <div class="reviews__block-text">
                                <p class="reviews__block-name">Ковальчук О. І.</p>
                                <p class="reviews__block-type">Фізична особа2</p>
                            </div>
                        </div>
                        <p class="reviews__block-rating __icon-star-fill">4,8</p>
                    </div>
                    <p class="reviews__block-description">
                        Наша компанія з великим задоволенням використовує логічну платформу для організації перевезень.
                        Цей інноваційний інструмент дозволяє нам ефективно керувати нашим транспортним парком та
                        знаходити оптимальні маршрути для доставки вантажів. Легка навігація, надійність та зручність
                        взаємодії з іншими учасниками ринку роблять цю платформу незамінною для наших потреб.
                    </p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="reviews__block">
                    <div class="reviews__block-header">
                        <div class="reviews__block-user">
                            <picture>
                                <source srcset="img/userImage.webp" type="image/webp"><img src="img/userImage.jpg"
                                    alt="" class="reviews__block-image">
                            </picture>
                            <div class="reviews__block-text">
                                <p class="reviews__block-name">Ковальчук О. І.</p>
                                <p class="reviews__block-type">Фізична особа3</p>
                            </div>
                        </div>
                        <p class="reviews__block-rating __icon-star-fill">4,8</p>
                    </div>
                    <p class="reviews__block-description">
                        Наша компанія з великим задоволенням використовує логічну платформу для організації перевезень.
                        Цей інноваційний інструмент дозволяє нам ефективно керувати нашим транспортним парком та
                        знаходити оптимальні маршрути для доставки вантажів. Легка навігація, надійність та зручність
                        взаємодії з іншими учасниками ринку роблять цю платформу незамінною для наших потреб.
                    </p>
                </div>
            </swiper-slide>
            <swiper-slide>
                <div class="reviews__block">
                    <div class="reviews__block-header">
                        <div class="reviews__block-user">
                            <picture>
                                <source srcset="img/userImage.webp" type="image/webp"><img src="img/userImage.jpg"
                                    alt="" class="reviews__block-image">
                            </picture>
                            <div class="reviews__block-text">
                                <p class="reviews__block-name">Ковальчук О. І.</p>
                                <p class="reviews__block-type">Фізична особа4</p>
                            </div>
                        </div>
                        <p class="reviews__block-rating __icon-star-fill">4,8</p>
                    </div>
                    <p class="reviews__block-description">
                        Наша компанія з великим задоволенням використовує логічну платформу для організації перевезень.
                        Цей інноваційний інструмент дозволяє нам ефективно керувати нашим транспортним парком та
                        знаходити оптимальні маршрути для доставки вантажів. Легка навігація, надійність та зручність
                        взаємодії з іншими учасниками ринку роблять цю платформу незамінною для наших потреб.
                    </p>
                </div>
            </swiper-slide>
        </swiper-container>
    </section>

</main>