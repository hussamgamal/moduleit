<?php

namespace Modules\Common\Controllers;

use Modules\Common\Models\Section;

class SectionsController extends HelperController
{

    public function __construct()
    {
        $this->model = new Section();
        $this->title = "Home Content";
        $this->name =  'home_sections';
        $this->list = ['type' => 'النوع', 'title' => 'العنوان'];
        $this->langInputs = [
            'title'  =>  ['title' => 'العنوان'],
            'content' => ['title' =>  'الحتوي', 'type'  =>  'editor']
        ];
        $types = [
            'about'    =>  'من نحن',
        ];
        $this->inputs = [
            'type'  =>  ['title'    =>  'النوع', 'type' => 'select', 'values' => $types]
        ];
        $this->can_delete = false;
    }
}
