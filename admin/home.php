

<?php
    //incluir o menu
include "menu.php";



if ( !isset( $_SESSION["admin"]["id"] ) ) {
        //direcionar para o index
    header( "Location: index.php" );
}

    //incluir o arquivo para conectar no banco
include "../config/conecta.php";

?>

    <h1>Welcome</h1>
</body>
</html>