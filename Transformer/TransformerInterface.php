<?php
namespace Rezzza\MailExtraBundle\Transformer;

interface TransformerInterface
{
    /**
     * @return void
     */
    public function setOptions(array $options);
    /**
     * @return boolean
     */
    public function supports(\Swift_Mime_Message $message);
    /**
     * @return void
     */
    public function transform(\Swift_Mime_Message $message);
}
