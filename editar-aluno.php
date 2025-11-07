<?php
require('includes/conexao.php');
$id = $_GET['id'];
$sql = "SELECT * FROM alunos WHERE id = $id";

$resultado = mysqli_query($conn, $sql);

while ($dados = mysqli_fetch_assoc($resultado)) {
    $id = $dados['id'];
    $nome = $dados['nome'];
    $rg = $dados['rg'];
    $cpf = $dados['cpf'];
    $endereco = $dados['endereco'];
    $tel = $dados['tel'];
    $turma = $dados['turma'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <title>Editar Aluno</title>
    <script src="assets/js/validacoes.js"></script>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <script type="text/javascript">
        $("#tel, #celular").mask("(00) 00000-0000");
        $('#cpf').mask("000.000.000-00");
    </script>
    <link rel="shortcut icon" href="assets/img/favicon.png">
</head>

<body>

    <?php
    include('layout/menu.php');
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-login">
                <h3>Alterar -
                    <?php echo $nome ?>
                </h3>

                <?php

                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Salvo com sucesso!</strong>
                            </div>
                            ";
                    } else {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao salvar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <div class="alert alert-danger col-md-12" id="erro" hidden>

                </div>

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/editar-aluno.php">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="bloco-input">
                        <label class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome ?>">
                    </div>

                    <div class="bloco-input">
                        <label class="form-label">RG:</label>
                        <input type="text" class="form-control" name="rg" id="rg" value="<?php echo $rg ?>">
                    </div>

                    <div class="bloco-input">
                        <label class="form-label">CPF:</label>
                        <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $cpf ?>">
                    </div>

                    <div class="bloco-input">
                        <label class="form-label">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            value="<?php echo $endereco ?>">
                    </div>

                    <div class="bloco-input">
                        <label class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="tel" id="tel" value="<?php echo $tel ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="bloco-input">
                                <label class="form-label">Turma</label>
                                <select class="form-control" id="turma" name="turma">
                                    <option value="">Selecione....</option>

                                    <?php
                                    $sql = "SELECT * FROM turma ORDER BY id ASC";
                                    $result = mysqli_query($conn, $sql);
                                    while ($dados = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value="<?php echo $dados['id'] ?>" <?php if ($dados['id'] == $turma) { ?>
                                            selected
                                            <?php } ?>>
                                            <?php echo $dados['ano'] ?> -
                                            <?php echo $dados['turma']; ?>
                                        </option>
                                    <?php
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>


                        <div class="offset-md-1 col-md-10">
                            <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarEdicaoAluno();">Salvar</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>