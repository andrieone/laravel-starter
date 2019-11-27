<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
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
            'allow_login'   => 'required|in:0,1',
            'display_name'  => 'required|string|max:100',
            'email'         => 'required|email|max:255|unique:admins,email' . ($type == 'update' ? ','.$data['id'] : ''),
            'password'      => $type == 'create' ? 'string|min:8|max:255' : 'string|min:8|max:255',
        ]);
    }

    /**
     * @param string parameter - url of custom resources page
     *
     * @return string - Any
     *
     * You may add custom page/api/route, this wrapped middleware as well
     */
    public function show( Request $request ){
        // because this is nested resource, there are 2 prams:
        // param for parent ($request->company) and current ($request->user)
        if( $request->user == 'json' ){

            $model = User::where('company_id', $request->company);
            return DatatablesHelper::json($model, true, true, null, null, $request->company);

        }
        abort(404);
    }

    public function index(Request $request){
        $data['parent_id']  = $request->company;
        $data['page_title'] = __('label.user');
        return view('backend.user.index', $data);
    }

    public function create(Request $request){
        $data['parent_id']  = $request->company;
        $data['item']       = new User();
        $data['page_title'] = __('label.add') . ' ' . __('label.user');
        $data['form_action']= route('admin.company.user.store', $request->company);
        $data['page_type']  = 'create';

        return view('backend.user.form', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();
        $data['admin_role_id']  = 3;
        $data['password']       = !empty($data['password']) ? bcrypt($data['password']) : '';
        $new = new User();
        $new->fill($data)->save();
        return redirect()->route('admin.admins.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
    }

    public function edit($parent_id, $id){
        $data['parent_id']      = $parent_id;

        $data['item']           = User::find($id);

        $data['page_title']     = __('label.edit') . ' ' . __('label.user');
        $data['form_action']    = route('admin.company.user.update', [$parent_id, $id]);
        $data['page_type']      = 'edit';

        return view('backend.user.form', $data);
    }

    public function update(Request $request, $id){
        $data               = $request->all();
        $currentData        = User::find($id);
        $data['password']   = !empty($data['password']) ? $data['password'] : $currentData['password'];
        $data['id']         = $id;
        $this->validator($data, 'update')->validate();

        if(Hash::needsRehash($data['password']) && !empty($data['password'])){
            $data['password'] = bcrypt($data['password']);
        }

        $currentData->update($data);

        return redirect()->route('admin.company.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($parent_id, $id){
        $item = User::findOrFail($id);
        $item->delete();
        
        $this->saveLog('Delete User', 'Delete User, Email : ' . $item->email . '', Auth::user()->id);

        return 1;
    }

}
