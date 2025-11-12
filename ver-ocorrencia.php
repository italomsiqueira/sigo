<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php
$titulo = "Detalhes da Ocorrência";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">

        <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        $ocorrencia_id = intval($_GET['id']);

        // Busca dados da ocorrência
        $sql = "SELECT * FROM ocorrencia WHERE id = $ocorrencia_id";
        $res = mysqli_query($conn, $sql);
        $oc = mysqli_fetch_assoc($res);

        if (!$oc) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        $data = date('d/m/Y', strtotime($oc['data']));
        $descricao = nl2br($oc['descricao']);
        ?>

        <div class="card shadow-lg p-4">
            <h3 class="text-center mb-4">Ocorrência Nº <strong><?php echo $ocorrencia_id; ?></strong></h3>

            <?php
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                if ($msg == 'sucesso') {
                    echo "
                            <div class='alert alert-success col-md-12'>
                                <strong>Editado com sucesso!</strong>
                            </div>
                            ";
                } else {
                    echo "
                            <div class='alert alert-danger col-md-12'>
                                <strong>Ops! Erro ao editar!</strong>
                            </div>
                            ";
                }
            }
            ?>

            <p><strong>Data da Ocorrência:</strong> <?php echo $data; ?></p>
            <p><strong>Descrição:</strong><br><?php echo $descricao; ?></p>

            <hr>
            <h5>Alunos Envolvidos:</h5>

            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Assinatura</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_alunos = "
                SELECT a.nome, a.cpf 
                FROM ocorrencia_aluno oa
                INNER JOIN alunos a ON a.id = oa.alunos_id
                WHERE oa.ocorrencia_id = $ocorrencia_id
            ";
                    $res_alunos = mysqli_query($conn, $sql_alunos);

                    if (mysqli_num_rows($res_alunos) > 0) {
                        while ($aluno = mysqli_fetch_assoc($res_alunos)) {
                            echo "
                    <tr>
                        <td>{$aluno['nome']}</td>
                        <td>{$aluno['cpf']}</td>
                        <td style='height: 50px;'></td>
                    </tr>
                    ";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='text-center'>Nenhum aluno vinculado.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-center mt-4 no-print">
                <a href="listar-ocorrencias.php" class="btn btn-secondary">Voltar</a>
                <button class="btn btn-success" onclick="window.print()">Imprimir</button>
                <a href="editar-ocorrencia.php?id=<?php echo $ocorrencia_id; ?>" class="btn btn-warning">Editar</a>
                <button class="btn btn-danger" onclick="confirmarExclusao(<?php echo $ocorrencia_id; ?>)">Excluir</button>
            </div>
        </div>
    </div>

    <script>
        function confirmarExclusao(id) {
            if (confirm("Tem certeza que deseja excluir esta ocorrência? Esta ação não pode ser desfeita.")) {
                window.location.href = "acoes/excluir-ocorrencia.php?id=" + id;
            }
        }
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .card,
            .card * {
                visibility: visible;
            }

            .card {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>

</body>

</html>