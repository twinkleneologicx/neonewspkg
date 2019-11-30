<?php

namespace Neologicx\Newspkg\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['id', 'ncat_id', 'image', 'heading', 'description', 'news_date', 'is_newsticker', 'is_active', 'is_highlight'];

    public function newsCategory(){
        return $this->belongsTo('Neologicx\Newspkg\Models\NewsCategory','ncat_id','id');
    }
}
