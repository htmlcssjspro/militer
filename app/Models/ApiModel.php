<?php

namespace App\Models;

use Militer\mvcCore\Model\aApiModel;

class ApiModel extends aApiModel
{
    public function __construct()
    {
        parent::__construct();
    }


    public function checkEmail($email)
    {
        $sql = "SELECT 1 FROM {$this->usersTable} WHERE `email`=?";
        $pdostmt = $this->pdo->prepare($sql);
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
        $pdostmt = $this->pdo->prepare($sql);
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
        $pdostmt = $this->pdo->prepare($sql);
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

    public function setCurrency($currencyData)
    {
        foreach ($currencyData as $name => $cost) {
            $sql = "UPDATE {$this->currencyTable} SET `cost`=:cost WHERE `name`=:name";
            $pdostmt = $this->pdo->prepare($sql);
            if (!$pdostmt->execute([':cost' => $cost, ':name' => $name])) {
                return false;
            }
        }
        return true;
    }


    public function setNewOffer($newOfferData)
    {
        $sql = "INSERT INTO {$this->offersTable} (
            `offer_uuid`,
            `organizator_uuid`,
            `organizator_name`,
            `town`,
            `name`,
            `img`,
            `country`,
            `url`,
            `about`,
            `status`,
            `start`,
            `stop`,
            `min`)
        VALUES (
            :offer_uuid,
            :organizator_uuid,
            :organizator_name,
            :town,
            :name,
            :img,
            :country,
            :url,
            :about,
            :status,
            :start,
            :stop,
            :min)";
        $pdostmt = $this->pdo->prepare($sql);
        $result = $pdostmt->execute([
            ':offer_uuid'       => $newOfferData['offer_uuid'],
            ':organizator_uuid' => $newOfferData['organizator_uuid'],
            ':organizator_name' => $newOfferData['organizator_name'],
            ':town'             => $newOfferData['town'],
            ':name'             => $newOfferData['name'],
            ':img'              => $newOfferData['img'],
            ':country'          => $newOfferData['country'],
            ':url'              => $newOfferData['url'],
            ':about'            => $newOfferData['about'],
            ':status'           => $newOfferData['status'],
            ':start'            => $newOfferData['start'],
            ':stop'             => $newOfferData['stop'],
            ':min'              => $newOfferData['min'],
        ]);
        if (!$result) {
            return false;
        }
        return $this->updateOrganizatorStat($newOfferData['organizator_uuid']);
    }



    public function setNewOrder($newOrderData)
    {
        foreach ($newOrderData['position'] as $position) {
            $sql = "INSERT INTO `{$this->ordersTable}` (
            `offer_uuid`,
            `order_uuid`,
            `position_uuid`,
            `user_uuid`,
            `username`,
            `link`,
            `name`,
            `artikul`,
            `img`,
            `num`,
            `price`,
            `color`,
            `size`,
            `comment`)
        VALUES (
            :offer_uuid,
            :order_uuid,
            :position_uuid,
            :user_uuid,
            (SELECT `username` FROM `{$this->usersTable}` WHERE `user_uuid`=:user_uuid),
            :link,
            :name,
            :artikul,
            :img,
            :num,
            :price,
            :color,
            :size,
            :comment)";
            $pdostmt = $this->pdo->prepare($sql);
            $result = $pdostmt->execute([
                ':offer_uuid'    => $newOrderData['offer-uuid'],
                ':order_uuid'    => $newOrderData['order_uuid'],
                ':position_uuid' => $position['position_uuid'],
                ':user_uuid'     => $newOrderData['user-uuid'],
                ':link'          => $position['link'],
                ':name'          => $position['name'],
                ':artikul'       => $position['artikul'],
                ':img'           => $position['img'],
                ':num'           => $position['num'],
                ':price'         => $position['price'],
                ':color'         => $position['color'],
                ':size'          => $position['size'],
                ':comment'       => $position['comment'],
            ]);
            if (!$result) {
                return false;
            }
        }
    }

    public function updateOfferFill($newOfferFill, $offerUuid)
    {
        $sql = "UPDATE {$this->offersTable} SET `fill`=? WHERE `offer_uuid`=?";
        $pdostmt = $this->pdo->prepare($sql);
        return $pdostmt->execute([$newOfferFill, $offerUuid]);
    }



    public function statusChange($userData)
    {
        $sql = "UPDATE {$this->usersTable} SET `status`=:status WHERE `user_uuid`=:user_uuid";
        $pdostmt = $this->pdo->prepare($sql);
        $result = $pdostmt->execute([
            ':status'    => $userData['status'],
            ':user_uuid' => $userData['user-uuid'],
        ]);
        if (!$result) {
            return false;
        }
        if ($userData['status'] === \STATUS_ORGANIZATOR) {
            $sql = "INSERT INTO {$this->organizatorsTable} (
                `organizator_uuid`,
                `organizator_name`,
                `status`,
                `org_reg_date`)
            VALUES (
                :user_uuid,
                (SELECT `username` FROM {$this->usersTable} WHERE `user_uuid`=:user_uuid),
                'active',
                CURRENT_DATE()
            )
            ON DUPLICATE KEY UPDATE `status`='active'";

            $pdostmt = $this->pdo->prepare($sql);
            $result = $pdostmt->execute([':user_uuid' => $userData['user-uuid']]);
            if (!$result) {
                return false;
            }

            $result = $this->updateOrganizatorStat($userData['user-uuid']);
            if (!$result) {
                return false;
            }
        }
        if ($userData['status'] === \STATUS_USER) {
            $sql = "UPDATE {$this->organizatorsTable} SET `status`='block' WHERE `organizator_uuid`=:user_uuid";
            $pdostmt = $this->pdo->prepare($sql);
            $result = $pdostmt->execute([':user_uuid' => $userData['user-uuid']]);
            if (!$result) {
                return false;
            }
        }
        return true;
    }


    private function updateOrganizatorStat($uuid)
    {
        $sql = "UPDATE `{$this->organizatorsTable}`
            SET
                `countries`       = (SELECT GROUP_CONCAT(DISTINCT `country`) FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid),
                `towns`           = (SELECT GROUP_CONCAT(DISTINCT `town`)    FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid),
                `first_offer`     = (SELECT MIN(`start`) FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid),
                `offers_total`    = (SELECT COUNT(*) FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid AND `status` LIKE '_%'),
                `offers_complete` = (SELECT COUNT(*) FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid AND `status`='complete'),
                `offers_active`   = (SELECT COUNT(*) FROM `{$this->offersTable}` WHERE `organizator_uuid`=:organizator_uuid AND `status`='active')
            WHERE `organizator_uuid`=:organizator_uuid";
        $pdostmt = $this->pdo->prepare($sql);
        return $pdostmt->execute([':organizator_uuid' => $uuid]);
    }
}
