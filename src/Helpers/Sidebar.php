<?php

namespace MshMsh\Helpers;

use Illuminate\Support\Facades\Cache;

class Sidebar
{
    static function getLinks()
    {
        $sidebarFiles = glob(base_path("Modules/**/Views/admin/sidebar.json"));
        $links = [];
        foreach ($sidebarFiles as $file) {
            $fileLinks = (array) json_decode(file_get_contents($file));
            foreach ($fileLinks as $sectionTitle => $sectionLinks) {
                $sectionLinks = (array) $sectionLinks;
                if (isset($links[$sectionTitle])) {
                    $links[$sectionTitle] = array_merge($links[$sectionTitle], $sectionLinks);
                } else {
                    $links[$sectionTitle] = $sectionLinks;
                }
            }
        }
        return $links;
    }

    static function list($guard = 'admin')
    {
        // $links = env('CacheSidebar') ? Cache::tags('cachedSidebar')->get('sidebar-' . auth('admin')->id()) : null;
        $links = null;
        $arr = [];
        if (!$links) {
            $links = self::getLinks();
            $role = auth($guard)->user()->roles->first();
            if($role->name != 'Super Admin'){
                $permissions = $role->permissions->pluck('name')->toArray();
                foreach ($links as $title => $sub_links) {
                    $arr[$title] = [];
                    foreach ($sub_links as $len) {
                        $lists = json_decode(json_encode($len),true);
                        $linkList = \Arr::pluck($lists,'link');
                        foreach ($linkList as $link){
                            if (in_array($link, $permissions)) {
                                $arr[$title][] = json_encode(\Arr::first(\Arr::where($lists,function ($q) use ($link){
                                    return @$q['link'] == @$link;
                                })));
                            }
                        }
                    }
                }
            }else{
                $arr = $links;
            }

            // Cache::tags('cachedSidebar')->get('sidebar-' . auth('admin')->id(), $links);
        }
        return $arr;
    }
}
