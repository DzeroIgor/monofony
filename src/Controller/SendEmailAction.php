<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SendEmailAction
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }

    public function __invoke(Request $request, string $message): Response
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to('you@example.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html("<p>See Twig integration for better HTML integration! {$message}</p>");

        $this->mailer->send($email);

        return new Response('trimis!!');
    }
}