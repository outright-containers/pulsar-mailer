<?php namespace Pulsar\Mailer\Configurations;

use Pulsar\Mailer\AwsService;
use Zephyrus\Core\Configuration\Mailer\MailerSmtpConfiguration;
use Zephyrus\Core\Mailer\MailerService;

class MailerConfiguration extends \Zephyrus\Core\Configuration\Mailer\MailerConfiguration
{
    public const array DEFAULT_CONFIGURATIONS = [
        'transport' => 'smtp',
        'default_from_address' => null, // Address FROM which the emails are sent
        'default_from_name' => null, // Name associated with the FROM address
        'smtp' => MailerSmtpConfiguration::DEFAULT_CONFIGURATIONS,
        'aws' => MailerAwsConfiguration::DEFAULT_CONFIGURATIONS
    ];
    private ?MailerAwsConfiguration $awsConfiguration = null;

    public function __construct(array $configurations = self::DEFAULT_CONFIGURATIONS)
    {
        parent::__construct($configurations);
        $this->initializeAwsConfigurations();
    }

    public function buildService(): ?MailerService
    {
        $service = parent::buildService();
        if (is_null($service)) {
            if ($this->getTransport() == AwsService::NAME) {
                return new AwsService($this->awsConfiguration);
            }
        }
        return $service;
    }

    public function getAwsConfiguration(): ?MailerAwsConfiguration
    {
        return $this->awsConfiguration;
    }

    private function initializeAwsConfigurations(): void
    {
        $this->awsConfiguration = new MailerAwsConfiguration($this->configurations['aws']
            ?? self::DEFAULT_CONFIGURATIONS['aws']);
    }
}
