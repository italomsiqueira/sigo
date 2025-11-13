<?php
require('../includes/protecao_admin.php');
$titulo = "Cadastrar Usuário";
include('../layout/head.php');
include('../layout/menu.php');
?>

<div class="container mt-4">
    <h3><i class="bi bi-person-plus-fill me-2"></i>Novo Usuário</h3>
    <form action="../acoes/usuario_cadastrar.php" method="POST" enctype="multipart/form-data" class="mt-3 col-md-6">
        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Login:</label>
            <input type="text" name="login" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha:</label>
            <input type="password" name="senha" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nível:</label>
            <select name="nivel" class="form-select">
                <option value="usuario">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Foto (opcional):</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
