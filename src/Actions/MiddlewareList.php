<?php

namespace MshMsh\Actions;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Route;
use MshMsh\Helpers\PermissionsList;

trait MiddlewareList
{
    public static function middleware(): array
    {
        $arr = [];
        $roleLists = json_decode(json_encode(PermissionsList::list()),true);
        $roleLists = \Arr::where($roleLists,function ($q){
            return \Arr::where($q, function ($item) {
                return $item['route'] == Route::getCurrentRoute()->getName();
            });
        });
        foreach ($roleLists as $roleList) {
            foreach ($roleList as $value) {
                if($value['route'] == Route::getCurrentRoute()->getName()){
                    $arr[] = new Middleware('permission:'. $value['route'], only: [ltrim(strstr(Route::getCurrentRoute()->getActionName(),'@'),'@')]);
                }
            }
        }
        return $arr;
    }
}
