<?php

namespace Modules\Pages\Controllers;

use Modules\Common\Controllers\Admin\HelperController;
use Modules\Pages\Models\Page;

class AdminController extends HelperController
{
    public function __construct()
    {
        $this->model = new Page();
        $this->title = "Pages";
        $this->name =  'pages';
        $this->list = ['title' => 'الاسم'];

        $this->langInputs = [
            'title' => ['title' =>  'عنوان الصفحة'],
            'content' => ['title' =>  'محتوي الصفحة', 'type' => 'editor']
        ];
        $this->inputs = [
            'type' => ['title' =>  'النوع', 'type' => 'select', 'values' => page_types()],
            'image' =>  ['title' => 'الصورة', 'type' => 'image' , 'empty' => 1]
        ];
    }
}
