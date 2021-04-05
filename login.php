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
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

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
    <link href="login.css" rel="stylesheet">
</head>


<body>
    <div class="container-fluid h-100">
      <header>
        <?php include 'nav_bar.html';?>
      </header>

        <main class="text-center">

            <!-- verifica se já está logado. se sim, vai direto pra página de atletas. se não, aparece o formulário de login. -->
            <?php include 'validacao_logado.php';?>
                    <div class="row">
                        <div class="container-login">
                            <form method="post" action="validacao_login.php">
                                <h1 class="h3 mb-3 fw-bold">5, 6, 7, 8!</h1>
                                <label for="user" class="visually-hidden">Username</label>
                                <input type="text" id="user" name="user" class="form-control" placeholder="Username"  required autofocus>
                                <label for="password" class="visually-hidden">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                <br>
                                <button class="w-100 btn btn-outline-warning" type="submit" name='login'>Login</button>
                            </form>
                        
                            <!-- se a SESSION já estiver setada, significa que já foi tentado realizar login, e então da um alert de qual foi o erro. -->
                            <?php 
                                if (isset($_GET['error'])) {
                                    echo "<br><div class='alert alert-warning'> erro ao fazer login! </div>";
                                }
                            ?>
                        </div>
                    </div>
            </div>
        </main>

    </div>

</body>