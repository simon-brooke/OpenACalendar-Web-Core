<?php

namespace repositories;

use models\API2ApplicationModel;
use models\UserAccountModel;

/**
 *
 * @package Core
 * @link http://ican.openacalendar.org/ OpenACalendar Open Source Software
 * @license http://ican.openacalendar.org/license.html 3-clause BSD
 * @copyright (c) 2013-2014, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class API2ApplicationRepository {

	
	/**
	 * 
	 * @return \models\API2ApplicationModel
	 */
	public function create(UserAccountModel $user, $title) {
		global $DB;
		
		$app = new API2ApplicationModel();
		$app->setTitle($title);
		$app->setAppSecret(createKey(1,255));
		$app->setAppToken(createKey(1,255));
				
		$stat = $DB->prepare("INSERT INTO  api2_application_information (user_id,title,app_token,app_secret,created_at) ".
				"VALUES (:user_id,:title,:app_token,:app_secret,:created_at) RETURNING id");
		$stat->execute(array( 
				'user_id'=>$user->getId(),
				'title'=>$title,
				'app_token'=>$app->getAppToken(),
				'app_secret'=>$app->getAppSecret(),
				'created_at'=>  \TimeSource::getFormattedForDataBase(),
			));
		$data = $stat->fetch();
		$app->setId($data['id']);
		
		return $app;
		
	}
	
	/** 
	 * 
	 * @return \models\API2ApplicationModel
	 */
	public function loadById($id) {
		global $DB;
		$stat = $DB->prepare("SELECT api2_application_information.* FROM api2_application_information WHERE id = :id");
		$stat->execute(array( 'id'=>$id ));
		if ($stat->rowCount() > 0) {
			$app = new API2ApplicationModel();
			$app->setFromDataBaseRow($stat->fetch());
			return $app;
		}
	}
	
	/** 
	 * 
	 * @return \models\API2ApplicationModel
	 */
	public function loadByAppTokenAndAppSecret($token, $secret) {
		global $DB;
		$stat = $DB->prepare("SELECT api2_application_information.* FROM api2_application_information WHERE app_token =:app_token AND app_secret =:app_secret");
		$stat->execute(array( 'app_token'=>$token, 'app_secret'=>$secret ));
		if ($stat->rowCount() > 0) {
			$app = new API2ApplicationModel();
			$app->setFromDataBaseRow($stat->fetch());
			return $app;
		}
	}
	

	/** 
	 * 
	 * @return \models\API2ApplicationModel
	 */
	public function loadByAppToken($token) {
		global $DB;
		$stat = $DB->prepare("SELECT api2_application_information.* FROM api2_application_information WHERE app_token =:app_token");
		$stat->execute(array( 'app_token'=>$token ));
		if ($stat->rowCount() > 0) {
			$app = new API2ApplicationModel();
			$app->setFromDataBaseRow($stat->fetch());
			return $app;
		}
	}
		
	
}
