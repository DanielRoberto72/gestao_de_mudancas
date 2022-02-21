<?php
	include_once("conexaoGMUD4.php");
    date_default_timezone_set('America/Sao_Paulo');
    $id= $_POST['id'];
	$data_inicio = $_POST['data_inicio'];
	$data_fim = $_POST['data_fim'];
	$select_status= $_POST['select_status'];
	$descricao= $_POST['descricao'];
    $observacao= $_POST['observacao'];
    $protocolo= $_POST['protocolo'];
    $responsavel = $_POST['responsavel'];
    $timeline= array($_POST['timeline']);

    
    // Definindo o diretorio que será enviado a documentação
    ($responsavel==""){
        $dir = ""; 
    }

     // recebendo o arquivo multipart 
     $file1 = $_FILES["arquivo"];
        
     $file=  $protocolo."-".$file1["name"].".xlsx";
 // Move o arquivo da pasta temporaria de upload para a pasta de destino 
 if (move_uploaded_file($file1["tmp_name"], "$dir/".$file)) { 
      
 } 
 else { 

 }  


if(!empty($timeline[0]) ){
    $nomearquivo = 'timeline-'.$protocolo.'.txt';
    $fp = fopen('C:/Prod/Documentos/'.$nomearquivo, 'w');
    fputcsv($fp, $timeline); 
    
}

	if(!empty($_POST['data_inicio']) && !empty($_POST['data_fim'])){
	try{
	$result_usuario = "UPDATE  SET where id=$id";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

    echo "
        <META HTTP-EQUIV=REFRESH CONTENT = ''>
        <script type=\"text/javascript\">
            alert(\"GMUD editada com Sucesso.\");
        </script>
    ";
    }catch (Exception $e){
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = ''>
            <script type=\"text/javascript\">
                alert(\"A GMUD não foi editada\");
            </script>
        ";
    }
}else if(empty($_POST['data_inicio']) && empty($_POST['data_fim'])){
    try{
        $result_usuario = "UPDATE  SET  where id=$id";
        $resultado_usuario = mysqli_query($conn, $result_usuario);
    
        echo "
            <META HTTP-EQUIV=REFRESH CONTENT = ''>
            <script type=\"text/javascript\">
                alert(\"GMUD editada com Sucesso.\");
            </script>
        ";
        }catch (Exception $e){
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = ''>
                <script type=\"text/javascript\">
                    alert(\"A GMUD não foi editada\");
                </script>
            ";
        }
}
?>