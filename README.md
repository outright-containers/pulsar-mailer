# Pulsar Forms

## Abstract
Framework extension which provides the basis for email templating and sending with AWS.

## Installation

### Composer dependency
The first step is to include the PHP composer dependency in the project. If the 
library is private, be sure to include the repository.

```json
"repositories": [
    {
      "type": "vcs",
      "url":  "https://github.com/ophelios-studio/pulsar-mailer.git"
    }
]
```

```json
"require": {
    "ophelios/pulsar-mailer": "dev-main"
}
```

Once it's done, update the project's dependencies. Should download and place the necessary 
files into the project with the standard Publisher class.

```shell
composer update
```

### Configurations
This library requires adding properties to the project's configurations to identify the AWS credentials. First, add in 
the `.env` file the following constants.

```dotenv
# AWS user configuration key
AWS_KEY="<YOUR_KEY>"
AWS_SECRET="<YOUR_SECRET>"
```

Then, add the following into the `config.yml` file.

```yml
mailer:
  transport: !php/const MAILER_TRANSPORT
  default_from_address: "info@ophelios.com"
  default_from_name: "Ophelios"
  aws:
    api_key: !php/const AWS_KEY
    api_secret: !php/const AWS_SECRET
  smtp:
    host: !php/const MAILER_SMTP_HOST
    port: !php/const MAILER_SMTP_PORT
    encryption: !php/const MAILER_SMTP_ENCRYPTION
    username: !php/const MAILER_SMTP_USERNAME
    password: !php/const MAILER_SMTP_PASSWORD
```
