<?php

namespace Neologicx\Newspkg\Http\Controllers;

use App\Http\Controllers\Controller;
use Neologicx\Newspkg\Http\Requests\Newsv;
use Neologicx\Newspkg\Models\News;
use Neologicx\Newspkg\Models\NewsCategory;
use Illuminate\Http\Request;


class NewsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cat = NewsCategory::all();
        return view('news::createnews')->with('cat', $cat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Newsv $request)
    {
        
         $image = $request->file('image');
         $img = $image->store('/public/newsimages');
         $datetime = $request->news_date;
        $news_date = date(' Y-m-d H:i', strtotime($datetime));
        News::create(array_merge($request->except('_csrf'), ['image' => $img, 'news_date' => $news_date]));

        return redirect('/newsCategory')->with('msg', 'News added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit($news)
    {
        $news = News::find($news);
        $cat = NewsCategory::all();
        return view('news::editnews')->with('news', $news)->with('cat', $cat);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $news)
    {
        $news = News::find($news);
        $datetime = $request->news_date;
        $news_date = date(' Y-m-d H:i', strtotime($datetime));
        if ($request->hasFile('image')) {
            $img = $request->file('image')->store('/public/newsimages');
            $news->update(array_merge($request->except('_csrf', '_method'), ['image' => $img, 'news_date'=>$news_date]));
        } else {
            $news->update(array_merge($request->except('_csrf', '_method'), ['news_date'=>$news_date]));
        }
        return redirect('/newsCategory')->with('msg', 'News updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($news)
    {
        $news = News::find($news);
        $news->delete();
        return redirect()->back()->with('msg', 'News deleted successfully.');
    }

    public function changenewsstatus(){
        $id = $_GET['id'];
        $currentstatus = News::where('id', $id)->pluck('is_active');
        // dd($currentstatus[0]);
        if ($currentstatus[0]) {
            $status='News deactivated successfully.';
           $query = News::where('id', $id)->update(['is_active'=>0]);
        } else {
            $status='News activated successfully.';
            $query = News::where('id', $id)->update(['is_active'=>1]);
        }
        if ($query) {
            return response()->json($status);
        } else {
            $status='something went wrong';
            return response()->json($status);
        }
        
    }
}
