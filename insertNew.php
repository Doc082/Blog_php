<?php
require_once 'header.php';
require_once 'function.php';
require_once 'connection.php';

$token = getFromGet('token');
$update = getFromGet('update');

if ((!isset($_COOKIE['token'])) || ($_COOKIE['token'] != $token)) {
    header('Location: index.php');
} else {
// per prima cosa verifico che il file sia stato effettivamente caricato
    if (!isset($_FILES['copertina']) || !is_uploaded_file($_FILES['copertina']['tmp_name'])) {
        echo 'Non hai inviato nessun file...';
    }

//percorso della cartella dove mettere i file caricati dagli utenti
    $uploaddir = 'images/';

//Recupero il percorso temporaneo del file
    $userfile_tmp = $_FILES['copertina']['tmp_name'];

//recupero il nome originale del file caricato
    $userfile_name = rand().'-';
	$userfile_name .= $_FILES['copertina']['name'];
	
//echo $userfile_name. "<br>".$userfile_tmp;
//copio il file dalla sua posizione temporanea alla mia cartella upload
    if (move_uploaded_file($userfile_tmp, $uploaddir.$userfile_name)) {
        //Se l'operazione è andata a buon fine...
        //echo 'File inviato con successo.';
    } else {
        //Se l'operazione è fallta...
        $userfile_name=$_POST['altcopertina'];
    }
    $_POST['copertina'] = $userfile_name;
    
    if (!$update) {
        if (insertNews($_POST)>0) {
            header('Location: editor.php?token=' . $_COOKIE['token'] . "&message=Articolo caricato con successo");
        }
    } else {
         if (updateNews($_POST, $update)>0) {
            header('Location: editor.php?token=' . $_COOKIE['token'] . "&message=Articolo aggiornato con successo");
        }
    }
    echo "errore database";
}