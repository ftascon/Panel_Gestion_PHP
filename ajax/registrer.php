<?php

include '../includes/general_settings.php';
$users = new users();
echo $users->login_users($_POST);

