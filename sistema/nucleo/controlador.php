<?php 
    namespace sistema\Nucleo;
    use sistema\suporte\template;

    class controlador
    {
        protected template $template;
        public function __construct(string $diretorio)
		{
			$this->template = new template($diretorio);
		}
    }
    

?>