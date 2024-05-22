<?php

namespace App\Message;

final class ReviewsNotification
{
    private $reviewId;

    public function __construct(int $reviewId)
    {
        $this->reviewId = $reviewId;
    }

    public function getReviewId(): int
    {
        return $this->reviewId;
    }
}
