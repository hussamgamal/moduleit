<?php

namespace Modules\Common\Controllers\Admin\Actions;

trait Form{

    public function create()
    {
        $this->formBuilder();
        $this->treeViewBuilder();

        $this->method = 'post';
        $this->action = route("admin." . $this->name . ".store");
        $this->model->code = ($this->model->latest()->first()->id ?? 0) + 10001;
        return view('Common::admin.form', get_object_vars($this));
    }

    public function edit($id)
    {
        $this->model = $this->model->findOrFail($id);
        $this->formBuilder();
        $this->treeViewBuilder();

        $this->method = 'put';
        $this->action = route("admin." . $this->name . ".update", $id);
        return view('Common::admin.form', get_object_vars($this));
    }

    public function formBuilder()
    {
    }
}
