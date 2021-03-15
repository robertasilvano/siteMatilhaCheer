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
    <link href="index.css" rel="stylesheet">
    <link href="sobre_esporte.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
      <header>
        <?php include 'nav_bar.html';?>
      </header>

      <main>
        <div class="row featurette">
          <div class="col-md-6 order-md-2">
            <h2 class="featurette-heading">Cheerleading<br><span class="text-muted">o que é?</span></h2><br>
            <p class="featurette-text">O <strong>esporte</strong> chegou ao Brasil em 2008, e é composto pelos seguintes quadros:
              <ul style="list-style-type:square">
                <li>Stunts - levantamento de pessoas</li>
                <li>Baskets - lançamento de pessoas</li>
                <li>Pirâmides - stunts conectados</li>
                <li>Tumbling - acrobacias de ginástica no solo</li>
                <li>Jumps - saltos caracteristicos</li>
                <li>Flex - posições corporais de alongamento</li>
                <li>Dance - uma dança específica e marcada</li>
              </ul>
            </p>
          </div>
          <div class="col-md-5 order-md-1 d-flex justify-content-center">
            <img class="imagens" src="img/piramide.png" height="350">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette text-center">
          <div class="col-md-6 order-md-1">
            <h2 class="featurette-heading">Matilha<br><span class="text-muted">o que é?</span></h2><br>
            <p class="featurette-text">Nascida em 2018, a matilha é o time de cheerleading da UFSC Campus Araranguá! O time tem como objetivo a evolução de seus atletas e a divulgação do esporte.
            </p>
          </div>
          <div class="col-md-5 order-md-2 d-flex justify-content-center">
            <img class="imagens" src="img/matilha2.png" height="350">
          </div>
        </div>

        <hr class="featurette-divider">
        <br>

      </main>



    </div>

</body>

</html>



