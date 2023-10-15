<title><?= $titolo ?></title>
<meta name="description" content="<?=$description?>">
<meta name="author" content="Mirko Fenu">
    
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta name="robots" content="noodp"/>
<link rel="canonical" href="<?=$siteUrl.$urlNews?>" />
<meta property="og:locale" content="it_IT" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$titolo?>" />
<meta property="og:description" content="<?=$description?>" />
<meta property="og:url" content="<?=$siteUrl.$urlNews?>" />
<meta property="og:site_name" content="Scimmietta pSiCoPaTiCa" />
<?php
    if(count(array_filter($atag))){
        foreach($atag as $tag){
        $tag = trim($tag);
?>
<meta property="article:tag" content="<?=$tag?>" />

<?php
    
        }
        echo"<meta property=\"article:section\" content=\"$titlecat\" />";
    }

?>

<meta property="og:image" content="<?=$siteUrl.$titleimg?>" />

<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?=$description?>" />
<meta name="twitter:title" content="<?=$titolo?>" />
<meta name="twitter:image" content="<?=$siteUrl.$titleimg?>" />