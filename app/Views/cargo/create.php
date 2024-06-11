<main class="main">
    <section class="sign-up main__section-page __container">
        <h2 class="main__headline">Новий вантаж</h2>
        <p class="main__subheadline">Вкажіть необхідні дані, визначте умови перевезення та отримайте доступ до
            широкого спектру транспортних рішень</p>

        <form class="sign-up__form" action="" onsubmit="event.preventDefault()" method="post"
            enctype="multipart/form-data">

            <div class="input__wrapper">
                <p class="input__icon __icon-cargo-name"></p>
                <div class="input__content">
                    <label for="cargo_name" class="input__label">Введіть назву товару</label>
                    <input type="text" id="cargo_name" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-weight"></p>
                <div class="input__content">
                    <label for="weight" class="input__label">Введіть вагу товару, кг</label>
                    <input type="number" id="weight" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="region" class="input__label">Оберіть область завантаження</label>
                    <select name="" id="region" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Полтавська область</option>
                        <option value="" class="input__option">Дніпропетровська область</option>
                        <option value="" class="input__option">Харківська область</option>
                        <option value="" class="input__option">Київська область</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="region" class="input__label">Оберіть місто завантаження</label>
                    <select name="" id="region" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Полтава</option>
                        <option value="" class="input__option">Дніпро</option>
                        <option value="" class="input__option">Харків</option>
                        <option value="" class="input__option">Київ</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="region" class="input__label">Оберіть область розвантаження</label>
                    <select name="" id="region" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Полтавська область</option>
                        <option value="" class="input__option">Дніпропетровська область</option>
                        <option value="" class="input__option">Харківська область</option>
                        <option value="" class="input__option">Київська область</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="region" class="input__label">Оберіть місто розвантаження</label>
                    <select name="" id="region" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Полтава</option>
                        <option value="" class="input__option">Дніпро</option>
                        <option value="" class="input__option">Харків</option>
                        <option value="" class="input__option">Київ</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-date"></p>
                <div class="input__content">
                    <label for="load_date" class="input__label">Оберіть дату завантаження</label>
                    <input type="date" id="load_date" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-date"></p>
                <div class="input__content">
                    <label for="unload_date" class="input__label">Оберіть дату розвантаження</label>
                    <input type="date" id="unload_date" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-type-body"></p>
                <div class="input__content">
                    <label for="body_type" class="input__label">Оберіть тип кузову</label>
                    <select name="body_type" id="body_type" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Тягач</option>
                        <option value="" class="input__option">Рефрижератор</option>
                        <option value="" class="input__option">Тентований</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-price"></p>
                <div class="input__content">
                    <label for="price" class="input__label">Введіть ціну перевезення, грн</label>
                    <input type="number" id="price" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-type-pay"></p>
                <div class="input__content">
                    <label for="body_type" class="input__label">Оберіть тип оплати</label>
                    <select name="body_type" id="body_type" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <option value="" class="input__option">Б/Р</option>
                        <option value="" class="input__option">Готівка</option>
                        <option value="" class="input__option">Криптовалюта</option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-distant"></p>
                <div class="input__content">
                    <label for="price" class="input__label">Введіть відстань перевезення, км</label>
                    <input type="number" id="price" class="input">
                </div>
            </div>

            <div class="input__wrapper input__wrapper--full-field">
                <p class="input__icon __icon-info-edit"></p>
                <div class="input__content">
                    <label for="price" class="input__label">Введіть опис товару</label>
                    <input type="text" id="price" class="input">
                </div>
            </div>

            <div class="input__checkbox-wrapper">
                <input type="checkbox" id="checkbox" class="input__checkbox">
                <label for="checkbox" class="input__checkbox-label">Терміновий вантаж</label>
            </div>

            <button type="submit" class="input__btn overlay--open">Додати вантаж</button>

        </form>
    </section>
</main>