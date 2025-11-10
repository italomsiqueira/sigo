<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<?php
$titulo = "Cadastrar ocorrência";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <div class="offset-md-3 col-md-6 bloco-cadastro">
                <h3>Cadastrar Ocorrência</h3>

                <?php
                if (isset($_GET['msg'])) {
                    if ($_GET['msg'] == 'sucesso') {
                        echo "<div class='alert alert-success'>Ocorrência salva com sucesso!</div>";
                    } elseif ($_GET['msg'] == 'erro') {
                        echo "<div class='alert alert-danger'>Erro ao salvar ocorrência.</div>";
                    } elseif ($_GET['msg'] == 'no_alunos') {
                        echo "<div class='alert alert-warning'>Selecione ao menos um aluno.</div>";
                    } elseif ($_GET['msg'] == 'debug') {
                        echo "<div class='alert alert-info'>Debug: verifique payload no DevTools (Network → form data).</div>";
                    }
                }
                ?>

                <form action="acoes/salvar-ocorrencia.php" method="POST">
                    <div class="bloco-input">
                        <label for="data">Data da Ocorrência</label>
                        <input type="date" name="data" id="data" class="form-control"
                            value="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="bloco-input">
                        <label for="descricao">Descrição da Ocorrência</label>
                        <textarea name="descricao" id="descricao" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="bloco-input">
                        <label>Selecione os alunos</label><br>
                        <!-- NOTE o name="alunos[]" -->
                        <select name="alunos[]" id="alunos-ocorrencia" class="selectpicker form-control" multiple
                            data-live-search="true" title="Escolha os alunos..." required>
                            <?php
                            $sql = "SELECT id, nome FROM alunos ORDER BY nome";
                            $resultado = mysqli_query($conn, $sql);
                            while ($aluno = mysqli_fetch_assoc($resultado)) {
                                echo "<option value='{$aluno['id']}'>{$aluno['nome']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-dark col-md-12 btn-salvar">Salvar Ocorrência</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap-select (CSS/JS) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js"></script>

    <script>
        // Inicializa selectpicker quando DOM estiver carregado
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof $ !== 'undefined' && typeof $.fn.selectpicker !== 'undefined') {
                $('.selectpicker').selectpicker();
            }
        });
    </script>
</body>

</html>