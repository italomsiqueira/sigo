<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
$titulo = "Detalhes das Ocorrências do Aluno";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">

        <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Aluno não encontrado!</div>";
            exit;
        }

        $aluno_id = mysqli_real_escape_string($conn, $_GET['id']);

        // Dados do aluno
        $sql_aluno = "SELECT a.nome, t.ano, t.turma 
                  FROM alunos a 
                  LEFT JOIN turma t ON a.turma = t.id 
                  WHERE a.id = '$aluno_id'";
        $res_aluno = mysqli_query($conn, $sql_aluno);
        $dados_aluno = mysqli_fetch_assoc($res_aluno);

        if (!$dados_aluno) {
            echo "<div class='alert alert-danger'>Aluno não encontrado no banco de dados!</div>";
            exit;
        }

        $nome_aluno = $dados_aluno['nome'];
        $turma_aluno = $dados_aluno['ano'] . '-' . $dados_aluno['turma'];

        echo "<h3 class='text-center mb-4'>Ocorrências de <b>$nome_aluno</b> ($turma_aluno)</h3>";
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Ocorrência</th>
                    <th>Descrição</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "
                SELECT o.id, , o.descricao, o.data, p.nome
                FROM ocorrencias o
                INNER JOIN ocorrencia_aluno oa ON oa.ocorrencia_id = o.id
                WHERE oa.alunos_id = '$aluno_id'
                ORDER BY o.data DESC
            ";
                $res = mysqli_query($conn, $sql);

                if (mysqli_num_rows($res) > 0) {
                    while ($oc = mysqli_fetch_assoc($res)) {
                        $id = $oc['id'];
                        $tipo = $oc['tipo'];
                        $descricao = $oc['descricao'];
                        $data = date('d/m/Y', strtotime($oc['data']));

                        echo "
                        <tr>
                            <td>$id</td>
                            <td>$tipo</td>
                            <td>$descricao</td>
                            <td>$data</td>
                            <td>
                                <a href='editar-ocorrencia.php?id=$id'>
                                    <button class='btn btn-sm btn-warning'>Editar</button>
                                </a>
                                <a href='excluir-ocorrencia.php?id=$id' 
                                   onclick=\"return confirm('Tem certeza que deseja excluir esta ocorrência?');\">
                                    <button class='btn btn-sm btn-danger'>Excluir</button>
                                </a>
                            </td>
                        </tr>
                    ";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Nenhuma ocorrência registrada para este aluno.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-center mt-4">
            <a href="listar-ocorrencias.php">
                <button class="btn btn-dark">Voltar à lista</button>
            </a>
        </div>
    </div>

</body>

</html>