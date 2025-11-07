<?php
require('includes/conexao.php');
$id = $_GET['id'];
$sql = "SELECT * FROM turma WHERE id = $id";

$resultado = mysqli_query($conn, $sql);

while ($dados = mysqli_fetch_assoc($resultado)) {
    $id = $dados['id'];
    $ano = $dados['ano'];
    $turma = $dados['turma'];
}
?>

<!DOCTYPE html>
<html lang="en">

<?php 
$titulo = "Editar turma"; // ou outro título
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
                <h3>Alterar - Turma
                    <?php echo $id ?>
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

                <form id="form-cadastro" onsubmit="return false" method="POST" action="acoes/editar-turma.php">
                    <input type="hidden" name="id" value="<?php echo $id ?>">

                    <div class="bloco-input">
                        <label class="form-label">Horário:</label>
                        <input type="time" class="form-control" name="hora" id="hora" value="<?php echo $hora ?>">
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="bloco-input">
                                <label class="form-label">Dia 1</label>
                                <select class="form-control" id="dia1" name="dia1">
                                    <?php if ($dia1 == 'SEG') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG' selected>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia1 == 'TER') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER' selected>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia1 == 'QUA') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA' selected>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia1 == 'QUI') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI' selected>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia1 == 'SEX') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX' selected>Sexta-feira</option>
                                     ";
                                    } else {
                                        echo "<option value='' selected>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                        ";
                                    }
                                    ?>


                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bloco-input">
                                <label class="form-label">Dia 2</label>
                                <select class="form-control" id="dia2" name="dia2">
                                    <?php if ($dia2 == 'SEG') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG' selected>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia2 == 'TER') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER' selected>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia2 == 'QUA') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA' selected>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia2 == 'QUI') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI' selected>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                     ";
                                    } else if ($dia2 == 'SEX') {
                                        echo "<option value=''>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX' selected>Sexta-feira</option>
                                     ";
                                    } else {
                                        echo "<option value='' selected>Selecione....</option>
                                        <option value='SEG'>Segunda-feira</option>
                                        <option value='TER'>Terça-feira</option>
                                        <option value='QUA'>Quarta-feira</option>
                                        <option value='QUI'>Quinta-feira</option>
                                        <option value='SEX'>Sexta-feira</option>
                                        ";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="offset-md-1 col-md-10">
                        <button class="btn btn-dark col-md-12 btn-salvar" onclick="validarEdicaoTurma();">Salvar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    </div>
</body>

</html>