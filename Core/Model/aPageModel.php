<?php

namespace Core\Model;

abstract class aPageModel extends aModel
{
    public string $title;
    public string $description;

    public string $layout;
    public string $header;
    public string $footer;
    public string $aside;
    public string $mainContent;

    public array $includes = [];

    public string $mainCSS;
    public string $mainJS;
    public array $pageCSS = [];
    public array $pageJS = [];

    public array $userData = [];
    public array $data = [];


    public function __construct()
    {
        parent::__construct();
    }


    public function getPageData($textId)
    {
        $sql = "SELECT `title`, `description` FROM {$this->sitemapTable} WHERE `text_id`='$textId' LIMIT 1";
        $pageData = $this->PDO->query($sql)->fetch();
        $this->title       = $pageData['title'];
        $this->description = $pageData['description'];
    }


}
