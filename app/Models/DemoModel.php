<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DemoModel extends Model
{
    use HasFactory;

    public function getData($params)
    {
        
        $getvalues = [
            "birthday" => null,
            "user_name" => null,
            "user_account" => null,
            "user_password" => null
        ];

        foreach ($getvalues as $key => $value) {
            if (array_key_exists($key, $params)) {
                $getvalues[$key] = $params[$key];
            } else {
                unset($getvalues[$key]);
            }
        }

        $condition = "";
        $condition_values = [
            "birthday" => " AND birthday = :birthday",
            "user_name" => " AND user_name = :user_name",
            "user_account" => " AND user_account = :user_account",
            "user_password" => " AND user_password = :user_password",

        ];

        foreach ($condition_values as $key => $value) {
            if (array_key_exists($key, $params)) {
                $condition .= $value;
            } else {
                unset($getvalues[$key]);
            }
        }
        $sql_default = "SELECT *
                        FROM `student` ";
        $sql_default = "SELECT *
                        FROM(
                            {$sql_default}
                        )dt
                        WHERE TRUE {$condition}
                        ";

        $result = DB::select($sql_default, $getvalues);

        return $result;
    }
    public function postData($data)
    {
        $data = $request->all();

        // 顯示資料（這裡僅作為示例，你可以根據需求進行處理）
        return response()->json([
            'received_data' => $data
        ]);
        return $result;
    }
}
