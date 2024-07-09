<?php

namespace MshMsh\Helpers;

use Illuminate\Support\Facades\Auth;

class PermissionsList
{
    static function getLinks($view)
    {
        $permissionFiles = glob(base_path("Modules/".$view."/Views/permission.json"));
        $permissions = [];
        foreach ($permissionFiles as $file) {
            $fileLinks = (array) json_decode(file_get_contents($file));
            foreach ($fileLinks as $sectionTitle => $sectionLinks) {
                $sectionLinks = (array) $sectionLinks;
                if (isset($permissions[$sectionTitle])) {
                    $permissions[$sectionTitle] = array_merge($permissions[$sectionTitle], $sectionLinks);
                } else {
                    $permissions[$sectionTitle] = $sectionLinks;
                }
            }
        }
        return $permissions;
    }

    static function list($guard = 'admin',$view = "**")
    {
        $links = self::getLinks($view);
        foreach ($links as $title => $sub_links) {
            foreach ($sub_links as $ken => $len) {
                if ($ken != $guard) {
                    unset($sub_links[$ken]);
                }
            }
            if (count($sub_links)) {
                $links[$title] = $sub_links[$ken];
            } else {
                unset($links[$title]);
            }
        }
        return $links;
    }

}
