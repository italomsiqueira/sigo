<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel='stylesheet' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css' />

    <!-- CSS personalizados -->
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/login.css"> -->

    <!-- Scripts jQuery e Bootstrap -->
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js'></script>

    <!-- Scripts personalizados -->
    <script src="assets/js/validacoes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="assets/js/jquery.btechco.excelexport.js"></script>
    <script src="assets/js/jquery.base64.js"></script>

    <!-- Título dinâmico da página -->
    <title><?php echo isset($titulo) ? $titulo . ' - SIGO' : 'SIGO'; ?></title>

    <!-- Scripts específicos -->
    <script type="text/javascript">
        // Máscaras de telefone e CPF
        $(document).ready(function() {
            if($("#tel, #celular").length) {
                $("#tel, #celular").mask("(00) 00000-0000");
            }
            if($('#cpf').length) {
                $('#cpf').mask("000.000.000-00");
            }

            // Exportação de tabela Excel
            if($("#btnExport").length && $("#tblExport").length) {
                $("#btnExport").click(function() {
                    $("#tblExport").btechco_excelexport({
                        containerid: "tblExport",
                        datatype: $datatype.Table,
                        filename: '<?php echo $exportFilename ?? "Export"; ?>'
                    });
                });
            }
        });
    </script>
</head>
