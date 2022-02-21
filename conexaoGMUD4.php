<?php
error_reporting(0);
	$servidor = "";
	$usuario = "";
	$senha = "";
	$dbname = "";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
	
	if(!$conn){
		die(
    "<META HTTP-EQUIV=REFRESH CONTENT = ''>
    <script type=\"text/javascript\">
      alert(\"Falha na conexão com o banco de dados. GMUD não criada\");
    </script>
  ");
	}else{
		//echo "Conexao realizada com sucesso";
	}	
	
?>

