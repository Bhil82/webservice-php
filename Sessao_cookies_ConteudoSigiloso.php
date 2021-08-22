<?php
ob_start();
?>
<html>
    <head>
        <title>sessão e cookies: Conteudo Sigiloso</title>
        <link rel="stylesheet" type="text/css" href="css/theme-sigiloso.css">
    </head>
    <body>
       
        <?php
        session_start();
        
        if(!isset($_SESSION["usuario"]))
        {
            echo "<p> erro </p>";
            exit();
        }
        
        echo"<h1> Olá, ". $_SESSION["usuario"];
        echo"</h1><br><br>";
        
        ?>
        
       <div id=corpo>
        [Conteudo privado / Sigiloso]
        </div>
    </body>
</html>
<?php
ob_flush();
?>