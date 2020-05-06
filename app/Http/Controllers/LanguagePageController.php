<?php

namespace App\Http\Controllers;


abstract class LanguagePageController extends PageController
{
	protected function before()
	{
		parent::before();

		$language = request()->route( 'language' );
		!$language OR $this->language = $language;
	}

	/**
	 * If the template is explicitly set, then it is used.
	 * Otherwise default "common" template is used.
	 * Default sub template name is a snakecased name of the class without the PageController suffix.
	 * The sub template located in the corresponding language folder of the 'page' folder of views.
	 *
	 * @throws \ReflectionException
	 */
	protected function setTemplateName()
	{
		$this->setParam('language', $this->language);
		
		if( is_null( $this->template ) ) {
			$this->template = 'page.common';
			$this->setParam('subPage', $this->language . '.' . snake_case( str_replace( 'PageController', '', $this->classShortName() )));
		}
	}
}