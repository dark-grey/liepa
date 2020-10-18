<?php

namespace App\Parsers;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\Facades\Date;
use Symfony\Component\DomCrawler\Crawler;

class RbcNewsParser
{
    private const RBC_URL = 'https://rbc.ru/';

    public function parse(int $count = 15): array
    {
        $mainPageHtml = $this->getContent(self::RBC_URL);

        $crawler = new Crawler($mainPageHtml);
        $nodes = $crawler->filter('.js-news-feed-list > .news-feed__item.js-news-feed-item')
            ->slice(0, $count);

        return $nodes->each(function (Crawler $node) {
            return $this->parseNode($node);
        });
    }

    private function parseNode(Crawler $node): array
    {
        $url = $node->extract(['href'])[0];

        $result = $this->parseNews($url);

        $result['rbc_id'] = $node->extract(['id'])[0];
        $result['title'] = $node->filter('.news-feed__item__title')->text();
        $result['url'] = $url;
        $result['date'] = Date::createFromTimestamp($node->extract(['data-modif'])[0]);

        return $result;
    }

    private function parseNews(string $url): array
    {
        $html = $this->getContent($url);

        $crawler = new Crawler($html);

        return [
            'description' => $crawler->filterXpath("//meta[@property='og:description']")->extract(['content'])[0] ?? null,
            'image_url' => $crawler->filterXpath("//meta[@name='twitter:image']")->extract(['content'])[0] ?? null,
        ];
    }

    private function getContent(string $url): string
    {
        $guzzle = new Guzzle();
        $result = $guzzle->request('GET', $url);

        return $result->getBody()->getContents();
    }
}
