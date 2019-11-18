<?php

namespace App\Http\Controllers\Backend;

use PHPUnit\Util\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;
use App\Models\AdminLogHistory;
use App\Traits\AdminLogsTraits;

class LoginHistoryController extends Controller
{
    // ----------------------------------------------------------------------
    use AdminLogsTraits;

    /**
     * first create route in web.php
     * and point to this method
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(){
        $history = AdminLogHistory::all();
        return Datatables::of($history)->addColumn('action', function($history){
            return '<div class="btn-group"><a title="Delete History" href="" data-remote="' . route('admin.histories.destroy', ['history' => $history->id]) . '" class="btn btn-warning deleteHistory"><i class="fas fa-trash"></i></a></div>';
        })->editColumn('id', '{{$id}}')->make(true);
    }

    /**
     * Admin Logs history index view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data['page_title'] = __('label.historyLog');
        return view('backend.history.index', $data);
    }

    /**
     * Only Show index data
     * @param $param
     * @return Json
     */
    public function show(){
        $data['page_title'] = __('label.historyLog');
        return view('backend.history.index', $data);
    }

    /**
     * Notification handle by js on viewTemplate
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $entry = AdminLogHistory::findOrFail($id);
        $entry->delete();
        return redirect()->route('admin.histories.index');
    }
}
