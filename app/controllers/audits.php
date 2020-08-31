<?php

namespace Controllers;

use Models\Audit;

class Audits
{
    public static function get_audit_trail()
    {
        $audit = Audit::orderBy('created_at', 'asc')->get();
        return $audit;
    }

    public static function get_audit_by_uid($id)
    {
        $audit = Audit::where("user_id", $id)->get();
        return $audit;
    }

    public static function add_audit($user_id, $activity)
    {
        $audit = Audit::create(['user_id' => $user_id, 'activity' => $activity]);
        return $audit;
    }
}
