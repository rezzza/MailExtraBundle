<?php

namespace Rezzza\MailExtraBundle\Transformer;

use Symfony\Component\Process\Process;

/**
 * PictureEmbedTransformer
 *
 * @uses AbstractTransformer
 * @uses TransformerInterface
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class PictureEmbedTransformer extends AbstractTransformer implements TransformerInterface
{
	/**
	 * {@inheritdoc)
	 */
	public function transform(\Swift_Mime_Message $message)
	{
		$body = $message->getBody();

        $body = preg_replace_callback('/src="([^"]*)"/',
            function($matches) use ($message) {
                $imagePath = $matches[1];

				if($fp = fopen($imagePath, "r" )) {
					$imagePath = $message->embed(\Swift_Image::fromPath($imagePath));
					fclose($fp);
				}

				return sprintf('src="%s"', $imagePath);
		}, $body);

        $message->setBody($body, 'text/html');
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
