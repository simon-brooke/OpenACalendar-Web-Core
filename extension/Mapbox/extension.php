<?php

/**
 *
 * @package org.openacalendar.mapbox
 * @link http://ican.openacalendar.org/ OpenACalendar Open Source Software
 * @license http://ican.openacalendar.org/license.html 3-clause BSD
 * @copyright (c) JMB Technology Limited, http://jmbtechnology.co.uk/
 */



$app['extensions']->addExtension(__DIR__, new org\openacalendar\mapbox\Extension($app));

