<?php

namespace MshMsh\Actions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


trait SortableTrait
{
    /**
     * Handle sorting for a given model.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $modelClass  The model class to update
     * @return void
     * @throws \InvalidArgumentException
     */
    public function handleSort(Request $request,  $modelClass)
    {
        // Validate that the provided class is an Eloquent model
        if (!is_subclass_of($modelClass, Model::class)) {
            throw new \InvalidArgumentException("The provided class is not a valid Eloquent model.");
        }

        // Retrieve and validate the sort data
        $data = $request->input('sort', []);
        if (!is_array($data)) {
            throw new \InvalidArgumentException("The 'sort' input must be an array.");
        }

        // Iterate over the data and update the model
        foreach ($data as $item) {
            if (!isset($item['id']) || !isset($item['sort'])) {
                continue; // Skip invalid items
            }
            $modelClass::where('id', $item['id'])->update(['sort' => $item['sort']]);
        }
    }
}
