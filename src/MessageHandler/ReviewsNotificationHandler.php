<?php

// src/MessageHandler/ReviewNotificationHandler.php
namespace App\MessageHandler;

use App\Message\ReviewsNotification;
use App\Repository\ReviewsRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class ReviewsNotificationHandler implements MessageHandlerInterface
{
    private $mailer;
    private $reviewsRepository;
    private $adminEmail;

    public function __construct(MailerInterface $mailer, ReviewsRepository $reviewsRepository, ParameterBagInterface $params)
    {
        $this->mailer = $mailer;
        $this->reviewsRepository = $reviewsRepository;
        $this->adminEmail = $params->get('admin_email');
    }

    public function __invoke(ReviewsNotification $notification)
    {
        $review = $this->reviewsRepository->find($notification->getReviewId());

        if (!$review) {
            return;
        }

        $email = (new Email())
            ->from('no-reply@yourdomain.com')
            ->to($this->adminEmail)
            ->subject('New Review Submitted')
            ->text(sprintf('A new review has been submitted by %s: %s', $review->getUsers()->getUsername(), $review->getTextReview()));

        $this->mailer->send($email);
    }
}
