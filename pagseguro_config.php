<?php

/**
 * 2007-2016 [PagSeguro Internet Ltda.]
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @author    PagSeguro Internet Ltda.
 * @copyright 2007-2016 PagSeguro Internet Ltda.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 *
 */
require_once "vendor/autoload.php";
require_once 'config/config.php';
try {
	\PagSeguro\Library::initialize();
	\PagSeguro\Library::cmsVersion()->setName("Nome")->setRelease("1.0.0");
	\PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

	if ($config['pagseguro']['testing'] === true) {
		\PagSeguro\Configuration\Configure::setEnvironment('sandbox'); //production or sandbox
		\PagSeguro\Configuration\Configure::setAccountCredentials(
			$config['pagseguro']['email'],
			$config['pagseguro']['tokentest']
		);
	} else {
		\PagSeguro\Configuration\Configure::setEnvironment('production'); //production or sandbox
		\PagSeguro\Configuration\Configure::setAccountCredentials(
			$config['pagseguro']['email'],
			$config['pagseguro']['token']
		);
	}

	\PagSeguro\Configuration\Configure::setCharset('UTF-8'); // UTF-8 or ISO-8859-1
	\PagSeguro\Configuration\Configure::setLog(true, '/logs/pagseguro.log');
	try {
		$sessionCode = \PagSeguro\Services\Session::create(
			\PagSeguro\Configuration\Configure::getAccountCredentials()
		);
	} catch (Exception $e) {
		die($e->getMessage());
	}
} catch (Exception $e) {
	die($e->getMessage());
}
