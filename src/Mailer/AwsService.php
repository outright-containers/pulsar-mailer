<?php namespace Pulsar\Mailer;

use Aws\SesV2\SesV2Client;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Pulsar\Mailer\Configurations\MailerAwsConfiguration;
use Zephyrus\Core\Mailer\MailerService;
use Zephyrus\Exceptions\Mailer\MailerException;

class AwsService implements MailerService
{
    public const NAME = "aws";
    private ?SesV2Client $amazonSimpleEmailService = null;
    private MailerAwsConfiguration $configuration;

    public function __construct(MailerAwsConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function initialize(PHPMailer $phpMailer): void
    {
        $this->amazonSimpleEmailService = new SesV2Client([
            'region' => $this->configuration->getRegion(),
            'version'  => $this->configuration->getVersion(),
            'credentials' => [
                'key' => $this->configuration->getKey(),
                'secret' => $this->configuration->getSecret()
            ]
        ]);
    }

    public function send(PHPMailer $phpMailer, bool $asHtml = true): string
    {
        $phpMailer->IsHTML($asHtml);
        try {
            $phpMailer->preSend();
            $rawMimeMessage = $phpMailer->getSentMIMEMessage();
            $this->amazonSimpleEmailService->sendEmail([
                "Content" => [
                    "Raw" => [
                        "Data" => $rawMimeMessage
                    ]
                ]
            ]);
            return $rawMimeMessage;
        } catch (Exception $exception) {
            throw new MailerException($exception->getMessage());
        }
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
