<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh;">
            <h4>Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link text-white">Home</a>
                </li>
                <li class="nav-item">
                    <a href="cadastro_usuario.php" class="nav-link text-white">Cadastrar Usuário</a>
                </li>
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link text-white">Sair</a>
                </li>
            </ul>
        </nav>

        <!-- Conteúdo -->
        <div class="container-fluid p-4">
            <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome']) ?>!</h1>
            <p>Use a sidebar para navegar no sistema.</p>
        </div>
    </div>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
