<?php

namespace usernotifications;

use models\UserAccountModel;
use models\SiteModel;

/**
 *
 * @package Core
 * @link http://ican.openacalendar.org/ OpenACalendar Open Source Software
 * @license http://ican.openacalendar.org/license.html 3-clause BSD
 * @copyright (c) 2013-2014, JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class UpcomingEventsUserNotificationType extends \BaseUserNotificationType {
		
		public function getNewNotification(UserAccountModel $user, SiteModel $site=null,  $toEmail=false) {
			$r =  new UpcomingEventsUserNotificationModel();
			$r->setUserSiteAndIsEmail($user->getId(), ($site?$site->getId():null), $toEmail);
			return $r;
		}
	
}

