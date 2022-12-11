<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTags extends Model
{
    use HasFactory;
    protected $table = 'news_tags';
    public $timestamps = false;

    public function tags()
    {
        return $this->belongsTo(Tags::class, 'tag_id');
    }

}
