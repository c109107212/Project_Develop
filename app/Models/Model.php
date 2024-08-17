<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdamModel extends Model
{
    use HasFactory;

    // 查詢資料
    public function getClusterData($params)
    {
        // 預設值設置
        $getvalues = [
            "cluster_id" => null,
            "pdb_id" => null,
            "cath_c" => null,
            "scop_c" => null,
        ];

        // 依據傳入的參數更新查詢條件
        foreach ($getvalues as $key => $value) {
            if (array_key_exists($key, $params)) {
                $getvalues[$key] = $params[$key];
            } else {
                unset($getvalues[$key]);
            }
        }

        // 查詢條件設置
        $condition = "";
        $condition_values = [
            "cluster_id" => " AND cluster_id = :cluster_id",
            "pdb_id" => " AND pdb_id = :pdb_id",
            "cath_c" => " AND cath_c = :cath_c",
            "scop_c" => " AND scop_c = :scop_c",
        ];

        foreach ($condition_values as $key => $value) {
            if (array_key_exists($key, $params)) {
                $condition .= $value;
            } else {
                unset($getvalues[$key]);
            }
        }

        // SQL查詢
        $sql_default = "SELECT * FROM `251_cluster` ";
        $sql_default = "SELECT * FROM ({$sql_default}) dt WHERE TRUE {$condition}";

        // 執行查詢
        $result = DB::select($sql_default, $getvalues);

        return $result;
    }

}

