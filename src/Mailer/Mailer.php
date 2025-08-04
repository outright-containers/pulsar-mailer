<?php namespace Pulsar\Mailer;

use Pulsar\Mailer\Configurations\MailerConfiguration;
use Zephyrus\Core\Application;
use Zephyrus\Core\Configuration;
use Zephyrus\Core\Configuration\LocalizationConfiguration;

class Mailer extends \Zephyrus\Core\Mailer\Mailer
{
    public function __construct(?array $configurations = null)
    {
        $configurations = new MailerConfiguration($configurations
            ?? Configuration::read('mailer'));
        parent::__construct($configurations);
    }

    public function setTemplate(string $template, array $data = [], ?string $locale = null): void
    {
        $localization = Application::getInstance()->getLocalization();
        $originalLocale = $localization->getLocale();
        if (!is_null($locale)) {
            $localization->changeLanguage(new LocalizationConfiguration(['locale' => $locale]));
        }
        $baseUrl = Application::getInstance()->getRequest()->getUrl()->getBaseUrl();
        parent::setTemplate($template, array_merge([
            'base_url' => $baseUrl,
            'version' => Application::getInstance()->getVersion(),
            'project' => Configuration::getApplication('project')
        ], $data));
        if (!is_null($locale)) {
            $localization->changeLanguage(new LocalizationConfiguration(['locale' => $originalLocale]));
        }
    }

    public function send(bool $asHtml = true): string
    {
        $rawMimeMessage = parent::send($asHtml);
//        Logger::system("logs.events.email_sent")
//            ->addArgument('email', implode(", ", array_keys($this->getPhpMailer()->getAllRecipientAddresses())))
//            ->log();
        return $rawMimeMessage;
    }
}
