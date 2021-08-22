<!--- inicio 1 ( Orientar o php para o que deve ser feio!!! ) -->
<?php

$erro = null;
$valido = false;

if(isset($_REQUEST["validar"]) && $_REQUEST["validar"] == true)
{
    if(strlen(utf8_decode($_POST["nome"])) < 5)
    {
        $erro = "Preecha o campo nome corretamente (Com no minimo de 5 caracteres!)";
    }
    else if(strlen(utf8_decode($_POST["email"])) < 6)
    {
        $erro = "Email invalido preencha corretamente.";
    }
    else if(is_numeric($_POST["idade"]) == false)
    {
        $erro = "O campo idade, deve ser numerico!";
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
        $erro = "selecione o campo de estado civil corretamente.";
    }
    else if(strlen(utf8_decode($_POST["senha"])) < 6)
    {
        $erro = "O campo de senha deve ser preenchido, com o minino de 6 caraceteres.";
    }
    else
    {
        $valido = true;
    }
}

?>
<!--- Fim 1 ( Orientar o php para o que deve ser feio!!! ) -->
<html>
    <head>
        <title>Formularios: Avançado</title>
    </head>
    
    <body>
        
        <!-- inicio 2 informa o tipo de erro -->
        <?php
        if($valido == true)
        {
            echo"Dados enviados, com sucesso!";
        }
        else
        {
        if(isset($erro))
        {
            echo $erro . "<br><br>";
            
        }
        
        ?>
        <!-- fim 2 informa o tipo de erro -->
        
        <form method=POST action="Formularios_avancado.php?validar=true">
            
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
            <br>
            
            Interesses:<br>
            <input type=CHECKBOX name="humanas"    <?php if(isset($_POST["humanas"]))   {echo "checked";}  ?>  >Ciências Humanas
            <input type=CHECKBOX name="exatas"     <?php if(isset($_POST["exatas"]))    {echo "checked"; } ?>  >Ciências Exatas
            <input type=CHECKBOX name="biologicas" <?php if(isset($_POST["biologicas"])){echo "checked"; } ?>  >Ciências Biologicas 
            <br> <br>
            Estado Civil:
            <select name="estadocivil">
                <option>Selecione..</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro(a)") {echo"Selected";} ?> >Solteiro(a)  </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado(a)") {echo"Selected";}   ?> >Casado(a)    </option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Divorcido(a)") {echo"Selected";} ?> >Divorcido(a)</option>
                <option <?php if(isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Viuvo(a)") {echo"Selected";}    ?> >Viuvo(a)     </option>  
            </select>
            <br><br>
            Senha:<br>
            <input type=PASSWORD name="senha"><br><br>
            <input type=SUBMIT value="Enviar">
            
            
        </form>
        <!-- fecha o bloco php aberto logo abaixo do body -->
        <?php
        }
        ?>
    </body>
</html>