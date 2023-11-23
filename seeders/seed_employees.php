<?php

require_once __DIR__ . '/../_.php';
require_once __DIR__ . '/Faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = _db();
$q = $db->prepare('SELECT user_id FROM users ORDER BY RAND() LIMIT 2');
$q->execute();
$ids = $q->fetchAll(PDO::FETCH_COLUMN); // [5,10]

$q = 'INSERT INTO employees VALUES ';
$values = '';
$array_length = count($ids);
for ($i = 0; $i < $array_length; $i++) {
  $salary = rand(10000, 99999);
  $index = array_rand($ids);
  $user_employee_fk = $ids[$index];
  unset($ids[$index]);
  $values .= "($user_employee_fk, $salary),";
}
$values = rtrim($values, ",");
$q .= $values;

echo $q;
$db = _db();
$sql = $db->prepare($q);
$sql->execute();

