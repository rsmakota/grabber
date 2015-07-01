<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Command\Parse;

/**
 * Class CategoryCommand
 *
 * @package Grabber\Bundle\GrabBundle\Command\Parse
 */
class CategoryCommand extends AbstractCommand
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'category';
    }

    /**
     * @param array $out
     *
     * @return array
     */
    protected function formatResult(array $out)
    {
        $categoryList = [];
        for ($i = 0; $i < count($out[1]); $i++) {
            $categoryList[] = [
                "uri"      => $out[1][$i],
                "category" => $out[2][$i],

            ];
        }

        return $categoryList;
    }

}