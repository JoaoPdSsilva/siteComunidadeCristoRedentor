<?php 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $NOME = htmlspecialchars((trim($_POST["nome"])));
    $EMAIL = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $MENSAGEM = htmlspecialchars((trim($_POST["mensagem"])));


    if(empty($NOME) || !$EMAIL || empty($MENSAGEM)) {
        http_response_code(400);
        echo "Preencha todos os campos corretamente.";
        exit();
    }

    $destinatario = "joaopedro@historiadesantos.site";
    $assunto = "Novo contato do site - Histórias dos Santos";
    
    $corpo = "Nome: $NOME\n";
    $corpo .="Email: $EMAIL\n\n";
    $corpo .= "Mensagem:\n$MENSAGEM\n";

    $headers = "From: $EMAIL\r\n";
    $headers .= "Reply-To: $EMAIL\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($destinatario, $assunto, $corpo, $headers)) {
        http_response_code(200);
        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(500);
        echo "Erro ao enviar mensagem.";
    }
} else {
    http_response_code(403);
    echo "Acesso negado.";
}

?>
