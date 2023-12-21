<?php

namespace Modules\Common\Models;

class Section extends HelperModel
{
    protected $table = "home_sections";
    protected $fillable = ['type', 'title', 'content'];
    protected $casts = ['title' => 'array', 'content' => 'array'];
}
