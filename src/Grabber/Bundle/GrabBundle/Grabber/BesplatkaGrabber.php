<?php
/**
 * @author    Rodion Smakota <rsmakota@gmail.com>
 * @copyright 2015 Grabber LLC
 */

namespace Grabber\Bundle\GrabBundle\Grabber;

/**
 * Class BesplatkaGrabber
 *
 * @package Grabber\Bundle\GrabBundle\Grabber
 */
class BesplatkaGrabber extends BaseGrabber
{
    /*
     * <a id="region_11" href="http://vn.besplatka.ua" title="Объявления в Винницкой области" rel="nofollow">Винницкая</a>
     */
    protected $regionPattern = '|<a id="region_[0-9]+" href="([^"]+)" title="[^"]+" rel="nofollow">([^<]+)<\/a>|';

    protected function getRegionListData()
    {
        $pageContent = $this->client->get($this->baseUri)->getBody()->getContents();
        $regionList = [];
        preg_match_all($this->regionPattern, $pageContent, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            $regionList[] = [
                "uri"        => $out[1][$i],
                "region"     => $out[2][$i],

            ];
        }

        return $regionList;
    }

    protected function findRegion()
    {
        
    }

    public function grab()
    {
        $regionList = $this->getRegionListData();
        foreach($regionList as $regionData) {

        }
    }
}