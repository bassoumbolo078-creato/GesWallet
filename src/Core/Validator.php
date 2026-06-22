<?php
namespace App\Core;
 final class Validator{
      private  static  array  $errors=[];
    private  function __construct()
    {
        
    }

     //Regles Validation

      public static function isEmpty(string $field,string $key,string $sms="Le champ est obligatoire" ):void{
           if (empty($field)) {
                  self::$errors[$key]= $sms;
          }
      }

      //Validation
      public static function validated():bool{
          return count(self::$errors)==0;
       }

     public static function getErrors():array{
       return self::$errors;
     }

}