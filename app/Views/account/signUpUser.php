<main class="main">
    <section class="sign-up main__section-page __container">
        <h2 class="main__headline">Реєстрація профілю</h2>
        <p class="main__subheadline">Зареєструйтеся, щоб отримати доступ до безмежних можливостей у світі
            перевезень та оренди транспорту</p>

        <form class="sign-up__form" action="" onsubmit="event.preventDefault()" method="post"
            enctype="multipart/form-data">

            <div class="input__wrapper">
                <p class="input__icon __icon-pass"></p>
                <p class="input__icon-visible __icon-visible_pass"></p>
                <div class="input__content">
                    <label for="pass" class="input__label">Введіть ваш пароль</label>
                    <input type="password" name="password" id="password" class="input input--password">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-pass"></p>
                <p class="input__icon-visible __icon-visible_pass"></p>
                <div class="input__content">
                    <label for="confirm" class="input__label">Повторіть ваш пароль</label>
                    <input type="password" name="confirm" id="confirm" class="input input--password">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-login"></p>
                <div class="input__content">
                    <label for="login" class="input__label">Введіть ваш логін</label>
                    <input type="text" name="login" id="login" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-user-edit"></p>
                <div class="input__content">
                    <label for="user_name" class="input__label">Введіть ваше ім’я</label>
                    <input type="text" name="user_name" id="user_name" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-user-edit"></p>
                <div class="input__content">
                    <label for="middle_name" class="input__label">По-батькові</label>
                    <input type="text" name="middle_name" id="middle_name" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-user-edit"></p>
                <div class="input__content">
                    <label for="last_name" class="input__label">Введіть ваше прізвище</label>
                    <input type="text" name="last_name" id="last_name" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="region" class="input__label">Оберіть вашу область</label>
                    <select name="region" id="region" class="input input__select">
                        <option value="" disabled selected hidden class="input__option"></option>
                        <?php 
                        foreach($regions as $region) {
                            echo "<option value='$region' class='input__option'>$region</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__content">
                    <label for="city" class="input__label">Оберіть ваше місто</label>
                    <select name="city" id="city" class="input input__select">
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-phone"></p>
                <div class="input__content">
                    <label for="phone" class="input__label">Введіть ваш номер телефону</label>
                    <input type="text" name="phone" id="phone" class="input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-mail"></p>
                <div class="input__content">
                    <label for="email" class="input__label">Введіть ваш e-mail</label>
                    <input type="email" name="email" id="email" class="input">
                </div>
            </div>

            <div class="file__wrapper">
                <label for="file" class="file__label">
                    <p class="file__icon __icon-upload"></p>
                    Завантажте фото профілю
                </label>
                <input type="file" id="file" name="images[]" class="file" accept="image/png, image/jpeg, image/webp">
            </div>

            <div class="input__images">
            </div>

            <button type="submit" class="input__btn overlay--open">Зареєструватись</button>

        </form>

    </section>
</main>