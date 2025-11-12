<?php
require('includes/protecao.php');
require('includes/conexao.php');
$nomeBusca = strtoupper($_GET['nomeBusca']);
$sqlTurma = "SELECT * FROM alunos WHERE nome LIKE '$nomeBusca%'";
?>
<!DOCTYPE html>
<html lang="en">

<?php 
$titulo = "Lista de alunos por nome"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

<body>
    <?php
    include('layout/menu.php');
    ?>
    <p></p>
    <div class="container">
        <div class="row">
            <div class="col-md-12 turma">


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


                <table class="table">
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
                            if ($result_turma2) {
                                $turma_final = $result_turma2['ano'] . "-" . $result_turma2['turma'];
                            } else {
                                $turma_final = "<strong>NÃO CADASTRADO!</strong>";
                            }
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

                <a href="listar-alunos.php">
                    <button class='offset-md-4 col-md-4 btn btn-info btn-sm'>Voltar</button>
                </a>

            </div>
        </div>
    </div>
</body>

</html>