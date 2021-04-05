<?php

session_start();
                 
?>


<!DOCTYPE html>
<html lang="pt-br" class="h-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Matilha Cheer</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/cover/">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- STYLES -->
    <link href="base.css" rel="stylesheet">
    <link href="nav_bar.css" rel="stylesheet">
    <link href="cadastro.css" rel="stylesheet">
</head>



<body>
    <div class="container-fluid h-100">
      <header>
        <?php include 'nav_bar.html';?>
      </header>

      <main class="text-center">

        <!-- só tem acesso a essa página quem é atleta, então é necessário fazer a validação. Se não estiver logado, vai pra página de login. -->
        <?php 
            include 'validacao_logado_atletas.php';
        ?>
            <div class="row">
                <div class="container-cadastro">
                    <form  method="post" action="validacao_cadastro.php" class="form-cadastro">
                        <h1 class="h3 mb-3 fw-bold">Cadastrar atleta</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nome_a" class="visually-hidden">Nome</label>
                                <input type="text" id="nome_a" name="nome_a" class="form-control" placeholder="Nome"  required autofocus>
                                <label for="user_a" class="visually-hidden">Username</label>
                                <input type="text" id="user_a" name="user_a" class="form-control" placeholder="Username" require>
                                <label for="pass_a" class="visually-hidden">Password</label>
                                <input type="password" id="pass_a" name="pass_a" class="form-control" placeholder="Password" required>
                                <label for="nascimento_a" class="visually-hidden">Nascimento</label>
                                <input type="date" id="nascimento_a" name="nascimento_a" class="form-control" placeholder="Nascimento" max= require>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="telefone_a" class="visually-hidden">Telefone</label>
                                <input type="tel" id="telefone_a" name="telefone_a" class="form-control" placeholder="Telefone: 11111111111" pattern="[0-9]{11}" require>
                                <label for="convenio_a" class="visually-hidden">Convênio</label>
                                <input type="text" id="convenio_a" name="convenio_a" class="form-control" placeholder="Convênio">
                                <label for="tipoSangue_a" class="visually-hidden">Tipo sanguíneo</label>
                                <input type="text" id="tipoSangue_a" name="tipoSangue_a" class="form-control" placeholder="Tipo sanguíneo" require>
                                <label for="cpf_a" class="visually-hidden">CPF</label>
                                <input type="text" id="cpf_a" name="cpf_a" class="form-control" placeholder="CPF: 11111111111" pattern="[0-9]{11}" require>
                            </div>
                        </div>
                        <input type="checkbox" id="diretoria_a" name="diretoria_a">
                        <label for="diretoria_a"><strong>Membro da diretoria</strong></label>
                        <button class="w-100 btn btn-outline-warning" type="submit" name='cadastrar'>Cadastrar</button>
                    </form>
                    

                    <?php 
                            if (isset($_SESSION['cadastrar'])) {
                                if ($_SESSION['cadastrar'] == 'user_cadastrado') {
                                    echo "<br><div class='alert alert-warning'> Atleta cadastrado com sucesso! </div>";
                                }
                                else if ($_SESSION['cadastrar'] == 'user_invalido') {
                                    echo "<br><div class='alert alert-warning'> user já em uso! </div>";
                                }
                                $_SESSION['cadastrar'] = '';
                            }
                    ?>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="container-tabela">
                <h1 class="h3 mb-3 fw-bold">Atletas cadastrados</h1>

                <?php 
                    include 'tabela_atletas.php';
                    $select = $atleta->select();         
                    
                    if($select) {
                ?>

                    <table class="table table-dark table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>User</th>
                                <th>Password</th>
                                <th>Nascimento</th>
                                <th>Telefone</th>
                                <th>Convênio</th>
                                <th>Tipo sanguíneo</th>
                                <th>CPF</th>
                                <th>Membro diretoria</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php 
                                $atleta->printar_tabela($select);
                            ?>
                        </tbody>
        
                    </table>

                    <?php 
                    }
                    else {
                        echo "<br><div class='alert alert-warning'>Ainda não há atletas cadastrados!</div>";
                    }
                    ?>

                    <?php 
                        if(isset($_GET['id_del'])) {
                            echo "<script> location.href = 'delete?id_del=".$_GET['id_del'].".php' </script>";
                        }
                        else if(isset($_GET['id_up'])){
                            echo "<script> location.href = 'update?id_up=".$_GET['id_up'].".php' </script>";
                        }
                        if(isset($_SESSION['delete'])){
                            if ($_SESSION['delete'] == 'delete_ok'){
                                echo "<br><div class='alert alert-warning'> Delete realizado com sucesso! </div>";
                            }
                            else if ($_SESSION['delete'] == 'delete_erro') {
                                echo "<br><div class='alert alert-warning'> Erro ao realizar delete! </div>";
                            }
                            $_SESSION['delete'] = '';
                        }
                        if(isset($_SESSION['update'])){
                            if ($_SESSION['update'] == 'update_ok'){
                                echo "<br><div class='alert alert-warning'> Update realizado com sucesso! </div>";
                            }
                            else if ($_SESSION['update'] == 'update_erro') {
                                echo "<br><div class='alert alert-warning'> Erro ao realizar update! </div>";
                            }
                            $_SESSION['update'] = '';
                        }

                    ?>


                </div>
            </div>
          
       </main>
    </div>

</body>
</html>