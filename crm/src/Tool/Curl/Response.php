<?php
namespace Tool\Curl;


class Response {
    private $response;
    private $info;

    public function __construct($response, $info, $headers = null) {
        $this->response = $this->extract($response);
        $this->info     = $info;
    }

    public function __toString()
    {
        if ($this->response)
            return $this->response;

        return '';
    }

    public function getInfo($propName = false)
    {
        if ($propName) {
            return isset($this->info[$propName])?$this->info[$propName]:null;
        } else {
            return $this->info;
        }
    }

    /**
     * unzip gzip/deflate
     * @param type $s
     * @return string
     */
    protected function extract($s)
    {
        return (substr($s, 0, 8) == "\x1F\x8B\x08\x00\x00\x00\x00\x00") ? gzinflate(substr($s, 10)) : $s;
    }
}

