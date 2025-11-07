<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php 
$titulo = "Lista de turmas"; // ou outro título
$exportFilename = "Lista de Alunos"; // se precisar do Excel
include('layout/head.php'); 
?>

<body>
    <?php
    include('layout/menu.php');
    ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Deletado com sucesso!</strong>
                            </div>
                            ";
                    } else if ($msg == 'erro') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao deletar!</strong>
                            </div>
                            ";
                    } else if ($msg == 'editarReserva') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro, verifique se não está tentando editar o cadastro reserva!</strong>
                            </div>
                            ";
                    } else if ($msg == 'deletarReserva') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro, verifique se não está tentando deletar o cadastro reserva!</strong>
                            </div>
                            ";
                    } else if ($msg == 'editar') {
                        echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Editado com sucesso!</strong>
                            </div>
                            ";
                    } else if ($msg == 'erroEditar') {
                        echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao editar!</strong>
                            </div>
                            ";
                    }
                }
                ?>


                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Excluir</th>
                            <th scope="col">Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM turma ORDER BY id ASC";
                        $result = mysqli_query($conn, $sql);
                        while ($dados = mysqli_fetch_assoc($result)) {
                            $id = $dados['id'];
                            $ano = $dados['ano'];
                            $turma = $dados['turma'];
                            if ($id == 1) {
                                echo "
                                <script>
                                document.getElementById('btn-editar').setAttribute('disabled', true);
                                </script>
                                ";
                            }
                            $urlDelete = "acoes/deletar-turma.php?id=$id";
                            $urlUpdate = "editar-turma.php?id=$id";
                            $urlVer = "turma.php?id=$id & ano=$ano & turma=$turma";

                            echo "
                           <tr>
                                <td>$id</td>
                                <td>$ano</td>
                                <td>$turma</td>
                                <td>
                                <a href='$urlUpdate' id='editar'>
                                
                                    <button class='btn btn-info btn-sm btn-editar' id='btn-editar'>Editar</button>
                                    <script>
                                    if($id == 1){
                                    document.getElementById('btn-editar').disabled = true;
                                    }
                                    </script>                                    
                                </a></td>
                                <td>
                                <a href='$urlDelete'>
                                <button class='btn btn-danger btn-sm btn-deletar'>Deletar</button>
                                </a>
                                </td>

                                <td>
                                <a href='$urlVer'>
                                <button class='btn btn-success btn-sm btn-ver'>Ver turma</button>
                                </a>
                                </td>
                           </tr>
                           ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>