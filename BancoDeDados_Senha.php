<html>
    <head>
        <title>Banco de dados: Alteraçaõ de Senha</title>
         <link rel="stylesheet" type="text/css" href="css/theme-senha.css">
    </head>
      <body>
        <H1>Alterar senha de cadastro</H1>
       
        <!--- inicio 1 ( Orientar o php para o que deve ser feio!!! ) -->
<?php

$erro = null;
$valido = false;

try
        {
            $connection = new PDO("mysql:host=localhost;dbname=cursophp", "root","");
            $connection->exec("set name utf8");
        }
        catch(PDOException $e)
        {
            echo "Falha: " . $e->getMessage();
            exit();
        }
        
       if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
       {
       if($_POST["senha"] != $_POST["senhaRepete"])
      {
        echo  "<div class='alert alert-success'><strong>Erro! </strong>Senhas digitadas diferentes</div>";
        echo  "<BR><BR><A href='?id=".$_POST["id"]."'>Tentar novamente</A>";
        echo $erro;
        exit();
    }
    
    //implemeto de validação de senha minimo de 6 caracer
     else if(strlen(utf8_decode($_POST["senha"])) < 6)
    {
         echo "<div class='alert alert-success'> O campo de senha deve ser preenchido, com o minino de 6 caraceteres.</div>";
            
        echo  "<BR><BR><A href='?id=".$_POST["id"]."'>Tentar novamente</A>";
        echo $erro;
        exit();
      }
  
    else
    {
        $valido = true;
        
         //  Inicio --- conecxão com o banco de dados começa aqui!! --- \\      
        
        $sql = "UPDATE usuarios SET
                senha = ?
                WHERE id = ?";

        $stmt = $connection->prepare($sql);
                
        $stmt->bindParam(1, $_POST["senha"]);              
        $stmt->bindParam(2, $_POST["id"]);
        //senha protegida com Hash
        $passwordHash = md5("@bhil@" . $_POST["senha"]);
        $stmt->bindParam(1, $passwordHash);
         
      
        
        // Fim exemplo de If curto
              
         $stmt->execute();
         
         if($stmt->errorCode() != "00000")
         {
            $valido = false;
            $erro = "Erro codigo " . $stmt->errorCode() . " : ";
            $erro = implode(", ", $stmt->errorInfo());
            
         }
                 
    }
}
else
{
    $rs = $connection->prepare("SELECT nome, email FROM usuarios WHERE id = ?");
    $rs->bindParam(1, $_REQUEST["id"]);
    
    if($rs->execute())
    {
        if($registro = $rs->Fetch(PDO::FETCH_OBJ))
           {
            
            $_POST["nome"] = $registro->nome;
            $_POST["email"] = $registro->email;
            
            //$_POST["idade"] = $registro->idade;
            //$_POST["sexo"] = $registro->sexo;
            //$_POST["estadocivil"] = $registro->estado_civil;
            //
            //$_POST["humanas"] = $registro->humanas == 1 ?  true : null;
            //$_POST["exatas"] = $registro->exatas == 1 ?  true : null;
            //$_POST["biologicas"] = $registro->biologicas == 1 ?  true : null;
                        
           }
           else
           {
            $erro = "<div class='alert alert-success'>Registro não encontrado</div>";
           }
      }
      else
           {
            $erro = "<div class='alert alert-success'>Falha na captura do registro</div>";
           }
    
    
}
   
   ?>
<!--- Fim 1 ( Orientar o php para o que deve ser feio!!! ) -->

                
       
        <!-- inicio 2 informa o tipo de erro -->
        <?php
        if($valido == true)
        {
            echo"<div class='alert alert-success'><strong>Sucesso! </strong>Senha Alterada.</div>";
            echo"<br><br>";
            echo "<a href='BancoDeDados_Lista.php'>Visualizar Cadastro</a>";
        }
        else
        {
        if(isset($erro))
        {
            echo $erro . "<br><br>";            
        }
        
        ?>
        <!-- fim 2 informa o tipo de erro -->

         <div id="corpo"> 
        <form method=POST action="?validar=true">
         
            <?php
            echo $_POST["nome"];
            echo"(". $_POST["email"]. ")";
            echo "<br>";            
            ?>
            </h4>
            <h5>Digite a nova senha.</h5>
          <h5>
  <input type=password name=senha>
            </h5>
            <h5><br>
          Repita a senha digitada.</h5>
            <h5>
  <input type=password name=senhaRepete>
              <br><br>
              
              <input type=HIDDEN name=id value="<?php echo $_REQUEST["id"]; ?> "> 
              <p><button id="sumit" type=SUBMIT value="Enviar">Enviar</button>
                  
            </h5>
        </form>
        </div>
        <!-- fecha o bloco php aberto logo abaixo do body -->
        <?php
        
        }
        
        ?>
    </body>
</html>
