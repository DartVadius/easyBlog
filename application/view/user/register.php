<div class="row page-header">
    <form class="" action="/blog/index" method="POST">
        <button class="btn btn-primary">Вернуться</button>
    </form>
</div>
<div class="row">
    <div class="alert-info text-center">
        <?php echo $_SESSION['msg']; ?>
    </div>
</div>   
<div class="row">
    <div class="col-lg-12">
        <form class="" action="/blog/user/saveUser" method="POST"> 
        <div class="col-lg-6 text-right">
            <label for="name" class="">Придумайте имя</label>
            <input name="name" type="text" size="50" required='required' value="<?php echo $_SESSION['reg_name'] ?>"><br>
            <label for="login" class="">Придумайте логин</label>
            <input name="login" type="text" size="50" required='required' value="<?php echo $_SESSION['reg_log'] ?>"><br>
            <label for="pass" class="">Придумайте пароль</label>
            <input name="pass" type="password" size="50" required='required'><br>
            <label for="passcheck" class="">Повторите пароль</label>
            <input name="passcheck" type="password" size="50" required='required'><br>
            <label for="email" class="">Введите email</label>
            <input name="email" type="text" size="50"><br>            
            <input type="submit" value="Зарегистрироваться" name="submit" class="btn btn-primary">            
        </div> 
    </form>
    </div>
    
</div>