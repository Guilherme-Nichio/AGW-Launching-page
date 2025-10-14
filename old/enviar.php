<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ***** MUITO IMPORTANTE: MUDE A LINHA ABAIXO! *****
    // Coloque aqui o seu e-mail, para onde os leads serão enviados.
    $destinatario = "seu-email-de-verdade@gmail.com";
    
    // Pega o e-mail que a pessoa digitou no formulário
    $email_lead = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    
    // Assunto do e-mail que você vai receber
    $assunto = "Novo Lead da Pagina Black RID";

    // Corpo do e-mail que você vai receber
    $mensagem = "Um novo lead se cadastrou na sua pagina de captura!\n\n";
    $mensagem .= "E-mail do Lead: " . $email_lead;

    // Cabeçalhos do e-mail (ajuda a não cair no spam)
    $headers = "From: nao-responda@seusite.com" . "\r\n" .
               "Reply-To: " . $email_lead . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Tenta enviar o e-mail
    if (mail($destinatario, $assunto, $mensagem, $headers)) {
        // Se o envio funcionar, redireciona o usuário para a página de obrigado
        header("Location: obrigado.html");
        exit();
    } else {
        // Se der algum erro no servidor, exibe uma mensagem
        echo "Houve um erro ao enviar o seu e-mail. Por favor, tente novamente.";
    }

} else {
    // Se alguém tentar acessar o arquivo diretamente pelo navegador
    echo "Acesso nao permitido.";
}
?>