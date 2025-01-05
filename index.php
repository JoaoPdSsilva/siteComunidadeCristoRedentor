<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórias dos Santos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Histórias dos Santos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Alternar navegação">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                        <a class="nav-link active" href="index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/ListaDosSantos.php">Sobre os Santos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/SantoDoDia.php">Santo do Dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view/Contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="santos-imagem">
        <div class="santos-texto">
            <p>Explore as vidas e legados dos santos da Igreja Católica</p>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row" id="lista-santos">
        <?php 
    include 'conexao.php';

    $consulta_santos = "SELECT * FROM santos ORDER BY RAND() LIMIT 3;";
    $consulta = mysqli_query($conexao, $consulta_santos);

    while ($linha = mysqli_fetch_array($consulta)) {
        echo '<div class="col-md-4 mb-4">';
        echo '<div class="card santo-card">';
        echo '<img src="' . htmlspecialchars($linha['imagem'], ENT_QUOTES, 'UTF-8') . '" alt="Imagem do Santo">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</h5>';
        echo '<p class="card-text">' . htmlspecialchars($linha['historia'], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '<p class="card-text"><small class="text-muted">Beatificação: ' . htmlspecialchars($linha['data_beatificacao'], ENT_QUOTES, 'UTF-8') . '</small></p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    mysqli_close($conexao);
?>

        </div>
    </div>

    <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> Histórias dos Santos. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
    <script>
        // Use o jQuery para aguardar o carregamento da página
        $(document).ready(function() {
            // Exiba o SweetAlert
            Swal.fire({
                title: 'Olá! Bem-vindo às Histórias dos Santos',
                text: 'Saiba que ela está em desenvolvimento, por isso não tem muitas informações sobre os santos',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        });
    </script>
</body>

</html>
