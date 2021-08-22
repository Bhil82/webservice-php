<?php
    ob_start();
?>
<HTML>
    <HEAD>
        <TITLE>Sessão e Cookies: Autenticação</TITLE>
        <link rel="stylesheet" type="text/css" href="css/theme-autenticar.css">
    </HEAD>
    <BODY>
        
<?php

    if(isset($_COOKIE["visitas"]))
    {
        $visitas = $_COOKIE["visitas"] + 1;
    }
    else
    {
        $visitas = 1;
    }

    setcookie("visitas", $visitas, time() + 30*24*60*60);
    
    echo "<p id='acesso'>Essa é a sua visita número [ " . $visitas . " ] em nosso site. </p>";
    
    if(isset($_REQUEST["autenticar"]) && $_REQUEST["autenticar"] == true)
    {
        $hashDaSenha = md5($_POST["senha"]);
        
        try
        {
            $connection = new PDO("mysql:host=localhost; dbname=cursophp", "root", "");
            $connection->exec("set names utf8");
        }
        catch(PDOException $e)
        {
            echo "<p id='alert1>Falha: " . $e->getMessage();
            exit();
        }
        
        $sql = "SELECT nome FROM usuarios WHERE email = ? AND senha = ?";
        $rs = $connection->prepare($sql);
        $rs->bindParam(1, $_POST["email"]);
        $rs->bindParam(2, $hashDaSenha);
        
        if($rs->execute())
        {
            if($registro = $rs->fetch(PDO::FETCH_OBJ))
            {
                session_start();
                $_SESSION["usuario"] = $registro->nome;
                
                header("location: Sessao_cookies_ConteudoSigiloso.php");
            }
            else
            {
                echo "<p id='alert2'> Dados inválidos.</p>";
            }
        }
        else
        {
            echo "<p id='alert3'> Falha no acesso. </p>";
        }
    }
    
?>
   
        <FORM method=POST action="?autenticar=true">
          
           <label > E-mail: </label><INPUT type=TEXT name=email><BR><BR>
           <label > Senha:  </label> <INPUT type=PASSWORD name=senha><BR>
           <p>
            <button id=submit type=SUBMIT value="autenticar"> Autenticar </button>
           </p>
        </FORM>
 </BODY>
</HTML>
<?php
    ob_flush();
?>