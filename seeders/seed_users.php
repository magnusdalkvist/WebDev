<?php

require_once __DIR__.'/../_.php';
require_once __DIR__.'/Faker/src/autoload.php';

// use the factory to create a Faker\Generator instance
$faker = Faker\Factory::create();

$db = _db();

/*
$q = $db->prepare('INSERT INTO users VALUES (  :user_id, :user_name, :user_last_name, 
                                  :user_email, :user_address, :user_password, :user_role, 
                                  :user_created_at, :user_updated_at, :user_deleted_at, :user_is_blocked)');

for($i = 0; $i < 1; $i++){
  $user_id = null;
  // $password = password_hash($faker->password, PASSWORD_DEFAULT);
  $password = "password";
  $user_role = 'user';
  $user_updated_at = 0;
  $user_deleted_at = 0;
  $user_is_blocked = rand(0,1);
  $q->bindParam(':user_id', $user_id );
  // $q->bindParam(':user_name', $faker->firstName);
  $q->bindParam(':user_name', "SantiagoDonoso");
  $q->bindParam(':user_last_name', $faker->lastName);
  $q->bindParam(':user_email', $faker->email);
  $q->bindParam(':user_address', $faker->address);
  $q->bindParam(':user_password', $password);
  $q->bindParam(':user_role', $user_role);
  $q->bindParam(':user_created_at', time());
  $q->bindParam(':user_updated_at', $user_updated_at);
  $q->bindParam(':user_deleted_at', $user_deleted_at);
  $q->bindParam(':user_is_blocked', $user_is_blocked);
}
$q->execute();
*/


  $q = 'INSERT INTO users VALUES ';
  $values = '';
  for($i = 0; $i < 10; $i++){
    // $user_id = bin2hex(random_bytes(16));
    $password = password_hash($faker->password, PASSWORD_DEFAULT);
    $blocked  = rand(0,1);
    $created_at = time();
    $values .= "(null,
                '$faker->firstName', 
                '$faker->lastName', 
                '$faker->email',
                '$faker->address',
                '$password', 
                'user', 
                $created_at, 0, 0, 
                $blocked
              ),"; 
  }
  $values = rtrim($values, ",");
  $q .= $values;

$db = _db();
$sql = $db->prepare($q);
$sql->execute();




