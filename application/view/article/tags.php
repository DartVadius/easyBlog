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
                echo "<p><a href='/blog/article/id/" . $art->artId . "'>Подробнее</a></p>";
                echo "</div>";                
            }
        }
        ?>
    </div>
    <div class="col-lg-1">
        
    </div>
</div>