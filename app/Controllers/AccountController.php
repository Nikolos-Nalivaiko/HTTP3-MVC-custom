<?php

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

    public function select(Request $request)
    {
        View::render('account/select', [
            'title' => 'HTTP - Profile select',
            'user' => $request->getBodyParam('user')
        ]);
    }

    public function signUpUser(Request $request, Response $response)
    {

        // $this->session->destroy();
        $userId = null;

        $rules = [
            'password' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'confirm' => ['required', 'min:2', 'max:30', 'no_special_chars', 'same:password'],
            'login' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'user_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'middle_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'last_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'email' => ['email'],
        ];

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