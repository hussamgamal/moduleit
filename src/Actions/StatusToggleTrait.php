<?php
namespace MshMsh\Actions;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use MshMsh\Helpers\ApiResponder;


trait StatusToggleTrait
{

    /**
     * Toggles the status of a model instance.
     *
     * @param Request $request The HTTP request object.
     * @param string $modelClass The fully qualified name of the model class.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating the status of the operation.
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the model instance is not found.
     */

    public function toggleStatus(Request $request, $modelClass)
    {
        try {
            // Find the model instance by its ID
            $model = $modelClass::findOrFail($request->id);
            // Toggle the status of the model instance
            $model->update(['status' => !$model->status]);
            // Return a success response
            return ApiResponder::get('', ['status' => 1]);

        } catch (ModelNotFoundException $e) {
                 return ApiResponder::get('Model not found', ['status' => 0], 404);
        } catch (\Exception $e) {
                 return ApiResponder::get('An error occurred', ['status' => 0], 500);
        }
    }
}
