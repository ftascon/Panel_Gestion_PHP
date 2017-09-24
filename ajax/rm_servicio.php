<?php

function remove_servicio($id) {
    $servicio = new servicios();
    $servicio->remove_servicio($id);
    header("Location: " . BASE_URL . "?servicios&ok");
}

