<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
$titulo = "Lista de Ocorrências";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">
        <h3 class="text-center mb-4">Lista de Ocorrências</h3>

        <?php
        // Consulta todas as ocorrências com os alunos envolvidos
        $sql = "
            SELECT 
                o.id AS ocorrencia_id, 
                o.descricao, 
                o.data,
                GROUP_CONCAT(SUBSTRING_INDEX(a.nome, ' ', 1) SEPARATOR ', ') AS alunos
            FROM ocorrencia o
            LEFT JOIN ocorrencia_aluno oa ON oa.ocorrencia_id = o.id
            LEFT JOIN alunos a ON a.id = oa.alunos_id
            GROUP BY o.id, o.descricao, o.data
            ORDER BY o.data DESC
        ";

        $res = mysqli_query($conn, $sql);

        // Verifica se houve erro na query
        if (!$res) {
            echo "<div class='alert alert-danger'>
                    Erro ao executar consulta: " . mysqli_error($conn) . "
                  </div>";
            exit;
        }
        ?>

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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Alunos Envolvidos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($res) > 0) {
                    while ($oc = mysqli_fetch_assoc($res)) {
                        $id = $oc['ocorrencia_id'];
                        $data = !empty($oc['data']) ? date('d/m/Y', strtotime($oc['data'])) : '-';
                        $descricao = htmlspecialchars($oc['descricao'] ?? '');
                        $alunos = htmlspecialchars($oc['alunos'] ?? 'Nenhum');

                        echo "
                            <tr>
                                <td>$id</td>
                                <td>$data</td>
                                <td>$descricao</td>
                                <td>$alunos</td>
                                <td>
                                    <a href='ver-ocorrencia.php?id=$id' class='btn btn-sm btn-dark'>Ver Detalhes</a>
                                </td>
                            </tr>
                        ";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhuma ocorrência registrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>