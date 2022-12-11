<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    use HasFactory;

    protected $table = 'News';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'announces',
        'text',
        'date_of_publish'
    ];


    function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->date_of_publish =  date("Y-m-d H:i:s");
    }


    public function news_tags()
    {
        return $this->hasMany(NewsTags::class, 'news_id', 'id');
    }

    public function getNewsId(){
        return $this->id;
    }

    public function getNewsPublishDate(){
        return $this->date_of_publish;
    }


    public function setText($text){
        $this->text = $text;
        $this->save();
    }

    public function getText(){
        return $this->text;
    }

    public function setTitle($title){
        $this->title = $title;
        $this->save();
    }

    public function getTitle(){
        return $this->title;
    }


    public function setAnnounces($announces){
        $this->announces = $announces;
        $this->save();
    }

    public function getAnnounces(){
        return $this->announces;
    }



    public function setTags($tags){
        DB::table("news_tags")->where('news_id', $this->id)->delete();
        foreach ($tags as $tag){
            DB::table("news_tags")->insert(["news_id" => $this->id,
                'tag_id' => $tag]);
        }
    }

    public function getTags(){
        $namedTags = [];
        $newsTags =  DB::table("news_tags")->where("news_id", $this->id)->get()->toArray();
        foreach ($newsTags as $tag){
            $namedTags[] = Tags::where("id",$tag->tag_id)->get()[0]['tag'];
        }
        return $namedTags;
    }


    public static function deleteNewsById($id){
        DB::table("News")->where("id", $id)->delete();
    }

    public static function findNewsByTitle($title){
        return News::where("title", "LIKE", "%".$title."%")->first();
    }

    public static function findNewsById($id){
        return News::where("id", $id)->first();
    }
}
