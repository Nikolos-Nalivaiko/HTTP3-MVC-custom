<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\View;
use Core\Request;
use Core\Response;
use App\Services\Validator;
use App\Services\Authenticator;
use App\Services\RegistrationService;
use App\Services\CredentionalsVerificationService;
use App\Services\GeoService;
use App\Services\ImagesService;

class AccountController
{
    private GeoService $geo;
    private Validator $validator;
    private Authenticator $auth;
    private RegistrationService $register;
    private CredentionalsVerificationService $verify;
    private ImagesService $image;

    public function __construct(GeoService $geo, Validator $validator, Authenticator $authenticator, RegistrationService $register, CredentionalsVerificationService $verify, ImagesService $image)
    {
        $this->geo = $geo;
        $this->validator = $validator;
        $this->auth = $authenticator;
        $this->register = $register;
        $this->verify = $verify;
        $this->image = $image;
    }

    public function select(Request $request)
    {

        return View::view('account/select', [
            'title' => 'HTTP - Profile select',
            'user' => $request->getBodyParam('user') 
        ]);
    }

    public function showSignUpUser(Request $request, Response $response)
    {

        if($request->getBodyParam('region'))
        {
            return $response->setJsonContent($this->geo->getCities($request->getBodyParam('region')));
        }

        return View::view('account/signUpUser', [
            'title' => 'HTTP - Sign-Up User',
            'regions' => $this->geo->getRegions(),
            'user' => $request->getBodyParam('user') 
        ]);

    }

    public function registerUser(Request $request, Response $response)
    {

        if($request->getMethod() == 'POST')
        {
            $data = $request->all();

            $rules = [
            'password' => ['required', 'min:4', 'max:15', 'no_special_chars'],
            'confirm' => ['required', 'min:2', 'max:30', 'no_special_chars', 'same:password'],
            'login' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'user_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'middle_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'last_name' => ['required', 'min:2', 'max:30', 'no_special_chars'],
            'email' => ['email'],
            ];

            if(!$this->validator->validate($data, $rules))
            { 
                return $response->setJsonContent([
                    'status' => false,
                    'message' => $this->validator->getFirstError()
                ]);
            }

            if($this->verify->verifyPassword($data['password'], $data['login']))
            {
                return $response->setJsonContent([
                    'status' => false,
                    'message' => 'Такий логін вже існує'
                ]);
            }

            $data['type'] = 'user';

            $userId = $this->register->register($data);

            if($userId)
            {
                return $response->setJsonContent([
                    'status' => true,
                    'userId' => $userId,
                    'message' => 'Профіль успішно створено'
                ]);
            } else
            {
                return $response->setJsonContent([
                    'status' => false,
                    'message' => 'Не вдалося зареєструвати користувача'
                ]);   
            }
        }

    }

    public function uploadImageUser(Request $request, Response $response)
    {
        if($request->getMethod() == 'POST')
        {
            $userId = (int) $request->getBodyParam('userId');

            if (!$userId) {
                return $response->setJsonContent([
                    'status' => false,
                    'message' => 'Немає ID користувача' 
                ]);
            }

            if($request->hasFile('images'))
            {
                $uploadResult = $this->image->uploadUserImage($request->files('images'), $userId);
                if($uploadResult)
                {
                    return $response->setJsonContent([
                        'status' => true,
                        'message' => 'Фотографії успішно завантажено'
                    ]);
                } else
                {
                    return $response->setJsonContent([
                        'status' => false,
                        'message' => 'Не вдалося завантажити фотографії'
                    ]);
                }
            }

        }
    }

    public function signIn(Request $request, Response $response)
    {
        // $this->session->destroy();

        // dump($this->session->get('user_id'));

        if($request->getMethod() == 'POST')
        {
            $data = $request->all();

            $rules = [
                'password' => ['required', 'min:4', 'max:15', 'strongRegex'],
                'login' => ['required', 'min:4', 'max:15', 'lightRegex'],
    
            ];

            if(!$this->validator->validate($data, $rules))
            {
                return $response->setJsonContent([
                    'status' => false,
                    'message' => $this->validator->getFirstError()
                ]);                
            }

            if(!$this->auth->login($data['login'], $data['password']))
            {
                return $response->setJsonContent([
                    'status' => false,
                    'message' => 'Такого користувача не знайдено'
                ]);
            }

            if($request->getBodyParam('checkbox'))
            {
                $this->auth->remember($data['login']);
            }

            return $response->setJsonContent([
                'status' => true,
                'message' => 'Користувач успішно авторизований'
            ]);

        }

        return View::view('account/signIn', [
            'title' => 'HTTP - User sign-in',
            'user' => $request->getBodyParam('user') 
        ]);
    }

}