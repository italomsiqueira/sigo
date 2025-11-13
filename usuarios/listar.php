<?php
require('../includes/protecao_admin.php');
require('../includes/conexao.php');
$titulo = "Gerenciar Usuários";
include('../layout/head.php');
include('../layout/menu.php');

$result = mysqli_query($conn, "SELECT * FROM usuarios ORDER BY id DESC");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="bi bi-people-fill me-2"></i>Usuários</h3>
        <a href="cadastrar.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Novo Usuário</a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($_GET['msg']) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Login</th>
                    <th>Nível</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($u = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><img src="../<?= $u['foto'] ?: 'assets/img/user-placeholder.png' ?>" width="40" class="rounded-circle"></td>
                        <td><?= htmlspecialchars($u['nome']) ?></td>
                        <td><?= htmlspecialchars($u['login']) ?></td>
                        <td><?= ucfirst($u['nivel']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-pencil"></i></a>
                            <a href="excluir.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este usuário?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
