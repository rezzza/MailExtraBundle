<?php
namespace Rezzza\MailExtraBundle\Transformer;

interface TransformerInterface
{
    public function setOptions(array $options);
    public function supports(\Swift_Mime_Message $message);
    public function transform(\Swift_Mime_Message $message);
}
