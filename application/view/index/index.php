<?php 
$pagePr = $page - 1;
$pageNx = $page + 1;
if ($page < 1 || $page > $_SESSION['page_num']) {
    $pagePr = $pageNx = 1;
}
    
?>
<div class="row">    
    <div class="col-lg-1">
        
    </div>
    <div class="col-lg-10">
        <?php
        $author = new UserRepository();        
        if (!empty($article)) {
            foreach ($article as $art) {
                echo "<div class = 'art'>";
                echo "<h3>" . $art->artTitle ."</h3>";
                echo "<p class='small'>" . $art->artDate . "</p>";
                $name = $author->findById($art->artAuthor)->getUserName();
                echo "<p class='small'>" . $name . "</p>";
                echo "<p>" . $art->artDesc . "</p>";
                echo "<a href='/blog/article/id/" . $art->artId . "'>Подробнее</a>";
                echo "</div>";                
            }
        }
        ?>
    </div>
    <div class="col-lg-1">
        
    </div>
</div>
<div class="row">    
    <div class="col-lg-1">        
    </div>
    <div class="col-lg-10 pager">
        <ul>
          <li><a href='/blog/index/index/<?php echo $pagePr; ?>'>Prev</a></li>
          <li><a href='/blog/index/index/<?php echo $pageNx; ?>'>Next</a></li>
        </ul>
    </div>
    <div class="col-lg-1">
        
    </div>
</div>