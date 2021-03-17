<?php

session_start();
require_once ("classe_atleta.php");

$atleta = new Atleta();

$select_id = $atleta->select_id($_GET['id_up']);
$id_up = $_GET['id_up'];

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
            echo $id_up;
        ?>
            <div class="row">
                <div class="container-cadastro">
                    <form  method="post" action="validacao_update.php?id_up=<?= $id_up ?>" class="form-cadastro">
                        <h1 class="h3 mb-3 fw-bold">Atualizar atleta</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nome_a" class="visually-hidden">Nome</label>
                                <input type="text" id="nome_a" name="nome_a" class="form-control" placeholder="Nome" value="<?= $select_id['nome'] ?>" required autofocus>
                                <label for="user_a" class="visually-hidden">Username</label>
                                <input type="text" id="user_a" name="user_a" class="form-control" placeholder="Username" value="<?= $select_id['user'] ?>" require>
                                <label for="pass_a" class="visually-hidden">Password</label>
                                <input type="password" id="pass_a" name="pass_a" class="form-control" placeholder="Password" value="<?= $select_id['pass'] ?>" required>
                                <label for="nascimento_a" class="visually-hidden">Nascimento</label>
                                <input type="date" id="nascimento_a" name="nascimento_a" class="form-control" placeholder="Nascimento" value="<?= $select_id['nascimento'] ?>" require>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="telefone_a" class="visually-hidden">Telefone</label>
                                <input type="tel" id="telefone_a" name="telefone_a" class="form-control" placeholder="Telefone: 11-11111-1111" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" value="<?= $select_id['telefone'] ?>" require>
                                <label for="convenio_a" class="visually-hidden">Convênio</label>
                                <input type="text" id="convenio_a" name="convenio_a" class="form-control" placeholder="Convênio" value="<?= $select_id['convenio'] ?>">
                                <label for="tipoSangue_a" class="visually-hidden">Tipo sanguíneo</label>
                                <input type="text" id="tipoSangue_a" name="tipoSangue_a" class="form-control" placeholder="Tipo sanguíneo" value="<?= $select_id['tipo_sangue'] ?>" require>
                                <label for="cpf_a" class="visually-hidden">CPF</label>
                                <input type="text" id="cpf_a" name="cpf_a" class="form-control" placeholder="CPF: 111.111.111-11" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" value="<?= $select_id['cpf'] ?>" require>
                            </div>
                        </div>
                        <input type="checkbox" id="diretoria" name="diretoria" value="<?= $select_id['diretoria'] ?>">
                        <label for="diretoria"><strong>Membro da diretoria</strong></label>
                        <button class="w-100 btn btn-outline-warning" type="submit" name='update'>Atualizar</button>
                    </form>
                </div>
            </div>

       </main>
    </div>

</body>
</html>
