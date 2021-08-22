 <html>
    <head>
        <title>Banco de dados: Alterar</title>
        <link rel="stylesheet" type="text/css" href="css/theme-alterar.css">
    </head>
      
 <body>
            <H1>Alterar cadastro de clientes</H1>
            
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
    if(strlen(utf8_decode($_POST["nome"])) < 5)
    {
        $erro = "<div class='alert alert-success'>Preecha o campo nome corretamente (Com no minimo de 5 caracteres!)</div>";
    }
    else if(strlen(utf8_decode($_POST["email"])) < 6)
    {
        $erro = "<div class='alert alert-success'>Email invalido preencha corretamente.</div>";
    }
   else if(is_numeric($_POST["idade"]) == False)
    {
        echo  "<div class='alert alert-success'> O campo idade, deve ser numerico!</div>";
        echo  "<BR><BR><A href='?id=".$_POST["id"]."'>Tentar novamente</A>";
        echo $erro;
        exit();
    }    
    else if($_POST["sexo"] != "M" && $_POST["sexo"] != "F")
    {
        $erro = "Selecione o campo sexo corretamente!";
    }
    else if  ($_POST["estadocivil"]  != "Solteiro(a)"
           && $_POST["estadocivil"]  != "Casado(a)"
           && $_POST["estadocivil"]  != "Divorcido(a)"
           && $_POST["estadocivil"]  != "Viuvo(a)"
           )
    {
        $erro = "<div class='alert alert-success'>selecione o campo de estado civil corretamente.</div>";
    }
      else
    {
        $valido = true;
        
         //  Inicio --- conecxão com o banco de dados começa aqui!! --- \\      
        
        $sql = "UPDATE usuarios SET
                nome = ?,
                email = ?,
                idade = ?,
                sexo = ?,
                estado_civil = ?,
                humanas = ?,
                exatas = ?,
                biologicas = ?
                WHERE id = ?";

        $stmt = $connection->prepare($sql);
        
        $stmt->bindParam(1, $_POST["nome"]);
        $stmt->bindParam(2, $_POST["email"]);
        $stmt->bindParam(3, $_POST["idade"]);
        $stmt->bindParam(4, $_POST["sexo"]);
        $stmt->bindParam(5, $_POST["estadocivil"]);
         //inicoi exemplo de If curto       
        $checkHumanas = isset($_POST["humanas"]) ? 1 : 0;
        $stmt->bindParam(6, $checkHumanas);
        
        $checkExatas = isset($_POST["exatas"]) ? 1 : 0;
        $stmt->bindParam(7, $checkExatas);
        
        $checkBiologicas = isset($_POST["biologicas"]) ? 1 : 0;
        $stmt->bindParam(8, $checkBiologicas);
        
        $stmt->bindParam(9, $_POST["id"]);
        
        // Fim exemplo de If curto
         
         //$passwordHash = md5($_POST["senha"]);
         //$stmt->bindParam(9, $passwordHash);
         //$passwordHash = md5("@bhil@" . $_POST["senha"]);
         //$stmt->bindParam(9, $passwordHash);
         
         
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
    $rs = $connection->prepare("SELECT * FROM usuarios WHERE id = ?");
    $rs->bindParam(1, $_REQUEST["id"]);
    
    if($rs->execute())
    {
        if($registro = $rs->Fetch(PDO::FETCH_OBJ))
           {
            
            $_POST["nome"] = $registro->nome;
            $_POST["email"] = $registro->email;
            $_POST["idade"] = $registro->idade;
            $_POST["sexo"] = $registro->sexo;
            $_POST["estadocivil"] = $registro->estado_civil;
            
            $_POST["humanas"] = $registro->humanas == 1 ?  true : null;
            $_POST["exatas"] = $registro->exatas == 1 ?  true : null;
            $_POST["biologicas"] = $registro->biologicas == 1 ?  true : null;
                        
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
            echo"<div class='alert alert-success'>  <strong>Dados alterados com sucesso!</div>";
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
            
			<!-- mantem os elementos preenchidos-->
			
            Nome:<br>
			<input type=TEXT name=nome  <?php if(isset($_POST["nome"])) {echo  "value='"  . $_POST["nome"]  . "'";} ?> ><br>
            
            E-mail:<br>
            <input type=TEXT name=email <?php if(isset($_POST["email"])){echo "value='" . $_POST["email"]    . "'";} ?> ><br>
            
            Idade:<br>
            <input type=TEXT name=idade  <?php if(isset($_POST["idade"])){echo "value='" . $_POST["idade"]   . "'";} ?> ><br>
            <br>
            
            Sexo:<br>
            <input type=RADIO name=sexo value="M"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") {echo  "checked";} ?>>Masculino
            <input type=RADIO name=sexo value="F"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") {echo  "checked";} ?>>Feminino
            <br> <br>
            
            Interesses:<br>
            <input type=CHECKBOX name="humanas"    <?php if(isset($_POST["humanas"]))   {echo "checked";}  ?>  >Ciências Humanas
            <input type=CHECKBOX name="exatas"     <?php if(isset($_POST["exatas"]))    {echo "checked"; } ?>  >Ciências Exatas
            <input type=CHECKBOX name="biologicas" <?php if(isset($_POST["biologicas"])){echo "checked"; } ?>  >Ciências Biologicas 
            <br> <br>
            Estado Civil:
            <select name="estadocivil">
                <option>Selecione..</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo"Selected";} ?> >Solteiro(a)</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)")   {echo"Selected";} ?> >Casado(a)  </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorcido(a)"){echo"Selected";} ?> >Divorcido(a)</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viuvo(a)")    {echo"Selected";} ?> >Viuvo(a)    </option>  
            </select>

            <input type=HIDDEN name=id value="<?php echo $_REQUEST["id"]; ?>"> 
            <p><button id="sumit" type=SUBMIT value="Enviar">Enviar</button>
                  
          </form>
        </div>
        
        <!-- fecha o bloco php aberto logo abaixo do body -->
        <?php
        
        }
        
        ?>
    </body>
</html>