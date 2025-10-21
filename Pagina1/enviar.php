<?php
// Garante que nenhum HTML, espaço ou linha em branco seja enviado antes do PHP
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $destinatario = "suporte@agbwdesign.com.br";
    
    // Você mencionou "O Grande Plano" em conversas anteriores,
    // então estou mantendo o assunto que você definiu.
    $assunto = "Novo Lead da Página o Grande Plano"; 
    
    // --- Melhorias na Sanitização ---
    
    // FILTER_SANITIZE_EMAIL está correto.
    $email_lead = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    
    // ATENÇÃO: FILTER_SANITIZE_STRING está obsoleto (deprecated) desde o PHP 8.1
    // É melhor usar strip_tags() para remover HTML e garantir texto puro.
    $name_lead = strip_tags($_POST["name"]);
    $phone_lead = strip_tags($_POST["phone"]);

    // --- Conteúdo do E-mail ---
    $mensagem = "Um novo lead se cadastrou na sua página!\n\n";
    $mensagem .= "Nome: " . $name_lead . "\n";
    $mensagem .= "E-mail: " . $email_lead . "\n";
    $mensagem .= "Telefone: " . $phone_lead . "\n";

    // --- Correção de Segurança (Email Header Injection) ---
    // Limpa o $email_lead de quaisquer quebras de linha antes de usá-lo no header.
    // Isso impede que alguém insira campos extras (como Bcc:) no e-mail.
    $reply_to_email = str_replace(["\r", "\n"], '', $email_lead);

    $headers = "From: nao-responda@seusite.com\r\n" .
               "Reply-To: " . $reply_to_email . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n" . // Garante acentuação correta
               "X-Mailer: PHP/" . phpversion();

    // --- Envio e Resposta para o JavaScript ---
    if (mail($destinatario, $assunto, $mensagem, $headers)) {
        // SUCESSO: Envie uma resposta simples de sucesso.
        echo "success";
    } else {
        // ERRO: Informa o JavaScript que o envio falhou.
        http_response_code(500); // Envia um código de erro 500
        echo "error_mail"; // Envia uma mensagem de erro
    }
} else {
    // Acesso negado
    http_response_code(405); // 405 Method Not Allowed (Método não permitido)
    echo "error_method";
}
?>