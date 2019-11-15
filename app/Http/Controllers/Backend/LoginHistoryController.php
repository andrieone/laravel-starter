<?php

namespace App\Http\Controllers\Backend;

use PHPUnit\Util\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\AdminLogs;

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

    // Admin Logs history view
    public function index() {
        // ------------------------------------------------------------------
        $data = new \stdClass;
        $data->page_title = __('label.log');
        $countries = Place::where('type', 'country')->get();
        $data->country_filters = array( '' => __('label.all'));
        foreach( $countries as $country ){
            $data->country_filters[ $country->label_en] = $country->label_en;
        }
        $data->json_path = route('admin.histories.show', 'json');
        // dd($data);
        return view('backend.histories.index', (array)$data);
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
