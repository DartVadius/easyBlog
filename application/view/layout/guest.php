<div class="row page-header">
    <div class="col-md-9">
    </div>
    <div class="col-md-3">
        <div class="alert-info small">
            <?php echo $_SESSION['msg'];
            $_SESSION['msg'] = ''; ?>
        </div>
        <form method="POST" action="/blog/user/login" class="text-right">
            <label for="login" class="">Логин</label>
            <input name="login" type="text" size="20" required='required'><br>
            <label for="pass" class="">Пароль</label>
            <input name="pass" type="password" size="20" required='required'><br>
            <a href="/blog/user/register">Регистрация</a>
            <input type="submit" value="Login" name="submit" class="btn btn-primary">            
        </form>        
    </div>
</div>