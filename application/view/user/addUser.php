<div class="row">
    <div class="col-md-6">
    <div class="text-right">
    <div class="alert-warning">
        <?php echo $_SESSION['msg'] ?>
    </div>        
    <form class="" action="/blog/user/saveUser" method="POST">        
        <label for="name" class="">Придумайте имя (будет отображаться на сайте)</label>
        <input name="name" type="text" size="50" required='required' value="<?php echo $_SESSION['reg_name'] ?>"><br>
        <label for="login" class="">Придумайте логин</label>
        <input name="login" type="text" size="50" required='required' value="<?php echo $_SESSION['reg_log'] ?>"><br>        
        <label for="pass" class="">Придумайте пароль</label>
        <input name="pass" type="password" size="50" required='required'><br>
        <label for="passcheck" class="">Повторите пароль</label>
        <input name="passcheck" type="password" size="50" required='required'><br>
        <label for="email" class="">Введите емэйл</label>
        <input name="email" type="text" size="50"><br>        
        <input type="submit" value="Зарегистрироваться" name="submit" class="btn btn-primary">  
        
    </form>
     </div>   
    </div>
</div>