<?php

namespace App\modals;

class DemoModal
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getDataModal($params)
    {   
        if ($params) {
            var_dump($params);
        } else {
            var_dump($params);
        }
        
        $stmt = $this->db->query("SELECT * FROM `student`");
        return $stmt->fetchAll();
    }
    
    public function postData($data)
    {

        $bindValue = [
            "user_account" => null,
            "user_name" => null,
            "user_password" => null,
            "birth" => null,
        ];

        $insert_cond = '';
        $value_cond = '';

        foreach ($bindValue as $key => $value ){
            if(array_key_exists($key,$data)){
                $bindValue[$key] = $data[$key];
                $insert_cond .= "{$key},";#
                $value_cond .= ":{$key},";

            } else {
                unset($bindValue[$key]);
            }
        }

        $insert_cond = rtrim( $insert_cond ,',');
        $value_cond = rtrim( $value_cond ,',');

        $sql = "INSERT INTO `student` ($insert_cond) 
                VALUES ($value_cond)
                ";
            
        $stmt = $this->db->prepare($sql);
        if( $stmt->execute($bindValue)){
            return ['status'=> 'success','messsage'=>'新增成功 !'];
        } else {
            $errorInfo = $stmt->errorInfo();
            return ['status'=> 'failure','messsage'=> $stmt->errorInfo()];
        }       
    }
    public function patchDataModal($data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            return [
                'status' => 'success',
                'message' => 'Data patched successfully',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to patch data: Missing id field'
            ];
        }
    }

    public function deleteDataModal($data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            return [
                'status' => 'success',
                'message' => 'Data deleted successfully',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to delete data: Missing id field'
            ];
        }
    }
}