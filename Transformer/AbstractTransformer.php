<?php

namespace Rezzza\MailExtraBundle\Transformer;

/**
 * AbstractTransformer
 *
 * @author Stephane PY <py.stephane1@gmail.com>
 */
class AbstractTransformer
{
	/**
	 * @var array
	 */
	protected $options = array();

	/**
	 * @param array $options options
	 */
	public function setOptions(array $options)
	{
		$this->options = array_merge($options, $this->options);
	}
}
