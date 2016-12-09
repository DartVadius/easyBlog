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
            foreach ($tags as $tag) {
                echo "<a href='/blog/article/tag/" . $tag->getTagId() . "' class='btn btn-primary btn-xs'>" . $tag->getTagName() . "</a>&nbsp;";
            }
            echo "<p></p>";
            echo "</div>";
            echo "<br>";
        }
        ?>
    </div>
    <div class="col-lg-1">

    </div>
</div>