<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Traits\LogActivityTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    use LogActivityTrait;

    public function __construct(){
    }

    protected function validator( array $data, $type ){
        return Validator::make($data, [
            'company_name'  => 'required|string|max:50',
            'post_code'     => 'required|max:7|min:5',
            'address'       => 'required|max:100|min:5',
            'phone'         => 'required|max:20|min:5',
        ]);
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

            $model = Company::query();
            return DatatablesHelper::json($model, true, true, null, ['current_nest' => 'user', 'style' => 'success', 'icon' => 'users']);

        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.company');
        return view('backend.company.index', $data);
    }

    public function create(){
        $data['item']       = new Company();
        $data['page_title'] = __('label.add') . ' ' . __('label.company');
        $data['form_action']= route('admin.company.store');
        $data['page_type']  = 'create';

        return view('backend.company.form', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();

        $new = new Company();
        $new->fill($data)->save();
        return redirect()->route('admin.company.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
    }

    public function edit($id){
        $data['item']           = Company::find($id);

        $data['page_title']     = __('label.edit') . ' ' . __('label.company');
        $data['form_action']    = route('admin.company.update', $id);
        $data['page_type']      = 'edit';

        return view('backend.company.form', $data);
    }

    public function update(Request $request, $id){
        $data               = $request->all();
        $this->validator($data, 'update')->validate();

        $currentAdmin       = Company::find($id);
        $currentAdmin->update($data);

        return redirect()->route('admin.company.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($id){
        $item = Company::findOrFail($id);
        $item->delete();

        $this->saveLog('Delete Company', 'Delete Company, Name : ' . $item->company_name . '', Auth::user()->id);

        return 1;
    }
}
