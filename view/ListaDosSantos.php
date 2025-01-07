<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórias dos Santos - Santo do Dia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/index.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .container {
            flex: 1; 
        }

        .footer {
            margin-top: auto;
        }
    </style>
</head>

<body>
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
                        <a class="nav-link active" href="../index.php">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ListaDosSantos.php">Sobre os Santos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="SantoDoDia.php">Santo do Dia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Contato.php">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="row justify-content-center">
        <?php 
        include '../conexao.php';

        // Número de santos por página
        $por_pagina = 5;

        // Pega a página atual via GET, se não existir, define como 1
        $pagina_atual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;

        // Calcula o início da consulta (OFFSET)
        $inicio = ($pagina_atual - 1) * $por_pagina;

        // Verifica se foi passado um ID na URL para exibir um santo específico
        $id_santo = isset($_GET['santo']) ? intval($_GET['santo']) : null;

        if ($id_santo) {
            // Consulta para exibir informações de um único santo
            $consulta_santos = "SELECT * FROM santos WHERE id = $id_santo";
            echo '<div class="container text-center mt-5"> <h1>Informações do Santo</h1> <p class="lead">Detalhes sobre o santo escolhido.</p> </div>';
        } else {
            // Consulta para listar santos com paginação
            $consulta_santos = "SELECT * FROM santos ORDER BY YEAR(data_beatificacao) DESC LIMIT $inicio, $por_pagina";
            echo '<div class="container text-center mt-5"> <h1>Sobre os Santos</h1> <p class="lead">Descubra os santos e suas histórias!</p> </div>';
        }

        $consulta = mysqli_query($conexao, $consulta_santos);

        if (mysqli_num_rows($consulta) > 0) {
            // Exibe os santos
            while ($linha = mysqli_fetch_array($consulta)) {
                echo '<div class="col-md-4 col-lg-4 mb-4 d-flex justify-content-center">';
                echo '<div class="card card-horizontal shadow-sm">';
                echo '<a href="ListaDosSantos.php?santo=' . $linha['id'] . '">';
                echo '<img src="' . htmlspecialchars($linha['imagem'], ENT_QUOTES, 'UTF-8') . '" alt="Imagem do Santo" class="card-img">';
                echo '</a>';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">' . htmlspecialchars($linha['nome'], ENT_QUOTES, 'UTF-8') . '</h5>';
                echo '<p class="card-text">' . htmlspecialchars($linha['historia'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p class="text-center">Nenhum santo encontrado.</p>';
        }

        // Paginação: contar o total de registros
        $consulta_total = "SELECT COUNT(*) AS total FROM santos";
        $resultado_total = mysqli_query($conexao, $consulta_total);
        $linha_total = mysqli_fetch_array($resultado_total);
        $total_santos = $linha_total['total'];

        // Calcular número total de páginas
        $total_paginas = ceil($total_santos / $por_pagina);

        // Exibe a navegação de página
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';

        // Link "Anterior"
        if ($pagina_atual > 1) {
            echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_atual - 1) . '">Anterior</a></li>';
        }

        // Links de páginas
        for ($i = 1; $i <= $total_paginas; $i++) {
            echo '<li class="page-item' . ($i == $pagina_atual ? ' active' : '') . '">';
            echo '<a class="page-link" href="?pagina=' . $i . '">' . $i . '</a>';
            echo '</li>';
        }

        // Link "Próximo"
        if ($pagina_atual < $total_paginas) {
            echo '<li class="page-item"><a class="page-link" href="?pagina=' . ($pagina_atual + 1) . '">Próximo</a></li>';
        }

        echo '</ul>';
        echo '</nav>';

        mysqli_close($conexao);
        ?>
    </div>
</div>


    <footer class="footer bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date("Y"); ?> Histórias dos Santos. Todos os direitos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/index.js"></script>    
    <script>
        $(document).ready(function() {
            if (!localStorage.getItem('alerta_exibido')) {
                Swal.fire({
                    title: 'Olá! Bem-vindo às Histórias dos Santos',
                    text: 'Este site está em desenvolvimento e, por isso, ainda não possui muitas informações sobre os santos. Agradecemos pela sua paciência e compreensão. 😊',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });

                localStorage.setItem('alerta_exibido', 'true');
            }
        });
    </script>
</body>

</html>
