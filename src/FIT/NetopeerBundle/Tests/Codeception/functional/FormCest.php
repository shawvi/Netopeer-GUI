<?php

use FIT\NetopeerBundle\Tests\Codeception\_support\CommonScenarios;

class CreateFormCest
{
	public function _before(TestGuy $I)
	{
		$I->amOnPage('/logout');
		$I->submitForm('#login-form', array('_username' => 'admin', '_password' => 'pass'));
		$I->fillField('Host', 'localhost');
		$I->fillField('Port', '830');
		$I->fillField('User', CommonScenarios::$deviceUser);
		$I->fillField('Password', CommonScenarios::$devicePass);
		$I->click('Connect');
	}

	public function _after(TestGuy $I)
	{
		$I->amOnPage('/logout');
	}

	// tests
	public function submitCreateForm(TestGuy $I)
	{
		$I->wantTo('submit create form test');
		$I->amOnPage('/sections/0/nacm/');

		$I->canSeeInCurrentUrl('/sections/0/nacm/');

		$data['newNodeForm'] = array(
				'parent'                          => '--*?1!',
				'label0_--*?1!--*?1!'             => 'groups',
				'value0_--*?1!--*?1!'             => '',
				'label1_--*?1!--*?1!--*?1!'       => 'group',
				'value1_--*?1!--*?1!--*?1!'       => '',
				'label2_--*?1!--*?1!--*?1!--*?1!' => 'name',
				'value2_--*?1!--*?1!--*?1!--*?1!' => 'bestsupertestever',
		);
		$I->sendAjaxPostRequest('/sections/0/nacm/', $data);

		// check what is in answer
		$I->see('block--state');
		$I->see('bestsupertestever');
		$I->dontSee('500 Internal Server Error');
	}

	public function submitEditConfigForm(TestGuy $I)
	{
		$I->wantTo('submit edit config form test');
		$I->amOnPage('/sections/0/nacm/');

		$data['configDataForm'] = array(
				'enable-nacm_--*--*?1!' => 'false',
		    'write-default_--*--*?2!' => 'deny',
		);
		$I->sendAjaxPostRequest('/sections/0/nacm/', $data);

		// check what is in answer
		$I->see('block--state');
		$I->dontSee('permit');
		$I->dontSee('500 Internal Server Error');
	}

	public function submitRemoveForm(TestGuy $I)
	{
		$I->wantTo('submit delete form test');
		$I->amOnPage('/sections/0/nacm/');

		$data['removeNodeForm'] = array(
				'parent' => '--*--*?2!',
		);
		$I->sendAjaxPostRequest('/sections/0/nacm/', $data);

		// check what is in answer
		$I->see('block--state');
		$I->dontSee('write-default', '.form');
		$I->dontSee('500 Internal Server Error');
	}

	public function _submitEmptyModuleForm(TestGuy $I)
	{
		$I->wantTo('submit empty module form test');
		$I->amOnPage('/sections/create-empty-module/0/');

		// remove root element
		$data['form'] = array(
				'name' => 'notification',
		    'namespace' => 'urn:ietf:params:xml:ns:netconf:notification:1.0',
		);

		$I->submitForm('form.create-empty-module', $data);

		// check what is in answer
		$I->see('block--state');
		$I->dontSee('500 Internal Server Error');
	}
}