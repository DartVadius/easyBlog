<div class="row">
    <div class="col-lg-2">
        <a class="btn btn-sm btn-block btn-primary" href='/blog/admin'>Main</a>
        <?php
        if ($_SESSION['user_group'] >= 25) {
            echo "<a class='btn btn-sm btn-block btn-primary' href='/blog/admin/users'>Users</a>";
        }
        ?>
    </div>
    <div class="col-lg-10">

        <form class='' action='/blog/admin/saveUpdateUser/<?php echo $user->getUserId()  ?>' method='POST'>
            <p>Пользователь: <?php echo $user->getUserName(); ?> </p>
            <p><label for="group" class="">Выберите категорию</label></p>
            <select name ="group" size="1">
                <?php
                    foreach ($access as $gr) {
                        echo "<option value='{$gr->getGroupValue()}'>" . $gr->getGroupName() . "</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Save changes" name="submit" class="btn btn-primary btn-xs">
        </form>
    </div>
    <div class="col-lg-2">

    </div>
</div>