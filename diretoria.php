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
    <link href="atletas.css" rel="stylesheet">
</head>



<body>
    <div class="container-fluid h-100">
      <header>
        <?php include 'nav_bar.html';?>
      </header>

      <main class="text-center">

        <!-- só tem acesso a essa página quem é atleta, então é necessário fazer a validação. Se não estiver logado, vai pra página de login. -->
        <?php include 'validacao_logado_atletas.php';?>

          <!-- listagem das funcionalidades do sistema -->
          <div class="row">
            <div class="col-lg-6">
              <img class="imagens" src="img/cadastro2.png">
              <h2>Cadastro de atletas</h2>
              <p class="a">Aqui você poderá adicionar, alterar e remover atletas. 👀</p>
              <p><a class="btn btn-outline-warning" href="cadastro.php">Go &raquo;</a></p>
            </div>

            <div class="col-lg-6">
              <img class="imagens" src="img/pautas.png">
              <h2>Pautas</h2>
              <p class="a">Aqui a diretoria tem acesso as pautas. 📣</p>
              <p><a class="btn btn-outline-warning" href="#">Go &raquo;</a></p>
            </div>

       </main>
    </div>

</body>
</html>