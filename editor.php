<?php
session_start();

require_once 'function.php';
require_once 'connection.php';

$elenco=false;
$token = getFromGet('token');
$message = getFromGet('message');
$elenco = getFromGet('elenco');
$modify = getFromGet('modify');
$delete = getFromGet('delete');
$commento = getFromGet('commento');
$idpost = getFromGet('idpost');
$accept = getFromGet('accept');
$deletecomment = getFromGet('deletecomment');




if((!isset($_COOKIE['token'])) || ($_COOKIE['token'] != $token)){
    header('Location: index.php');
    exit();
}else{
   if($delete) deleteNews ($delete);
   if($deletecomment)  deleteComment ($deletecomment);
   if($accept) acceptComment($accept);

    if($modify){
         $news = getNewsById($modify); 
    }else $news = $editor; 
?>
<!DOCTYPE html>
<html lang="it">
  <head>
    <!-- Required meta tags always come first -->
    <title>Scimmietta pSiCoPaTiCa</title>
    <meta name="description">
    <meta name="keywords">
    <meta name="author" content="Mirko Fenu">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="http://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic" rel="stylesheet" type="text/css">
   <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    
   <script src="js/scripts.js"></script>
  <script src="tinymce/tinymce.min.js"></script>
  <script language="javascript" type="text/javascript">
  tinyMCE.init({
        mode : "exact",
	elements : "textarea1",
        plugins: 'lists advlist autolink code link textcolor image imagetools',
        toolbar: 'undo redo | formatselect | alignleft aligncenter alignright alignjustify | bold italic | bullist numlist outdent indent | link | forecolor | code | image ',
        default_link_target: '_blank',
        textcolor_cols: '5',
        height: '300',
        width: '100%',
        menubar: false,
        imagetools_toolbar: "rotateleft rotateright | flipv fliph | editimage imageoptions",
        
        images_upload_url: 'postAcceptor.php',
        images_upload_base_path: 'images',
        images_upload_credentials: true
  
    });
  </script>
</head>
    <body>
        <div class="container-fluid" id="main">
            <h1 class="title">Editor Articoli</h1>
            <?php
                
                if($message){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Messaggio</strong> <?=$message;?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
                }
            ?>
            <div class="row">
                <div class="col-lg-2 btn btn-group-vertical menublock">
                    <button type="button" onclick="location.href='index.php'" class="btn btn-dark"><i class="fa fa-home"></i> Home Page</button>
                    <button type="button" onclick="location.href='editor.php?token=<?=$token?>'" class="btn btn-dark"><i class="fa fa-pencil"></i> Nuovo Articolo</button>
                    <button type="button" onclick="location.href='editor.php?token=<?=$token?>&elenco=1'" class="btn btn-dark"><i class="fa fa-th-list"></i> Elenco articoli</button>
                </div>
            
            
            
                <div class="col-lg-10"> 
            <?php    
                if($elenco){
                    require_once 'elenco_articoli.php';
                    
                }else if($commento){
                    require_once 'elenco_commenti.php';
                    
                }else require_once 'tiny.php';
            ?>
                </div>
        </div>
        </div>
    </body>
    </html>

<?php
}
require_once 'footer.php';

