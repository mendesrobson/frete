<?php

   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   class Regioes
   {
        public function Bairros($codigo,$bairro)
        {
             require('./db/conect.php');
             
             $bairro = '';
             $cod = '';
             
             $codigo = split('=', $codigo);
             $bairros = split('=', $bairro);

            if($codigo[0] == 'codigo'){
              $cod  = $codigo[1];
            }
            
            if($codigo[0] == 'bairro'){
              $bairro  = $codigo[1];
            }
            
            if($bairros[0] == 'codigo'){
              $cod  = $codigo[1];
            }
            
            if($bairros[0] == 'bairro'){
              $bairro  = $codigo[1];
            }
             
            if($bairro != ''){
              $sql = "SELECT * FROM Regioes where Bairro like '%". $bairro ."%' ORDER BY Bairro ASC";
            }
            else if ($cod != ''){
                $sql = "SELECT * FROM Regioes where CodBairro = ". $cod . " ORDER BY Bairro ASC";
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