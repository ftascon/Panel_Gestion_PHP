<?php
$id = $_POST['id'];

$connection = mysqli_connect("localhost", "root", "", "admin") or die(mysqli_error($connection));
$stmt = "SET CHARSET 'utf8'";
$stmt = "DELETE from cal_events WHERE id_event=".$id;

header('Content-Type: application/json');
$result = mysqli_query($connection,$stmt);
if($result){
  echo true;
}
