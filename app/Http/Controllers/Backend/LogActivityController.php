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
            $model = LogActivity::with('admin');

            return (new DatatablesHelper)->instance($model, false, false)
                                            ->filterColumn('admin.display_name', function($query, $keyword){
                                                $query->whereHas('admin', function($q) use ($keyword){
                                                    $q->where('display_name', 'like', '%'.$keyword.'%');
                                                });
                                            })
                                            ->filterColumn('admin.email', function($query, $keyword){
                                                $query->whereHas('admin', function($q) use ($keyword){
                                                    $q->where('email', 'like', '%'.$keyword.'%');
                                                });
                                            })
                                            ->toJson();
        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.log_activity');
        return view('backend.logactivity.index', $data);
    }
}
