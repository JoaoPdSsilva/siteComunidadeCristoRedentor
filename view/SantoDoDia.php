<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórias dos Santos - Santo do Dia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <style>
     html, body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    .container {
        flex: 1; /* Faz o conteúdo principal ocupar o espaço restante */
    }

</style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Histórias dos Santos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link" href="../index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ListaDosSantos.php">Sobre os Santos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="SantoDoDia.php">Santo do Dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Lista de Santos -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-4">
                <?php 
                include '../conexao.php';

                    echo '<div class="container text-center mt-5"> <h1>Santo do dia: <span id="santoDia">' . htmlspecialchars($data_param, ENT_QUOTES, 'UTF-8') . '</span></h1> <p class="lead">Descubra o santo do dia e sua história!</p> </div>';

                    $consulta_santos = "SELECT * FROM santos WHERE DATE_FORMAT(data_beatificacao, '%m-%d') = GETDATE()";
                    $consulta = mysqli_query($conexao, $consulta_santos);

                    // Verificar se há resultados
                    if (mysqli_num_rows($consulta) > 0) {
                        while ($linha = mysqli_fetch_array($consulta)) {
                            echo '<div class="col-md-4 mb-4 d-flex justify-content-center">';
                            echo '<div class="text-center mb-3">';
                            echo '<img src="' . htmlspecialchars($linha['imagem'], ENT_QUOTES, 'UTF-8') . '" alt="Imagem do Santo" class="img-fluid" style="max-width: 100%; height: auto;">';
                            echo '</div>';
                            echo '<div class="card text-center santo-card border-light shadow-sm">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title">' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</h5>';
                            echo '<p class="card-text"><small class="text-muted">Beatificação: ' . htmlspecialchars($linha['data_beatificacao'], ENT_QUOTES, 'UTF-8') . '</small></p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">Nenhum santo encontrado para esta data.</p>';
                    }

                mysqli_close($conexao);
                ?>
            </div>
        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> Histórias dos Santos. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/index.js"></script>

</body>

</html>
