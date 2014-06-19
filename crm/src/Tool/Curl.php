<?php

namespace Tool;

use Tool\Curl\Response;

class Curl
{

    private $ch = null;
    private $method = 'get';
    private $url;
    public $info = null;
    public $response = null;
    private $_contentType = null;

    private $_isAuth = false;
    private $_username = '';
    private $_password = '';

    private $_connectionTimeout = 15;
    private $_responseHeaders = false;

    private $_header = array();
    private $_cookie = '';

    public function enableContentType($contentType) {
    	$this->_contentType = $contentType;
    	return $this;
    }

    public function addHeader($header) {
        array_push($this->_header, $header);
        return $this;
    }

    public function setCookie($cookie) {
        $this->_cookie = $cookie;
        return $this;
    }

    public function enableAuth($username, $password){
    	$this->_isAuth = true;
    	$this->_username = $username;
    	$this->_password = $password;
    	return $this;
    }

    public function enableResponseHeaders() {
        $this->_responseHeaders = true;
        return $this;
    }

    public function setConnectionTimeout($timeout){
    	$this->_connectionTimeout = $timeout;
    	return $this;
    }

    public function init() {
        $this->ch = curl_init($this->url);
        curl_setopt($this->ch, CURLOPT_HEADER, $this->_responseHeaders);
        //curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->_connectionTimeout);

        if ($this->_contentType) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array($this->_contentType)); // 'Content-Type: text/xml'
            $this->_contentType = null;
        }

        foreach ($this->_header as $header) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array($header)); // 'Content-Type: text/xml'
        }
        $this->_header = array();

        if ($this->_cookie) {
            curl_setopt($this->ch, CURLOPT_COOKIE, $this->_cookie);
        }
        $this->_cookie = '';

        if ($this->_isAuth) {
            curl_setopt($this->ch, CURLOPT_USERPWD, $this->_username . ':' . $this->_password);
            $this->_isAuth = false;
        }

//        if (debug()->isProxy()) {
//            curl_setopt($this->ch, CURLOPT_PROXY, debug()->getProxy());
//            //Set proxy type to SOCKS 5; default is HTTP
//            curl_setopt($this->ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
//        }
        return $this;
    }

    /**
     * @param $params
     * @return Response
     */

    private function execute($params) {
    	$this->response = curl_exec($this->ch);

//        debug()->force()->general($this->method . '(): ' . get_instance()->uri->uri_string . ' | ');
//        debug()->force()->general($this->method . '(): URL: ' . $this->url);
        if ($this->method == 'Curl::post') {
//            debug()->force()->general($this->method . '(): POST PARAMS: ');
//            debug()->force()->general($params);
        }

//    	debug()->force()->general($this->method . '(): RESPONSE: ');
//    	debug()->force()->general(substr($this->response, 0, 2000));

    	$err = curl_error($this->ch);
    	if ($err) {
//    		debug()->force()->error($this->method . '(): ERROR: ' . $err);
    	}

    	$this->info = curl_getinfo($this->ch);

//    	debug()->force()->performance('time: ' . $this->info['total_time'] . ' Debug: curl->get ' . $this->url);

    	curl_close($this->ch);
    	return new Response($this->response, $this->info);
    }

    // DO NOT CACHE THIS FUNCTIONS !!!
    /**
     * @param $url
     * @param array $params
     * @return Response
     */
    public function get($url, $params = array()) {
    	$this->method = __METHOD__;
    	$this->url = $url;

        if ($params) {
            if (is_array($params))
                $this->url .= '?' . http_build_query($params);
            else
                $this->url .= '?' . $params;
        }
        return $this->init()->execute($params);
    }

    // DO NOT CACHE THIS FUNCTIONS !!!
    public function post($url, $params = array()) {
    	$this->method = __METHOD__;
    	$this->url = $url;

        $this->init();
        curl_setopt($this->ch, CURLOPT_POST, 1);
        if ($params) {
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $params);
        }
        return $this->execute($params);
    }

    // DO NOT CACHE THIS FUNCTIONS !!!
    public function head($url, $params = array()) {
    	$this->method = __METHOD__;
    	$this->url = $url;

    	if ($params) {
    		if (is_array($params))
    		$this->url = $url . '?' . http_build_query($params);
    		else
    		$this->url = $url . '?' . $params;
    	}
        $this->init($params);
    	curl_setopt($this->ch, CURLOPT_NOBODY, true);
    	$this->execute($params);
    	return $this->info;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getCurlResource()
    {
        return $this->ch;
    }
}