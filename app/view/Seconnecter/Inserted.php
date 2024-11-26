<?php 
require ($root . '/app/view/fragment/fragmentHeader.html');
if($results) { 
    if(!isset($_SESSION)) {
    session_start();
    }
    $_SESSION['login']=$_GET['login'];
    $_SESSION['nom']=$_GET['nom'];
    $_SESSION['prenom']=$_GET['prenom'];
    $_SESSION['statut']=$_GET['statut'];
echo('<div class=\'bg-success-subtle\'> 
<h2 class="text-success">Inscription réussie !</h2>
<br/>
</div>
<a href="router1.php?action=truc"><button type="button" class="btn btn-primary">Retour au site </button> </a>
');
}

?>
