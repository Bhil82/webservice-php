<html>
    <head><title>OO: Classes e Objetos</title></head>
    
    <body>
        
        
        <?php
        
        class Carro
        {
            private $velocidade;
            private $cor;
            
            public function __construct($cor)
            {
                $this->setCor($cor);
                $this->setVelocidade(0);
            }
            
            public function getVelocidade()
            {
                return $this->velocidade;
            }
            public function getCor()
            {
                return $this->cor;
            }
            
            public function setVelocidade($velocidade)
            {
                if($velocidade > 110 || $velocidade < 0)
                {
                    echo"Velocidade não permitida <br> ";
                }
                else
                {
                    $this->velocidade = $velocidade;
                }
            }
            public function setCor($cor)
            {
                $this->cor = $cor;
            }
            public function acelerar()
            {
                $this->getVelocidade($this->getVelocidade()+ 1);
            }
            public function frear()
            {
                $this->getVelocidade($this->getVelocidade()- 1);

            }
        }
                
        //$meuCarro = new Carro();
        //
        //$meuCarro->velocidade = 50;
        //$meuCarro->cor = "preta";
        
        
        $meuCarro = new Carro("vermelha");
        $meuCarro->acelerar();
        $meuCarro->frear();
        echo"O carro de cor ". $meuCarro->getCor() . ", está andando: ". $meuCarro->getVelocidade() ." km/h";
        echo"<br>";
        
        //$meuCarro->setVelocidade(70);
        //echo"O carro de cor ". $meuCarro->getCor() . ", está andando: ". $meuCarro->getVelocidade() ." km/h";
        //echo"<br>";
        //
        //$meuCarro->setVelocidade(230);
        //echo"O carro de cor ". $meuCarro->getCor() . ", está andando: ". $meuCarro->getVelocidade() ." km/h";
        //echo"<br>";
        //
        // $meuCarro->cor =  "Amarela";
        // $meuCarro->velocidade = 220;
        //echo"O carro de cor ". $meuCarro->cor . ", está andando: ". $meuCarro->velocidade ." km/h";
        //echo"<br>";
        
        ?>
        
    </body>
</html>