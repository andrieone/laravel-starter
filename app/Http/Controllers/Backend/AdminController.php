<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use App\Traits\AdminLogsTraits;

class AdminController extends Controller
{
    use AdminLogsTraits;

    public function __construct(){
    }

    protected function validator( array $data, $type ){
        return Validator::make($data, [
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|string|max:255|unique:admins,email,' . $type == 'update' ? ','.$data['id'] : '',
            'password'      => $type == 'create' ? 'required|string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    public function index(){
        $data['page_title'] = __('label.admin');
        return view('backend.admin.index', $data);
    }

    public function create(){
        $data['item'] = new Admin();
        $data['page_title'] = __('label.add') . ' ' . __('label.admin');
        $data['form_action'] = route('admin.admins.store');
        $data['page_type'] = 'create';

        return view('backend.admin.form', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();
        $data['admin_role_id']  = 2;
        $data['password']       = bcrypt($data['password']);
        $new = new Admin();
        $new->fill($data)->save();
        return redirect()->route('admin.admins.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
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

            $model = admin::where('admin_role_id', 2);
            return DatatablesHelper::json($model);

        }
        abort(404);
    }

    public function edit($id){
        $data['item']           = Admin::find($id);

        $data['page_title']     = __('label.edit') . ' ' . __('label.admin');
        $data['form_action']    = route('admin.admins.update', $id);
        $data['page_type']      = 'edit';

        return view('backend.admin.form', $data);
    }

    public function update(Request $request, $id){
        $data = $request->all();
        $currentAdmin = Admin::find($id);
        $data['password'] = !empty($data['password']) ? $data['password'] : $currentAdmin['password'];

        $this->validator($data, 'update')->validate();

        if(Hash::needsRehash($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $currentAdmin->update($data);

        return redirect()->route('admin.admins.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($id){
        $item = Admin::findOrFail($id);
        $admin_email = $item->email;
        $admin_id = Auth::user(0);
        if($item->adminRole->name == 'admin'){
            $item->delete();
            $this->saveLogsHistory('Delete Admin', 'Delete Admin Email : ' . $admin_email . '', $admin_id); // @TODO: This function not exist
            return redirect()->route('admin.admins.index')->with('success', config('const.SUCCESS_DELETE_MESSAGE'));
        }
        return redirect()->route('admin.admins.index')->with('error', config('const.FAILED_DELETE_MESSAGE'));
    }

}
