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
 * Class AnnounceCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse
 */
class AnnounceCommand extends AbstractCommand
{

    protected $cityPattern;

    protected $msisdnPattern;

    protected $createdPattern;

    protected $announceIdPattern;

    protected $personNamePattern;

    /**
     * @param string       $uri
     * @param string|array $pattern
     */
    public function __construct($uri, $pattern)
    {
        parent::__construct($uri, $pattern);
        $this->msisdnPattern     = $pattern['msisdn'];
        $this->cityPattern       = $pattern['city'];
        $this->createdPattern    = $pattern['created'];
        $this->announceIdPattern = $pattern['announceId'];
        $this->personNamePattern = $pattern['personName'];
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'announce';
    }

    /**
     * @param array $out
     *
     * @return array
     */
    protected function formatResult(array $out)
    {
        return [];
    }

    /**
     * @param string $text
     *
     * @return array
     */
    protected function parseMsisdn($text)
    {
        $numbers = [];
        preg_match_all($this->msisdnPattern, $text, $out);
        for ($i = 0; $i < count($out[1]); $i++) {
            $numbers[] = trim($out[1][$i]) . trim(str_replace(' ', '', $out[2][$i]));

        }

        return array_unique($numbers);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function parseCity($text)
    {
        preg_match_all($this->cityPattern, $text, $out);

        return trim($out[1][0]);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function parseCreated($text)
    {
        preg_match_all($this->createdPattern, $text, $out);

        return trim($out[1][0]);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function parseAnnounceId($text)
    {
        preg_match_all($this->announceIdPattern, $text, $out);

        return trim($out[1][0]);
    }

    /**
     * @param string $text
     *
     * @return string
     */
    protected function parsePersonName($text)
    {
        if (preg_match_all($this->personNamePattern, $text, $out)) {
            return trim($out[1][0]);
        }

        return '';
    }



    /**
     * @return Fail|Success
     */
    public function parse()
    {
        try {
            $this->response = $this->client->get($this->uri);
            $data = [];
            if ($this->response->getHeader()['http_code'] != 200) {
                throw new \Exception('http code is ' . $this->response->getHeader()['http_code'] );
            }
            $data['msisdn']     = $this->parseMsisdn($this->response->getContent());
            $data['city']       = $this->parseCity($this->response->getContent());
            $data['created']    = $this->parseCreated($this->response->getContent());
            $data['announceId'] = $this->parseAnnounceId($this->response->getContent());
            $data['personName'] = $this->parsePersonName($this->response->getContent());

            return new Success($data);
        } catch (\Exception $e) {
            return new Fail($e->getMessage());
        }
    }
}