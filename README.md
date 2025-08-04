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
