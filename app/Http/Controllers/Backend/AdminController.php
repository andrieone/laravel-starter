<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
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
        // return datatables(Admin::where('admin_role_id', 2))->toJson();
        $admin = admin::select('*')->where('admin_role_id', 2);
        return Datatables::of($admin)->addColumn('action', function($admin){
                return '<div class="btn-group">
                         <a title="Edit Admin" href="' . route('admin.admins.edit', ['admin' => $admin->id]) . '" class="btn btn-success"><i class="fas fa-eye"></i></a>
                         <a title="Delete Admin" href="' . route('admin.admins.destroy', ['admin' => $admin->id]) . '" class="btn btn-danger"><i class="fas fa-trash"></i></a></div>';
            })
            // ->editColumn('id', 'ID: {{$id}}')
            ->editColumn('id', '{{$id}}')->make(true);
    }

    public function index(){
        // $data['page_title'] = trans('label.admin');
        $data['page_title'] = __('label.admin');
        return view('backend.admin.index', $data);
    }
}
