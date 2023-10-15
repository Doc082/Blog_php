

<nav class="navbar">
  
    <form class="form-inline mx-auto">
        <button style="margin:5px;"class="btn btn-lg btn-outline-danger right" onclick="location.href='index.php'" type="button">Home</button>  
        <?php
            $categories = getCategories();
            $cicle=false;
            
            foreach($categories as $button){
        ?>
        <button rel="category tag" style="margin:5px;" class="btn <?= !$cicle?'btn-outline-warning left':'btn-lg btn-outline-danger right'?> " onclick="location.href='index.php?categoria=<?=$button?>'" type="button"><?= ucfirst($button)?></button>  
       <?php
            
                if($cicle) $cicle=false;
                else $cicle=true;
            }
        ?>  
  </form>   
</nav>
   
