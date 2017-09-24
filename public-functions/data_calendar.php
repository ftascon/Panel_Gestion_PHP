<?php
$connection = mysqli_connect("localhost", "nicolas_admin", "adminPanel100", "nicolas_admin") or die(mysqli_error($connection));
if(isset($_POST['action']) or isset($_GET['view'])){
  if(isset($_GET['view'])){
    $stmt = "SET CHARSET 'utf8'";
    $stmt = "SELECT ce.id_event,ce.start,
    ce.end,m.nombre_modulo,m.bg_modulo
    FROM cal_events ce
    LEFT JOIN aulas a ON ce.fk_aula = a.id_aula
    LEFT JOIN modulos m ON a.fk_modulo = m.id_modulo";

    header('Content-Type: application/json');
    $result = mysqli_query($connection,$stmt);
    $events = array();
    while($row = mysqli_fetch_assoc($result)){
      $row["title"] = utf8_encode($row["nombre_modulo"]);
      $row["backgroundColor"] = utf8_encode($row["bg_modulo"]);
      $row["borderColor"] = utf8_encode($row["bg_modulo"]);
      $row["title"] = "".substr(explode(" ", utf8_encode($row["start"]))[1],0,5) . " " . $row["title"];
      unset($row["nombre_modulo"]);
      unset($row["bg_modulo"]);
      $events[] = $row;
    }
    $data = ($events);
    echo json_encode($data);
    exit;
  }
}
