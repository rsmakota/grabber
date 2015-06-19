<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Service;

use Grabber\Bundle\GrabBundle\Entity\ProxyConfig;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ProxyConfigManager
 *
 * @package Grabber\Bundle\GrabBundle\Service
 */
class ProxyConfigManager 
{
    /**
     * Path to proxy config file
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $config;

    public function __construct($path)
    {
        $this->path = $path;
        $this->load();
    }

    protected function load()
    {
        if (!file_exists($this->path)) {
            throw new \Exception('Can\' find file by path '.$this->path);
        }
        $this->config = Yaml::parse(file_get_contents($this->path));
    }

    /**
     * @return ProxyConfig
     */
    public function selectConfig()
    {
        $countProxy = count($this->config);
        if ($countProxy == 0) {
            return false;
        }
        $rand = rand(0, count($this->config));

        return new ProxyConfig($this->config[$rand]);
    }

    /**
     * @param array $configs
     *
     * @throws \Exception
     */
    public function update(array $configs)
    {
        if (false === file_put_contents($this->path, Yaml::dump($configs))) {
            throw new \Exception('Error write '.$this->path);
        }

    }

}