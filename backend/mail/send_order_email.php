<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

function sendOrderEmail($toEmail, $toName, $orderId, $total)
{
    $mail = new PHPMailer(true); //TRUE activează excepțiile

    try {
        // configurare SMTP
        $mail->isSMTP(); // Setează mailer-ul să folosească SMTP
        $mail->Host       = 'smtp.gmail.com'; // Setează serverul SMTP
        $mail->SMTPAuth   = true; // Activează autentificarea SMTP
        $mail->Username   = 'ioanamadaras2000@gmail.com'; // Numele de utilizator SMTP
        $mail->Password   = 'qire eank opmw wlnj'; // Parola SMTP
        $mail->SMTPSecure = 'tls'; // Criptare TLS
        $mail->Port       = 587; // Portul SMTP

        //setări email
        // Expeditor
        $mail->setFrom('ioanamadaras2000@gmail.com', 'Fashion Store');
        // Destinatar
        $mail->addAddress($toEmail, $toName);
        // Conținut
        $mail->isHTML(true);
        $mail->Subject = "Confirmare comanda #$orderId";
        $mail->Body    = "
            <h2>Mulțumim pentru comandă!</h2>
            <p>Comanda ta #<strong>$orderId</strong> a fost înregistrată.</p>
            <p>Total: <strong>$total lei</strong></p>
            <p>Te vom contacta în curând cu detalii despre livrare.</p>
        ";

        $mail->send();
    } catch (Exception $e) {
        // IMPORTANT: NU oprim procesarea comenzii dacă emailul nu merge
    }
}


