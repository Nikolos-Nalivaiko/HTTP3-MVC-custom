<main class="main">
    <section class="sign-up section__new-page container">
        <h2>Реєстрація профілю</h2>
        <p class="section__new-page-description">Зареєструйтеся, щоб отримати доступ до безмежних можливостей у світі
            перевезень та оренди транспорту</p>

        <form action="/create/user" method="post" class="create__form" id="createUser">
            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-password"></p>
                    <div class="input__inner">
                        <label for="password" class="input__label">Введіть ваш пароль</label>
                        <input type="password" name="password" id="password"
                            class="input__input input__input--password">
                        <p class="input__icon--password __icon-eye"></p>
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-password"></p>
                    <div class="input__inner">
                        <label for="confirm" class="input__label">Повторіть ваш пароль</label>
                        <input type="password" name="confirm" id="confirm" class="input__input input__input--password">
                        <p class="input__icon--password __icon-eye"></p>
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-login"></p>
                    <div class="input__inner">
                        <label for="login" class="input__label">Введіть ваш логін</label>
                        <input type="text" name="login" id="login" class="input__input">
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-user-edit"></p>
                    <div class="input__inner">
                        <label for="username" class="input__label">Введіть ваше ім’я</label>
                        <input type="text" name="username" id="username" class="input__input">
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-user-edit"></p>
                    <div class="input__inner">
                        <label for="middlename" class="input__label">По-батькові</label>
                        <input type="text" name="middlename" id="middlename" class="input__input">
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input">
                <div class="input__wrapper">
                    <p class="input__icon __icon-user-edit"></p>
                    <div class="input__inner">
                        <label for="lastname" class="input__label">Введіть ваше прізвище</label>
                        <input type="text" name="lastname" id="lastname" class="input__input">
                    </div>
                </div>
                <span class="error-message"></span>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__inner">
                    <label for="region" class="input__label">Оберіть вашу область</label>
                    <select name="region" id="region" class="create__select">
                        <option value="Полтавська область" hidden selected class="create__option"></option>
                        <?php 
                        foreach($regions as $region) {
                            echo "<option value='$region' class='create__option'>$region</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-map"></p>
                <div class="input__inner">
                    <label for="city" class="input__label">Оберіть ваше місто</label>
                    <select name="city" id="city" class="create__select">
                        <option value="Полтавська область" hidden selected class="create__option"></option>
                    </select>
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-phone"></p>
                <div class="input__inner">
                    <label for="phone" class="input__label">Введіть ваш номер телефону</label>
                    <input type="text" name="phone" id="phone" class="input__input">
                </div>
            </div>

            <div class="input__wrapper">
                <p class="input__icon __icon-email"></p>
                <div class="input__inner">
                    <label for="email" class="input__label">Введіть ваш e-mail</label>
                    <input type="text" name="email" id="email" class="input__input">
                </div>
            </div>

            <label class="create__file">
                <input type="file" name="images[]" accept="image/png, image/jpeg, image/webp">
                <p class="create__file-icon __icon-upload"></p>
                <span class="create__file-label">Завантажте фото профілю</span>
            </label>

            <div class="create__images">
            </div>

            <button type="submit" class="create__form-btn">Зареєструватись</button>

        </form>

    </section>
</main>