<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function save(News $news){
       Storage::disk('local')->put('news.json', json_encode($news->getNews(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
       dump(json_decode( Storage::disk('local')->get('news.json'), true));
    }
}
