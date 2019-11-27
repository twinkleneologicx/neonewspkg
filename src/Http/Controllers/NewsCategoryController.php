<?php

namespace Neologicx\Newspkg\Http\Controllers;

use App\Http\Controllers\Controller;
use Neologicx\Newspkg\Http\Requests\NewsCategoryv;
use Neologicx\Newspkg\Models\News;
use Neologicx\Newspkg\Models\NewsCategory;
use Illuminate\Http\Request;


class NewsCategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = News::orderBy('news_date','DESC')->paginate(10);
        return view('news::allnews')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = NewsCategory::orderBy('id', 'DESC')->paginate(10);
        return view('news::createnewscat')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsCategoryv $request)
    {
        NewsCategory::create($request->except('_csrf'));
       return redirect()->back()->with('msg', 'News Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function show(NewsCategory $newsCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($newsCategory)
    {
        $newsCategory = NewsCategory::find($newsCategory);
        return view('news::editnewscat')->with('newsCategory', $newsCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $newsCategory)
    {
        $newsCategory = NewsCategory::find($newsCategory);
        $newsCategory->update($request->except('_csrf', '_method'));
        return redirect('/newsCategory/create')->with('msg', 'News category updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsCategory  $newsCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($newsCategory)
    {
        $newsCategory = NewsCategory::find($newsCategory);
        $newsCategory->delete();
        return redirect()->back()->with('msg', 'Category deleted successfully.');
    }

    public function showallnews($id){
        $data=NewsCategory::where('id', $id)->with('descnews')->first();
       return view('news::allnewsofcat')->with('data', $data);
    }
}
