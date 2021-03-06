<?php

namespace reports\valuereports;

use BaseValueReport;
use Silex\Application;


/**
 *
 * @package Core
 * @link http://ican.openacalendar.org/ OpenACalendar Open Source Software
 * @license http://ican.openacalendar.org/license.html 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 * @author James Baster <james@jarofgreen.co.uk>
 */
class VenuesEditedReport extends BaseValueReport {

    function __construct(Application $app)
    {
        parent::__construct($app);
		$this->hasFilterTime = true;
	}

	public function getExtensionID() { return 'org.openacalendar'; }

	public function getReportTitle()
	{
		return "Venues Edited";
	}

	public function getReportID()
	{
		return "VenuesEdited";
	}

	public function run()
	{


		$where = array();
		$params = array();

		if ($this->filterTimeStart) {
			$where[] = " venue_history.created_at >= :start_at ";
			$params['start_at'] = $this->filterTimeStart->format("Y-m-d H:i:s");
		}


		if ($this->filterTimeEnd) {
			$where[] = " venue_history.created_at <= :end_at ";
			$params['end_at'] = $this->filterTimeEnd->format("Y-m-d H:i:s");
		}

		$sql = "SELECT COUNT(*) AS count  ".
			" FROM venue_history ".
			($where ? " WHERE " . implode(" AND ",$where) : "");

		$stat = $this->app['db']->prepare($sql);
		$stat->execute($params);
		$data = $stat->fetch();
		$this->data = $data['count'];

	}

}
