<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController
{
    /**
     * @Route("/login/success")
     * @param TexterInterface $texter
     */
public function loginSuccess(TexterInterface $texter)
{
$sms = new SmsMessage(
// the phone number to send the SMS message to
'+212770444209',
// the message
'test'
);

$texter->send($sms);

// ...
}
}

