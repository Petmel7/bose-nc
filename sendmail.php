<?php

require 'vendor/autoload.php';

header('Content-Type: application/json');

$response = array();

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $comment = $_POST['comment'] ?? '';
    $agree = $_POST['agree'] ?? '';

    if (!empty($name) && !empty($email) && !empty($comment) && !empty($agree)) {

        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'SSL'))
            ->setUsername('olegsiuma@gmail.com')
            ->setPassword('qwtq sldb szow mpmn');

        $mailer = new Swift_Mailer($transport);

        $messageBody = 'Name: ' . $name . "\nEmail: " . $email . "\nComment: " . $comment . "\nAgree: " . $agree;

        $message = (new Swift_Message('New Form Submission'))
            ->setFrom([$email => $name])
            ->setTo(['romanbodnarr@ukr.net'])
            ->setBody($messageBody);

        $result = $mailer->send($message);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'The email has been successfully sent!';
        } else {
            $response['success'] = false;
            $response['message'] = 'Error sending the email.';
        }
    } else {
        $response['success'] = false;
        $response['message'] = 'Please fill in all the fields and select a agree.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'The request method error.';
}

echo json_encode($response);
