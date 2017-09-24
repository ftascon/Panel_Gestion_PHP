<?php

include "../includes/general_settings.php";
session_start();
unset($_SESSION["user_data"]);
session_destroy();
header('Location: ' . BASE_URL . ' ');

