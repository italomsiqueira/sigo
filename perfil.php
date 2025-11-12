<?php
require('includes/conexao.php');
include('includes/protecao.php');

$usuario_id = $_SESSION['usuario_id'];

// Pega dados do usuário
$sql = "SELECT id, nome, login, nivel, foto FROM usuarios WHERE id='$usuario_id'";
$result = mysqli_query($conn, $sql);
$usuario = mysqli_fetch_assoc($result);

// Foto padrão se não existir
$usuario['foto'] = $usuario['foto'] ?? 'assets/img/user-placeholder.png';

$msg = $_GET['msg'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Meu Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-profile {
            border-radius: 1rem;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .btn-save {
            width: 100%;
        }

        .form-label i {
            margin-right: 5px;
        }
    </style>
    <script>
        function previewFoto(event) {
            const output = document.getElementById('fotoPreview');
            output.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</head>

<body>
    <?php include('layout/menu.php'); ?>

    <div class="container mt-4">
        <h2 class="mb-4">Meu Perfil</h2>

        <?php if ($msg): ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($msg) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        <?php endif; ?>

        <div class="row">
            <!-- Card da foto -->
            <div class="col-md-4 mb-3">
                <div class="card card-profile shadow-sm text-center p-3">
                    <img id="fotoPreview" src="<?= $usuario['foto'] ?>" class="profile-img mb-3" alt="Foto do usuário">
                    <form action="acoes/alterar-foto.php" method="POST" enctype="multipart/form-data">
                        <input type="file" name="foto" class="form-control mb-2" accept="image/*" onchange="previewFoto(event)" required>
                        <button type="submit" class="btn btn-primary btn-save"><i class="bi bi-camera-fill"></i> Alterar Foto</button>
                    </form>
                </div>
            </div>

            <!-- Card dos dados -->
            <div class="col-md-8">
                <div class="card shadow-sm card-profile p-4">
                    <form action="acoes/alterar-perfil.php" method="POST">
                        <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-fill"></i>Nome</label>
                            <input type="text" name="nome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person-badge-fill"></i>Login</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($usuario['login']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-shield-lock-fill"></i>Nível</label>
                            <input type="text" class="form-control" value="<?= ucfirst($usuario['nivel']) ?>" disabled>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-key-fill"></i>Nova Senha</label>
                            <input type="password" name="senha" class="form-control" placeholder="Digite a nova senha se quiser alterar">
                        </div>

                        <button type="submit" class="btn btn-success btn-save"><i class="bi bi-check-lg"></i> Salvar Alterações</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>