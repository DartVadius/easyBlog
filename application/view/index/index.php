<table>
<?php
foreach ($category as $value) {    
    echo "<tr>";
    echo "<td>Category title: ".$value->getCategoryName()."</td>";    
    echo "</tr>";
} ?>
</table>