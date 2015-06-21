<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Grabber;

use Grabber\Bundle\GrabBundle\Service\ProxyConfigManager;
use GuzzleHttp\Client;
use Monolog\Logger;

class ProxyGrabber implements GrabberInterface
{
    /**
     * @var ProxyConfigManager
     */
    private $configManager;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var Logger
     */
    private $logger;
    /**
     * <tr><td>52.69.59.64</td><td>3128</td><td>JP</td><td>Japan</td><td>elite proxy</td><td>no</td><td>yes</td><td>2 seconds ago</td></tr>
     * @var string
     */
    private $pattern = "|>([0-9\\.]*)</td><td>([0-9]{2,4})</td><td>([A-Z]{2})</td><td>([a-zA-Z]*)</td><td>([a-zA-Z0-9 ]*)</td><td>([a-z]{2,3})</td><td>([a-z]{2,3})</td><td>([a-zA-Z0-9 ]*)|";

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param ProxyConfigManager $configManager
     * @param Client             $client
     */
    public function __construct(ProxyConfigManager $configManager, Client $client)
    {
        $this->configManager = $configManager;
        $this->client        = $client;
    }

    /**
     * @param string $str
     * @return boolean
     */
    protected function boolFormatter($str)
    {
        if ($str == 'yes') {
            return true;
        }

        return false;
    }

    protected function dateFormatter($str)
    {
        $date = new \DateTime();
        $str = substr($str, 0, -4);
        $params = explode(' ', $str);
        $i = 0 ;
        while ($i < count($params)) {
            echo "- ".$params[$i]." ".$params[($i+1)] ." ";
            $i = $i + 2;
        }

        return $date->format("Y-m-d H:i:s");
    }

    public function grab()
    {
        $response = $this->client->get('');
        $content = $response->getBody()->getContents();
        $proxyList = [];
        preg_match_all($this->pattern, $content, $out);
        for($i = 1; $i < count($out[1]); $i++) {
            $proxyList[] = [
                "ip"        => $out[1][$i],
                "port"      => $out[2][$i],
                "code"      => $out[3][$i],
                "country"   => $out[4][$i],
                "anonymity" => $out[5][$i],
                "google"    => $this->boolFormatter($out[6][$i]),
                "https"     => $this->boolFormatter($out[7][$i]),
                "checked"   => $this->dateFormatter($out[8][$i]),
            ];
        }
        if (count($proxyList) > 0) {
            $this->configManager->update($proxyList);
        }

    }
}