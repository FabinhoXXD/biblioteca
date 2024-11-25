<?php 
    use Pecee\SimpleRouter\SimpleRouter;

    try {
        SimpleRouter::setDefaultNamespace("sistema\controlador");

        SimpleRouter::get(DIRETORIO_SITE,'siteControlador@index');
        SimpleRouter::get(DIRETORIO_SITE.'sobre','siteControlador@sobre');
        SimpleRouter::get(DIRETORIO_SITE.'contato','siteControlador@contato');

        SimpleRouter::start();
    } catch (Pecee\SimpleRouter\Exceptions\NotFoundHttpException $e) {
        echo $e->getMessage();
    }
?>