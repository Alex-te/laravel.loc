<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Categories;
use App\Queries\CategoriesQueryBuilder;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    public function index(CategoriesQueryBuilder $builder)
    {
        return view('admin.categories', [
            'categories' => $builder->getCategories()
        ]);
    }

    public function create()
    {
        return view('admin.category', [
            'category' => null
        ]);
    }


    public function store(CreateRequest $request, CategoriesQueryBuilder $builder)
    {
        $news = $builder->insert($request->validated());
        if (!empty($news)) {
            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.create.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.categories.create.error'));
        }
    }


    public function show($id, CategoriesQueryBuilder $builder)
    {

        return view('admin.category', [
            'category' => $builder->getCategoryById($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Categories $categories
     * @return \Illuminate\Http\Response
     */
    public function edit(Categories $categories)
    {
        //
    }


    public function update($id, UpdateRequest $request, CategoriesQueryBuilder $builder)
    {
        if ($builder->update($id, $request->validated())) {
            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.update.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.categories.update.error'));
        }
    }


    public function destroy($id, CategoriesQueryBuilder $builder)
    {
        if ($builder->remove($id)) {
            return redirect()->route('admin.categories.index')
                ->with('success', __('messages.admin.categories.remove.success'));
        } else {
            return redirect()->back()
                ->with('error', __('messages.admin.categories.remove.error'));
        }
    }
}
