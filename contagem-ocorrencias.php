<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<?php
require('includes/protecao.php');
require('includes/conexao.php');
$titulo = "Ocorrências por Aluno";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>
    <p></p>
    <div class="container">

        <div class="row">
            <div class="alert alert-danger col-md-12" id="erro" hidden></div>

            <h3 class="text-center mb-4">Ocorrências por Aluno</h3>

            <!-- 🔍 Filtros -->
            <form id="form-filtro" method="GET" action="">
                <div class="row g-2 align-items-end">
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="nomeBusca" id="nomeBusca"
                            placeholder="Digite o nome do aluno..."
                            value="<?= isset($_GET['nomeBusca']) ? htmlspecialchars($_GET['nomeBusca']) : ''; ?>">
                    </div>

                    <div class="col-md-2">
                        <select name="turmaBusca" id="turmaBusca" class="form-control">
                            <option value="">Todas as turmas...</option>
                            <?php
                            $turmas_sql = "SELECT id, ano, turma FROM turma ORDER BY ano, turma";
                            $turmas_res = mysqli_query($conn, $turmas_sql);
                            while ($t = mysqli_fetch_assoc($turmas_res)) {
                                $selected = (isset($_GET['turmaBusca']) && $_GET['turmaBusca'] == $t['id']) ? 'selected' : '';
                                echo "<option value='{$t['id']}' $selected>{$t['ano']}-{$t['turma']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-dark w-100" type="submit">Filtrar</button>
                    </div>

                    <div class="col-md-2">
                        <a href="<?= basename($_SERVER['PHP_SELF']); ?>" class="btn btn-danger w-100">Limpar filtros</a>
                    </div>
                </div>
            </form>


            <div class="col-md-12 mt-4">
                <?php
                if (isset($_GET['msg'])) {
                    $msg = $_GET['msg'];
                    if ($msg == 'sucesso') {
                        echo "<div class='alert alert-success col-md-12'><strong>Ocorrência removida com sucesso!</strong></div>";
                    } else {
                        echo "<div class='alert alert-danger col-md-12'><strong>Ops! Erro ao processar a solicitação!</strong></div>";
                    }
                }
                ?>

                <table class="table" id="tblExport">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Turma</th>
                            <th scope="col">Qtd. Ocorrências</th>
                            <th scope="col">Detalhes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Filtros dinâmicos
                        $filtros = [];
                        if (!empty($_GET['nomeBusca'])) {
                            $nomeBusca = mysqli_real_escape_string($conn, $_GET['nomeBusca']);
                            $filtros[] = "a.nome LIKE '%$nomeBusca%'";
                        }
                        if (!empty($_GET['turmaBusca'])) {
                            $turmaBusca = mysqli_real_escape_string($conn, $_GET['turmaBusca']);
                            $filtros[] = "a.turma = '$turmaBusca'";
                        }

                        $where = count($filtros) > 0 ? "WHERE " . implode(" AND ", $filtros) : "";

                        // Query principal
                        $sql = "
                            SELECT a.id, a.nome, a.turma, COUNT(oa.ocorrencia_id) AS total
                            FROM alunos a
                            LEFT JOIN ocorrencia_aluno oa ON a.id = oa.alunos_id
                            $where
                            GROUP BY a.id, a.nome, a.turma
                            ORDER BY a.nome ASC
                        ";

                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($dados = mysqli_fetch_assoc($result)) {
                                $id = $dados['id'];
                                $nome = $dados['nome'];
                                $turma_id = $dados['turma'];
                                $total = $dados['total'];

                                $turma_sql = "SELECT ano, turma FROM turma WHERE id = '$turma_id'";
                                $res_turma = mysqli_query($conn, $turma_sql);
                                $turma_dados = mysqli_fetch_assoc($res_turma);
                                $turma_nome = $turma_dados ? $turma_dados['ano'] . '-' . $turma_dados['turma'] : 'NÃO CADASTRADA';

                                echo "
                                <tr>
                                    <td>$id</td>
                                    <td>$nome</td>
                                    <td>$turma_nome</td>
                                    <td>$total</td>
                                    <td>
                                        <a href='ver-ocorrencias-aluno.php?id=$id'>
                                            <button class='btn btn-dark btn-sm'>Ver Detalhes</button>
                                        </a>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center'>Nenhum aluno encontrado.</td></tr>";
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