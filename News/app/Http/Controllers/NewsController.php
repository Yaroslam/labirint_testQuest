<?php

namespace App\Http\Controllers;

use App\Models\News;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function createNews(Request $request){
        $news = new News(['title' => $request['title'], "announces" => $request['announces'], "text" => $request['text']]);
        $news->save();
        $news->setTags($request['tags']);
        return $news;
    }

    public function deleteNews(Request $request){
        News::deleteNewsById($request["id"]);
    }

    public function getNews(Request $request){
        if($request['id']){
            $news = News::findNewsById($request['id']);
        } else if($request['q']){
            $news = News::findNewsByTitle($request['q']);
        }
        if($news) {
            return Response(view('NewsTemplate', compact('news')));
        } else {
            return Response("no News", 404);
        }
    }




}
