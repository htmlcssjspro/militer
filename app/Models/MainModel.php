<?php

namespace App\Models;


class MainModel extends aPageModel
{
    public $headerNav;

    public $offers;
    public $offer;
    public $offerDict;
    public $orders;
    public $currencyData;
    public $townsList;
    public $guest = false;
    public $user = false;
    public $organizator = false;


    public function __construct()
    {
        parent::__construct();

        $this->getHeaderData();
        $this->getFooterData();
        $this->getAsideData();
    }


    public function getHeaderData()
    {
        $sql = "SELECT `label`, `page_url` FROM {$this->sitemapTable} WHERE `header_nav`=1";
        $headerNav = $this->pdo->query($sql)->fetchAll();
        $this->headerNav = $this->escapeOutput($headerNav);
        $this->getTownsList();
    }

    public function getFooterData()
    {
    }

    public function getAsideData()
    {
    }


    public function getCurrencyData()
    {
        $sql = "SELECT * FROM {$this->currencyTable} WHERE 1";
        $currencyData = $this->pdo->query($sql)->fetchAll();
        $this->currencyData = $this->escapeOutput($currencyData);
    }
    public function getTownsList()
    {
        $sql = "SELECT `name` FROM {$this->townsTable} WHERE 1";
        $townsList = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_COLUMN);
        $this->townsList = $this->escapeOutput($townsList);
    }

    public function getDeliveryCostData()
    {
        $sql = "SELECT * FROM {$this->deliveryCostTable} WHERE 1";
        $deliveryCostData = $this->pdo->query($sql)->fetchAll();
        $this->deliveryCostData = $this->escapeOutput($deliveryCostData);
    }

    public function getOrganizatorsData()
    {
        $sql = "SELECT
            `ot`.`organizator_uuid`,
            `ut`.`username`,
            `ut`.`name`,
            `ut`.`last_visit`,
            `ot`.`countries`,
            `ot`.`towns`,
            `ot`.`first_offer`,
            `ot`.`offers_total`,
            `ot`.`offers_complete`,
            `ot`.`offers_active`
        FROM `{$this->organizatorsTable}` AS `ot`
        LEFT JOIN `{$this->usersTable}` AS `ut`
        ON `ot`.`status`='active' AND `ot`.`organizator_uuid` = `ut`.`user_uuid`";

        // $sql = "SELECT * FROM `{$this->organizatorsTable}` WHERE `status`='active'";
        $this->organizatorsData = $this->pdo->query($sql)->fetchAll();
    }


    public function getOffers()
    {
        $sql = "SELECT
            `oft`.`offer_uuid`,
            `oft`.`organizator_uuid`,
            `ut`.`username` AS `organizator_name`,
            `oft`.`town`,
            `oft`.`name`,
            `oft`.`img`,
            `oft`.`country`,
            `oft`.`url`,
            `oft`.`about`,
            `oft`.`status`,
            `oft`.`fill`,
            `oft`.`start`,
            `oft`.`stop`,
            `oft`.`min`
        FROM {$this->offersTable} AS `oft`
        INNER JOIN {$this->usersTable} AS `ut`
        ON `oft`.`town`='{$_SESSION['town']}'
        AND `oft`.`organizator_uuid`=`ut`.`user_uuid`
        ORDER BY `oft`.`status`, `oft`.`country`, `oft`.`name`";
        $offers = $this->pdo->query($sql)->fetchAll();
        $this->offers = $this->escapeOutput($offers);
    }

    public function getUserOffers()
    {
        $sql = "SELECT
            `oft`.`offer_uuid`,
            `oft`.`organizator_uuid`,
            `ut`.`username` AS `organizator_name`,
            `oft`.`town`,
            `oft`.`name`,
            `oft`.`img`,
            `oft`.`country`,
            `oft`.`url`,
            `oft`.`about`,
            `oft`.`status`,
            `oft`.`fill`,
            `oft`.`start`,
            `oft`.`stop`,
            `oft`.`min`
        FROM {$this->offersTable} AS `oft`
        INNER JOIN {$this->usersTable} AS `ut`
        ON `oft`.`organizator_uuid`='{$this->userData['user_uuid']}'
        AND `oft`.`organizator_uuid`=`ut`.`user_uuid`
        ORDER BY `oft`.`status`, `oft`.`country`, `oft`.`name`";
        $offers = $this->pdo->query($sql)->fetchAll();
        $this->offers = $this->escapeOutput($offers);
    }

    public function getOffer($uuid)
    {
        $sql = "SELECT
            `oft`.`offer_uuid`,
            `oft`.`organizator_uuid`,
            `ut`.`username` AS `organizator_name`,
            `oft`.`town`,
            `oft`.`name`,
            `oft`.`img`,
            `oft`.`country`,
            `oft`.`url`,
            `oft`.`about`,
            `oft`.`status`,
            `oft`.`fill`,
            `oft`.`start`,
            `oft`.`stop`,
            `oft`.`min`
        FROM {$this->offersTable} AS `oft`
        INNER JOIN {$this->usersTable} AS `ut`
        ON `oft`.`offer_uuid`='$uuid'
        AND `oft`.`organizator_uuid`=`ut`.`user_uuid`";
        $offer = $this->pdo->query($sql)->fetch();
        $this->offer = $this->escapeOutput($offer);

        $sql = "SELECT `ut`.`username`, `ort`.`name`, `ort`.`img`, `ort`.`link`
        FROM {$this->ordersTable} AS `ort`
        INNER JOIN {$this->usersTable} AS `ut`
        ON `ort`.`offer_uuid`='$uuid' AND `ort`.`user_uuid`=`ut`.`user_uuid`";
        $orders = $this->pdo->query($sql)->fetchAll();
        $this->orders = $this->escapeOutput($orders);
    }


    public function getOrders()
    {
        $sql = "SELECT
            `ort`.`offer_uuid`,
            `oft`.`status` AS `offer_status`,
            `ort`.`order_uuid`,
            `ort`.`order_type`,
            `ort`.`position_uuid`,
            `ort`.`user_uuid`,
            `ort`.`link`,
            `ort`.`name`,
            `ort`.`artikul`,
            `ort`.`img`,
            `ort`.`amount`,
            `ort`.`price`,
            `ort`.`color`,
            `ort`.`size`,
            `ort`.`comment`
        FROM {$this->ordersTable} AS `ort`
        LEFT JOIN {$this->offersTable} AS `oft`
        ON  `ort`.`user_uuid`='{$this->userData['user_uuid']}'
        AND `ort`.`offer_uuid`=`oft`.`offer_uuid`
        ORDER BY `offer_status`, `ort`.`offer_uuid`, `oft`.`country`, `ort`.`name`";
        $orders = $this->pdo->query($sql)->fetchAll();
        // \prd($orders, '$orders');
        $this->orders = $this->escapeOutput($orders);
    }

    public function getUserOrders()
    {
        $sql = "SELECT
            `ort`.`offer_uuid`,
            `oft`.`status` AS `offer_status`,
            `ort`.`order_uuid`,
            `ort`.`order_type`,
            `ort`.`position_uuid`,
            `ort`.`user_uuid`,
            `ort`.`link`,
            `ort`.`name`,
            `ort`.`artikul`,
            `ort`.`img`,
            `ort`.`amount`,
            `ort`.`price`,
            `ort`.`color`,
            `ort`.`size`,
            `ort`.`comment`
        FROM {$this->ordersTable} AS `ort`
        LEFT JOIN {$this->offersTable} AS `oft`
        ON  `ort`.`user_uuid`='{$this->userData['user_uuid']}'
        AND `ort`.`offer_uuid`=`oft`.`offer_uuid`
        ORDER BY `offer_status`, `ort`.`offer_uuid`, `oft`.`country`, `ort`.`name`";
        $orders = $this->pdo->query($sql)->fetchAll();
        // \prd($orders, '$orders');
        $this->orders = $this->escapeOutput($orders);
    }

    public function getOrder()
    {
        $sql = "SELECT
            `ort`.`offer_uuid`,
            `oft`.`status` AS `offer_status`,
            `ort`.`order_uuid`,
            `ort`.`order_type`,
            `ort`.`position_uuid`,
            `ort`.`user_uuid`,
            `ort`.`link`,
            `ort`.`name`,
            `ort`.`artikul`,
            `ort`.`img`,
            `ort`.`amount`,
            `ort`.`price`,
            `ort`.`color`,
            `ort`.`size`,
            `ort`.`comment`
        FROM {$this->ordersTable} AS `ort`
        LEFT JOIN {$this->offersTable} AS `oft`
        ON  `ort`.`user_uuid`='{$this->userData['user_uuid']}'
        AND `ort`.`offer_uuid`=`oft`.`offer_uuid`
        ORDER BY `offer_status`, `ort`.`offer_uuid`, `oft`.`country`, `ort`.`name`";
        $orders = $this->pdo->query($sql)->fetchAll();
        // \prd($orders, '$orders');
        $this->orders = $this->escapeOutput($orders);
    }


    public function getVip()
    {
        $sql = "SELECT * FROM {$this->vipOffersTable}
            WHERE `user_uuid`='{$this->userData['user_uuid']}'
            ORDER BY `status`, `country`, `name`";
        $offers = $this->pdo->query($sql)->fetchAll();
        $this->offers = $this->escapeOutput($offers);
    }


    private function escapeOutput(array &$data)
    {
        \array_walk_recursive($data, function (&$item) {
            $item = \htmlspecialchars($item, \ENT_QUOTES | \ENT_HTML5 | \ENT_SUBSTITUTE, 'UTF-8');
        });
        return $data;
    }
}
