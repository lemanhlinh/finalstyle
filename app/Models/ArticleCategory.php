<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class ArticleCategory extends Model
{
    protected $fillable = ['name', 'slug', 'parent_id', 'seo_title' , 'seo_keyword' ,'seo_description'];
    protected $guarded = ['id', 'lft', 'rgt'];
    use NodeTrait;

    public function getLftName()
    {
        return 'lft';
    }

    public function getRgtName()
    {
        return 'rgt';
    }

    public function getParentIdName()
    {
        return 'parent_id';
    }

// Specify parent id attribute mutator
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }
}
