<?php

   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   class Regioes
   {
        public function Buscarcodigo($codigo)
        {
             require('./db/conect.php');
             
             $codigos = '';
             
             $nomecliente = split('=', $codigo);

            if($nomecliente[0] == 'codigo'){
              $codigos  = $nomecliente[1];
            }
             
            if($codigos != ''){
                $sql = "SELECT * FROM Regioes where CodBairro = ". $codigos . " ORDER BY Bairro ASC";
            }else {
                $sql = "SELECT * FROM Regioes ORDER BY Bairro ASC";
            }
             
             
            $resultados = array();

            $result = mysql_query($sql,$conn) or die(mysql_error());
            
            while($dados = mysql_fetch_assoc($result)){
                $resultados[] = $dados;
            }

            mysql_close();
            
            if(!$resultados){
                throw new Exception("Nao foi encontrado nenhum registro!");
            }

            return $resultados;
        }


        public function Buscarnome($bairro)
        {
             require('./db/conect.php');
             
             $nomes = '';
             
             $nomecliente = split('=', $bairro);

            if($nomecliente[0] == 'nome'){
              $nomes  = $nomecliente[1];
            }
             
            if($nomes != ''){
              $sql = "SELECT * FROM Regioes where Bairro like '%". $nomes ."%' ORDER BY Bairro ASC";
            }else {
                $sql = "SELECT * FROM Regioes ORDER BY Bairro ASC";
            }
             
             
            $resultados = array();

            $result = mysql_query($sql,$conn) or die(mysql_error());
            
            while($dados = mysql_fetch_assoc($result)){
                $resultados[] = $dados;
            }

            mysql_close();
            
            if(!$resultados){
                throw new Exception("Nao foi encontrado nenhum registro!");
            }

            return $resultados;
        }
   }
?>