<?php

namespace Neologicx\Newspkg\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['id', 'ncat_id', 'image', 'heading', 'description', 'news_date', 'is_active'];

    public function newsCategory(){
        return $this->belongsTO('Neologicx\Newspkg\Models\NewsCategory','ncat_id','id');
    }
}
