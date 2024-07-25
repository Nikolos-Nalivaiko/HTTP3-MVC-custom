<main class="main">
    <section class="sign-in section__new-page no-containerRight">
        <div class="sign-in__inner">
            <h2>Ласкаво просимо</h2>
            <p class="section__new-page-description">Ласкаво просимо в наш віртуальний світ, де можливості не мають меж,
                а співпраця – легка та захоплива</p>

            <form action="/sign-in" method="post" class="sign-in__form" id="signIn">

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
                        <p class="input__icon __icon-login"></p>
                        <div class="input__inner">
                            <label for="login" class="input__label">Введіть ваш логін</label>
                            <input type="text" name="login" id="login" class="input__input">
                        </div>
                    </div>
                    <span class="error-message"></span>
                </div>

                <label class="custom-checkbox">
                    <input name="checkbox" type="checkbox">
                    <span class="custom-checkbox__box"></span>
                    Запам’ятати мене
                </label>

                <button type="submit" class="sign-in__form-btn">Увійти</button>

                <a href="" class="sign-in__restore-btn">Відновити дані</a>

                <p class="sign-in__goToSignUp">Не маєте акаунту ? <a href="sign-up/select">Створіть його</a></p>
            </form>

        </div>
        <div class="sign-in__image"></div>
    </section>
</main>