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
        if (!$links) {
            $links = self::getLinks();
            $roles = auth('admin')->user()->role->roles ?? [];
            foreach ($links as $title => $sub_links) {
                foreach ($sub_links as $ken => $len) {
                    if (!in_array($ken, $roles)) {
                        unset($sub_links[$ken]);
                    }
                }
                if (count($sub_links)) {
                    $links[$title] = $sub_links;
                } else {
                    unset($links[$title]);
                }
            }
            // Cache::tags('cachedSidebar')->get('sidebar-' . auth('admin')->id(), $links);
        }
        return $links;
    }
}
