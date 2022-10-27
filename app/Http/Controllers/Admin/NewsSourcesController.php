<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsSource\CreateRequest;
use App\Http\Requests\NewsSource\UpdateRequest;
use App\Models\NewsSources;
use App\Queries\NewsSourcesQueryBuilder;
use App\Services\Contracts\Parser as Parser;
use App\Services\ParserService;

class NewsSourcesController extends Controller
{

    public function index()
    {
        return view('admin.news_sources', ['news_sources' => (new NewsSourcesQueryBuilder)->getNewsSources()]);
    }


    public function create()
    {
        return view('admin.news_sources_create', [
            'news_sources' => null
        ]);
    }


    public function store(CreateRequest $request, NewsSourcesQueryBuilder $builder,)
    {
        $newsSourses = $builder->insert($request->validated());
        if (!empty($newsSourses)) {
            $parser =  (new ParserService())->setLink($newsSourses->url)->getParseData();
            if(!empty($parser)){
                if($builder->fillNews($parser, $newsSourses->id)){
                    return redirect()->route('admin.news_sources.show', [$newsSourses->id])
                        ->with('success', __('messages.admin.news_sources.fill_news.success'));
                }else{
                    return redirect()->back()
                        ->with('error',  __('messages.admin.news_sources.fill_news.error'));
                }
            }
            return redirect()->route('admin.news_sources.show', [$newsSourses->id])
                ->with('success', __('messages.admin.news_sources.create.success'));
        } else {
            return redirect()->back()
                ->with('error',  __('messages.admin.news_sources.create.error'));
        }
    }


    public function show($id, NewsSourcesQueryBuilder $builder)
    {
        return view('admin.news_sources_create', [
            'news_sources' => $builder->getNewsSourceById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsSources  $newsSources
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsSources $newsSources)
    {
        //
    }


    public function update( $id, UpdateRequest $request, NewsSourcesQueryBuilder $builder)
    {

        if ($builder->update($id, $request->validated())) {
            return redirect()->route('admin.news_sources.index')
                ->with('success',  __('messages.admin.news_sources.update.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.news_sources.update.error'));
        }
    }


    public function destroy(NewsSourcesQueryBuilder $builder, $id)
    {
        if ($builder->remove($id)) {
            return redirect()->route('admin.news_sources.index')
                ->with('success',  __('messages.admin.news_sources.remove.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.news_sources.remove.error'));
        }
    }
}
