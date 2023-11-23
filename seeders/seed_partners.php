<?php

require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/autoload.php';

$faker = Faker\Factory::create();


try {

  $db = _db();

  $q = $db->prepare('DROP TABLE IF EXISTS partners');
  $q->execute();


  $q = $db->prepare('
  CREATE TABLE partners(
  user_partner_id               TEXT,
  partner_geo                   TEXT,
  PRIMARY KEY (user_partner_id(255))
)
');
  $q->execute();

  $q = $db->prepare("SELECT user_id FROM users WHERE user_role_name = 'partner' LIMIT 2");
  $q->execute();
  $ids = $q->fetchAll(PDO::FETCH_COLUMN); // [5,10]

  $values = '';
  foreach ($ids as $user_partner_id) {
    $values .= "('$user_partner_id', '$faker->latitude,$faker->longitude'),";
  }

  $values = rtrim($values, ',');
  $q = $db->prepare("INSERT INTO partners VALUES $values");
  $q->execute();

  echo "+ partners" . PHP_EOL;
} catch (Exception $e) {
  echo $e;
}
