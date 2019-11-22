<?php
namespace App\Helpers;

use DataTables;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class DatatablesHelper
{
    /**
     * @param object $eloquent
     * @param bool $edit - is edit button will included
     * @param bool $delete - is delete button will included
     * @param string $custom - custom HTML <a> Buttons
     *
     * @return string json - pagination, search etc. processed by Yajra Datatable package
     */
    public static function json($eloquent, $edit = true, $delete = true, $custom = null) {

        return Datatables::eloquent($eloquent)
                            ->addColumn('action', function($query) use($edit, $delete, $custom){
                                $routeCurrent   = Route::currentRouteName();
                                $routeEdit      = str_replace('show', 'edit', $routeCurrent);
                                $routeDestroy   = str_replace('show', 'destroy', $routeCurrent);

                                $buttons = [];
                                if(!empty($custom)){
                                    $buttons[] = $custom;
                                }
                                if(!empty($edit)){
                                    $buttons[] = '<a title="Edit Data" href="' . URL::route($routeEdit, $query->id) . '" class="btn btn-info"><i class="fas fa-edit"></i></a>';
                                }
                                if(!empty($delete)){
                                    $buttons[] = '<a title="Delete Data" href="" data-remote="' . URL::route($routeDestroy, $query->id) . '" class="btn btn-danger deleteData"><i class="fas fa-trash"></i></a>';
                                }

                                $render = "";
                                if(count($buttons) > 0){
                                    $render .= '<div class="btn-group">';
                                    foreach ($buttons as $button){
                                        $render .= $button;
                                    }
                                    $render .= '</div>';
                                }
                                return $render;
                            })
                            ->editColumn('id', '{{$id}}')
                            ->toJson();
    }
}
