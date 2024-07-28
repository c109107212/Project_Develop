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
        // 能接受帶入的值
        $bindvalues = [
            "user_code" => null,
            "user_name" => null,
            "user_account" => null,
            "user_password" => null
        ];

        foreach ($bindvalues as $key => $value) {
            if (array_key_exists($key, $params)) {
                $bindvalues[$key] = $params[$key];
            } else {
                unset($bindvalues[$key]);
            }
        }

        $condition = "";
        $condition_values = [
            "user_code" => " AND user_code = :user_code",
            "user_name" => " AND user_name = :user_name",
            "user_account" => " AND user_account = :user_account",
            "user_password" => " AND user_password = :user_password",

        ];

        foreach ($condition_values as $key => $value) {
            if (array_key_exists($key, $params)) {
                $condition .= $value;
            } else {
                unset($bindvalues[$key]);
            }
        }
        $sql_default = "SELECT *
                        FROM demo.user ";

        // 放置條件
        $sql_default = "SELECT *
                        FROM(
                            {$sql_default}
                        )dt
                        WHERE TRUE {$condition}
                        ";

        $result = DB::select($sql_default, $bindvalues);

        return $result;
    }
    public function postData($data)
    {
        return $data;
    }
}
