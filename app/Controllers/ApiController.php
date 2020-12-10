<?php

namespace App\Controllers;

use App\Models\ApiModel;
use Militer\mvcCore\Controller\aApiController;
use Militer\mvcCore\DI\Container;
use Ramsey\Uuid\Uuid;

class ApiController extends aApiController
{
    public $Model;

    public function __construct(ApiModel $Model) {
        parent::__construct();
        $this->Model = $Model;
    }


    public function index()
    {
    }

    public function login()
    {
        $this->csrfVerify(function ($loginData) {
            $loginMessages = Container::get('loginMessages');
            $login = $loginData['login'];
            $password = $loginData['password'];
            $userUuid = $this->User->login($login, $password);
            if ($userUuid) {
                $_SESSION['user_uuid'] = $userUuid;
                $this->Response->sendJson($loginMessages['success']);
            } else {
                $this->Response->sendJson($loginMessages['error']);
            }
        });
    }

    public function logout()
    {
        $logoutMessages = Container::get('logoutMessages');
        unset($_SESSION['user_uuid'], $_SESSION['status']);
        $this->Response->sendJson($logoutMessages['success']);
    }

    public function register()
    {
        $this->csrfVerify(function ($registerData) {
            if ($this->Model->checkEmail($registerData['email'])) {
                $messages = Container::get('messages')['register'];
                $message = $messages['impossible'];
                $message['error'] = \str_replace('%email%', $registerData['email'], $message['error']);
                $this->Response->sendJson($message);
            } else {
                $registerData['userUuid'] = Uuid::uuid4();
                $registerData['password'] = \password_hash($registerData['password'], \PASSWORD_DEFAULT);
                $messages = 'register';
                $result = $this->Model->register($registerData);
                $this->sendMessage($messages, $result);
            }
        });
    }

    public function accessRestore()
    {
        $this->csrfVerify(function ($accessRestoreData) {
            $accessRestoreMessages = Container::get('accessRestoreMessages');
            $email = $accessRestoreData['email'];
            if ($this->Model->checkEmail($email)) {
                $password = $this->User->generatePassword();
                if ($this->Model->accessRestore($email, $password)) {
                    $accessRestoreMessages['success']['success'] =
                        \str_replace('%email%', $email, $accessRestoreMessages['success']['success']);
                    $this->Response->sendJson($accessRestoreMessages['success']);
                } else {
                    $this->Response->sendJson($accessRestoreMessages['error']);
                }
            } else {
                $this->Response->sendJson($accessRestoreMessages['noUser']);
            }
        });
    }

    public function newOffer()
    {
        $this->csrfVerify(function ($newOfferData) {
            $newOfferData['offer_uuid'] = $newOfferUuid = Uuid::uuid4();
            $dest = \UPLOADS . "/img/offers/$newOfferUuid";
            $newOfferData['img'] = $this->fileUpload('img', $dest, function ($file) {
                // check $file
            });
            $messages = 'offers';
            $result = $this->Model->setNewOffer($newOfferData);
            $this->sendMessage($messages, $result);
        });
    }

    public function newOrder()
    {
        $this->csrfVerify(function ($newOrderData) {
            $newOrderData['order_uuid'] = Uuid::uuid4();
            foreach ($newOrderData['name'] as $key => $name) {
                $newOrderData['position_uuid'][$key] = $positionUuid = Uuid::uuid4();
                $dest[$key] = \UPLOADS . "/img/orders/$positionUuid";
            }
            $newOrderData['img'] = $this->fileUpload('img', $dest, function ($file) {
                // $file['tmp_name'];
                // $file['name'];
                // $file['type'];
                // $file['size'];
                // $file['error'];

                //! Проверить формат файла
                if ($file['type'] === 'image/jpeg') {
                }
                //! Проверить размер файла
                if ($file['size'] > 5000000) {
                }
            });

            \prd($newOrderData, '$newOrderData');

            $messages = 'orders';
            $result = $this->Model->setNewOrder($newOrderData);
            if ($result) {
                $this->countOfferFill($newOrderData);
            }
            $this->sendMessage($messages, $result);
        });
    }

    private function countOfferFill($newOrderData)
    {
        $offerUuid = $newOrderData['offer_uuid'];
        $offerFill = $newOrderData['offer-fill'];
        $offerMin  = $newOrderData['offer-min'];
        $price     = $newOrderData['price'];
        $sum = $offerFill * $offerMin / 100;
        $newSum = $sum + $price;
        $newOfferFill = $newSum / $offerMin * 100;
        $result = $this->Model->updateOfferFill($newOfferFill, $offerUuid);
        if (!$result) {
            throw new \Exception('Ошибка обновления $offerFill');
        }
    }


    public function setTown()
    {
        $postData = $this->Request->getPOST();
        $this->filterInput($postData);
        $_SESSION['town'] = $postData['town'];
    }




    public function documentation()
    {
        $message = 'api_documentation';
        $this->Response->sendText($message);
    }

    public function example()
    {
        $message = 'text';
        $this->Response->sendText($message);

        $message = '<html></html>';
        $this->Response->sendHtml($message);

        $message = [
            'name1' => 'value1',
            'name2' => 'value2',
        ];
        $this->Response->sendJson($message);
    }
}
