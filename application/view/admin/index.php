<?php
$pagePr = $page - 1;
$pageNx = $page + 1;
if ($page <= 1) {
    $page = $pagePr = 1;
}
if ($page >= $_SESSION['page_num']) {
    $page = $pageNx = $_SESSION['page_num'];
}
?>
<div class="row">
    <div class="col-lg-2">
        <?php
        if ($_SESSION['user_group'] >= 25) {
            echo "<a class='btn btn-sm btn-block btn-primary' href='/blog/admin/users'>Users</a>";
        }
        ?>
        <a class="btn btn-sm btn-block btn-primary" href='/blog/article/addArticle'>New article</a>
    </div>
    <div class="col-lg-10">
        <table class="table">
            <tr>
                <th>ID
                <a href="/blog/admin/index/ASC">&uarr;</a>
                <a href="/blog/admin/index/DESC">&darr;</a>
                </th>
                <th>Название статьи</th>
                <th>Дата</th>
                <th>Автор</th>
                <th>Категория</th>
                <th></th>
                <th></th>
            </tr>
        <?php
        if (!empty($articles)) {
            foreach ($articles as $article) {
                echo "<tr>";
                echo "<td>".$article->artId."</td>";
                echo "<td>".$article->artTitle."</td>";
                echo "<td>".$article->artDate."</td>";
                $rep = new UserRepository();
                $author = $rep->findById($article->artAuthor)->getUserName();
                echo "<td>".$author."</td>";
                $rep = new CategoryRepository();
                $artId = $article->artCategory;
                $cat = $rep->findById($artId);
                echo "<td>".$cat->getCategoryName()."</td>";
                echo "<td>";
                echo "<form method='POST' action='/blog/article/updateArticle/" . $article->artId . "' class='text-right'>";
                echo "<button name ='update' value='' class='btn btn-primary btn-xs wellcome'><span>Update</span></button>";
                echo "</form>";
                echo "</td>";
                echo "<td>";
                echo "<form method='POST' action='/blog/article/delete/" . $article->artId . "' class='text-right'>";
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
<div class="row">
    <div class="col-lg-2">
    </div>
    <div class="col-lg-10 pager">
        <ul>
            <li><a href='/blog/admin/index/1'><<</a></li>
            <li><a href='/blog/admin/index/<?php echo $pagePr; ?>'>Prev</a></li>
            <li><a href='#'><?php echo $page; ?></a></li>
            <li><a href='/blog/admin/index/<?php echo $pageNx; ?>'>Next</a></li>
            <li><a href='/blog/admin/index/<?php echo $_SESSION['page_num']; ?>'>>></a></li>
        </ul>
    </div>
</div>