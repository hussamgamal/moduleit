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
        $user =  auth('admin')->user() ?? auth()->user();

        $links = null;
        $arr = [];

        if (!$links) {
            $links = self::getLinks();
            if (!$user->hasRole('Super Admin')) {
                $permissions = $user->getAllPermissions()->pluck('name')->toArray();

                foreach ($links as $title => $sub_links) {
                    foreach ($sub_links as $key => $len) {
                        $lists = (array) $len;

                        if (@$len->childs) {
                            $childLists = (array) $len->childs;
                            foreach ($childLists as $childKey => $child) {
                                if (!in_array('admin.' . $child->link, $permissions)) {
                                    unset($sub_links[$key]->childs[$childKey]);
                                }
                                if (count($sub_links[$key]->childs) == 0) {
                                    unset($sub_links[$key]);
                                }
                            }
                        } else {
                            if (!in_array('admin.' . @$len->link, $permissions)) {
                                unset($sub_links[$key]);
                            }
                        }

                        if (count($sub_links)) {
                            $arr[$title] = $sub_links;
                        } else {
                            unset($arr[$title]);
                        }
                    }
                }
            } else {
                $arr = $links;
            }
            // Optional caching here if needed
            // Cache::tags('cachedSidebar')->put('sidebar-' . $user->id, $arr);
        }

        return $arr;
    }
}
