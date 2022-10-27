<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Contracts\Parser;
use Illuminate\Http\Request;

class ParserController extends Controller
{

    public function __invoke(Request $request, Parser $parser, $link = 'http://rss.cnn.com/rss/edition.rss')
    {
        $load = $parser->setLink($link)
            ->getParseData();
        dd($load);
    }
}
