<?php

class calendars extends Database {

  function get_all() {
    $stmt = 'SELECT
    calendars.id_calendar,
    calendars.nombre,
    calendars.autor,
    people.fname_people,
    people.id_people
     FROM calendars LEFT JOIN people  ON calendars.autor = people.id_people;';
    return $this->getRecord($stmt);
  }

  function get_by_id($id) {
    $stmt = 'SELECT * FROM calendars WHERE id_calendar='.$id.';';
    return $this->getRecord($stmt)[0];
  }

  function create($data) {
    $stmt = "INSERT INTO calendars "
    . "(nombre, autor) "
    . "VALUES "
    . "('" . $data["nombre"] . "', '" . $data["autor"] . "');";
    $this->mysqli->query($stmt);
    return $this->mysqli->insert_id;
  }

  function edit($data) {
    $stmt = "UPDATE `calendars` SET"
    . " nombre = '". $data["nombre"] . "'"
    . " WHERE "
    . " (`id_calendar`='".$data["id_calendar"]."');";
    // echo $stmt;
    return $this->mysqli->query($stmt);
  }

  function remove($id) {
    $stmt = "DELETE FROM calendars "
    . "WHERE id_calendar = '" . $id . "'";
    return $this->mysqli->query($stmt);
  }

  /* no permisions */
}
