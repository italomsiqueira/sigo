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

<?php 
$titulo = "Editar aluno"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

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