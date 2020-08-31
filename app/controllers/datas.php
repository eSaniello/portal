<?php

namespace Controllers;

use Models\Data;

class Datas
{
    public static function get_data_by_uid($user_id)
    {
        $data = Data::where("user_id", $user_id)->get();
        return $data;
    }

    public static function get_data_by_id($id)
    {
        $data = Data::where("id", $id)->get();
        return $data;
    }

    public static function add_data($user_id, $number, $code, $start_date, $end_date, $num1, $percent, $num2, $expiry_date)
    {
        $data = Data::create([
            'user_id' => $user_id, 'number' => $number, 'code' => $code, 'start_date' => $start_date, 'end_date' => $end_date,
            'num1' => $num1, 'percent' => $percent, 'num2' => $num2, 'expiry_date' => $expiry_date
        ]);
        return $data;
    }


    public static function delete($id)
    {
        $data = Data::find($id);
        $data->delete();

        return $data;
    }

    public static function update($id, $number, $code, $start_date, $end_date, $num1, $percent, $num2, $expiry_date)
    {
        $data = Data::find((int)$id)->update([
            'number' => $number, 'code' => $code, 'start_date' => $start_date, 'end_date' => $end_date,
            'num1' => $num1, 'percent' => $percent, 'num2' => $num2, 'expiry_date' => $expiry_date
        ]);

        return $data;
    }
}
