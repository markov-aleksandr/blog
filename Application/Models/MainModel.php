<?php


namespace Application\Models;


class MainModel extends \Core\Model
{
    public $data;
    public function __construct()
    {
        parent::__construct();
    }

    public function select()
    {
        $getArticles = $this->dataConnect->query('SELECT * FROM articles');
        $data = $getArticles->fetchAll();
        return $data;
    }

}