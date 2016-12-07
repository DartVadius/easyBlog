<?php 
$pagePr = $page - 1;
$pageNx = $page + 1;
if ($page <= 1) {
    $pagePr = 1;
}
if ($page >= $_SESSION['page_num']) {
    $pageNx = $_SESSION['page_num'];
}
?>
<div class="row">
    <div class="col-lg-2">
        <form method="POST" action="/blog/article/addArticle">
            <button name ="addArticle" value="1" class="btn btn-primary wellcome"><span>New article</span></button>
        </form><br>
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
                echo "<button name ='update' value='' class='btn btn-primary wellcome'><span>Update</span></button>";
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
          <li><a href='/blog/admin/index/<?php echo $pagePr; ?>'>Prev</a></li>
          <li><a href='/blog/admin/index/<?php echo $pageNx; ?>'>Next</a></li>
        </ul>
    </div>    
</div>