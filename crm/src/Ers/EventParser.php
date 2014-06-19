<?php

namespace Ers;

use Crm\Logic\Client\Register;

use Crm\Logic\Logic;
use Crm\Model\User\User;
use Crm\Model\Statistic\Event\LoginEvent;
use Crm\Logic\Client\Vote;
use Crm\Logic\Client\Auth;

/**
 * Класс содержащий формат представления строки в логе событий
 * Так же содержит массив сокращений названий событий и их аргументов
 * Предназначен для уменьшения потребляемого дискового пространства
 */
class EventParser {

    const _DATE = 'd';
    const _PROJECT = 'pr';
    const _EVENT = 'e';
    const _USER_ID = 'ui';
    const _PARAMS = 'pa';

    /**
     * Темплейт строки лога
     * @var string
     */
    private static $_log_template = "%date%;%project%;%user_agent%;%os_client%;%ip_client%;%referer%;%page_url%;%utm_source%;%session_referer%;%sess_id%;%user_id%;%event%;%params%;%guest_id%;%country_code%;%region_code%;%city%;%use_js%";

    /**
     * Назначение альясов для строк часто повторяющихся в логе
     */
    private static $_translation = array(
        self::_PROJECT => array(
            'default' => '0',
        ),
        self::_EVENT => array(
            Vote::EVENT_ADD => 'va',
            Auth::EVENT_LOGIN => 'l',
            Register::EVENT_REGISTER => 'r',
        ),
        self::_PARAMS => array(
            0 => array(
                User::GENDER_MEN => 'm',
                User::GENDER_WOMEN => 'w',
                User::GENDER_UNKNOWN => 'u',
                LoginEvent::SOCIAL_FB => 'f',
                LoginEvent::SOCIAL_VK => 'v',
                LoginEvent::SOCIAL_OK => 'o',
            ),
            1 => array(),
            2 => array(),
            3 => array(),
            4 => array(),
            5 => array(),
        ),
    );

    public static function createFileRow($project, $event, $userId, $sessId = null, $request = array(), $params = array(), $date = null) {
        // Сокращаем параметры
        $params = EventParser::shortExt($params);

       if (!$sessId)
           $sessId = Logic::getSession()->getId();

        if (isset($_SERVER['HTTP_USER_AGENT'])) {
            if (!isset($request['user_agent']))
                $request['user_agent'] = substr($_SERVER['HTTP_USER_AGENT'], 0, 150);

            if (!isset($request['os_client']))
                $request['os_client'] = self::getOS();
        }

        if (!isset($request['ip_client']))
            $request['ip_client'] = self::getRealIpAddr();

        if (!isset($request['page_url']))
            $request['page_url'] = Logic::getRequest()->getPathInfo();

        if (!isset($request['referer']) && isset($_SERVER['HTTP_REFERER']))
            $request['referer'] = $_SERVER['HTTP_REFERER'];

        // Формируем строку
        $write_params = array(
            '%date%' => ($date == null) ? date('Y-m-d H:i:s') : $date,
            '%project%' => EventParser::short(self::_PROJECT, $project),
            '%user_agent%' => $request['user_agent'],
            '%os_client%' => $request['os_client'],
            '%ip_client%' => $request['ip_client'],
            '%referer%' => $request['referer'],
            '%page_url%' => $request['page_url'],
            '%utm_source%' => $request['utm_source'],
            '%session_referer%' => $request['session_referer'],
            '%sess_id%' => $sessId,
            '%user_id%' => $userId,
            '%event%' => EventParser::short(self::_EVENT, $event),
            '%params%' => implode('|', $params),
            '%guest_id%' => $request['guest_id'],
            '%country_code%' => $request['country_code'],
            '%region_code%' => $request['region_code'],
            '%city%' => $request['city'],
            '%use_js%' => $request['use_js'],
        );

        return preg_replace(
            "/[\r\n]+/",
            '',
            strtr(self::$_log_template, $write_params)
        ) . PHP_EOL;
    }

    /**
     * Преобразование записи лога в ассоциативный массив.
     * Формат CSV-строки:
     * 0:date;
     * 1:project;
     * 2:user_agent;
     * 3:os_client;
     * 4:ip_client;
     * 5:referer;
     * 6:page_url;
     * 7:utm_source;
     * 8:session_referer;
     * 9:sess_id;
     * 10:user_id;
     * 11:event;
     * 12:params;
     * 13:guest_id;
     * 14:country_code;
     * 15:region_code;
     * 16:city;
     * 17:use_js
     *
     * @param array $log
     */
    public static function parseFileRow($row) {
        if (count($row) != 18) {
            //TODO log this event
            return;
        }

        return array(
            self::_DATE => $row[0],
            self::_PROJECT => self::translate(self::_PROJECT, $row[1]),
            'user_agent' => $row[2],
            'os_client' => $row[3],
            'ip_client' => $row[4],
            'referer' => $row[5],
            'page_url' => $row[6],
            'utm_source' => $row[7],
            'session_referer' => $row[8],
            'sess_id' => $row[9],
            self::_USER_ID => $row[10],
            self::_EVENT => self::translate(self::_EVENT, $row[11]),
            self::_PARAMS => self::getExt($row[12]),
            'guest_id' => $row[13],
            'country_code' => $row[14],
            'region_code' => $row[15],
            'city' => $row[16],
            'use_js' => $row[17],
        );
    }

    public static function translate($param, $value) {
		if (isset(self::$_translation[$param]))
            if ($key = array_search($value, self::$_translation[$param]))
                return $key;
        return $value;
    }

    public static function translateExt($ext, $value) {
        if (isset(self::$_translation[self::_PARAMS][$ext]))
            if ($key = array_search($value, self::$_translation[self::_PARAMS][$ext]))
            return $key;
        return $value;
    }

    public static function getExt($paramsRow) {
        $translated_row = array();
        foreach (explode('|', $paramsRow) as $index => $value) {
            $ext = ($index + 1);
            if ($key = array_search($value, self::$_translation[self::_PARAMS][$ext])) {
                $translated_row[$ext] = $key;
                continue;
            }
            $translated_row[$ext] = $value;
        }
        return $translated_row;
    }

    public static function short($param, $value) {
        if (isset(self::$_translation[$param][$value]))
            return self::$_translation[$param][$value];
        return $value;
    }

    public static function shortExt($params) {
   	    foreach ($params as $ext => $value)
	        if (isset(self::$_translation[self::_PARAMS][$ext][$value]))
	            $params[$ext] = self::$_translation[self::_PARAMS][$ext][$value];
        return $params;
    }

    public static function getOS() {

        $os_platform    =   "Unknown OS Platform";
        $os_array       =   array(
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
        );

        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $_SERVER['HTTP_USER_AGENT']))
                $os_platform    =   $value;

        return $os_platform;

    }

    public static function getRealIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            //check ip from share internet
        {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
        }
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            //to check ip is pass from proxy
        {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $ip=$_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
}