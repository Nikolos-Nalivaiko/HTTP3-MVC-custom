<?php

// Почитай про declare(strict_types=1) і додавай всюди :)

namespace App\Controllers;

use Core\View;
use Core\Request;
use Core\Response;
use App\Models\User;
use App\Models\Geo;
use App\Services\Validator;
use App\Services\Authenticator;
use App\Services\Session;

class AccountController
{
    // Не забувай вказувати типи своїх проперті. protected Model $userModel, або protected User $userModel
    // А чому ти використовуєш protected? В тебе від AccountController ніхто не спадкується, тобі достатньо private
    protected $userModel;
    protected $geoModel;
    protected $validator;
    protected $auth;
    protected $session;

    public function __construct(User $user, Geo $geo, Validator $validator, Authenticator $authenticator, Session $session)
    {
        $this->userModel = $user;
        $this->geoModel = $geo;
        $this->validator = $validator;
        $this->auth = $authenticator;
        $this->session = $session;
    }

    public function select(Request $request) // Не забувай вказувати тип який повертає метод. : string, : int, : Response, : View https://phpgrid.com/blog/time-to-use-php-return-types-in-your-code/
    {
        // Метод не повинен рендерити і помирати.
        // Він повинен повернути клас типу View, а самим відтворенням в тебе займеться Kernel, чи хто там.
        // Тому що ти хрєнак, вирішив десь встановити Listener, що якщо повертається вью - переписати це на другий формат.
        // І тепер не вьюшка летить, а JSON (буває)

        // В цілому, насправді, виглядає як дядьківський код, але тре доробити
        View::render('account/select', [
            'title' => 'HTTP - Profile select',
            'user' => $request->getBodyParam('user')
        ]);
    }

    // Як я помітив, в тебе один метод займається мінімум трьома задачами:
    // 1. Відображення сторінки реєстрації
    // 2. Сама реєстрація
    // 3. Завантаження картиночок
    // Це трошечки дохєра :) Варто або винести їх по окремим методам, або винести ці задачі в сервіси, хендлери, екшени і звідси тільки викликати ці сервіси
    public function signUpUser(Request $request, Response $response)
    {

        // $this->session->destroy();
        $userId = null; // Зайва змінна. Вона всюди перевизначається. Нема поінту де б вона використалась необ'явленою

        $rules = [
            'password' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'confirm' => ['required', 'min:2', 'max:30', 'no_special_chars', 'same:password'],
            'login' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'user_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'middle_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'last_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'email' => ['email'],
        ];

        // Якщо ти хочеш зробити єдиний метод для відображення і самої, власне, логіки регістрації - варто визначати це по методу (GET, POST), а не по полям
        if($request->getBodyParam('password'))
        {
            $data = $request->all();

            if(!$this->validator->validate($data, $rules))
            {
                return $response->setJsonContent($this->validator->getErrors());
            }

            if(!$this->auth->checkCredentials($data['password'], $data['login']))
            {
                $response->setStatusCode(422);
                return $response->setJsonContent('Sorry, bad credentials');
            }

            $userId = $this->auth->register($data);

            if (!$userId) {
                $response->setStatusCode(500);
                return $response->setJsonContent('Failed to create user');
            }

            // Якщо в реквесті були зображення - вони не будуть збережені.
            return $response->setJsonContent(['userId' => $userId]);
        }

        if($request->hasFile('images') && $request->getBodyParam('userId'))
        {
            $userId = $request->getBodyParam('userId');

            if (!isset($userId)) {
                $response->setStatusCode(400);
                return $response->setJsonContent('User ID is not defined');
            }

            foreach($request->files('images') as $image)
            {
                $photoPath = 'public/usersImages/' . $image['name'];
                if(move_uploaded_file($image['tmp_name'], $photoPath))
                {
                    $this->userModel->addImage($userId, $image['name']);
                } else {
                    $response->setStatusCode(400);
                    return $response->setJsonContent('Image not uploaded');
                }
            }
        }

        if($request->getBodyParam('region'))
        {
            return $response->setJsonContent($this->geoModel->getCities($request->getBodyParam('region')));
        }

        View::render('account/signUpUser', [
            'title' => 'HTTP - User sign-up',
            'regions' => $this->geoModel->getRegions(),
            'user' => $request->getBodyParam('user')
        ]);
    }

    public function signIn(Request $request, Response $response)
    {
        // $this->session->destroy();
        $rules = [
            'password' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'login' => ['required', 'min:2', 'max:30', 'no_special_chars'],

        ];

        if($request->getBodyParam('password'))
        {
            $data = $request->all();

            if(!$this->validator->validate($data, $rules))
            {
                return $response->setJsonContent($this->validator->getErrors());
            }

            if(!$this->auth->login($data['login'], $data['password']))
            {
                return $response->setJsonContent('Not auth');
            }

            if($request->getBodyParam('checkbox'))
            {
                $this->auth->remember($data['login']);
            }

            return $response->setJsonContent(true);
        }

        View::render('account/signIn', [
            'title' => 'HTTP - User sign-in',
            'user' => $request->getBodyParam('user')
        ]);
    }

}