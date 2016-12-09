<div class="row">
    <div class="col-lg-2">
        <a class="btn btn-sm btn-block btn-primary" href='/blog/admin'>Main</a>
        <a class="btn btn-sm btn-block btn-primary" href='/blog/article/addArticle'>New article</a>
    </div>
    <div class="col-lg-10">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Логин</th>
                <th>E-mail</th>
                <th>Группа</th>                
            </tr>
        <?php
        if (!empty($users)) {
            foreach ($users as $user) {
                echo "<tr>";
                echo "<td>".$user->getUserId()."</td>";
                echo "<td>".$user->getUserName()."</td>";
                echo "<td>".$user->getUserLogin()."</td>";
                echo "<td>".$user->getUserEmail()."</td>";
                $rep = new GroupRepository();
                $group = $rep->findByValue($user->getUserGroup())->getGroupName();
                echo "<td>".$group."</td>";                                
                echo "<td>";
                echo "<form method='POST' action='/blog/admin/updateuser/" . $user->getUserId() . "' class='text-right'>";
                echo "<button name ='update' value='' class='btn btn-primary btn-xs wellcome'><span>Update</span></button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='POST' action='/blog/admin/deleteuser/" . $user->getUserId() . "' class='text-right'>";
                echo "<button name ='delete' value='' class='btn btn-primary btn-xs wellcome'><span>Delete</span></button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        }
        ?>     
        </table>
    </div>
</div>