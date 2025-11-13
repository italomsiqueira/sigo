<?php
require('protecao.php');
if ($_SESSION['usuario_nivel'] !== 'admin') {
    header('Location: index.php?msg=acessonegado');
    exit;
}
?>
