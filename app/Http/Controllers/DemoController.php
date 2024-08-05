<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DemoModel;

class DemoController extends Controller
{
    public function getData(Request $request)
    {
        try {
            $params = $request->query();
            $DemoModel = new DemoModel();
            $result = $DemoModel->getData($params);
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        }  catch (\Exception $e) {
            return response()->json([
                'status' => 'failute',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    public function postData(Request $request)
    {
        try {
            $data = $request->all();
            $DemoModel = new DemoModel();
            $result = $DemoModel->postData($data);
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        }  catch (\Exception $e) {
            return response()->json([
                'status' => 'failute',
                'message' => 'An error occurred while fetching data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function patchData($request)
    {
        return response()->json($user, 200);
    }

    public function deleteData(Request $request)
    {
        try {
            $data = $request->all();
            $DemoModel = new DemoModel();
            $result = $DemoModel->deleteData($data['id']);  
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'failure',
                'message' => 'An error occurred while deleting data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
