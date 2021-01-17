<?php

namespace App\EventSubscriber;

use App\Entity\Alert;
use App\Event\AccountActivatedEvent;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AccountNotificationSubscriber implements EventSubscriberInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AccountActivatedEvent::class => 'onUserActivation'
        ];
    }

    public function onUserActivation(AccountActivatedEvent $event)
    {
        $entityManager = $this->entityManager;
        $alert = new Alert();
        $time = new DateTime('NOW');

        $alert->setTitle('Your account has been activated');
        $alert->setType('Warning');
        $alert->setContent('Your account has been successfully activated ! Enjoy.');
        $alert->setPublishedAt($time);
        $alert->setUid(uniqid('alert'));
        $alert->setIsConsulted(false);

        $user = $event->getUser();
        $alert->setUser($user);

        $entityManager->persist($alert);
        $entityManager->flush();
    }
}
