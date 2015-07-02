<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Factory;


use Grabber\Bundle\GrabBundle\Client\ClientInterface;
use Grabber\Bundle\GrabBundle\Command\Parse\AnnounceCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\AnnounceListCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\CategoryCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\PageCommand;
use Grabber\Bundle\GrabBundle\Command\Parse\RegionCommand;

/**
 * Class ParseCommandFactory
 *
 * @package Grabber\Bundle\GrabBundle\Factory
 */
class ParseCommandFactory
{
    /**
     * @param string          $uri
     * @param string          $pattern
     * @param ClientInterface $client
     *
     * @return RegionCommand
     */
    public function createRegionCommand($uri, $pattern, $client)
    {
        $command = new RegionCommand($uri, $pattern);
        $command->setClient($client);

        return $command;
    }

    /**
     * @param string          $uri
     * @param string          $pattern
     * @param ClientInterface $client
     *
     * @return CategoryCommand
     */
    public function createCategoryCommand($uri, $pattern, $client)
    {
        $command = new CategoryCommand($uri, $pattern);
        $command->setClient($client);

        return $command;
    }

    /**
     * @param string          $uri
     * @param string          $pattern
     * @param ClientInterface $client
     *
     * @return PageCommand
     */
    public function createPageCommand($uri, $pattern, $client)
    {
        $command = new PageCommand($uri, $pattern);
        $command->setClient($client);

        return $command;
    }

    /**
     * @param string          $uri
     * @param string          $pattern
     * @param ClientInterface $client
     *
     * @return AnnounceListCommand
     */
    public function createAnnounceListCommand($uri, $pattern, $client)
    {
        $command = new AnnounceListCommand($uri, $pattern);
        $command->setClient($client);

        return $command;
    }

    /**
     * @param string          $uri
     * @param string          $pattern
     * @param ClientInterface $client
     *
     * @return AnnounceCommand
     */
    public function createAnnounceCommand($uri, $pattern, $client)
    {
        $command = new AnnounceCommand($uri, $pattern);
        $command->setClient($client);

        return $command;
    }



}