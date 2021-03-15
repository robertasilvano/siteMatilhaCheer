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

            try {
                $pdo = new PDO("mysql:dbname=avii_desenvweb;host=localhost;", "root", "");
            }
            catch (PDOException $e) {
                echo "Erro com o banco de dados: ".$e->getMessage();
            }
            catch (Exception $e) {
                echo "Erro genérico: ".$e->getMessage();
            }

            $res = $pdo->prepare("INSERT INTO ATLETAS(nome, user, pass, nascimento, telefone, convenio, tipo_sangue, cpf, diretoria) VALUES (:nome, :user, :pass, :nascimento, :telefone, :convenio, :tipo_sangue, :cpf, :diretoria)");

            $res->bindValue(":nome", "Roberta Silvano");
            $res->bindValue(":user", "robs");
            $res->bindValue(":pass", "111");
            $res->bindValue(":nascimento", "1996-07-01");
            $res->bindValue(":telefone", "111");
            $res->bindValue(":convenio", "SC");
            $res->bindValue(":tipo_sangue", "O+");
            $res->bindValue(":cpf", "111");
            $res->bindValue(":diretoria", "1");
            $res->execute();

        ?>
            <div class="row">
                <div class="container-cadastro">
                    <form  method="post" action="" class="form-cadastro">
                        <h1 class="h3 mb-3 fw-bold">Cadastrar atleta</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="nome" class="visually-hidden">Nome</label>
                                <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome"  required autofocus>
                                <label for="user" class="visually-hidden">Username</label>
                                <input type="text" id="user" name="user" class="form-control" placeholder="Username" require>
                                <label for="password" class="visually-hidden">Password</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                <label for="nascimento" class="visually-hidden">Nascimento</label>
                                <input type="date" id="nascimento" name="nascimento" class="form-control" placeholder="Nascimento" require>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="telefone" class="visually-hidden">Telefone</label>
                                <input type="tel" id="telefone" name="telefone" class="form-control" placeholder="Telefone: 11-11111-1111" pattern="[0-9]{2}-[0-9]{5}-[0-9]{4}" require>
                                <label for="convenio" class="visually-hidden">Convênio</label>
                                <input type="text" id="convenio" name="convenio" class="form-control" placeholder="Convênio">
                                <label for="tipo_sangue" class="visually-hidden">Tipo sanguíneo</label>
                                <input type="text" id="tipo_sangue" name="tipo_sangue" class="form-control" placeholder="Tipo sanguíneo" require>
                                <label for="cpf" class="visually-hidden">CPF</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF: 111.111.111-11" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" require>
                            </div>
                        </div>
                        <input type="checkbox" id="diretoria" name="diretoria">
                        <label for="diretoria">Membro da diretoria</label>
                        <button class="w-100 btn btn-outline-warning" type="submit" name='cadastrar'>Cadastrar</button>
                    </form>
                    <!-- se a SESSION já estiver setada, significa que já foi tentado realizar login, e então da um alert de qual foi o erro. -->
                    <?php 
                            if (isset($_SESSION['user'])) {
                                if ($_SESSION['user'] == '' && $_SESSION['password'] == 'password_invalido') {
                                    echo "<br><div class='alert alert-warning'> senha inválida! </div>";
                                }
                                else if ($_SESSION['user'] == 'login_invalido' || $_SESSION['password'] == 'password_invalido') {
                                    echo "<br><div class='alert alert-warning'> user inválido! </div>";
                                }
                                else {
                                    echo "<br><div class='alert alert-warning'> erro ao cadastrar atleta! </div>";
                                }
                            }
                    ?>
                </div>
            </div>

            <hr>
            
            <div class="row">
                <div class="container-tabela">
                <h1 class="h3 mb-3 fw-bold">Atletas cadastrados</h1>
                    <table class="table table-striped table-warning table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
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
                            <tr>
                                <td>1</td>
                                <td>Roberta Silvano</td>
                                <td>robs</td>
                                <td>adjdiasdjisd</td>
                                <td>1996-07-01</td>
                                <td>11111111111</td>
                                <td>SC</td>
                                <td>O+</td>
                                <td>11111111111</td>
                                <td>Sim</td>
                                <td>
                                    <a href="#">Editar</a>
                                    <a href="#">Excluir</a>
                                </td>
                            </tr>
                            <tr>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>a</td>
                                <td>
                                    <a href="#">Editar</a>
                                    <a href="#">Excluir</a>
                                </td>
                            </tr>
                        </tbody>
        
                    </table>
                </div>
            </div>
          
       </main>
    </div>

</body>
</html>