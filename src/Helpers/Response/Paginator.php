<?php

namespace MshMsh\Helpers\Response;

class Paginator
{

    /**
     * Check if data is paginated or has specific object has paginations
     *
     */
    public static function finalResponse($response)
    {
        $data = $response['data'];
        if (is_array($data)) {
            foreach ($data as $key => $row) {
                $pagination = self::getPaginationObject($row);
                if ($pagination) {
                    $response['pagination'] = $pagination;
                    try {
                        $response['data'][$key] = $row->toArray()['data'];
                    } catch (\Throwable $th) {
                        //throw $th;
                        $response['data'][$key] = $row;
                    }
                }
            }
        } else {
            $pagination = self::getPaginationObject($data);
            if ($pagination) {
                $response['pagination'] = $pagination;
            }
        }
        return $response;
    }

    /**
     * Check if data has pagination methods 
     * then return object with specific keys
     */
    static function getPaginationObject($model)
    {
        if (is_object($model)) {
            $query_paramters = request()->query();
            unset($query_paramters['page']);
            $query_paramters = http_build_query($query_paramters);
            try {
                $pagnation['total'] = $model->total();
                $pagnation['lastPage'] = $model->lastPage();
                $pagnation['total_pages'] = $model->lastPage();
                $pagnation['perPage'] = $model->perPage();
                $pagnation['currentPage'] = $model->currentPage();
                $pagnation['next_page_url'] = ($url = $model->nextPageUrl()) ? $url . '&' . $query_paramters : null;
                $pagnation['prev_page_url'] = ($url = $model->previousPageUrl()) ? $url . '&' . $query_paramters : null;
                return $pagnation;
            } catch (\Throwable $e) {
            }
        }
        return null;
    }
}
