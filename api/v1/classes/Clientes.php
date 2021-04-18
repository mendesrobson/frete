<?php

   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
   class Clientes
   {
        public function Buscarnome($nome)
        {
             require('./db/conect.php');
             
             $nomes = '';
             
             $nomecliente = split('=', $nome);

            if($nomecliente[0] == 'nome'){
              $nomes  = $nomecliente[1];
            }
            
             
            if($nomes != ''){
              $sql = "SELECT * FROM Clientes where NomeFantasia like '%". $nomes ."%' ORDER BY NomeFantasia ASC";
            }else {
                $sql = "SELECT * FROM Clientes ORDER BY NomeFantasia ASC";
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

        public function Buscarcodigo($codigo)
        {
             require('./db/conect.php');
             
             $codigocliente = '';
             
             $codi = split('=', $codigo);

            if($codi[0] == 'codigo'){
              $codigocliente  = $codi[1];
            }
            
             
            if($nomes != ''){
              $sql = "SELECT * FROM Clientes where CodCliente = ". $codigocliente ."  ORDER BY CodCliente ASC";
            }else {
                $sql = "SELECT * FROM Clientes ORDER BY CodCliente ASC";
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