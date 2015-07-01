<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Client;


use Grabber\Bundle\GrabBundle\Client\Response\Response;
use Grabber\Bundle\GrabBundle\Client\Response\ResponseInterface;

/**
 * Class Client
 *
 * @package Grabber\Bundle\GrabBundle\Client
 */
class Client implements ClientInterface
{
    /**
     * @var array
     */
    protected $options = [
        'CURLOPT_USERAGENT'      => 'Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.9.168 Version/11.51',
        'CURLOPT_TIMEOUT'        => 200,
        'CURLOPT_RETURNTRANSFER' => true,
        'CURLOPT_FOLLOWLOCATION' => true
    ];

    /**
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * @param string $url
     * @param array  $options
     *
     * @return Response
     */
    protected function request($url, array $options)
    {
        $this->options = array_merge($this->options, $options);
        $this->options['CURLOPT_URL'] = $url;
        $ch = curl_init();
        foreach ($this->options as $key => $value) {
            curl_setopt($ch, constant($key), $value);
        }
        $output    = curl_exec($ch); // get content
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); // Получаем HTTP-код
        curl_close($ch);
        return new Response(['http_code' => $http_code], $output);
    }

    /**
     * @param string $uri
     * @param array  $options
     *
     * @return ResponseInterface
     */
    public function get($uri, $options=[])
    {
        $this->options['CURLOPT_HTTPGET'] = true;

        return $this->request($uri, $options);
    }

    /**
     * @param string $ip
     * @param string $port
     */
    public function setProxy($ip, $port)
    {
        $this->options['CURLOPT_PROXY'] = $ip . ":" . $port;
    }

    /**
     * @param       $uri
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function post($uri, $options=[])
    {
        $this->options['CURLOPT_POST'] = true;

        return $this->request($uri, $options);
    }
}