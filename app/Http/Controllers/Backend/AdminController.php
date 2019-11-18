<?php

namespace App\Http\Controllers\Backend;

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

    //traits
    use AdminLogsTraits;

    public function __construct(){
    }

    protected function validator(array $data, $type){
        return Validator::make($data, [
            'display_name' => 'required|string|max:100',
            'email'        => 'required|string|max:255|unique:admins,email,1',
            'password'     => $type == 'create' ? 'required|string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    /**
     * first create route in web.php
     * and point to this method
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(){
        $admin = admin::select('*')->where('admin_role_id', 2);
        return Datatables::of($admin)->addColumn('action', function($admin){
            return '<div class="btn-group">
                         <a title="Edit Admin" href="' . route('admin.admins.edit', ['admin' => $admin->id]) . '" class="btn btn-info"><i class="fas fa-eye"></i></a>
                         <a title="Delete Admin" href="" data-remote="' . route('admin.admins.destroy', ['admin' => $admin->id]) . '" class="btn btn-warning deleteAdmin"><i class="fas fa-trash"></i></a></div>';
        })->editColumn('id', '{{$id}}')->make(true);
    }

    /**
     * admin index page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data['page_title'] = __('label.admin');
        return view('backend.admin.index', $data);
    }

    /**
     * edit
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $data['item'] = Admin::find($id);
        $data['page_title'] = __('label.edit') . ' ' . __('label.admin');
        $data['form_action'] = ['admin.admins.update', $id];
        $data['page_type'] = 'edit';

        return view('backend.admin.form', $data);
    }

    /**
     * Update
     * @param Request $request
     * @param         $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * create and send to store function
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(){
        $data['item'] = new Admin();
        $data['page_title'] = __('label.add') . ' ' . __('label.admin');
        $data['form_action'] = 'admin.admins.store';
        $data['page_type'] = 'create';
        return view('backend.admin.form', $data);
    }

    /**
     * storing data
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        try{
            $data = $request->all();
            $this->validator($data, 'create')->validate();
            $data['password'] = bcrypt($data['password']);
            $data['admin_role_id'] = 2; // Admin
            $new = new Admin();
            $new->fill($data)->save();
            return redirect()->route('admin.admins.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
        }catch(\Exception $e){
            return redirect()->route('admin.admins.index')->with('error', config('const.FAILED_CREATE_MESSAGE'));
        }
    }

    /**
     * show data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(){
        $data['page_title'] = __('label.admin');
        return view('backend.admin.index', $data);
    }

    /**
     * delete data
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id){
        $obj = Admin::findOrFail($id);
        $admin_email = $obj->email;
        $admin_id = Auth::user(0);
        if($obj->adminRole->name == 'admin'){
            $obj->delete();
            // Save logs
            $this->saveLogsHistory('Delete Admin', 'Delete Admin Email : ' . $admin_email . '', $admin_id);
            return redirect()->route('admin.admins.index')->with('success', config('const.SUCCESS_DELETE_MESSAGE'));
        }
        return redirect()->route('admin.admins.index')->with('error', config('const.FAILED_DELETE_MESSAGE'));
    }

}
