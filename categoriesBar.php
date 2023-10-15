<?php
$categories = '';
$year = 0;
$arrayCategories= getCategories();
foreach ($arrayCategories as $cat) {
    $categories = $cat;

    foreach ($AllNews as $old) {
        $newyear = date('Y', strtotime($old['create_at']));
        if ($year != $newyear) {
            if ($year != 0)
                echo "<hr>";
            echo $newyear . "<br>";
            $year = $newyear;
        }
        if ($cat == $categories) {
            ?>
                 
                <p class="categories"><a href="/index.php?categoria=<?= $cat ?>"><?= $cat ?></a></p>
                    
                <?php
                $categories = '';
            }


            if ($old['categoria'] == $cat) {
                ?>

                <p class="oldtitle"><a href="<?= $old['url'] ?>"><?= $old['titolo'] ?></a></p>
            <?php
        }
    }

    echo '<p>&nbsp;</p>';
}
?>