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

    static function list()
    {
        // $links = env('CacheSidebar') ? Cache::tags('cachedSidebar')->get('sidebar-' . auth('admin')->id()) : null;
        $links = null;
        $arr = [];
        if (!$links) {
            $links = self::getLinks();
            $user = auth()->user();
            if(!$user->hasRole('Super Admin')){
                $permissions = $user->getAllPermissions()->pluck('name')->toArray();
                foreach ($links as $title => $sub_links) {
                    foreach ($sub_links as $len) {
                        $lists = (array) $len;
                        foreach ($lists as $key => $link){
                            if(@$link->childs){
                                $childLists = (array) $link->childs;
                                foreach($childLists as $childKey => $child){
                                    if (!in_array('admin.'.$child->link, $permissions)) {
                                        unset($childLists[$childKey]);
                                    }
                                }
                            }else{
                                if (!in_array('admin.'.@$link->link, $permissions)) {
                                    unset($lists[$key]);
                                }
                            }
                        }
                        if (count($lists)) {
                            $arr[$title] = $lists;
                        } else {
                            unset($arr[$title]);
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
