<div class="row page-header">
    <div class="col-md-7 text-right">
    </div>
    <div class="col-md-3 text-center">
        <div class="alert-info"><?php echo "Вы вошли как " . $_SESSION['user_name']; ?></div>
    </div>
    <?php
        if (!empty($_SESSION['user_group']) && $_SESSION['user_group'] >= 5) {
            include_once 'adminbtn.php';
        }
    ?>
    <div class="col-md-1 text-right">
        <form method="POST" action="/blog/user/logout">
            <button name ="logout" value="1" class="btn btn-primary wellcome"><span>Logout</span></button>
        </form>
    </div>
</div>