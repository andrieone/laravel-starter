<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\LogActivityTrait;
use DataTables;

class UserController extends Controller
{
    use LogActivityTrait;

    public function __construct(){
    }

    protected function validator( array $data, $type ){
        return Validator::make($data, [
            'user_role_id'  => 'required|exists:user_roles,id',
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|email|max:255|unique:users,email' . ($type == 'update' ? ','.$data['id'] : ''),
            'password'      => $type == 'create' ? 'string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    public function show( $parent_param, $param ){ // because this is nested resource, there are 2 prams:
        if( $param == 'json' ){

            $model = User::with(['userRole', 'company'])
                            ->where('company_id', $parent_param);
            return DatatablesHelper::json($model, true, true, null, null, $parent_param);

        }
        abort(404);
    }

    public function index($parent_id){
        $data['parent_id']      = $parent_id;
        $data['company_name']   = Company::find($parent_id)->company_name;
        $data['page_title']     = $data['company_name'] . ' ' . __('label.user') ;
        $data['filter_select_columns'] = [
            'user_roles' => UserRole::pluck('label', 'label')
        ];
        return view('backend.user.index', $data);
    }

    public function create($parent_id){
        $data['parent_id']  = $parent_id;
        $data['item']       = new User();
        $data['page_title'] = __('label.add') . ' ' . __('label.user');
        $data['form_action']= route('admin.company.user.store', $parent_id);
        $data['user_roles'] = UserRole::pluck('label', 'id')->all();
        $data['page_type']  = 'create';

        return view('backend.user.form', $data);
    }

    public function store($parent_id, Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();
        $data['password']       = !empty($data['password']) ? bcrypt($data['password']) : '';
        $data['company_id']     = $parent_id;
        $new                    = new User();
        $new->fill($data)->save();
        return redirect()->route('admin.company.user.index', $parent_id)->with('success', __('label.SUCCESS_CREATE_MESSAGE'));
    }

    public function edit($parent_id, $id){
        $data['parent_id']      = $parent_id;

        $data['item']           = User::find($id);

        $data['page_title']     = __('label.edit') . ' ' . __('label.user');
        $data['form_action']    = route('admin.company.user.update', [$parent_id, $id]);
        $data['user_roles']     = UserRole::pluck('label', 'id')->all();
        $data['page_type']      = 'edit';

        return view('backend.user.form', $data);
    }

    public function update($parent_id, $id, Request $request){
        $data               = $request->all();
        $currentData        = User::find($id);
        $data['password']   = !empty($data['password']) ? $data['password'] : $currentData['password'];
        $data['id']         = $id;
        $this->validator($data, 'update')->validate();

        if(Hash::needsRehash($data['password']) && !empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $currentData->update($data);

        return redirect()->route('admin.company.user.edit', [$parent_id, $id])->with('success', __('label.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($parent_id, $id){
        $item = User::findOrFail($id);
        $item->delete();
        
        $this->saveLog('Delete User', 'Delete User, Email : ' . $item->email . '', Auth::user()->id);

        return 1;
    }

    protected function userOwnerValidator( array $data, $type ){
        return Validator::make($data, [
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|email|max:255|unique:users,email' . ($type == 'update' ? ','.$data['id'] : ''),
            'password'      => $type == 'create' ? 'string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    public function editAsUserOwner(){
        $id                     = Auth::guard('user')->user()->id;

        $data['item']           = User::find( $id );

        $data['page_title']     = __('label.edit') . ' ' . __('label.user');
        $data['form_action']    = route('userowner-update');
        $data['page_type']      = 'edit';

        return view('backend.userowner.form', $data);
    }

    public function updateAsUserOwner(Request $request){
        $id             = Auth::guard('user')->user()->id;
        $user_role_id   = Auth::guard('user')->user()->user_role_id;

        $data               = $request->all();
        $currentData        = User::find($id);
        $data['password']   = !empty($data['password']) ? $data['password'] : $currentData['password'];
        $data['id']         = $id; // Secure id
        $data['user_role_id'] = $user_role_id; // Secure user_role_id
        $this->validator($data, 'update')->validate();

        if(Hash::needsRehash($data['password']) && !empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $currentData->update($data);

        return redirect()->back()->with('success', __('label.SUCCESS_UPDATE_MESSAGE'));
    }

}
