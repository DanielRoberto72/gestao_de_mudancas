<?php
session_start();
ob_start();
include_once './conexaoGMUD.php';
$nuCR = filter_input(INPUT_GET, 'nuCR');
// var_dump($nuCR);

if (empty($nuCR)) {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: GMUD não editada!</p>";
    header("Location: consultarGMUD.php");
}


//Pesquisar os dados do carro no banco de dados
$query_carro = "";
$result_carro = $conn->prepare($query_carro);
$result_carro->execute();


//verificar se conseguiu encontrar o registro no BD
if ($result_carro->rowCount() != 0) {
    $row_carro = $result_carro->fetch(PDO::FETCH_ASSOC);
    // var_dump($row_carro);
    extract($row_carro);


} else {
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: GMUD não editada!</p>";
    header("Location: consultarGMUD.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>TYP-E GMUD SURF- v.1</title>
    <link rel="stylesheet" href="styleEditGMUD.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
   <style>
     /* Googlefont Poppins CDN Link */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

   </style>
<body>
  <div class="sidebar">
    <div class="logo-details">
    <i><img src="img/Typ-e.png" alt="logo typ-e" style ="width: 250px; margin-top: 50px"></i>
      <span class="logo_name"></span>
    </div>
      <ul class="nav-links" style=" margin-top: 50px">
        <li>
        <a href="GMUD.php">
          <i class='bx bx-home-alt'></i>
          <span class="link_name">Criar</span>
        </a>
      </li>
      <li>
        <a href="consultarGMUD.php">
          <i class='bx bxs-data' ></i>
          <span class="link_name">Consultar GMUD</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="Provisionamento.php">Consultar Provisionamento</a></li>
        </ul>
      </li>
        
      </ul>
  </div>
  <section class="home-section">


  <a><img src="img/Logo.png" alt="logo surf" style ="height: 80px;"align="right"></a>
    <nav>
    
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard"></span>
      </div>

      
      
    </nav>

    <div class="home-content">
      <script>
   let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}
 </script>
     <td></td>
     <td></td>
     <td></td>

      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">TICKET CR</div>
            <div class="number"><?php echo $cr_ticket;?></div>
            
            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/ticket.png"></i>
        </div>
   <div class="box">
          <div class="right-side">
            
            <div class="box-topic">Inicio</div>
            <div class="number"><?php echo $dt_inicio;?></div>
            
            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/calendar.png"></i>
        </div>
        <div class="box">
          <div class="right-side">
            
            <div class="box-topic">Fim</div>
            <div class="number"><?php echo $dt_fim;?></div>
            

            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/calendar.png"></i>
        </div>
         <div class="box">
          <div class="right-side">
            
            <div class="box-topic">Tipo</div>
            <div class="number"><?php echo $noTipo;?></div>
            
            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/tipo.png"></i>
        </div>
    </div>
        <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            
            <div class="box-topic">Responsável</div>
            <div class="number"><?php echo $noResponsavel;?></div>
            
            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/responsavel.png"></i>
        </div>
        <div class="box">
          <div class="right-side">
            
            <div class="box-topic">Status</div>
            <div class="number"><?php echo $noStatus;?></div>
            
            <div class="indicator">
            </div>
          </div>
          <i class=''><img src="img/status.png"></i>
        </div>
    </div>
 
      <div class="sales-boxes">
        <div class="recent-sales box">

          
          <div class="sales-details">
            
 <div class="container">



    <div class="title">Editar GMUD</div>
    <div class="content">
      <form name="up GMUD" method="POST" action="processa_edit_GMUD.php"  enctype="multipart/form-data">
        <div class="user-details">
          <div class="input-box">
          <span class="details">Inicio</span>
          <input type="datetime-local" name="data_inicio" id="data_inicio" >
          </div>
          <div class="input-box">
          <span class="details">Fim</span>
          <input type="datetime-local" name="data_fim" id="data_fim" >
          </div>

          <div class="input-box">
            <span class="details">Status</span>
            <select name="select_status" style="width: 300px; height:45px; border-radius: 5px;border-color: #0000ff;"required>
          <option value="" >Selecione</option>
          <?php
          include_once './conexaoGMUD4.php';
            $result_status = "";
            $resultado_criticidade = mysqli_query($conn, $result_status);
            while($row_niveis_acessos = mysqli_fetch_assoc($resultado_criticidade)){ ?>
              <option value="<?php echo $row_niveis_acessos['idStatus']; ?>"><?php echo $row_niveis_acessos['noStatus']; ?></option> <?php
            }
          ?>
       </select>
          </div>
          <div class="input-box"></div>
          <div class="input-box">
            <span class="details">Descrição</span>
            <textarea id="descricao" name="descricao" rows="5" cols="44" 
            placeholder="Digite aqui a descrição da GMUD" maxlength ="300" 
            style="border-radius: 5px;border-color: #0000ff" required><?php echo $descricao;?></textarea>
          </div>
          <div class="input-box">
            <span class="details">Observação</span>
            <textarea id="observacao" name="observacao" rows="5" cols="44" 
            placeholder="Digite aqui a sua observação" maxlength ="300" 
            style="border-radius: 5px;border-color: #0000ff" required value='N/A'><?php echo $observacoes;?></textarea>
          </div>
          <div >
        Selecione a documentação: <input type="file" name="arquivo"/>
        </div>
          <div class="input-box">
          
          <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
          
          </div>
          <div class="input-box">
          
          <input type="hidden" name="responsavel" id="responsavel" value="<?php echo $noResponsavel;?>">
          
          </div>
          <div class="input-box">
          
          <input type="hidden" name="protocolo" id="protocolo" value="<?php echo $cr_ticket;?>">
          
          </div>
        </div>
        
        <div class="button">
          <input type="submit" value="Editar GMUD" name="">

        </div>
      
      <a href="consultarGMUD.php" style="text-decoration: none"><img src="img/voltar.png" alt="voltar" > Consultar GMUD</a>
    </div>
  </div>
      
          </div>
        </div>
        
        <div class="top-sales box">
          <div class="title"> TIMELINE</div>
                  
            <div class="input-box">
            
            <textarea id="timeline" name="timeline" rows="20" cols="56" 
            placeholder="Digite aqui a timeline da Gmud:
            Exemplo
            
22:00	Inicio de atividades	
22:02	Iniciado a mudança referente ...
22:14	Finalizado a alteração no ...
22:18	Validado o sistema	...
23:47	Informado que está sendo feito a ...
23:58	Finalizado a GMUDs, não identificado impacto ...
23:59	Encerrada atividade ...
"  
            style="border-radius: 5px;border-color: #0000ff"></textarea>
          </div>
          </form>
            

        </div>
      </div>
    </div>
    <br>
 
    <p align="middle" > TYP-E | v.1.0 - </p>. 
  </section>

 
 

</body>
</html>