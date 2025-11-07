<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php 
$titulo = "Cadastrar aluno"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

<body>
    <?php
    include('layout/menu.php');
    ?>
    
    <div class="container-fluid">



        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-cadastro">
                <h3>Cadastrar Aluno</h3>

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

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/salvar-aluno.php">

                    <div class="bloco-input">
                        <label class="form-label">Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">RG:</label>
                        <input type="text" class="form-control" name="rg" id="rg">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">CPF:</label>
                        <input type="text" class="form-control" name="cpf" id="cpf">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">Endereço:</label>
                        <input type="text" class="form-control" name="endereco" id="endereco"
                            placeholder="Ex.: Rua Dom Manoel, N 251, Centro">
                    </div>
                    <div class="bloco-input">
                        <label class="form-label">Telefone:</label>
                        <input type="text" class="form-control" name="tel" id="tel" placeholder="Ex.: (00) 9.0000-0000">
                    </div>

                    <script type="text/javascript">
                        $("#tel, #celular").mask("(00) 00000-0000");
                        $('#cpf').mask("000.000.000-00");
                    </script>

                    <div class="bloco-input">
                        <label class="form-label">Escolaridade</label>
                        <select class="form-control" id="escolaridade" name="escolaridade">
                            <option value="">Selecione....</option>
                            <option value="fundamental_inc">Ensino fundamental incompleto</option>
                            <option value="fundamental">Ensino fundamental completo</option>
                            <option value="medio_inc">Ensino médio incompleto</option>
                            <option value="medio">Ensino médio completo</option>
                            <option value="superior_inc">Ensino superior incompleto</option>
                            <option value="superior">Ensino superior completo</option>
                        </select>
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
                                    <option value="<?php echo $dados['id']; ?>">
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
                            <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarAluno();">Salvar</button>
                        </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>