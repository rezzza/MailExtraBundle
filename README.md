MailExtraBundle
===============

# Transformers:

## html2text (WIP)

## picture_embed

Transform your `<img src="path" />` by a attached file on the mail.

# Full configuration reference:

```
rezzza_mail_extra:
    mailer_class: Rezzza\MailExtraBundle\Mailer\Mailer
    transformers: # list of transformers
        html2text:
            id:         rezzza.transformer.html2text # service identifier
            default:    false # is used by default on each mail
            options:    # some options
                binary: /usr/local/bin/html2text
        picture_embed:
            id:         rezzza.transformer.picture_embed
```
