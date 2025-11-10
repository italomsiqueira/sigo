<?php
require('includes/conexao.php');
?>
<!DOCTYPE html>
<html lang="en">

<?php
$titulo = "Lista de ocorrências por aluno";
include('layout/head.php');
?>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
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

                // Variável para título do arquivo
                $arquivoTitulo = "Ocorrencias_de_{$nome_aluno}_({$turma_aluno})";
                $arquivoTitulo = str_replace(' ', '_', $arquivoTitulo);

                echo "<h3 class='text-center mb-4'>Ocorrências de <b>$nome_aluno</b> ($turma_aluno)</h3>";

                // Consulta das ocorrências do aluno
                $sqlOcorrenciasAluno = "SELECT o.id, o.data, o.descricao
                                        FROM ocorrencia_aluno oa
                                        INNER JOIN ocorrencia o ON oa.ocorrencia_id = o.id
                                        WHERE oa.alunos_id = '$aluno_id'
                                        ORDER BY o.data DESC";

                $result = mysqli_query($conn, $sqlOcorrenciasAluno);

                if (!$result) {
                    echo "<div class='alert alert-danger'>Erro ao buscar ocorrências: " . mysqli_error($conn) . "</div>";
                    exit;
                }
                ?>

                <div class='d-flex justify-content-end mb-3'>
                    <button class='btn btn-success me-2' id='btnExcel'><i class='bi bi-file-earmark-excel'></i> Exportar Excel</button>
                    <button class='btn btn-danger' id='btnPDF'><i class='bi bi-file-earmark-pdf'></i> Exportar PDF</button>
                </div>

                <table class="table" id="tblExport">
                    <thead>
                        <tr>
                            <th scope="col">ID Ocorrência</th>
                            <th scope="col">Data</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($dados = mysqli_fetch_assoc($result)) {
                            $id = $dados['id'];
                            $data = date('d-m-Y', strtotime($dados['data']));
                            $descricao = $dados['descricao'];

                            echo "
                            <tr>
                                <td>$id</td>
                                <td>$data</td>
                                <td>$descricao</td>
                            </tr>
                            ";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver/dist/FileSaver.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>

    <script>
        // Pegando o título do arquivo via PHP
        var tituloArquivo = "<?= $arquivoTitulo ?>";

        // ===== Exportar para EXCEL =====
        document.getElementById('btnExcel').addEventListener('click', function() {
            try {
                var table = document.getElementById('tblExport');
                var wb = XLSX.utils.table_to_book(table, { sheet: "Ocorrencias" });
                var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'array' });
                saveAs(new Blob([wbout], { type: "application/octet-stream" }), tituloArquivo + '.xlsx');
            } catch (err) {
                alert('Erro ao exportar para Excel: ' + err.message);
                console.error(err);
            }
        });

        // ===== Exportar para PDF =====
        document.getElementById('btnPDF').addEventListener('click', function() {
            try {
                const { jsPDF } = window.jspdf;
                var doc = new jsPDF('p', 'pt', 'a4');
                doc.setFontSize(14);
                doc.text("Ocorrências de <?= $nome_aluno ?> (<?= $turma_aluno ?>)", 40, 40);

                doc.autoTable({
                    html: '#tblExport',
                    startY: 60,
                    theme: 'striped',
                    styles: { fontSize: 10, cellPadding: 6 },
                    headStyles: { fillColor: [52, 152, 219], textColor: 255 }
                });

                doc.save(tituloArquivo + '.pdf');
            } catch (err) {
                alert('Erro ao exportar para PDF: ' + err.message);
                console.error(err);
            }
        });
    </script>
</body>
