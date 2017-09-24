<?php

include "../includes/general_settings.php";
$content = "";
if (isset($_GET["ok"])) {
    $alumnos = new people();
    $alumnos_data = $alumnos->get_all(false);
//    echo count($alumnos_data);
//    print_r($alumnos_data);
    for ($i = 0; $i < count($alumnos_data); $i++) {
//  $headers = "From: felipe@gestor-energetico.com\r\n"
        $headers = "From:noreply@gestor-energetico.com\r\n"
                . "Reply-To:noreply@gestor-energetico.com\r\n"
                . "MIME-Version:1.0\r\n"
                . "Content-Type:text/html;charset=UTF-8\r\n";

        $content = "<html>"
                . "<body style='width:100%;text-align:center;margin:0px;'>"
                . "<div style='border:solid 1px #CCD4D8;display:block;padding:10px;margin:0px;min-height:81px;'><img style='margin:0px 20px 0px 0px;padding:10px;background:#fff;font-family: Georgia; color: #FFF; font-style: italic; font-size: 30px;float:left' src='http://www.gestor-energetico.com/wp-content/uploads/2013/09/logo-avada-final1.png' alt='Gestor Energético' />"
                . "<h2 style='float:left;color:#363839;width:50%'>Panel de gestión<small style='display:block;color: #888888;'>Tus aulas, videoconferencias, resultados y más en un solo lugar.</small></h2></div>"
                . "<div style='text-align:left;'>
                        <p>
                            Bienvenida   " . $alumnos_data[$i]["fname_people"] . " " . $alumnos_data[$i]["lname1_people"] . " " . $alumnos_data[$i]["lname2_people"] . ", <br/>
                            Ha sido registrad@ en el panel de gestion de <a href='http://gestor-energetico.com/'>gestor energetico</a>.
                        <p>
                        <p><strong style='text-align:left; display:block;'>Sus datos de acceso son los siguientes:</strong><br />
                        <span style='display: block;margin: 10px'><em style='padding:10px'>Enlace: </em> <a href='http://admin.gestor-energetico.es/'>http://admin.gestor-energetico.es/</a></span>
                        <span style='display: block;margin: 10px'><em style='padding:10px'>Usuario: </em>  " . $alumnos_data[$i]["username_users"] . "  </span>
                        <span style='display: block;margin: 10px'><em style='padding:10px'>Contraseña: </em> " . $alumnos_data[$i]["passphrase_users"] . " </span></p>
                        <div style='text-align: center'>
                            <img src='http://www.gestor-energetico.com.pe/wp-content/uploads/2015/11/USGBC-gestor-energetico.png' height='70px' alt='' style='font-family: Georgia; color: #697c52; font-style: italic; font-size: 30px;margin: 15px 0px;' />
                            <img src='http://www.gestor-energetico.com.pe/wp-content/uploads/2015/11/green-hosting3.png' alt='' style='font-family: Georgia; color: #697c52; font-style: italic; font-size: 30px;' />
                            <p style='padding:10px;margin:0px;font-size:10px;'>Copyright 2016 Gestor Energético Econova </p>
                        </div>
                    </div>"
                . "</body>"
                . "</html>";
        mail($alumnos_data[$i]["email_people"], "Bienvenid@ al Panel de gestión de gestor energético", $content, $headers);
        echo $i ." ok";
//    mail("felipe@gestor-energetico.com", "Bienvenid@ al Panel de gestión de gestor energético", $content, $headers);
//        mail("felipegestorenergetico@gmail.com", "panel de gestión gestor-energetico ", $content, $headers);
    }
} else {
    echo "<h5>Is something wrong!</h5>";
}

echo "terminado";
?>
