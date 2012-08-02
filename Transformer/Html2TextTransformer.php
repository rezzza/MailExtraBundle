<?php

namespace Rezzza\MailExtraBundle\Transformer;

use Symfony\Component\Process\Process;

/**
 * Html2TextTransformer
 *
 * @uses AbstractTransformer
 * @uses TransformerInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class Html2TextTransformer extends AbstractTransformer implements TransformerInterface
{
	/**
	 * Initialize default options
	 */
	public function __construct()
	{
		$this->options = array(
			'bin' => '/usr/local/bin/html2text',
		);
	}

	/**
	 * {@inheritdoc)
	 */
	public function transform(\Swift_Mime_Message $message)
	{
		$processor = new Process('ls');
		$processor->run();
		//@todo
		exit('@todo');
	}

	/**
	 * {@inheritdoc)
	 */
	public function supports(\Swift_Mime_Message $message)
	{
		// why multipart/mixed, because if you attach a file, it'll be the contentType
		// So be careful to not use this transformer if you don't use text/html and attach a file
		return in_array($message->getContentType(), array('multipart/mixed', 'text/html'));
	}
}
