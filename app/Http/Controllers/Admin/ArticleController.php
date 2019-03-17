<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use App\Http\Requests\StoreArticle;

class ArticleController extends Controller
{
    protected $layout = 'layouts.app';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::where('user_id',\Auth::getUser()->id)->simplePaginate(10);
        return view('admin.articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $input = $request->all();

        $article = Article::create([
            'user_id' => \Auth::getUser()->id,
            'title' => $input['title'],
            'body' => htmlspecialchars($input['body']),
        ]);

        if($input['tag']){
            $tags = explode(';',$input['tag']);

            foreach ($tags as $tag){
                $tag_m = Tag::firstOrNew(
                    ['name' => $tag]
                );
                $tag_m->save();

                $article->tags()->attach([$tag_m->id]);
            }
        }

        return redirect('admin/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::where('id',$id)->with('tags')->get()->toArray()[0];
        $tags = Arr::pluck($article['tags'],'name');

        return view('admin.articles.edit', ['article' => $article, 'id' => $id, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, $id)
    {
        $input = $request->all();

        Article::where('id',$id)->update([
            'user_id' => \Auth::getUser()->id,
            'title' => $input['title'],
            'body' => htmlspecialchars($input['body']),
        ]);

        if($input['tag']){
            $tags = explode(';',$input['tag']);
            $tag_ids = [];

            foreach ($tags as $tag){
                $tag_m = Tag::firstOrNew(
                    ['name' => $tag]
                );
                $tag_m->save();
                $tag_ids[] = $tag_m->id;
            }

            Article::find($id)->tags()->sync($tag_ids,true);
        }

        return redirect('admin/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
        return redirect('admin/articles');
    }

}
