<html>
    
        <head>
        
            <title> OO: Abstração e Interfaces </title>
        
        </head>
    
    <body>
        <?php
        
        abstract class InstrumentoMusical
        {
            
            public $volume;
            public abstract function tocar();
                     
        }
        
        interface transportavel
        {
            public function transportar();
        }
        
        class Guitarra extends InstrumentoMusical implements transportavel
        {
            public function tocar()
            {
              echo "&#9835; Tocando Guitarra &#9833; &#9834; &#9837;<br>";
            }
             public function transportar()
            {
                echo"Transporte de Guitarra: Entrar em contato com a loja de música <br>";
            }
       }
        class Computador implements transportavel
        {
            public function transportar()
            {
                echo"Transporte de computador: Chame a SoftBlue<br>";
            }
        }
              
        $guitarra = new Guitarra();
        $guitarra->tocar();
        $guitarra->transportar();
        
        $computador = new Computador();
        $computador->transportar();
        
                
        ?>
    </body>
</html>