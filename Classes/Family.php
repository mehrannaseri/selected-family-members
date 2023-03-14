<?php
require_once "Core/DB.php";

use Dotenv\Dotenv;

class Family
{
    private $connection;
    public function __construct()
    {
        $this->connection = DB::getInstance();
    }

    public function getData()
    {
       $sql = $this->connection->prepare("SELECT ID,surname,count(first_name) as members, MAX(age) as max_age,
                                    (select first_name from families where surname = f.surname and gender = 'male' and legal_guardian = 1) as father,
                                    (select GROUP_CONCAT(first_name) from families where surname = f.surname and legal_guardian = 0) as children
                                    FROM `families` as f group by surname order by surname;");

        $sql->execute();
        return $sql->fetchAll();
    }
}