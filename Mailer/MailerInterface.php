<?php

namespace Rezzza\MailExtraBundle\Mailer;

use Rezzza\MailExtraBundle\Transformer\Processor;


/**
 * MailerInterface
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
interface MailerInterface
{
	/**
	 * @param Processor $transformerProcessor transformerProcessor
	 */
	public function setTransformerProcessor(Processor $transformerProcessor);
}
