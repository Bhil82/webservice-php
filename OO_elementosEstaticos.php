<html>
    <head>
        <title>OO: Herança Elementos Estáticos</title>
    </head>
    
    <body>
        <?php
        
        class InstrumentoMusical
        {
            public $isPercussao;
            public $volume;
            
            public function __construct($isPercussao, $volume)
            {
                $this->isPercussao = $isPercussao;
                $this->volume = $volume;
            }
            
            public function tocar()
            {
                echo"Tocando no volume: ".$this->volume ."<br>";
            }
            
        }
        
        class Guitarra extends InstrumentoMusical
        {
            public function tocar()
            {
                echo"Amplificador ligado em " . $this->volume . " decibéis<br>";
            }
            
            public function tocarGuitarra()
            {
                $this->tocar();
                parent::tocar();
            }
        }
        
        
        $instrumentoMusical = new InstrumentoMusical(true, 80);
        
        if($instrumentoMusical->isPercussao)
        {
        echo "Instrumento de percussão, volume: "    . $instrumentoMusical->volume . "<br>";
        }
        else
        {
            echo "Instrumento não é de percussão, volume: "    . $instrumentoMusical->volume . "<br>";
        }
        
        $instrumentoMusical->tocar();
        
        $guitarra = new Guitarra(False, 40);
        
        if($guitarra->isPercussao)
        {
        echo "Instrumento de percussão, volume: "    . $guitarra->volume . "<br>";
        }
        else
        {
            echo "Instrumento não é de percussão, volume: "    . $guitarra->volume . "<br>";
        }
        $guitarra->tocar();
        echo"<br><br>";
        $guitarra->tocarGuitarra();
        
        class EscalaMusical
        {
           public static $escalaDoMaior = "C D E F G A B C";
           public $vezesquefoiUtilizada;
           
           public static function CalculaDecibeis($watts)
           {
            return $watts /10;
           }
        }
        $em = new EscalaMusical();
        echo EscalaMusical::$escalaDoMaior . "<br>";
        echo EscalaMusical::CalculaDecibeis(123) . "<br>";
        
        $emC = new EscalaMusical();
        $emC->vezesquefoiUtilizada = 3;
        echo "Foi utilizada: ". $emC->vezesquefoiUtilizada;
        echo"<br>";
        $emD = new EscalaMusical();
        $emD->vezesquefoiUtilizada = 5;
        echo "Foi utilizada: ". $emD->vezesquefoiUtilizada;
        echo"<br>";
        echo $emD::$escalaDoMaior;
        
        ?>
    </body>
</html>