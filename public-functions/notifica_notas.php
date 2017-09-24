<?php

function notifica_alumno($to, $cont) {
    $headers = "From:noreply@gestor-energetico.com\r\n"
            . "Reply-To:noreply@gestor-energetico.com\r\n"
            . "MIME-Version:1.0\r\n"
            . "Content-Type:text/html;charset=UTF-8\r\n";

    $content = "<html>"
            . "<body style='width:100%;text-align:center;margin:0px;'>"
            . "<div style='border:solid 1px #CCD4D8;display:block;padding:10px;margin:0px;min-height:81px;'><img style='margin:0px 20px 0px 0px;padding:10px;background:#fff;font-family: Georgia; color: #FFF; font-style: italic; font-size: 30px;float:left' src='http://www.gestor-energetico.com/wp-content/uploads/2013/09/logo-avada-final1.png' alt='Gestor Energético' />"
            . "<h2 style='float:left;color:#363839;width:50%'>Panel de gestión<small style='display:block;color: #888888;'>Tus resultados y más en un solo lugar.</small></h2></div>"
            . "<div style='text-align:left;padding:15px;'>
                        <p>Tienes un nuevo resultado en: <strong style='text-align:left; display:block;font-size:17px;margin: 10px 0;'>" . $cont . "</strong></p>
                        <p>Para más detalles entra en el <a href='http://admin.gestor-energetico.es/'>panel de gestión</a>.<p>                        
                        <div style='text-align: center'>
                            <img src='http://www.gestor-energetico.com.pe/wp-content/uploads/2015/11/USGBC-gestor-energetico.png' height='70px' alt='' style='font-family: Georgia; color: #697c52; font-style: italic; font-size: 30px;margin: 15px 0px;' />
                            <img src='http://www.gestor-energetico.com.pe/wp-content/uploads/2015/11/green-hosting3.png' alt='' style='font-family: Georgia; color: #697c52; font-style: italic; font-size: 30px;' />
                            <p style='padding:10px;margin:0px;font-size:10px;'>Copyright 2016 Gestor Energético Econova </p>
                            <p style='color:#888;padding:10px;margin:0px;font-size:12px;'>Usted ha recibido un comunicado mediante el panel de gestion de gestor energético, si no desea recibir más información comuniquelo por escrito a través de <a href='mailto'>informatica@gestor-energetico.com</a>.</p>
                        </div>
                    </div>"
            . "</body>"
            . "</html>";
    mail($to, "Se han actualizado tus resultados en gestor energético", $content, $headers);
//    return $content;
}
