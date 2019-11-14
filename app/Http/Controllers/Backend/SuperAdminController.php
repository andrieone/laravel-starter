<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SuperAdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    protected function validator(array $data, $type) {
        return Validator::make($data, [
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|string|max:255|unique:admins,email,1',
            'password'      => $type == 'create' ? 'required|string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    public function json(){
        $admin = admin::select('*');
        return Datatables::of($admin)
            ->addColumn('action', function ($admin) {
                return '<div class="btn-group">
                         <a title="Edit Superadmin" href="'.route('admin.super-admin.edit', ['super_admin' => $admin->id]).'" class="btn btn-success"><i class="fas fa-eye"></i></a>
                         <a title="Edit Admin" href="'.route('admin.admins.edit', ['admin' => $admin->id]).'" class="btn btn-info"><i class="fas fa-eye"></i></a>
                         <a title="Delete Admin" href="'.route('admin.admins.destroy', ['admin' => $admin->id]).'" class="btn btn-danger"><i class="fas fa-trash"></i></a></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            ->editColumn('id', '{{$id}}')
            ->make(true);
    }

    public function index() {
        $data['page_title']         = __('label.superAdmin');
        // $data['json_path']          = route('admin.super-admin.show', 'json');
        return view('backend.superadmin.index', $data);
    }

    // public function show($param, Request $request) {
    //     switch ($param) {
    //         case "json":
    //             $this->tabulatorObject  = Admin::where('admin_role_id', 1);
    //             $data                   = $this->tabulatorAjaxHandler($request, ['office:id,name', 'adminRole:id,display_name'], 0, 0);
    //             return response()->json($data);
    //     }
    //     abort(404);
    // }

    public function edit($id) {
        $data['item']           = Admin::find($id);
        $data['page_title']     = __('label.superAdmin');
        $data['form_action']    = ['admin.super-admin.update', $id];
        $data['page_type']      = 'edit';

        return view('backend.superadmin.form', $data);
    }

    // public function update(Request $request, $id) {
    //     $data = $request->all();
    //     $currentAdmin = Admin::find($id);
    //     $data['password'] = !empty($data['password']) ? $data['password'] : $currentAdmin['password'];
    //
    //     $this->validator($data, 'update')->validate();
    //
    //     if (Hash::needsRehash($data['password'])) {
    //         $data['password'] = bcrypt($data['password']);
    //     }
    //
    //     $currentAdmin->update($data);
    //
    //     return redirect()->route('admin.super-admin.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    // }
}
