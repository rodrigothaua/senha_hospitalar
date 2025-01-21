<?php
session_start();
include('db.php');

// Inicializar variáveis
$ultimaSenhaChamada = null;
$senhasChamadas = [];

// Buscar a última senha chamada
$sql = "SELECT numero_senha FROM senhas WHERE status = 'chamada' ORDER BY criada_em DESC LIMIT 1";
$stmt = $pdo->query($sql);
$ultimaSenhaChamada = $stmt->fetchColumn();

// Buscar as últimas 5 senhas chamadas para o resumo
$sql = "SELECT numero_senha FROM senhas WHERE status = 'chamada' ORDER BY criada_em DESC LIMIT 5";
$stmt = $pdo->query($sql);
$senhasChamadas = $stmt->fetchAll(PDO::FETCH_COLUMN);
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
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Never expand</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample01">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Última senha -->
            <div class="col-9">
                <h1 class="mb-4">Senha de chamada:</h1>

                <?php if ($ultimaSenhaChamada): ?>
                    <div class="alert alert-info">
                        <h3>Senha: <strong><?= htmlspecialchars($ultimaSenhaChamada) ?></strong></h3>
                    </div>
                <?php else: ?>
                    <div class="alert alert-secondary">
                        <p class="mb-0">Nenhuma senha foi chamada até agora.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Resumo das últimas senhas chamadas -->
            <div class="col-3">
                <h4>Últimas Chamadas</h4>
                <ul class="list-group">
                    <?php if (!empty($senhasChamadas)): ?>
                        <?php foreach ($senhasChamadas as $senha): ?>
                            <li class="list-group-item">Senha: <strong><?= htmlspecialchars($senha) ?></strong></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted">Nenhuma senha chamada.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
