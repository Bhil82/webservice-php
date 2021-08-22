<html>
    <head>
        <title>Banco de dados: Lista </title>
        <link rel="stylesheet" type="text/css" href="css/theme.css">
    </head>
    <body>
        <p>
        <ul>
  <li><a href="default.php"><h2>Inicio  </h2>  </a></li>
  <li><a href="news.php">   <h2>Portifólio </h2>  </a></li>
  <li><a href="contact.php"><h2>Ferramenta </h2>  </a></li>
  <li><a href="about.php"><h2>Mapa Cliente </h2>  </a></li>
       <br><br><br><br><br>
  <li><a href="BancoDeDados_Cadastro.php">+ Criar novo Registro  </a> <li><a href="Sessao_cookies_ Autenticacao.php"> Login   </a></a> <br></li></li>
  
</ul>
   
      </p>    

          <div id="form">
    <table id="corpo">
      <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Estado Civil</th>
                <th>Humanas</th>
                <th>Exatas</th>
                <th>Biologicas</th>
                <th>Hash da senha</th>
                <th>Ações</th>
                
      </tr>
            
            <?php
                 // inicio conectar no banco de dados, cursophp
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
        // inicio comando que remove usuario do banco de dado 
        if(isset($_REQUEST["excluir"]) && $_REQUEST["excluir"] == true)
        {
            $stmt = $connection->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bindParam(1, $_REQUEST["id"]);
            $stmt->execute();
            
            if($stmt->errorCode() != "00000")
            {              
            echo "Erro codigo " . $stmt->errorCode() . " : ";
            echo implode(", ", $stmt->errorInfo());
            }
            else
            {
                echo "<div class='alert alert-success'><strong> SUCESSO! </strong> Usuario removido.</div><br>";
            }
        }
        // fim comando que remove usuario do banco de dado 
            
            $rs = $connection->prepare("SELECT * FROM usuarios");
            
            if($rs->execute())
            {
                while($registro = $rs->fetch(PDO::FETCH_OBJ))
                {
                  echo"<tr>";
                    
                    echo"<td>". strtoupper( $registro->nome . "</td>");
                      echo"<td>". strtolower($registro->email . "</td>");
                        echo"<td>". $registro->idade . "</td>";
                          echo"<td>". $registro->sexo . "</td>";
                            echo"<td>". $registro->estado_civil . "</td>";
                              echo"<td>". $registro->humanas . "</td>";
                                echo"<td>". $registro->exatas . "</td>";
                                  echo"<td>". $registro->biologicas . "</td>";
                                    echo"<td>". $registro->senha . "</td>";
                                    
                                     echo"<td>";
                                     echo"<a href='?excluir=true&id=". $registro->id ."'>(Exclusão)</a>";
                                     echo"<a href='BancoDeDados_Alterar.php?id=" . $registro->id ."'>(Alteração)</a>";
                                       echo"<a href='BancoDeDados_Senha.php?id=" . $registro->id ."'>(Senha)</a>";
                                     echo"<td>";

                    
                    echo"</tr>";
                }
            }
            else
            {
                echo "Falha na seleção de usuario!<br>";
            }
            
            // Fim conectar no banco de dados, cursophp
            ?>
        </table>
          </div>
    </div>
        
    </body>
</html>