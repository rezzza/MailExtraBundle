<?php

namespace Rezzza\MailExtraBundle\Transformer;

/**
 * Processor
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Processor
{
    /**
     * @var array
     */
    protected $transformers = array();

    /**
     * @var array
     */
    protected $activatedTransformers = array();

    /**
     * @param string               $ident       ident
     * @param TransformerInterface $transformer transformer
     */
    public function add($ident, TransformerInterface $transformer)
    {
        $this->transformers[$ident] = $transformer;
    }

    /**
     * @param string $ident ident
     */
    public function activate($ident)
    {
        if (isset($this->transformers[$ident])) {
            $this->activatedTransformers[$ident] = $ident;
        }
    }

    /**
     * @param string $ident ident
     */
    public function deactivate($ident)
    {
        if (array_key_exists($ident, $this->activatedTransformers)) {
            unset($this->activatedTransformers[$ident]);
        }
    }

    /**
     * @param \Swift_Message $message message
     */
    public function process(\Swift_Mime_Message $message)
    {
        foreach ($this->activatedTransformers as $activatedTransformer) {
            $transformer = $this->transformers[$activatedTransformer];

            if ($transformer->supports($message)) {
                $transformer->transform($message);
            }
        }
    }
}
