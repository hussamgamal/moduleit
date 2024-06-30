<?php

namespace Modules\Common\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = "home_sections";
    protected $fillable = ['type', 'title', 'content'];
    protected $casts = ['title' => 'array', 'content' => 'array'];
}
