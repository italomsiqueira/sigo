<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php 
$titulo = "Editar Ocorrência";
include('layout/head.php'); 
?>

<body>
<?php include('layout/menu.php'); ?>

<div class="container mt-4">
    <div class="col-md-8 offset-md-2">
        <h3 class="text-center mb-4">Editar Ocorrência</h3>

        <?php
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        $ocorrencia_id = intval($_GET['id']);

        // Busca ocorrência
        $sql = "SELECT * FROM ocorrencia WHERE id = $ocorrencia_id";
        $res = mysqli_query($conn, $sql);
        $oc = mysqli_fetch_assoc($res);

        if (!$oc) {
            echo "<div class='alert alert-danger'>Ocorrência não encontrada!</div>";
            exit;
        }

        // Busca alunos vinculados
        $sql_alunos_vinc = "SELECT alunos_id FROM ocorrencia_aluno WHERE ocorrencia_id = $ocorrencia_id";
        $res_vinc = mysqli_query($conn, $sql_alunos_vinc);
        $alunos_vinc = [];
        while ($a = mysqli_fetch_assoc($res_vinc)) {
            $alunos_vinc[] = $a['alunos_id'];
        }
        ?>

        <form action="acoes/atualizar-ocorrencia.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $ocorrencia_id; ?>">

            <div class="mb-3">
                <label for="data" class="form-label">Data da Ocorrência</label>
                <input type="date" name="data" id="data" class="form-control" value="<?php echo $oc['data']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control" required><?php echo htmlspecialchars($oc['descricao']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="alunos" class="form-label">Alunos Envolvidos</label>
                <select name="alunos[]" id="alunos" class="selectpicker form-control" multiple data-live-search="true" title="Selecione os alunos...">
                    <?php
                    $sql_alunos = "SELECT id, nome FROM alunos ORDER BY nome";
                    $res_alunos = mysqli_query($conn, $sql_alunos);

                    while ($aluno = mysqli_fetch_assoc($res_alunos)) {
                        $selected = in_array($aluno['id'], $alunos_vinc) ? 'selected' : '';
                        echo "<option value='{$aluno['id']}' $selected>{$aluno['nome']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success col-md-12">Salvar Alterações</button>
                <a href="detalhes-ocorrencia.php?id=<?php echo $ocorrencia_id; ?>" class="btn btn-secondary mt-2 col-md-12">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap-select -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
        $('.selectpicker').selectpicker();
    }
});
</script>

</body>
</html>
