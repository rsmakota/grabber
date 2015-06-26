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
    protected $categoryPattern = '|<a href="([^"]+)">([^<]+)</a>[\s]*<span>[0-9]+</span>|';
    /**
     * @param string $name
     *
     * @return string
     */
    protected function formatRegionName($name)
    {
        return $name." область";
    }

    protected function getRegionListData()
    {
        $pageContent = $this->client->get($this->baseUri)->getBody()->getContents();
        $regionList = [];
        preg_match_all($this->regionPattern, $pageContent, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            $regionList[] = [
                "uri"        => $out[1][$i],
                "region"     => $this->formatRegionName($out[2][$i]),

            ];
        }

        return $regionList;
    }

    protected function getCategory($uri)
    {
        $pageContent = $this->client->get($uri)->getBody()->getContents();
        $categoryList = [];
        preg_match_all($this->categoryPattern, $pageContent, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            $categoryList[] = [
                "uri"        => $out[1][$i],
                "category"     => $this->formatRegionName($out[2][$i]),

            ];
        }

        return $categoryList;
    }


    public function grab()
    {
        $regionList = $this->getRegionListData();
        foreach($regionList as $regionData) {
            $region = $this->localityManager->findRegion($regionData['region'], $this->country);
            $categoryList = $this->getCategory($regionData['uri']);
            foreach ($categoryList as $categoryData) {

            }
        }
    }
}