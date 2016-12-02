<div class="row">
    <div class="col-md-3">
        <form method="POST" action="/blog/user/logout">
            <button name ="logout" value="1" class="btn btn-primary wellcome"><span>Logout</span></button>
        </form>
    </div>
    <div class="col-md-9">
        <div class="alert-success"><?php echo "Вы вошли как " . $_SESSION['user_name']; ?></div>
    </div>
</div>