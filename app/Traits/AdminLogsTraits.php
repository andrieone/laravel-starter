<?php

namespace App\Traits;

use App\Models\AdminLogHistory;
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
        $loginHistory = new AdminLogHistory;
        $loginHistory->admins_id = $admin->id;
        $loginHistory->activity = $article;
        $loginHistory->detail = $detail;
        $loginHistory->ip = request()->ip();
        $loginHistory->last_access = Carbon::now();
        $loginHistory->save();
    }
}
