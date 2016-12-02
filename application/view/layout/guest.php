<div class="row page-header">
    <div class="col-md-9">
    </div>
    <div class="col-md-3">
        <div class="alert-info">
            <?php echo $_SESSION['msg'];
            $_SESSION['msg'] = ''; ?>
        </div>
        <form method="POST" action="/blog/user/login">            
            <div class="text-right">
            <label for="login" class="">Логин</label>
            <input name="login" type="text" size="20" required='required'><br>
            <label for="pass" class="">Пароль</label>
            <input name="pass" type="password" size="20" required='required'>
            <button name ="logout" value="1" class="btn btn-primary wellcome"><span>Login</span></button>
            </div>
        </form>
    </div>
</div>