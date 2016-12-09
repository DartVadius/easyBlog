<?php
$tree = SupportLib::tree('category_id', 'category_parent_id', 'category');
$menu = showCategoryTree($tree);

function showCategoryTree($data) {
    static $tree;
    $tree .= "<ul class='dropdown-menu'>";
    foreach($data as $arr){
        if (!empty($arr['children'])) {
            $tree .= "<li class='list-unstyled dropdown dropdown-submenu'><a href='/blog/article/category/" . $arr['category_id'] . "'>" . $arr['category_name'] . "</a></li>";
            showCategoryTree ($arr['children']);
        } else {
            $tree .= "<li class='list-unstyled dropdown dropdown-submenu'><a href='/blog/article/category/" . $arr['category_id'] . "'>" . $arr['category_name'] . "</a></li>";
        }
    }
    $tree .= "</ul>";
    return $tree;
}
?>
<div class="row">
    <div class="col-lg-1">

    </div>
    <div class="col-lg-10">
        <nav class="navbar navbar-static-top navbar-brand marginBottom-0" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/blog/article/index">Home</a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Category <b class="caret"></b></a>
                    <?php echo $menu; ?>
                </li>
            </ul>
        </div>
        </nav>
    </div>
    <div class="col-lg-1">

    </div>
</div>