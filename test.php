<?php

$data = [
    "first_name" => "Rachida",
    "last_name" => "W7da fihom",
    "specialization" => "Cardio",
    "phone" => "0666073301",
    "email" => "rachida@tbiba.ma",
    "dept_id" => 2
];


$columns = "";
$values = "";

foreach ($data as $key => $value) {

    $columns .= "$key, ";
    $values .= "?, ";
}

$values = rtrim($values, ", ");
$columns = rtrim($columns, ", ");

$qry = "INSERT INTO doctors ($columns) values($values)";
echo $qry;
