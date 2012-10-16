MailExtraBundle
===============

Add transformer to your mail before sending it.

Transformers already added:

## html2text

Needs binary `html2text`
Install: `brew install html2text`

This transformer will create a text/plain verion of your HTML message and add it as part.

## PictureEmbed

This transformer will look at picture on your html email and add pictures in embed of mail.

## Add your transformer

Add it to the `config.yml`

```yaml
rezzza_mail_extra:
    transformers:
        mytransforrmer:
            id:         service_id
            options:    [] # some options

```

Your service_id should implements `TransformerInterface`, example:

```php
<?php

namespace MyNamespace\Transformer;

use Rezzza\MailExtraBundle\Transformer\AbstractTransformer;
use Rezzza\MailExtraBundle\Transformer\TransformerInterface;

class MyTransfrormer extends AbstractTransformer implements TransformerInterface
{
    /**
     * {@inheritdoc)
     */
    public function transform(\Swift_Mime_Message $message)
    {
        // transform message
    }

    /**
     * {@inheritdoc)
     */
    public function supports(\Swift_Mime_Message $message)
    {
        return true; // if the message is supported by this transformer ?
    }

}
```

## Activate transformers

You can activate by default a transformer by use the `default` key on config.

Else, on the mailer, use:

```php
<?php
$transformerProcessor = $this->get('rezzza.transformer.processor'); // or replace by direct definition
$transformerProcessor->activate('my_transformer'); // activate
$transformerProcessor->deactivate('my_transformer'); // deactivate
```

# Full configuration reference:

```yaml
rezzza_mail_extra:
    mailer_class: Rezzza\MailExtraBundle\Mailer\Mailer
    transformers: # list of transformers
        html2text:
            id:         rezzza.transformer.html2text # service identifier
            default:    false # is used by default on each mail
            enabled:    true # can be disabled for tests for example.
            options:    # some options
                binary: /usr/local/bin/html2text
        picture_embed:
            id:         rezzza.transformer.picture_embed
```

If you have any questions or improvements, create an issue or contact us.
