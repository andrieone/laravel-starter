<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\AdminLogsTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SuperAdminController extends Controller
{
    use AdminLogsTraits;

    protected function validator(array $data, $type){
        return Validator::make($data, [
            'display_name' => 'required|string|max:100',
            'email'        => 'required|string|max:255|unique:admins,email,1',
            'password'     => $type == 'create' ? 'required|string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    public function json(){
        $admin = admin::where('admin_role_id', 1);
        return Datatables::of($admin)->addColumn('action', function($admin){
                return '<div class="btn-group">
                         <a title="Edit Super Admin" href="' . route('admin.super-admin.edit', ['super_admin' => $admin->id]) . '" class="btn btn-info"><i class="fas fa-eye"></i></a>
                         <a title="Delete Super Admin" href="" data-remote="' . route('admin.super-admin.destroy', ['super_admin' => $admin->id]) . '" class="btn btn-warning deleteAdmin"><i class="fas fa-trash"></i></a></div>';
            })->editColumn('id', '{{$id}}')->make(true);
    }

    public function index(){
        $data['page_title'] = __('label.superAdmin');
        return view('backend.superadmin.index', $data);
    }

    public function show(){
        $data['page_title'] = __('label.admin');
        return view('backend.superadmin.index', $data);
    }

    public function edit($id){
        $data['item'] = Admin::find($id);
        $data['page_title'] = __('label.edit') . ' ' . __('label.superAdmin');
        $data['form_action'] = ['admin.super-admin.update', $id];
        $data['page_type'] = 'edit';

        return view('backend.superadmin.form', $data);
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

        return redirect()->route('admin.super-admin.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    }

    public function create(){
        $data['item'] = new Admin();
        $data['page_title'] = __('label.add') . ' ' . __('label.superAdmin');
        $data['form_action'] = 'admin.super-admin.store';
        $data['page_type'] = 'create';
        return view('backend.superadmin.form', $data);
    }

    public function store(Request $request){
        try{
            $data = $request->all();
            $this->validator($data, 'create')->validate();
            $data['password'] = bcrypt($data['password']);
            $data['admin_role_id'] = 1; // Super Admin
            $new = new Admin();
            $new->fill($data)->save();
            return redirect()->route('admin.super-admin.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
        }catch(\Exception $e){
            return redirect()->route('admin.super-admin.index')->with('error', config('const.FAILED_CREATE_MESSAGE'));
        }
    }

    public function destroy($id){
        $superAdmin = Admin::findOrFail($id);
        $admin_email = $superAdmin->email;
        $admin_id = Auth::user(0);
        if($superAdmin->adminRole->name == 'super_admin'){
            $superAdmin->delete();
            // Save log Activity
            $this->saveLogsHistory('Delete Super Admin', 'Delete Super Admin Email : ' . $admin_email . '', $admin_id);
            return redirect()->route('admin.super-admin.index')->with('success', config('const.SUCCESS_DELETE_MESSAGE'));
        }
        return redirect()->route('admin.super-admin.index')->with('error', config('const.FAILED_DELETE_MESSAGE'));
    }
}
