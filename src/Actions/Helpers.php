<?php

namespace MshMsh\Actions;

trait Helpers
{
    public function setImages($model)
    {
        if ($images = request('images')) {
            foreach ($images as $image) {
                $model->images()->create(['image' => $image]);
            }
        }
    }
    public function getGuard()
    {
        $guards = array_keys(config('auth.guards'));
        foreach($guards as $guard){
            if(auth()->guard($guard)->check()){
                return $guard;
            }
        }
    }
    public function syncActions($model)
    {
        foreach ($this->moreActions as $action) {
            $this->$action($model);
        }
    }

    public function successfullResponse($message = "Info saved successfully")
    {
        return response()->json(['url' => route('admin.' . $this->name . '.index', $this->queryParams()), 'message' => __($message)]);
    }
    public function failedfullResponse($message = "Info failed to saved")
    {
        return response()->json(['url' => route('admin.' . $this->name . '.index', $this->queryParams()), 'message' => __($message)]);
    }
}
