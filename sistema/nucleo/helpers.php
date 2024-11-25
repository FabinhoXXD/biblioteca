<?php
    namespace sistema\Nucleo;
    use Exception;
    /**
     * 
     */
    class Helpers
    {

        public static function redirecionar(string $url = null):void
        {
            header('HTTP/1.1 302 Found');

            $local = ($url?self::url($url):$url());
            header("location:{$local}");
            exit();
        }

        public static function localhost()
        {
            if(str_contains(self::url(),'localhost')){
                return true;
            }
            return false;
        }


        public static function validarCpf(string $cpf):bool
        {
            $cpf = self::limparNumero($cpf);

            if (mb_strlen($cpf)!= 11 or preg_match('/(\d)\1{10}/', $cpf)) {
                throw new Exception('O CPF precisa ter 11 digitos!');
            }
            for ($t = 9; $t < 11; $t++){
                for ($d = 0, $c = 0; $c < $t; $c++){
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) %11) %10;
                if ($cpf[$c] != $d) {
                    throw new Exception('CPF Invalido');
                }
            }
            return true;
        }



        public static function limparNumero(string $numero):string
        {
            return preg_replace('/[^0-9]/', '', $numero);
        }



        public static function dataAtual()
        {
            $diaMes = date('d');
            $diaSemana = date('w');
            $mes = date('n') - 1;
            $ano = date('Y');

            $nomeDiasDaSemana = ['domingo','segunda-feira','terca-feira','quarta-feira','quinta-feira','sexta-feira','sabado'];
            $nomeDosMeses = ['janeiro','fevereiro','marco','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];
            $dataFormatada = $nomeDiasDaSemana[$diaSemana].", ".$diaMes." de ".$nomeDosMeses[$mes]." de ".$ano;
            return $dataFormatada;
        }

        public static function url(string $url = null):string
        {
            $servidor = filter_input(INPUT_SERVER,'SERVER_NAME');
            $ambiente = ($servidor == 'localhost'?URL_DESENVOLVIMENTO:URL_PRODUCAO);
            if (str_starts_with($url, '/')) {
                return $ambiente.$url;
            }
            return $ambiente.'/'.$url;
        }


        public static function validarEmail(string $email):bool
        {
            return filter_var($email,FILTER_VALIDATE_EMAIL);
        }


        public static function contarTempo(string $data):string
        {
            $agora = strtotime(date('Y-m-d H:i:s'));
            $tempo = strtotime($data);
            $diferenca = $agora - $tempo;
            $segundos = $diferenca;
            $minutos = round($diferenca / 60);
            $horas = round($diferenca / 3600);
            $dias = round($diferenca / 86400);
            $semanas = round($diferenca / 604800);
            $meses = round($diferenca / 2419200);
            $anos = round($diferenca / 29030400);
            echo "<hr>";
            var_dump($data);

            if ($segundos <= 60) {
                return "agora";
            }elseif ($minutos <= 60) {
                return $minutos == 1?"há 1 minuto":"há ".$minutos." minutos";
            }elseif($horas <= 24){
                return $horas == 1?"há 1 hora":"há ".$horas." horas";
            }elseif($dias <= 7){
                return $dias == 1?"ontem":"há ".$dias." dias";
            }elseif($semanas <= 4){
                return $semanas == 1?"há 1 semana":"há ".$semanas." semanas";
            }elseif($meses <= 12){
                return $meses == 1?"há 1 mes":"há ".$meses." meses";
            }else{
                return $anos == 1?"há 1 ano":"há ".$anos." anos";
            }
        }





        public static function formatarValor(float $valor):string
        {
            return number_format($valor,2,',','.');
        }





        public static function saudacao()
        {
            $hora = date("H");

            if ($hora >= 0 and $hora <= 5) {
                $saudacao = "boa madrugada";
            }
            elseif ($hora >= 6 and $hora <= 12) {
                $saudacao = "bom dia";
            }
            elseif($hora >= 13 and $hora <= 18){
                $saudacao = "boa tarde";
            }
            else{
                $saudacao = "boa noite";
            }
            /*$saudacao = match (true) {
                $hora >= 0 and $hora <= 5 => "teste",
                default => null,
            }*/
            return $saudacao;
        }






        public static function resumirTexto($texto, $limite,$continue = "...")
        {
            $textoLimpo = trim($texto);
            if(mb_strlen($textoLimpo) <= $limite){
                return $textoLimpo;
            }

            $resumirTexto = mb_substr($textoLimpo, 0, $limite);
             return $resumirTexto.$continue;
        }
        
    }

    


?>
