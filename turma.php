<?php
require('includes/conexao.php');
$idTurma = $_GET['id'];
$anoTurma = $_GET['ano'];
$turmaTurma = $_GET['turma'];
$sqlTurma = "SELECT * FROM alunos WHERE turma = $idTurma";
?>
<!DOCTYPE html>
<html lang="en">

<?php 
$titulo = "Lista de alunos da turma"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

<body>
    <?php
    include('layout/menu.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12 turma">
                <h3>Turma:

                    <?php
                    echo $anoTurma;
                    echo $turmaTurma;
                    ?>
                </h3>

                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Deletado com sucesso!</strong>
                            </div>
                            ";
                    } else {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao deletar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <table class="table" id="tblExport">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">RG</th>
                            <th scope="col">CPF</th>
                            <th scope="col">ENDEREÇO</th>
                            <th scope="col">TELEFONE</th>
                            <th scope="col">TURMA</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($conn, $sqlTurma);
                        while ($dados = mysqli_fetch_assoc($result)) {
                            $id = $dados['id'];
                            $nome = $dados['nome'];
                            $rg = $dados['rg'];
                            $cpf = $dados['cpf'];
                            $endereco = $dados['endereco'];
                            $tel = $dados['tel'];
                            $turma = $dados['turma'];
                            $turma_sql = "SELECT * FROM turma WHERE id = $turma";
                            $result_turma = mysqli_query($conn, $turma_sql);
                            $result_turma2 = mysqli_fetch_assoc($result_turma);
                            $turma_final = $result_turma2['ano'] . "-" . $result_turma2['turma'];
                            $urlDelete = "acoes/deletar-aluno.php?id=$id";
                            $urlUpdate = "editar-aluno.php?id=$id";
                            echo "
                           <tr>
                                <td>$id</td>
                                <td>$nome</td>
                                <td>$rg</td>
                                <td>$cpf</td>
                                <td>$endereco</td>
                                <td>$tel</td>
                                <td>$turma_final</td>
                                <td>
                                <a href='$urlUpdate'>
                                    <button class='btn btn-info btn-sm'>Editar</button>
                                </a></td>
                                <td>
                                <a href='$urlDelete'>
                                <button class='btn btn-danger btn-sm'>Deletar</button>
                                </a>
                                </td>
                           </tr>
                           ";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
            <div>
                <button class="offset-md-4 col-md-4 btn btn-success" id="btnExport">Exportar para Excel</button>
            </div>
        </div>
    </div>
</body>

</html>