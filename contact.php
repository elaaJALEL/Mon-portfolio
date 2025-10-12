<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et sécurisation des données
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);
    
    // Validation
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez compléter le formulaire correctement.";
        exit;
    }
    
    // Configuration de l'email
    $to = "ala.jalel@viacesi.fr";
    $email_subject = "Nouveau message de portfolio: $subject";
    $email_body = "Vous avez reçu un nouveau message depuis votre portfolio.\n\n";
    $email_body .= "Nom: $name\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Sujet: $subject\n\n";
    $email_body .= "Message:\n$message\n";
    
    // En-têtes
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    
    // Envoi
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<script>alert('Merci ! Votre message a été envoyé.'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Erreur lors de l\\'envoi du message.'); window.history.back();</script>";
    }
}
?>