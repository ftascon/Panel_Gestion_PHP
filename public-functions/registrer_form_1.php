<?php function get_registrer_form(){
return '<!-- Login wrapper -->
<div class="login-wrapper">
    <form action="ajax/login.php" method="POST" role="form">
        <div class="popup-header">
            <span class="text-semibold">User Login</span>
        </div>
        <div class="well">
            <div class="form-group has-feedback">
                <label>Username</label>
                <input type="text" class="form-control" name="email_users" placeholder="Username">
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
</div>  
<!-- /login wrapper -->';
}
