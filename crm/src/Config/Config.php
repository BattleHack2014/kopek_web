<?php
namespace Config;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Parser;

class Config implements IConfig, \Iterator
{
    protected $_data = array();

    protected static $_parser = null;

    public function __construct(array $data = array(), $reduce_path = null)
    {
        $this->_data = $data;

        // create config with only partial data
        if ($reduce_path)
            $this->_data = $this->get($reduce_path);
    }

    /**
     * @param string $file - название файла конфигурации без расширения
     * @param string $reduce_path - путь для создания объекта только из части конфигурации
     * @throws \ErrorException
     * @return Config
     */
    public static function createConfig($file, $reduce_path = null) {
        if (!defined('ENV'))
            throw new \ErrorException(__METHOD__ . ' :: Please set ENV constant');

        $projects = array();
        if (defined('PROJECT'))
            $projects[] = PROJECT;
        $projects[] = 'default';

        $file_path = '';
        foreach ($projects as $project) {
            $file_path = ROOT_PATH . '/config/' . $project . '/' . ENV . '/' . $file . '.yaml';
            if (!file_exists($file_path))
                $file_path = ROOT_PATH . '/config/' . $project . '/' . $file . '.yaml';

            if (file_exists($file_path))
                break;
        }

        if (!file_exists($file_path))
            throw new \ErrorException('Конфигурационный файл ' . $file . ' не найден');

        return new self(self::getParser()->parse($file_path), $reduce_path);

    }

    /**
     * @return \Symfony\Component\Yaml\Yaml
     */
    private static function getParser() {
        if (self::$_parser === null)
            self::$_parser = new Yaml();

        return self::$_parser;
    }

    /**
     * Конфигурация мемкеша глобальна для всех проектов
     * так как на нем работают сессии в которых лежит текущий проект
     *
     * @return \Config\Config
     */
    public static function getMemcachedConfig() {
        $file_path = ROOT_PATH . '/config/default/' . ENV . '/memcached.yaml';
        if (!file_exists($file_path))
            $file_path = ROOT_PATH . '/config/default/memcached.yaml';
        return new self(self::getParser()->parse($file_path));
    }

    public function has($key)
    {
        if (!strpos($key, '.'))
            return isset($this->_data[$key]);

        $value = $this->_data;
        foreach (explode('.', $key) as $key) {
            if (!isset($value[$key]))
                return false;

            $value = $value[$key];
        }
        return true;
    }

    public function get($key, $default = null)
    {
        if (!strpos($key, '.'))
            return isset($this->_data[$key]) ? $this->_data[$key] : $default;

        $value = $this->_data;
        foreach (explode('.', $key) as $key) {
            if (!isset($value[$key]))
                return $default;

            $value = $value[$key];
        }
        return $value;
    }

    public function all() {
        return $this->_data;
    }

    public function rewind()
    {
        reset($this->_data);
    }

    public function current()
    {
        return current($this->_data);
    }

    public function key()
    {
        return key($this->_data);
    }

    public function next()
    {
        return next($this->_data);
    }

    public function valid()
    {
        $key = key($this->_data);
        return ($key !== NULL && $key !== FALSE);
    }
}