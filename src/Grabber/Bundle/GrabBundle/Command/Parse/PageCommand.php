<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;

/**
 * Class PageCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse
 */
class PageCommand extends AbstractCommand
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'page';
    }

    /**
     * @param array $out
     *
     * @return array
     */
    protected function formatResult(array $out)
    {
        $pages = 1;
        for($i = 0; $i < count($out[1]); $i++) {
            if ($pages < $out[1][$i]) {
                $pages = $out[1][$i];
            }
        }

        return ['pages' => $pages];
    }

}