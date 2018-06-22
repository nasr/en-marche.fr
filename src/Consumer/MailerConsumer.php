<?php

namespace AppBundle\Consumer;

use AppBundle\Mailer\MailerService;
use AppBundle\Mailer\Message\Message;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\NotBlank;

class MailerConsumer extends AbstractConsumer
{
    /**
     * @var MailerService
     */
    private $mailerService;

    public function setMailerService(MailerService $mailerService): void
    {
        $this->mailerService = $mailerService;
    }

    protected function configureDataConstraints(): array
    {
        return [
            'fromName' => [new NotBlank()],
            'fromEmail' => [new NotBlank()],
            'subject' => [new NotBlank()],
            'templateKey' => [new NotBlank()],
            'recipients' => [new Count(['min' => 1])],
        ];
    }

    protected function isExtraFieldsAllowed(): bool
    {
        return true;
    }

    protected function doExecute(array $data): int
    {
        $firstRecipient = array_pop($data['recipients']);

        $message = new Message(
            Uuid::uuid4(),
            $firstRecipient['email'],
            $firstRecipient['name'],
            $data['templateVars'] ?? [],
            $firstRecipient['templateVars'] ?? [],
            $firstRecipient['replyTo'] ?? null
        );

        // Template id provided by mailjet, not needed anymore for MailerConsumerV2 as we get the message class from templateKey
        $message->setTemplate($data['templateKey']);

        $message->setApp($data['app'] ?? 'Unknown');
        $message->setSubject($data['subject']);
        $message->setSenderEmail($data['fromEmail']);
        $message->setSenderName($data['fromName']);

        $this->mailerService->sendMessage($message);

        return ConsumerInterface::MSG_ACK;
    }
}
