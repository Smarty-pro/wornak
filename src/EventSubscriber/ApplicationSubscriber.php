<?php

namespace App\EventSubscriber;

use App\Entity\Alert;
use App\Event\ApplicationEvent;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ApplicationSubscriber implements EventSubscriberInterface
{
    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ApplicationEvent::class => 'onApplicationNew',
        ];
    }

    public function onApplicationNew(ApplicationEvent $event)
    {
        $entityManager = $this->entityManager;
        $alert = new Alert();
        $time = new DateTime('NOW');


        $alert->setTitle('A job seeker applied to your offer');
        $alert->setType('Warning');
        $alert->setPublishedAt($time);
        $alert->setContent('A job seeker applied to your offer'); //TODO
        $alert->setUid(uniqid("alert"));
        $alert->setIsConsulted(false);

        $user = $event->getUser();
        $alert->setUser($user);

        $entityManager->persist($alert);
        $entityManager->flush();
    }
}
