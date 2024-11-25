<?php 
    namespace sistema\Controlador;
    use sistema\nucleo\controlador;

    class siteControlador extends controlador
    {
        public function __construct()
        {
            parent::__construct('templates/site/views');
        }
        public function index()
        {
            echo $this->template->renderizar('index.html',[
                'titulo'=>'Biblioteca Virtual'
             ]);
        }
        public function sobre()
        {
            echo $this->template->renderizar('sobre.html',[
                'titulo'=>'Biblioteca Virtual'
             ]);
        }
        public function contato()
        {
            echo $this->template->renderizar('contato.html',[
                'titulo'=>'Biblioteca Virtual'
             ]);
        }
    }
    
?>