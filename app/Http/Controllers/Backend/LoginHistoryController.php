<?php

namespace App\Http\Controllers\Backend;

use PHPUnit\Util\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\AdminLogs;
use App\Traits\AdminLogsTraits;

class LoginHistoryController extends Controller
{
    // ----------------------------------------------------------------------
    use AdminLogsTraits;
    // ----------------------------------------------------------------------

    /**
     * Get named route depends on which user is logged in
     */
    private function getRoute() {
        return Auth::guard('admin')->check() ? 'admin' : '';
    }

    /**
     * Display a listing of the resource. For admin.
     * @return \Illuminate\Http\Response
     */
    public function LoginHistoriesAdmin() {
        return view('backend.histories.index', [
            'route' => $this->getRoute()
        ]);
    }

    /**
     * first create route in web.php
     * and point to this method
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(){
        $history = AdminLogs::all();
        return Datatables::of($history)->addColumn('action', function($history){
            return '<div class="btn-group"><a title="Delete History" href="" data-remote="' . route('admin.histories.destroy', ['history' => $history->id]) . '" class="btn btn-danger deleteHistory"><i class="fas fa-trash"></i></a></div>';
        })->editColumn('id', '{{$id}}')->make(true);
    }

    // Admin Logs history view
    public function index() {
        $data['page_title'] = __('label.historyLog');
        return view('backend.history.index', $data);
    }

    /**
     * API focused to external communication
     * use show() to help tabulator js to get items
     * no need to create API to internal usage
     * @param $param
     * @return Json
     */
    public function show(Request $request, $param) {
        switch ($param) {
            case "json":
                $this->tabulatorObject = AdminLogs::leftJoin('places', 'admin_logs.country_id', '=', 'places.id')
                    ->select('admin_logs.*', 'places.label_en');
                // $this->tabulatorObject = Place::select('*')->pluck('label_en', 'id');
                $data = $this->tabulatorAjaxHandler($request, ['admin'], 0, 1);
                return response()->json($data);
        }
        // ------------------------------------------------
        abort(404);
    }

    // Super admin delete log history
    public function destroy($id) {
        $entry = AdminLogs::findOrFail($id);
        $entry->delete();
        // ------------------------------------------------
        return redirect()
            ->route('admin.histories.index')
            ->with('success', config('const.SUCCESS_DELETE_MESSAGE'));
    }
}
