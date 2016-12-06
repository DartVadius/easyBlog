<div class="row">    
    <div class="col-lg-1">
        
    </div>
    <div class="col-lg-10">
        <?php
        $author = new UserRepository();        
        if (!empty($article)) {
            echo "<div class = 'art'>";
            echo "<h3>" . $article->artTitle ."</h3>";
            echo "<p class='small'>" . $article->artDate . "</p>";
            $name = $author->findById($article->artAuthor)->getUserName();
            echo "<p class='small'>" . $name . "</p>";
            echo "<p>" . $article->artText . "</p>";            
            echo "</div>";
        }
        ?>
    </div>
    <div class="col-lg-1">
        
    </div>
</div>