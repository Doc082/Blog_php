<?php
include 'function.php';
include 'connection.php';



$titlecat='';
$atag[]='';
$urlNews='';
$search = getFromGet('search');
$category = getFromGet('categoria');
$message = getFromGet('message');


if($category){
    $news = selectCategory($category);
}else if($search){
    $news = searchNews($search);
}else{
    $urlNews = getFromGet('url');
    if($urlNews){
        $news[0] = getNews($urlNews);
        $titolo = $news[0]['categoria'].' - '.$news[0]['titolo'].' | Scimmietta pSiCoPaTiCa';
        $atag= explode(',', $news[0]['hashtag']);
        $titlecat = $news[0]['categoria'];
        $titleimg = 'images/'.$news[0]['immagini'];
		$description = $news[0]['descrizione'];
    }else $news = getAllNews(10);
    
}
$AllNews = getAllNews();

require_once 'header.php';
require_once 'navbar.php';
?>
<p>&nbsp;</p>
<?php
if ($message) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Messaggio</strong> <?= $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
}
?>
<div class="row">
    
    <div class="col-md-8 offset-2 news">
        <div class="row"> 
            <div class="col-md-10">

                <?php
                foreach ($news as $articolo) {

                    $hashConvert = hashtag($articolo['hashtag']);
                    //if(!$urlNews) $articolo['contenuto'] = substr($articolo['contenuto'],0,200);
                    ?>   


                    <?php
                    if ($articolo['immagini']) {

                        $immagine = trim($articolo['immagini']);
                        ?>
                        <div class="intestazione">
                            <a href="<?= $articolo['url'] ?>"><img src="images/<?= $immagine ?>" alt="<?= $articolo['titolo'] . ' immagine' ?>" ></a>
                            <span>
                                <?= ucfirst($articolo['titolo']) ?>  
                            </span>
                        </div>
                        <?php
                    }
                    ?>

                    <p><?= $date = date('d/m/Y', strtotime($articolo['create_at'])); ?> - <?= ucfirst($articolo['categoria']) ?></p>
                    <div>
                    <?php
                    echo $articolo['contenuto'];
                    /* if(!$urlNews)
                      {
                      ?> ... <a href="<?=$articolo['url']?>">Leggi tutto l'articolo</a>
                      <?php
                      } */
                    ?>
                    </div>  
                     <p>&nbsp;</p>
                     <p>&nbsp;</p>
                    <?php
                    foreach ($hashConvert as $key => $hashUrl) {
                        if (!$key === 0) {
                            echo ", ";
                        }
                        ?>   
                    
                        <a href="index.php?search=<?= substr($hashUrl, 1) ?>"><?= $hashUrl ?></a>
                    
                        <?php
                    }
                    ?>
                   
                    <hr>



    <?php
    if($urlNews) require_once 'comments.php';
}
?>
            </div>

            <div class="col-md-2">
                <?php
                    require_once 'leftbar.php';
                ?>
                <p>&nbsp;</p>
                <h6>Tutti gli articoli</h6>
                
                
                <?php
                require_once 'categoriesBar.php';
                ?>
                <p>&nbsp;</p>
               
            </div>
        </div>
    </div>

</div>


<?php
require_once 'footer.php';

