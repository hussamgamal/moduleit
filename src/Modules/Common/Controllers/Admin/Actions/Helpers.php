<?php

namespace MshMsh\Modules\Common\Controllers\Admin\Actions;

trait Helpers
{
    public function setImages($model)
    {
        if ($images = request('images')) {
            foreach ($images as $image) {
                $model->images()->create(['path' => $image]);
            }
        }
    }

    public function syncActions($model)
    {
        foreach ($this->more_actions as $action) {
            $this->$action($model);
        }
    }

    public function successfullResponse()
    {
        return response()->json(['url' => route('admin.' . $this->name . '.index', $this->query_params), 'message' => __("Info saved successfully")]);
    }
}
