<?php

namespace App\Services;

use App\Services\Contracts\Parser;
use Orchestra\Parser\Xml\Facade as XmlParser;

class ParserService implements Parser
{

    private string $link;

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getParseData(): array
    {
        $xml = XMLParser::load($this->link);

        return $xml->parse([
            'title' => [
                'uses' => 'channel.title'
            ],
            'description' => [
                'uses' => 'channel.description'
            ],
            'image' => [
                'uses' => 'channel.image.url'
            ],
            'news' => [
                'uses' => 'channel.item[title,link,description,pubDate]'
            ]
        ]);
    }
}
