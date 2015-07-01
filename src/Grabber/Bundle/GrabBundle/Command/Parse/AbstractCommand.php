<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;

use Grabber\Bundle\GrabBundle\Client\ClientInterface;
use Grabber\Bundle\GrabBundle\Command\Parse\Response\Fail;
use Grabber\Bundle\GrabBundle\Command\Parse\Response\Success;

/**
 * Class AbstractCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Site
 */
abstract class AbstractCommand implements CommandInterface
{
    protected $pattern;

    protected $name;

    protected $response;

    abstract protected function formatResult(array $out);
    /**
     * @param string          $uri
     * @param ClientInterface $client
     *
     * @return Fail|Success
     */
    public function parse($uri, ClientInterface $client)
    {
        try {
            $out = $this->getParseData($uri, $client);

            return new Success($this->formatResult($out));
        } catch (\Exception $e) {
            return new Fail($e->getMessage());
        }
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @param string          $uri
     * @param ClientInterface $client
     *
     * @return mixed
     * @throws \Exception
     */
    protected function getParseData($uri, ClientInterface $client) {
        $this->response = $client->get($uri);
        if ($this->response->getHeader()['http_code'] != 200) {
            throw new \Exception('http code is ' . $this->response->getHeader()['http_code'] );
        }

        preg_match_all($this->pattern, $this->response->getContent(), $out);

        return $out;
    }
}