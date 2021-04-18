<?php

   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   class Vendedores
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
              $sql = "SELECT * FROM Vendedores where NomeVendedor like '%". $nomes ."%' ORDER BY NomeVendedor ASC";
            }else {
                $sql = "SELECT * FROM Vendedores ORDER BY NomeVendedor ASC";
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