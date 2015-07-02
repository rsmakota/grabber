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
    /**
     * @var ClientInterface
     */
    protected $client;
    /**
     * @var string
     */
    protected $uri;

    /**
     * @param string       $uri
     * @param string|array $pattern
     */
    public function __construct($uri, $pattern)
    {
        $this->uri     = $uri;
        $this->pattern = $pattern;
    }

    public function setClient(ClientInterface $client)
    {
        $this->client = $client;
    }

    abstract protected function formatResult(array $out);

    /**
     * @return Fail|Success
     */
    public function parse()
    {
        try {
            $out = $this->getParseData($this->uri, $this->client);

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