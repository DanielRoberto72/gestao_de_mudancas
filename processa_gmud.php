<?php
	include_once("conexaoGMUD4.php");
    date_default_timezone_set('America/Sao_Paulo');
    $protocolo = 'CR'.date('YmdHis');
	$txt_titulo = $_POST['txt_titulo'];
	$select_tipo = $_POST['select_tipo'];
	$select_responsavel = $_POST['select_responsavel'];
    $select_responsavel_acomp = $_POST['select_responsavel_acomp'];
    $select_responsavel_validacao = $_POST['select_responsavel_validacao'];
	$data_inicio = $_POST['data_inicio'];
	$data_fim = $_POST['data_fim'];
	$select_status= $_POST['select_status'];
	$descricao= $_POST['descricao'];
    $select_segmento = $_POST['select_segmento'];
    ($select_responsavel==1){
    $dir = "C:/Users/Administrator/OneDrive - Surf Group/Área de Trabalho/DOCUMENTOS/NUAGE/"; 
    }
        
        // recebendo o arquivo multipart 
        $file1 = $_FILES["arquivo"];
        
        $file=  $protocolo."-".$file1["name"].".xlsx";
    // Move o arquivo da pasta temporaria de upload para a pasta de destino 
    if (move_uploaded_file($file1["tmp_name"], "$dir/".$file)) { 
         
    } 
    else { 
        echo "
        <META HTTP-EQUIV=REFRESH CONTENT = '0;URL=http://www.c3po.surf.local/consultarGMUD.php'>
        <script type=\"text/javascript\">
            alert(\"O documento não foi enviado.\");
        </script>
    "; 
    }  
	if(!empty($_POST['data_inicio']) && !empty($_POST['data_fim'])){
    	try{
    
            $result_usuario = "INSERT INTO  
            VALUES ();";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
        
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = ''>
                <script type=\"text/javascript\">
                    alert(\"GMUD cadastrada com Sucesso. Protocolo: $protocolo\");
                </script>
            ";
            
            }catch (Exception $e){
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = ''>
                    <script type=\"text/javascript\">
                        alert(\"A GMUD não foi cadastrada com Sucesso.\");
                    </script>
                ";
                
            }
        
    }else if(empty($_POST['data_inicio']) && empty($_POST['data_fim'])){
        try{
    
            $result_usuario = "INSERT INTO 
            VALUES ();";
            $resultado_usuario = mysqli_query($conn, $result_usuario);
        
            echo "
                <META HTTP-EQUIV=REFRESH CONTENT = ''>
                <script type=\"text/javascript\">
                    alert(\"GMUD cadastrada com Sucesso. Protocolo: $protocolo\");
                </script>
            ";
            }catch (Exception $e){
                echo "
                    <META HTTP-EQUIV=REFRESH CONTENT = ''>
                    <script type=\"text/javascript\">
                        alert(\"A GMUD não foi cadastrada com Sucesso.\");
                    </script>
                ";
            }
    }
    ?>