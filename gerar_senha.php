<?php
session_start();
include('db.php');

$senhaGerada = null; // Variável para exibir a senha gerada, se houver

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buscar o último número de senha gerado
    $sql = "SELECT MAX(numero_senha) AS ultima_senha FROM senhas";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Determinar o próximo número de senha
    $proxima_senha = $row['ultima_senha'] ? $row['ultima_senha'] + 1 : 1;

    // Inserir a nova senha no banco
    $sql = "INSERT INTO senhas (numero_senha) VALUES (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$proxima_senha]);

    // Armazenar a senha gerada para exibir ao usuário
    $senhaGerada = $proxima_senha;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1 class="mb-4">Sistema de Senhas</h1>

                <?php if ($senhaGerada): ?>
                    <div class="alert alert-success">
                        <h3>Sua senha é: <strong><?= htmlspecialchars($senhaGerada) ?></strong></h3>
                    </div>
                <?php endif; ?>

                <form method="POST">
                    <button type="submit" class="btn btn-success btn-lg">Gerar Senha de Atendimento</button>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
