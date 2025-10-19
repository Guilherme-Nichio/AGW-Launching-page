<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinatario = "guilhermenicchio.co@gmail.com";
    $email_lead = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $name_lead = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $phone_lead = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);

    $assunto = "Novo Lead da Página o Grande Plano";
    $mensagem = "Um novo lead se cadastrou na sua página!\n\n";
    $mensagem .= "Nome: " . $name_lead . "\n";
    $mensagem .= "E-mail: " . $email_lead . "\n";
    $mensagem .= "Telefone: " . $phone_lead . "\n";

    $headers = "From: nao-responda@seusite.com\r\n" .
               "Reply-To: " . $email_lead . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    if (mail($destinatario, $assunto, $mensagem, $headers)) {
        echo "success"; // mensagem de sucesso para o JS
    } else {
        http_response_code(500);
        echo "error";   // mensagem de erro para o JS
    }
} else {
    echo "Acesso não permitido.";
}
?>
