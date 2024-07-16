<?php

namespace App\modals;

class DemoModal
{
    public function getDataModal($params)
    {
        $data = [];
        for ($i = 1; $i <= 10; $i++) {
            $data[] = [
                'id' => $i,
                'name' => 'Item ' . $i,
                'description' => 'This is the description for item ' . $i,
                'price' => rand(10, 100),
                'created_at' => date('Y-m-d H:i:s')
            ];
        }
        return $data;
    }
    public function postDataModal($data)
    {
        if (isset($data['name']) && !empty($data['name'])) {
            return [
                'status' => 'success',
                'message' => 'Data posted successfully',
                'data' => $data
            ];
        } else {
            return [
                'status' => 'error',
                'message' => 'Failed to post data: Missing name field'
            ];
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
