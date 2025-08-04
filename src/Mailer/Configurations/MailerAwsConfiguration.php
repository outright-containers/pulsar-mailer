<?php namespace Pulsar\Mailer\Configurations;

class MailerAwsConfiguration
{
    public const array DEFAULT_CONFIGURATIONS = [
        'region' => 'us-east-1',
        'version' => 'latest',
        'api_key' => '', // Key for the Amazon service
        'api_secret' => '' // Secret associated with the key
    ];

    private array $configurations;
    private string $region;
    private string $version;
    private string $key;
    private string $secret;

    public function __construct(array $configurations = self::DEFAULT_CONFIGURATIONS)
    {
        $this->initializeConfigurations($configurations);
        $this->initializeAuthentication();
        $this->initializeRegion();
        $this->initializeVersion();
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getRegion(): string
    {
        return $this->region;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    private function initializeConfigurations(array $configurations): void
    {
        $this->configurations = $configurations;
    }

    private function initializeAuthentication(): void
    {
        $this->key = $this->configurations['api_key']
            ?? self::DEFAULT_CONFIGURATIONS['api_key'];
        $this->secret = $this->configurations['api_secret']
            ?? self::DEFAULT_CONFIGURATIONS['api_secret'];
    }

    private function initializeRegion(): void
    {
        $this->region = $this->configurations['region']
            ?? self::DEFAULT_CONFIGURATIONS['region'];
    }

    private function initializeVersion(): void
    {
        $this->version = $this->configurations['version']
            ?? self::DEFAULT_CONFIGURATIONS['version'];
    }
}
