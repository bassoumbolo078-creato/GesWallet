<?php 
namespace App\Service;


use App\Entity\UserEntity;
use App\Repository\UserRepository;

final class UserService
{
    private function __construct()
    {
        throw new \Exception('Not implemented');
    }
   
    public static function seConnecter(string $login): ?UserEntity
    {
          $userRepository=new UserRepository();
          return  $userRepository->selectByLogin($login);
    }
   

  
    
}