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
    <link href="login.css" rel="stylesheet">
</head>

<body class="d-flex h-100 text-center text-white bg-dark flex-column">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column" >
        <?php include 'nav_bar.html';?>

        <?php include 'validacao_logado.php';?>

        <main class="form-signin px-3">

            <form method="post" action="validacao_login.php">
                <h1 class="h3 mb-3 fw-bold">5, 6, 7, 8!</h1>
                <label for="user" class="visually-hidden">Username</label>
                <input type="text" id="user" name="user" class="form-control" placeholder="Username"  required autofocus>
                <label for="password" class="visually-hidden">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <button class="w-100 btn btn-outline-warning" type="submit" name='login'>Login</button>
            </form>
            
            <?php 
                if (isset($_SESSION['user'])) {
                    if ($_SESSION['user'] == '' && $_SESSION['password'] == 'password_invalido') {
                        echo "<br><div class='alert alert-warning'> senha inválida! </div>";
                    }
                    else if ($_SESSION['user'] == 'login_invalido' || $_SESSION['password'] == 'password_invalido') {
                        echo "<br><div class='alert alert-warning'> user inválido! </div>";
                    }
                }
            ?>
     
        </main>

    </div>
</body>
</html>