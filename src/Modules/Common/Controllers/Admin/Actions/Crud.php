<?php

namespace Modules\Common\Controllers\Admin\Actions;

use Illuminate\Http\Request;

trait Crud
{
    use Helpers;

    protected function store(Request $request)
    {
        $data = $this->formRequest ? app($this->formRequest)->validated() : $request->all();

        $model = $this->model->create($data);

        $this->setImages($model);

        $this->syncActions($model);

        return $this->successfullResponse();
    }



    protected function update(Request $request, $id)
    {
        $data = $this->formRequest ? app($this->formRequest)->validated() : $request->all();

        $this->model = $this->model->findOrFail($id);
        $this->model->update($data);

        $this->setImages($this->model);

        $this->syncActions($this->model);

        return $this->successfullResponse();
    }

    public function destroy($id)
    {
        $this->model->findOrFail($id)->delete();

        return $this->successfullResponse();
    }
}
