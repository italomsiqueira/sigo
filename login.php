<?php
require('includes/conexao.php');
?>

<html>

<?php 
$titulo = "Login"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

<head>
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>



    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-login">
                <div class="row">
                    <div class="col-md-6 bloco-info">
                        <center>
                            <img src="assets/img/logo-cinza.png" class="logo" min-width="100%">

                            <div class="col-md-10">
                                <h4></h4>
                            </div>

                        </center>
                    </div>

                    <div class="col-md-6 bloco-form">


                        <form id="form-login" onsubmit="return false" method="POST" action="acoes/login.php">


                            <div class="login">

                                <div class="alert alert-danger col-md-12" id="erro" hidden> </div>
                                <?php

                                if (isset($_GET['msg'])) {
                                    $msg = $_GET['msg'];
                                    if ($msg == 'sucesso') {
                                        echo "
                                        <div class='alert alert-success col-md-12'>
                                            <strong>Logado com sucesso! Aguarde</strong>
                                        </div>
                                        ";
                                        header('Location: ../infocurso/index.php');
                                    } else if ($msg == 'errologin') {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>Usuário incorreto!</strong>
                                        </div>
                                        ";
                                    } else if ($msg == 'errosenha') {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>Senha incorreta!</strong>
                                        </div>
                                        ";
                                    } else {
                                        echo "
                                        <div class='alert alert-danger col-md-12'>
                                            <strong>ERRO!</strong>
                                        </div>
                                        ";
                                    }
                                }
                                ?>

                                <div class="offset-md-1 col-md-10 bloco-input">
                                    <label class="form-label">Login:</label>
                                    <input type="text" class="form-control" name="login" id="login">
                                </div>

                                <div class="offset-md-1 col-md-10 bloco-input">
                                    <label class="form-label">Senha:</label>
                                    <input type="password" class="form-control" name="senha" id="senha">
                                </div>

                                <div class="offset-md-1 col-md-10">
                                    <a href="principal.html">
                                        <button class="btn btn-success col-md-12 btn-salvar"
                                            onclick="validarLogin();">Entrar no sistema</button>
                                    </a>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




</body>

</html>