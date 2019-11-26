<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\LogActivity;

class LogActivityController extends Controller
{
    public function __construct(){
    }

    /**
     * @param string parameter - url of custom resources page
     *
     * @return string - Any
     *
     * You may add custom page/api/route, this wrapped middleware as well
     */
    public function show( $param ){
        if( $param == 'json' ){

            $model = LogActivity::query();
            return DatatablesHelper::json($model, false, false);
        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.news');
        return view('backend.logactivity.index', $data);
    }
}
