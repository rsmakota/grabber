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
     * <a data-npage="3" class="number " href="http://vn.besplatka.ua/page/3">3</a>
     */
    protected $pagePattern = '|<a data-npage="([0-9]+)"[^>]*>|';

    protected $announcementListPattern = '|<div class="one_message_title">[\s]*<a href="((?:(?!spec).)*)"><h3>|';

    protected $msisdn = '|<div class="phone3">([0-9]*)&nbsp;</div>[\s]*<div class="mpphone">([0-9\s]*)</div>|';

    protected $city = '|<div class="city">[\s]*Город:[\s]*<div class="text">([^<]+)</div>|';

    protected $created = '|<div class="date_start">Добавлено: ([^<]+)</div>|';

    protected $announceId = '|<div class="id_advert">ID объявления: ([^<]+)</div>|';

    protected $name = '|<div class="name">([^<]+)</div>|';
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
        $this->countPages($pageContent);
        $categoryList = [];
        preg_match_all($this->categoryPattern, $pageContent, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            $categoryList[] = [
                "uri"      => $out[1][$i],
                "category" => $out[2][$i],
                "pages"    => $this->countPages($pageContent)
            ];
        }

        return $categoryList;
    }

    /**
     * @param string $body
     * @return array
     */
    protected function countPages($body)
    {
        $pages = 1;
        preg_match_all($this->pagePattern, $body, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            if ($pages < $out[1][$i]) {
                $pages = $out[1][$i];
            }
        }

        return $pages;
    }

    protected function getAnnouncementListData($uri)
    {
        $pageContent = $this->client->get($uri)->getBody()->getContents();
        $announcementList = [];
        preg_match_all($this->announcementListPattern, $pageContent, $out);
        for($i = 0; $i < count($out[1]); $i++) {
            $announcementList[] = [
                "uri"      => $out[1][$i]
            ];
        }

        return $announcementList;
    }

    public function grab()
    {
        $regionList = $this->getRegionListData();
        foreach ($regionList as $regionData) {
            $region = $this->localityManager->findRegion($regionData['region'], $this->country);
            $categoryList = $this->getCategory($regionData['uri']);
            foreach ($categoryList as $categoryData) {
                $categoty  = $this->categoryManager->getCategory($categoryData['category']);
                for ($i=1; $i < $categoryData['pages']; $i++) {
                    $announceListData = $this->getAnnouncementListData($categoryData['uri']."/page/".$i);
                    var_dump($announceListData);exit;
                }

            }
        }
    }
}