<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
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
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|email|max:255|unique:admins,email' . ($type == 'update' ? ','.$data['admin_id'] : ''),
            'password'      => $type == 'create' ? 'required|string|min:8|max:255' : 'string|min:8|max:255',

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
            switch (Auth::user()->admin_role_id){
                case 1:
                    $model = Company::query();
                    break;
                case 3:
                    $model = Company::where('admin_id', Auth::user()->id);
                    break;
            }
            return DatatablesHelper::json($model, true, true, null, ['current_nest' => 'user', 'style' => 'success', 'icon' => 'users']);

        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.company');
        $data['filter_select_columns'] = [
            'status' => [
                'pending' => 'pending',
                'active' => 'active',
                'block' => 'block',
            ]
        ];

        return view('backend.company.index', $data);
    }

    public function create(){
        $data['item']       = new Company();
        $data['item']->admin= new Admin();
        $data['page_title'] = __('label.add') . ' ' . __('label.company');
        $data['form_action']= route('admin.company.store');
        $data['page_type']  = 'create';

        return view('backend.company.form', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();

        $data['admin_role_id']  = 3; // Company Admin
        $data['password']       = bcrypt($data['password']);
        $admin = new Admin();
        $admin->fill($data)->save();

        $new = new Company();
        $new->admin_id = $admin->id;
        $new->fill($data)->save();

        return redirect()->route('admin.company.index')->with('success', __('label.SUCCESS_CREATE_MESSAGE'));
    }

    public function edit($id){
        $data['item']           = Company::with('admin')->where('companies.id', $id)->first();

        $data['page_title']     = __('label.edit') . ' ' . __('label.company');
        $data['form_action']    = route('admin.company.update', $id);
        $data['page_type']      = 'edit';

        return view('backend.company.form', $data);
    }

    public function update(Request $request, $id){
        $data               = $request->all();
        $currentCompany     = Company::find($id);
        $currentAdmin       = Admin::find($currentCompany->admin_id);
        $data['password']   = !empty($data['password']) ? $data['password'] : $currentAdmin['password'];
        $data['admin_id']   = $currentAdmin->id;

        $this->validator($data, 'update')->validate();

        if(Hash::needsRehash($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $currentCompany->update($data);
        $currentAdmin->update($data);

        return redirect()->route('admin.company.edit', $id)->with('success', __('label.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($id){
        $item = Company::findOrFail($id);
        $item->delete();

        $this->saveLog('Delete Company', 'Delete Company, Name : ' . $item->company_name . '', Auth::user()->id);

        return 1;
    }
}
