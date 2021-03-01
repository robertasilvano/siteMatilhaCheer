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

    <!-- Custom styles for this template -->
    <link href="base.css" rel="stylesheet">
    <link href="nav_bar.css" rel="stylesheet">
    <link href="listagem.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark flex-column">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <?php include 'nav_bar.html';?>

        <main class="px-3">
          <div class="container">
            <div class="row">

              <div class="col-lg-4">
                <img class="imagens" src="img/lista2.png">
                <h2>Faltas</h2>
                <p class="a">Aqui você irá avisar quando tiver que faltar o treino e a justificativa. 😡</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
              </div>

              <div class="col-lg-4">
                <img class="imagens" src="img/lista1.png">
                <h2>Diretoria</h2>
                <p class="a">Aqui a diretoria tem acesso as pautas. 📣</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
              </div>

              <div class="col-lg-4">
                <img class="imagens" src="img/lista3.png">
                <h2>Financeiro</h2>
                <p class="a">Aqui você poderá consultar sua situação na tesouraria. 💸</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
              </div>
            </div>
          </div>
        </main>        
    </div>
</body>

</html>