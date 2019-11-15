<?php

namespace App\Traits;

use App\Models\AdminLogs;
use Carbon\Carbon;

trait AdminLogsTraits
{
    /**
     * saving admin logging to database.
     * @param $article
     * @param $detail
     * @param $admin
     */
    private function saveLogsHistory($article, $detail, $admin){
        $loginHistory = new AdminLogs;
        $loginHistory->admins_id = $admin->id;
        // $loginHistory->country_id = !empty(Place::find($admin->office_id)->id)?Place::find($admin->office_id)->id:Null;
        $loginHistory->activity = $article;
        $loginHistory->detail = $detail;
        $loginHistory->ip = request()->ip();
        $loginHistory->last_access = Carbon::now();
        $loginHistory->save();
    }
}
