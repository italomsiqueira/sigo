<?php
require('../includes/protecao_admin.php');
require('../includes/conexao.php');

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = $id LIMIT 1");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    header('Location: listar.php?msg=Usuário não encontrado');
    exit;
}

$titulo = "Editar Usuário";
include('../layout/head.php');
include('../layout/menu.php');
?>

<div class="container mt-4">
    <h3><i class="bi bi-pencil-square me-2"></i>Editar Usuário</h3>

    <form action="../acoes/usuario_editar.php" method="POST" enctype="multipart/form-data" class="col-md-6 mt-3">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="mb-3">
            <label>Nome:</label>
            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($user['nome']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Login:</label>
            <input type="text" name="login" class="form-control" value="<?= htmlspecialchars($user['login']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Senha (deixe em branco para manter):</label>
            <input type="password" name="senha" class="form-control">
        </div>

        <div class="mb-3">
            <label>Nível:</label>
            <select name="nivel" class="form-select">
                <option value="usuario" <?= $user['nivel'] == 'usuario' ? 'selected' : '' ?>>Usuário</option>
                <option value="admin" <?= $user['nivel'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Foto:</label><br>
            <img src="../<?= $user['foto'] ?: 'assets/img/user-placeholder.png' ?>" width="70" class="rounded mb-2"><br>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Salvar alterações</button>
        <a href="listar.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
