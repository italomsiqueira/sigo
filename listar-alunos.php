<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>
    <script src="assets/js/validacoes.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="assets/js/jquery.btechco.excelexport.js"></script>
    <script src="assets/js/jquery.base64.js"></script>
    <link rel="shortcut icon" href="assets/img/favicon.png">
    <title>Lista de alunos</title>

    <script>
        $(document).ready(function() {
            $("#btnExport").click(function() {
                $("#tblExport").btechco_excelexport({
                    containerid: "tblExport",
                    datatype: $datatype.Table,
                    filename: 'Lista de Alunos'
                });
            });
        });
    </script>
</head>

<body>
    <?php
    include('layout/menu.php');
    ?>

    <div class="container">

        <div class="row">
            <div class="alert alert-danger col-md-12" id="erro" hidden> </div>
            <div class="col-md-9">
                <form id="form-cadastro" onsubmit="return false" method="GET" action="aluno-nome.php">
                    <div class="bloco-input">
                        <input type="text" class="form-control" name="nomeBusca" id="nomeBusca"
                            placeholder="Digite o nome que deseja buscar...">
                    </div>
            </div>
            <div class="col-md-3">
                <button class="btn btn-dark col-md-12" onclick="validarBusca()">Buscar</button>
            </div>
            </form>


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
                        $sql = "SELECT * FROM alunos ORDER BY nome ASC";
                        $result = mysqli_query($conn, $sql);
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
            </div>
            <div>
                <button class="offset-md-4 col-md-4 btn btn-success" id="btnExport">Exportar para Excel</button>
            </div>
        </div>
    </div>



</body>

</html>