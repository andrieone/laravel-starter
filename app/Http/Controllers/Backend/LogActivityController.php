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
            $model = LogActivity::select(['log_activities.*',
                                           'admins.email AS admins.email', // Adding `AS` is important for search and sorting
                                           'admins.display_name AS admins.display_name'])
                                ->leftJoin('admins', 'log_activities.admin_id', '=', 'admins.id');

            return DatatablesHelper::json($model, false, false);
        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.log_activity');
        return view('backend.logactivity.index', $data);
    }
}
