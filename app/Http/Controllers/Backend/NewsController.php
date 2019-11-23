<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\DatatablesHelper;
use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function __construct(){
    }

    protected function validator( array $data, $type ){
        return Validator::make($data, [
            'title'         => 'required|string|max:100',
            'body'          => 'required|string|max:255',
            'image'         => 'image|mimes:jpeg,bmp,png,jpg|max:1024',
            'publish_date'  => 'date',
            'status'        => 'required|in:draft,publish',
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

            $model = News::query();
            return DatatablesHelper::json($model);

        }
        abort(404);
    }

    public function index(){
        $data['page_title'] = __('label.news');
        return view('backend.news.index', $data);
    }

    public function create(){
        $data['item']       = new News();
        $data['page_title'] = __('label.add') . ' ' . __('label.news');
        $data['form_action']= route('admin.news.store');
        $data['page_type']  = 'create';

        return view('backend.news.form', $data);
    }

    public function store(Request $request){
        $data = $request->all();
        $this->validator($data, 'create')->validate();

        $data['image']    = $this->uploadImage( $request->file('image') );
        $data['admin_id']  = Auth::user()->id;

        $new = new News();
        $new->fill($data)->save();
        return redirect()->route('admin.news.index')->with('success', config('const.SUCCESS_CREATE_MESSAGE'));
    }

    public function edit($id){
        $data['item']           = News::find($id);

        $data['page_title']     = __('label.edit') . ' ' . __('label.news');
        $data['form_action']    = route('admin.news.update', $id);
        $data['page_type']      = 'edit';

        return view('backend.news.form', $data);
    }

    public function update(Request $request, $id){
        $data               = $request->all();
        $currentAdmin       = News::find($id);
        $this->validator($data, 'update')->validate();
        $currentAdmin->update($data);

        return redirect()->route('admin.news.edit', $id)->with('success', config('const.SUCCESS_UPDATE_MESSAGE'));
    }

    public function destroy($id){
        $item = News::findOrFail($id);
        $admin_email = $item->email;
        $admin_id = Auth::user(0);
        if($item->adminRole->name == 'admin'){
            $item->delete();
            $this->saveLogsHistory('Delete Admin', 'Delete Admin Email : ' . $admin_email . '', $admin_id); // @TODO: This function not exist
            return redirect()->route('admin.news.index')->with('success', config('const.SUCCESS_DELETE_MESSAGE'));
        }
        return redirect()->route('admin.news.index')->with('error', config('const.FAILED_DELETE_MESSAGE'));
    }
}
