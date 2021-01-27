<?php

namespace App\Models;

use Core\Model\aApiModel;

class ApiModel extends aApiModel
{
    public function __construct()
    {
        parent::__construct();
    }


    public function checkEmail($email)
    {
        $sql = "SELECT 1 FROM {$this->usersTable} WHERE `email`=?";
        $pdostmt = $this->PDO->prepare($sql);
        return $pdostmt->execute([$email]);
    }

    public function register($registerData)
    {
        $sql = "INSERT INTO {$this->usersTable} (
            `user_uuid`,
            `username`,
            `name`,
            `email`,
            `password`,
            `phone`,
            `last_visit`,
            `register_date`)
        VALUES (
            :user_uuid,
            :username,
            :name,
            :email,
            :password,
            :phone,
            CURRENT_DATE(),
            CURRENT_DATE())";
        $pdostmt = $this->PDO->prepare($sql);
        return $pdostmt->execute([
            ':user_uuid' => $registerData['userUuid'],
            ':username'  => $registerData['login'],
            ':name'      => $registerData['name'],
            ':email'     => $registerData['email'],
            ':password'  => $registerData['password'],
            ':phone'     => $registerData['phone'],
        ]);
    }

    public function accessRestore($email, $password)
    {
        // $password = $this->generatePassword();
        $passwordHash = \password_hash($password, \PASSWORD_DEFAULT);
        $sql = "UPDATE {$this->usersTable} SET `password`='$passwordHash' WHERE `email`=? LIMIT 1";
        $pdostmt = $this->PDO->prepare($sql);
        if ($pdostmt->execute([$email])) {
            $subject = 'Восстановление доступа sp-tut.ru';
            $message = "
            <html>
                <head>
                <title>Восстановление доступа sp-tut.ru</title>
                </head>
                <body>
                    <p>Здравствуйте!</p>
                    <p>Вы восстановили доступ к системе SP-TUT.ru</p>
                    <p>Ваши новые данные для доступа:</p>
                    <table>
                        <tr>
                        <td>Логин:</td><td>$email</td>
                        </tr>
                        <tr>
                        <td>Пароль:</td><td>$password</td>
                        </tr>
                    </table>
                    <p>Сохраните эти данные</p>
                    <p>В случае их утери, или при подозрении в их утечке, воспользуйтесь системой восстановления доступа для создания нового пароля</p>
                    <p>Успешной работы!</p>
                </body>
            </html>
        ";
            $additional_headers = [
                'MIME-Version' => '1.0',
                'Content-type' => 'text/html;charset=UTF-8',
                'From'         => 'robot@sp-tut.ru',
            ];

            return mail($email, $subject, $message, $additional_headers);
            // imap_mail($to, $subject, $message, $additional_headers, $cc, $bcc, $rpath);
            // imap_mail ( string $to , string $subject , string $message [, string $additional_headers = NULL [, string $cc = NULL [, string $bcc = NULL [, string $rpath = NULL ]]]] ) : bool
        } else {
            return false;
        }
    }

}
