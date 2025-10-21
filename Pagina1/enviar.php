<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $destinatario = "bwdesign.contato@gmail.com";
    
    $assunto = "Novo Lead da Página o Grande Plano"; 
    


    $email_lead = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    

    $name_lead = strip_tags($_POST["name"]);
    $phone_lead = strip_tags($_POST["phone"]);

    $mensagem = "Um novo lead se cadastrou na sua página da !\n\n";
    $mensagem .= "Nome: " . $name_lead . "\n";
    $mensagem .= "E-mail: " . $email_lead . "\n";
    $mensagem .= "Telefone: " . $phone_lead . "\n";

 
    $reply_to_email = str_replace(["\r", "\n"], '', $email_lead);

    $headers = "From: nao-responda@seusite.com\r\n" .
               "Reply-To: " . $reply_to_email . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n" . 
               "X-Mailer: PHP/" . phpversion();

    // --- Envio e Resposta para o JavaScript ---
    if (mail($destinatario, $assunto, $mensagem, $headers)) {
        
        echo "success";
    } else {
        0
        echo "error_mail"; // Envia uma mensagem de erro
    }
} else {
    // Acesso negado
    http_response_code(405); 
    echo "error_method";
}
?>