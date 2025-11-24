<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/PHPMailer/src/PHPMailer.php';
require __DIR__ . '/PHPMailer/src/SMTP.php';
require __DIR__ . '/PHPMailer/src/Exception.php';

function sendOrderEmail($toEmail, $toName, $orderId, $total)
{
    $mail = new PHPMailer(true);

    try {
        // SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ioanamadaras2000@gmail.com';
        $mail->Password   = 'qire eank opmw wlnj';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

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


