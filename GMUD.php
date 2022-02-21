<?php
session_start();
ob_start();
include_once("conexaoGMUD4.php");
?>
<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>

    <meta charset="UTF-8">
    <title>TYP-E GMUD SURF- v.1</title>
    <link rel="sortcut icon" href="img/icone.png"/>
    <link rel="stylesheet" href="styleGMUD.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>



        
  <div class="container">

    <div> <h2 align="middle">Nova GMUD</h2> </div>
    <h1 class="title" align="middle" ><i><img src="img/surf.gif" alt="logo c3po" style ="height: 60px;"></i></h1>


    <div class="content">
      <form method="POST" action="processa_gmud.php" enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
          Título da mudança<input type="text" name="txt_titulo" placeholder="Digite o título da GMUD" maxlength ="150" required></div>

       <div class="input-box">
          Tipo<select name="select_tipo" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;" required>
          <option value="">Selecione</option>
          <?php
            $select_tipo = "";
            $resultado_criticidade = mysqli_query($conn, $select_tipo);
            while($row_tipo = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_tipo['coTipo']; ?>"><?php echo $row_tipo['noTipo']; ?></option> <?php
            }
          ?>
       </select></div>

       <div class="input-box">
          Responsável pela execução
           <select name="select_responsavel" style="width: 300px; height:45px; border-radius: 5px; border-color: #0000ff;" required>
          <option value="">Selecione</option>
          <?php
            $result_responsavel = "";
            $resultado_fornecedor = mysqli_query($conn, $result_responsavel);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_fornecedor)){ ?>
              <option value="<?php echo $row_niveis_acessos['idResponsavel']; ?>"><?php echo $row_niveis_acessos['noResponsavel']; ?></option> <?php
            }
          ?>
       </select></div>
 
          <div class="input-box">
          Data/Hora de início
          <input type="datetime-local" name="data_inicio" id="data_inicio" ></div>
          <div class="input-box">
          Data/Hora de término
          <input type="datetime-local" name="data_fim" id="data_fim" onchange="myFunction()"></div>
          <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
              function myFunction() {
                
                var valor1 = document.getElementById("data_inicio").value;
                var valor2 = document.getElementById("data_fim").value;
                var data1= new Date(valor1);
                var data2= new Date(valor2);
                if(data1 > data2){
                  
          
            swal({
                  title: "ERRO",
                  text: "Data de inicio maior que a data de término, favor alterar.",
                  icon: "error",
                  button: "OK",
                });
                  document.getElementById("data_fim").value="";
                  document.getElementById("data_inicio").value="";
                }
              }
     </script>

        <div class="input-box">
          Status<select name="select_status" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;" required>
          <option valeu="">Selecione</option>
          <?php
            $result_status = "";
            $resultado_criticidade = mysqli_query($conn, $result_status);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_niveis_acessos['idStatus']; ?>"><?php echo $row_niveis_acessos['noStatus']; ?></option> <?php
            }
          ?>
       </select></div>
       <div class="input-box">
          Responsável acompanhamento<select name="select_responsavel_acomp" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;" required>
          <option valeu="">Selecione</option>
          <?php
            $result_status = "SELECT * FROM `responsavel_interno`";
            $resultado_criticidade = mysqli_query($conn, $result_status);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_niveis_acessos['idResponsavel']; ?>"><?php echo $row_niveis_acessos['noResponsavel']; ?></option> <?php
            }
          ?>
       </select></div>
       <div class="input-box">
          Responsável validação<select name="select_responsavel_validacao" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;" required>
          <option valeu="">Selecione</option>
          <?php
            $result_status = "";
            $resultado_criticidade = mysqli_query($conn, $result_status);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_niveis_acessos['idResponsavel']; ?>"><?php echo $row_niveis_acessos['noResponsavel']; ?></option> <?php
            }
          ?>
       </select></div>
       <div class="input-box">
          Segmento da GMUD<select name="select_segmento" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;" required>
          <option valeu="">Selecione</option>
          <?php
            $result_status = "";
            $resultado_criticidade = mysqli_query($conn, $result_status);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_niveis_acessos['idSegmento']; ?>"><?php echo $row_niveis_acessos['noSegmento']; ?></option> <?php
            }
          ?>
       </select></div>
       <div class="input-box">
          Descrição
          <textarea id="descricao" name="descricao" rows="5" cols="43" 
          placeholder="Digite aqui a descrição da GMUD" maxlength ="300" 
          style="border-radius: 5px;border-color: #0000ff" required;></textarea></div>
        </div>
        <div class="input-box">
        Selecione a documentação: <input type="file" name="arquivo"/>
        </div>
        <div class="button">
      <input type="submit" value="Criar GMUD">
    </div>
      </div>
    </form>
    <a href="consultarGMUD.php" style="text-decoration: none"><img src="./img/voltar.png" alt="bloqueado" > Consultar GMUD</a>
    </div>
  </div>
</body>
</html>
