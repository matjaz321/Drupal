<?php
use Symfony\Component\HttpFoundation\Request;
namespace Drupal\ad_general\Controller;

use Drupal\Core\Controller\ControllerBase;

class TestingHelloController extends ControllerBase
{
	/**
	 * Display the markup.
	 *
	 * @return array
	 */
	public function content()
	{
		return array(
			'#type' => 'markup',
			'#markup' => $this->t('Hello, World!'),
		);
	}
}