<?php

require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = _db();

$q = $db->prepare('DROP TABLE IF EXISTS users');
$q->execute();

$q = $db->prepare('
CREATE TABLE users(
  user_id          VARCHAR(255),
  user_name        TEXT,
  user_last_name  TEXT,
  user_email  TEXT,
  user_address TEXT,
  user_password TEXT,
  user_role TEXT,
  user_created_at TEXT,
  user_updated_at TEXT,
  user_deleted_at TEXT,
  user_is_blocked TEXT,
  PRIMARY KEY (user_id)
)
');

$q->execute();

$q = $db->prepare('INSERT INTO users VALUES (  :user_id, :user_name, :user_last_name, 
                                  :user_email, :user_address, :user_password, :user_role, 
                                  :user_created_at, :user_updated_at, :user_deleted_at, :user_is_blocked)');

for ($i = 0; $i < 1; $i++) {

  $user_role = 'user';
  $user_updated_at = 0;
  $user_deleted_at = 0;
  $user_is_blocked = rand(0, 1);

  $user_id = null;
  $firstName = $faker->firstName;
  $lastName = $faker->lastName;
  $email = $faker->email;
  $address = $faker->address;
  $password = password_hash($faker->password, PASSWORD_DEFAULT);
  $created_at = time();

  $q->bindParam(':user_id', $user_id);
  $q->bindParam(':user_name', $firstName);
  $q->bindParam(':user_last_name', $lastName);
  $q->bindParam(':user_email', $email);
  $q->bindParam(':user_address', $address);
  $q->bindParam(':user_password', $password);
  $q->bindParam(':user_role', $user_role);
  $q->bindParam(':user_created_at', $created_at);
  $q->bindParam(':user_updated_at', $user_updated_at);
  $q->bindParam(':user_deleted_at', $user_deleted_at);
  $q->bindParam(':user_is_blocked', $user_is_blocked);
}
$q->execute();



//   $q = 'INSERT INTO users VALUES ';
//   $values = '';
//   for($i = 0; $i < 10; $i++){
//     // $user_id = bin2hex(random_bytes(16));
//     $password = password_hash($faker->password, PASSWORD_DEFAULT);
//     $blocked  = rand(0,1);
//     $created_at = time();
//     $deleted_at = time();
//     $updated_at = time();
//     $values .= "(null,
//                 '$faker->firstName', 
//                 '$faker->lastName', 
//                 '$faker->email',
//                 '$faker->address',
//                 'user', 
//                 '$password', 
//                 $created_at, 0, 0, 
//                 $updated_at, 0, 0,
//                 $deleted_at, 0, 0,
//                 $blocked
//               ),"; 
//   }
//   $values = rtrim($values, ",");
//   $q .= $values;

// $db = _db();
// $sql = $db->prepare($q);
// $sql->execute();
