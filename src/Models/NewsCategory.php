<?php

namespace Neologicx\Newspkg\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    protected $fillable = ['id', 'name'];
    public function news(){
        return $this->hasMany('Neologicx\Newspkg\Models\News', 'ncat_id', 'id');
    }

    public function descnews(){
        return $this->hasMany('Neologicx\Newspkg\Models\News', 'ncat_id', 'id')->orderBy('id', 'DESC');
    }
    public function activenews(){
        return $this->hasMany('Neologicx\Newspkg\Models\News', 'ncat_id', 'id')->where('is_active', '1');
    }
}
