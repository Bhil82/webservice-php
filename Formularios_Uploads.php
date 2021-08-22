<html>
    <head>
        <title>Formulario: Upload</title>
    </head>
    <body>
        <?php
        //Verificando se os campos de envio foram feito corretamente
        
               if(isset($_REQUEST["envio"]) && $_REQUEST["envio"] == True)
               {
               // $erro = 0;
                
                if(isset($_FILES["campoArquivo"]))
                {
                    $arquivoNome     = $_FILES["campoArquivo"]["name"];
                    $arquivoTipo     = $_FILES["campoArquivo"]["type"];
                    $arquivoTamanho  = $_FILES["campoArquivo"]["size"];
                    $arquivoNomeTemp = $_FILES["campoArquivo"]["tmp_name"];
                    
                    $erro = $_FILES["campoArquivo"]["error"];
                    
                    if($erro == 0)
                    {
                        if(is_uploaded_file($arquivoNomeTemp))
                        {
                           if(move_uploaded_file($arquivoNomeTemp, "uploads/".$arquivoNome))
                           {
                             echo "Sucesso. <br>";
                             
                             echo "nome original: ". $arquivoNome . "<br>";
                             echo "Tipo: ". $arquivoTipo . "<br>";
                             echo "Tamanho: ". $arquivoTamanho .     "<br>";
                             echo "nome temporario: ". $arquivoNomeTemp . "<br>";
                   
                           }
                           else
                           {
                            $erro = "Falha ao mover o arquivo (permissão de acesso ou caminho invalido!) ";
                           }
                        }
                        else
                        {
                            $erro = "Erro no envio arquivo não recebido com com sucesso.";
                        }
                    }
                    else
                    {
                        $erro = "Erro no envio: ".$erro;
                    }
                                                    
                }
                else
                {
                    $erro = "Arquivo enviado não encontrado.";
                }
                if($erro !== 0)
                {
                    echo $erro;
                }
               }
        ?>
        
        <form enctype="multipart/form-data" method=post action="Formularios_Uploads.php?envio=true">
            Arquivo:
            <input type=FILE name=campoArquivo>
            <br>
            <input type=SUBMIT valeu="Enviar">
        </form>
        
    </body>
</html>