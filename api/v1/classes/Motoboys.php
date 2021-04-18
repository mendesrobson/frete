<?php

   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   class Motoboys
   {
        public function Buscar($nome)
        {
             require('./db/conect.php');
             
             $nomes = '';
             
             $nome = split('=', $nome);

            if($nome[0] == 'nome'){
              $nomes  = $nome[1];
            }
             
            if($nomes != ''){
              $sql = "SELECT * FROM Motoboys where NomeMotoboy like '%". $nomes ."%' ORDER BY CodMotoboy ASC";
            }else {
                $sql = "SELECT * FROM Motoboys ORDER BY CodMotoboy ASC";
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