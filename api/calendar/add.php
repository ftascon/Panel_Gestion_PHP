<?php
$start = $_POST['start'];
$end = $_POST['end'];
$fk_aula = $_POST['fk_aula'];
$fk_calendar = $_POST['fk_calendar'];

$connection = mysqli_connect("localhost", "root", "", "admin") or die(mysqli_error($connection));
$stmt = "SET CHARSET 'utf8'";
$stmt = "INSERT INTO cal_events (fk_calendar, fk_aula, start, end) VALUES ($fk_calendar, $fk_aula, '$start', '$end')";
header('Content-Type: application/json');
$result = mysqli_query($connection,$stmt);
if($result){
  echo true;
}
