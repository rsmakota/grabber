<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;

/**
 * Class AnnounceListCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse
 */
class AnnounceListCommand extends AbstractCommand
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'announce_list';
    }

    /**
     * @param array $out
     *
     * @return array
     */
    protected function formatResult(array $out)
    {
        $regionList = [];
        for ($i = 0; $i < count($out[1]); $i++) {
            $regionList[] = [
                "uri"      => $out[1][$i]
            ];
        }

        return $regionList;
    }


}