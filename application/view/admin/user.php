<div class="row">
    <div class="col-lg-2">

    </div>
    <div class="col-lg-10">

        <form class="" action="/admin/saveUpdateUser" method="POST">
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