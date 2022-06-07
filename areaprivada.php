<?php
    session_start();
    if(!isset($_SESSION['id_usuario']))
    {
        header("location: index.php");
        exit;
    }


?>



seja bem vindo seu trouxa!!
<br><br>
<button><a href="sair.php">sair</a></button>
