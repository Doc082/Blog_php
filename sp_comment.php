<?php

require_once 'function.php';
require_once 'connection.php';

if (isset($_POST)) {
    if($_POST['email'] == '') $_POST['email'] = 'anonimo';
    
    if($_POST['commento'] == ''){
        header('Location:/index.php?url='.$_POST['url'].'&message=Devi scrivere qualcosa nei commenti');
        exit();
    }
    if (insertComment($_POST)) {
        header('Location:/index.php?url='.$_POST['url'].'&message=Grazie per il tuo commento');
        exit();
    }
}

header('Location:index.php');

