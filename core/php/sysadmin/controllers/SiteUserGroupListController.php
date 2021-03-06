<?php

namespace sysadmin\controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use repositories\SiteRepository;
use repositories\builders\UserGroupRepositoryBuilder;

/**
 *
 * @package Core
 * @link http://ican.openacalendar.org/ OpenACalendar Open Source Software
 * @license http://ican.openacalendar.org/license.html 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class SiteUserGroupListController {


	function index($siteid, Request $request, Application $app) {


		$sr = new SiteRepository($app);
		$site = $sr->loadById($siteid);

		if (!$site) {
			die("404");
		}


		$ugrb = new UserGroupRepositoryBuilder($app);
		$ugrb->setSite($site);
		$userGroups = $ugrb->fetchAll();

		return $app['twig']->render('sysadmin/siteusergrouplist/index.html.twig', array(
				'usergroups'=>$userGroups,
				'site'=>$site,
			));

	}


}


