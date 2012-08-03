<?php

namespace Rezzza\MailExtraBundle\Mailer;

use Rezzza\MailExtraBundle\Transformer\Processor;

/**
 * Mailer
 *
 * @uses MailerInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Mailer extends \Swift_Mailer implements MailerInterface
{
    /**
     * @var Processor
     */
    protected $Processor;

    /**
     * {@inheritdoc}
     */
    public function setTransformerProcessor(Processor $transformerProcessor)
    {
        $this->transformerProcessor = $transformerProcessor;
    }

    /**
     * @param string $ident ident of the transformer
     */
    public function activateTransformer($ident)
    {
        $this->transformerProcessor->activate($ident);
    }

    /**
     * {@inheritdoc}
     *
     * Use transformers defined on transformer processor
     */
    public function send(\Swift_Mime_Message $message, &$failedRecipients = null)
    {
        $this->transformerProcessor->process($message);

        return parent::send($message, $failedRecipients);
    }
}
