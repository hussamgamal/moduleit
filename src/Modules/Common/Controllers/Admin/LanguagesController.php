<?php

namespace Modules\Common\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MshMsh\Helpers\ApiResponder;

class LanguagesController extends Controller
{

    public function index()
    {
        $title = "Translations";
        return view('Common::admin.languages.index', get_defined_vars());
    }

    public function editWords($slug)
    {
        $title = "Edit Translation";
        $words = \Arr::where(json_decode(file_get_contents(base_path().'/lang/'. $slug . '.json'),true),function($q,$key){
            return !\Str::contains($key,'app.');
        });
        return view('Common::admin.languages.editWords', get_defined_vars());
    }
    public function transInput(Request $request)
    {
        $lang = $request->lang;
        if (file_exists(base_path().'/lang/'. $lang .'.json')) {
            $default_lang_data = file_get_contents(base_path().'/lang/'.$lang .'.json');
            $default_lang_data = (array)json_decode($default_lang_data);
            $default_lang_data[$request->id] = $request->text;
            $default_lang_data = (object)$default_lang_data;
            $default_lang_data = json_encode($default_lang_data,JSON_UNESCAPED_UNICODE);
            file_put_contents(base_path().'/lang/'. $lang . '.json', $default_lang_data);
        }
        return ApiResponder::loaded();
    }
}
