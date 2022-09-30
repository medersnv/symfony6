<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class Converter
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Converter constructor
     */
    public function __construct( LoggerInterface $logger, $userEmail){
        $this->logger = $logger;
        $this->userEmail = $userEmail;
    }

    public function CovertSomToDollar($som){
        dump($this->userEmail);
        $this->logger->info('Все правильно');
        return $som / 83;
    }
}