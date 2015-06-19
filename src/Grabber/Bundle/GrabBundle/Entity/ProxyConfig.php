<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */
namespace Grabber\Bundle\GrabBundle\Entity;

/**
 * Class ProxyConfig
 *
 * @package Grabber\Bundle\GrabBundle\Entity
 */
class ProxyConfig 
{
    /**
     * @var string
     */
    private $ip;
    /**
     * @var string
     */
    private $port;
    /**
     * Country code
     * @var String
     */
    private $code;
    /**
     * Country name
     * @var string
     */
    private $country;
    /**
     * Is anonymity proxy
     * @var boolean
     */
    private $anonymity;
    /**
     * Is google know that proxy is proxy
     * @var boolean
     */
    private $google;
    /**
     * Is proxy support https protocol
     * @var boolean
     */
    private $https;
    /**
     * Last date when proxy was checked 
     * @var \DateTime
     */
    private $checked;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->ip        = $config['ip'];
        $this->$port     = $config['port'];
        $this->code      = $config['code'];
        $this->country   = $config['country'];
        $this->anonymity = $config['anonymity'];
        $this->google    = $config['google'];
        $this->https     = $config['https'];
        $this->checked   = $config['checked'];
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setIp($ip)
    {
        $this->ip = $ip;
    }

    public function getPort()
    {
        return $this->port;
    }

    public function setPort($port)
    {
        $this->port = $port;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function isAnonymity()
    {
        return $this->anonymity;
    }

    public function setAnonymity($anonymity)
    {
        $this->anonymity = $anonymity;
    }

    public function isGoogle()
    {
        return $this->google;
    }

    public function setGoogle($google)
    {
        $this->google = $google;
    }

    public function isHttps()
    {
        return $this->https;
    }

    public function setHttps($https)
    {
        $this->https = $https;
    }

    public function isChecked()
    {
        return $this->checked;
    }

    public function setChecked($checked)
    {
        $this->checked = $checked;
    }


}