<?php

function get_login_form() {
    $alert = "";
    if (isset($_GET["ko_no"])) {
        $alert = '<div class="callout callout-danger fade in" style="margin-top:25px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h5>Usuario no existe</h5>
                    </div>';
    } else {
        if (isset($_GET["ko_pw"])) {

            $alert = '<div class="callout callout-danger fade in" style="margin-top:25px;">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <h5>Contraseña incorrecta</h5>
                    </div>';
        }
    }
    return '<!-- Login wrapper -->
<div class="login-wrapper">
    <form action="ajax/login.php" method="POST" role="form">
    <div class="ctm-login-logo"><img src="images/logo_login.png" alt="gestor-energetico" /></div>
        <div class="popup-header">
            <span class="text-semibold">Login</span>
        </div>
        <div class="well">
            <div class="form-group has-feedback">
                <label>Username</label>
                <input type="text" class="form-control" name="username_users" placeholder="Username">
                <i class="icon-users form-control-feedback"></i>
            </div>
            <div class="form-group has-feedback"> 
                <label>Password</label>
                <input type="password" class="form-control" name="password_users"  placeholder="Password">
                <i class="icon-lock form-control-feedback"></i>
            </div>
            <div class="row form-actions">
                <div class="col-xs-6">
                    <div class="checkbox checkbox-success">
                        <label>
                            <input type="checkbox" class="styled">
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="col-xs-6">
                    <button type="submit" class="btn btn-warning pull-right"><i class="icon-menu2"></i> Sign in</button>
                </div>
            </div>
        </div>
    </form>
' . $alert . '
</div>  
<!-- /login wrapper -->';
}
