<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class DemoModel extends Model
{
    use HasFactory;

    public function getData($params)
    {
        
        $getvalues = [
            "birth" => null,
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
            "birth" => " AND birth = :birth",
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
    protected $fillable = ['id','birth', 'user_name', 'user_account', 'user_password'];
    public function postData($data)
    {
        
        $sql = "INSERT INTO student (birth, user_name, user_account, user_password) VALUES (:birth, :user_name, :user_account, :user_password)";
        
        $result = DB::insert($sql, [
            'birth' => $data['birth'],
            'user_name' => $data['user_name'],
            'user_account' => $data['user_account'],
            'user_password' => $data['user_password'], 
        ]);
    
        return $result; 
    }

    
}
