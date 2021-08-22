<!--- inicio 1 ( Orientar o php para o que deve ser feio!!! ) -->
<?php

$erro = null;
$valido = false;

if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
{
    if(strlen(utf8_decode($_POST["nome"])) < 5)
    {
        $erro = "<div class='alert alert-success'> Preecha o campo nome corretamente (Com o minimo de 5 caracteres!)</div>";
    }
    else if(strlen(utf8_decode($_POST["email"])) < 6)
    {
        $erro = "<div class='alert alert-success'>Email invalido preencha corretamente.</div>";
    }
    else if(is_numeric($_POST["idade"]) == false)
    {
        $erro = "<div class='alert alert-success'>O campo idade, deve ser numerico!</div>";
       
    }
    else if($_POST["sexo"] != 'M' && $_POST["sexo"] != 'F')
    {
        $erro = "<div class='alert alert-success'>Selecione o campo sexo corretamente!</div>";
    }
    else if  ($_POST["estadocivil"]  != "Solteiro(a)"
           && $_POST["estadocivil"]  != "Casado(a)"
           && $_POST["estadocivil"]  != "Divorcido(a)"
           && $_POST["estadocivil"]  != "Viuvo(a)"
           )
    {
        $erro = "<div class='alert alert-success'> selecione o campo de estado civil corretamente. </div>";
    }
    else if(strlen(utf8_decode($_POST["senha"])) < 6)
    {
        
        $erro = "<div class='alert alert-success'> O campo de senha deve ser preenchido, com o minino de 6 caraceteres.</div>";
        //echo "<div class='alert alert-success'>  <strong>$erro </strong> </div>";
    }
    else
    {
        $valido = true;
        
        //  Inicio --- conecxão com o banco de dados começa aqui!! --- \\
        
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
        
        $sql = "INSERT INTO usuarios(nome, email, idade, sexo, estado_civil, humanas, exatas, biologicas, senha)
        VALUES(?,?,?,?,?,?,?,?,?)";
        
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
         // Fim exemplo de If curto
         
         $passwordHash = md5($_POST["senha"]);
         $stmt->bindParam(9, $passwordHash);
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

?>
<!--- Fim 1 ( Orientar o php para o que deve ser feio!!! ) -->


<html>
    <head>
        <title>Banco de dados Cadastro</title>
        <link rel="stylesheet" type="text/css" href="css/theme-cadastro.css">
    </head>
    
    <body>
             <!-- inicio 2 informa o tipo de erro -->
        <?php
        if($valido == true)
        {
            echo "<div class='alert alert-success'>  <strong>Sucesso! </strong> Dados enviados! </div>";
            //echo"Dados enviados, com sucesso!";
            echo"<br>";
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
        
        
        <H1>Cadastro de Clientes</H1>
        <div id="form">
        <form method=POST action="BancoDeDados_Cadastro.php?validar=true">
            
			<!-- mantem os elementos preenchidos-->
			          
          <label>Nome:</label> <br>
			<input type=TEXT name=nome  <?php if(isset($_POST["nome"])) {echo  "value='"  . $_POST["nome"]  . "'";} ?> ><br>    
           <label>E-mail: </label> <br>
            <input type=TEXT name=email <?php if(isset($_POST["email"])){echo "value='" . $_POST["email"]    . "'";} ?> ><br>  
           <label>Idade:</label> <br>
            <input type=TEXT name=idade  <?php if(isset($_POST["idade"])){echo "value='" . $_POST["idade"]   . "'";} ?> ><br>  
            <br>
            
            <label>Sexo:</label> <br>
            <input type=RADIO name=sexo value="M"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "M") {echo  "checked";} ?>>Masculino
            <input type=RADIO name=sexo value="F"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "F") {echo  "checked";} ?>>Feminino
            <br> <br>
            
            <label>Interesses:</label> <br>
            <input type=CHECKBOX name="humanas"    <?php if(isset($_POST["humanas"]))   {echo "checked";}  ?>  >Ciências Humanas
            <input type=CHECKBOX name="exatas"     <?php if(isset($_POST["exatas"]))    {echo "checked"; } ?>  >Ciências Exatas
            <input type=CHECKBOX name="biologicas" <?php if(isset($_POST["biologicas"])){echo "checked"; } ?>  >Ciências Biologicas 
            <br>
            <br>            
            <label>Estado Civil:</label> 
            <select name="estadocivil">
                <option>Selecione..</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo"Selected";} ?> >Solteiro(a)  </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)") {echo"Selected";}   ?> >Casado(a)    </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorcido(a)") {echo"Selected";} ?> >Divorcido(a)</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viuvo(a)") {echo"Selected";}    ?>  >Viuvo(a)     </option>  
            </select>
            <br>
            <br>
            <label> Senha: </label><br>
            <input type=PASSWORD name="senha"><br>
            <p>
            <button id="reset" type=RESET value="limpar">Limpar</button>
            <button id="sumit" type=SUBMIT value="Enviar">Enviar</button>
             </p>
            
         </form>        
        </div>
        <!-- fecha o bloco php aberto logo abaixo do body -->
        
        <?php
        
        }
        
        ?>
    </body>
</html>