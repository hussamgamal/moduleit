<?php

namespace Modules\ModelName\Controllers;

use Modules\ModelName\Models\ModelName;

use Modules\Common\Controllers\Admin\HelperController;

class AdminController extends HelperController
{
    public function __construct()
    {
        $this->model = new ModelName();
        $this->rows = ModelName::whereNull('role_id');

        $this->title = "ModuleName";
        $this->name = 'module_name';
    }

    public function listBuilder()
    {
        $this->list = [
            'title' => 'العنوان',
            'content' => 'الوصف',
        ];
    }

    public function formBuilder()
    {
        $this->langInputs = [
            'title' => ['title' => 'العنوان '],
            'content' => ['title' => 'الوصف'],
        ];
        $this->inputs = [];
    }
}
