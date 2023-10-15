<?php
session_start();
require_once 'header.php';
include 'config.php';

$message = 'Ciao Scimmietta, inserisci Username e Password';
if(isset($_COOKIE['token'])){
    header("Location: editor.php?token=".$_COOKIE['token']);
}
if((isset($_SESSION['token'])) && (isset($_POST['username'])) && (isset($_POST['password'])))
{
    if($_SESSION['token'] == $_POST['token']){
        $username=$_POST['username'];
        $password=$_POST['password'];
    
        if($username == $admin['username']){
            if($password == $admin['password']){
            setcookie("token",$_SESSION['token'],time()+3600000);
            header("Location: editor.php?token=".$_SESSION['token']);
         }
        } 
    $message = "Nome Utente o Password errata";
    }else $message = 'Tentativo di accesso non autorizzato';
}else {
    $token = time() . "scimmietta";
    $_SESSION['token'] = password_hash($token, PASSWORD_DEFAULT);
}
?>

<p>&nbsp;</p>
<p>&nbsp;</p>


<h2 class="message"><?=$message?></h2>
<p>&nbsp;</p>
<div class="row justify-content-md-center">

    <form method="POST" action="sp_admin.php">
   <div class="input-group input-group-lg mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-lg">Username</span>
    </div>
    <input type="text" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="username">
   </div>
    
    <div class="input-group input-group-lg mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text" id="inputGroup-sizing-lg">Password</span>
    </div>
    <input type="password" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="password">
   </div>
    <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
    <button type="submit" class="btn btn-primary">Login</button>
</form>

</div>

<?php
require_once 'footer.php';

