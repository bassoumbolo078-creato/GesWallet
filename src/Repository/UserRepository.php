<?php
namespace App\Repository;

use App\Core\Repository;
use App\Entity\UserEntity;


 class UserRepository extends Repository
{
    
    public function __construct()
    {
             parent::__construct();
             $this->tableName= "users";
             $this->classeName= "App\\Entity\\UserEntity";
    }

    public function selectByLogin(string $login): ?UserEntity
    {
        try {
            $this->connect();
            $sql = "SELECT * FROM " . $this->tableName . " WHERE login = :login";
             $stm = $this->pdo->prepare($sql);
             $stm->execute([":login" => $login]);
            $stm->setFetchMode(\PDO::FETCH_CLASS, $this->classeName);
            $this->close();
            $result= $stm->fetch();
            return $result==false ? null : $result;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

  

   
}