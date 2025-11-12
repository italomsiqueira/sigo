<?php
require('includes/protecao.php');
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php
$titulo = "Cadastrar Turma"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php');
?>

<body>
    <?php
    include('layout/menu.php');
    ?>
    <p></p>
    <div class="container-fluid">



        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-cadastro">
                <h3>Cadastrar Turma</h3>

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

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/salvar-turma.php">

                    <div class="col-md-6">
                        <div class="bloco-input">
                            <label class="form-label">Ano</label>
                            <select class="form-control" id="ano" name="ano">
                                <option value="">Selecione....</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="bloco-input">
                            <label class="form-label">Turma</label>
                            <select class="form-control" id="turma" name="turma">
                                <option value="">Selecione....</option>
                                <option value="a">A</option>
                                <option value="b">B</option>
                            </select>
                        </div>
                    </div>


                    <div class="offset-md-1 col-md-10">
                        <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarTurma();">Salvar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>