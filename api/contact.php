<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    $to = 'idowu.s.adekale@gmail.com'; // Replace with your email address
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    $mailBody = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";

    if (mail($to, $subject, $mailBody, $headers)) {
        $response = [
            'status' => 'success',
            'message' => 'Thank you for contacting us, ' . htmlspecialchars($name) . '. We will get back to you soon.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Failed to send email. Please try again later.'
        ];
    }
} else {
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.'
    ];
}

echo json_encode($response);
