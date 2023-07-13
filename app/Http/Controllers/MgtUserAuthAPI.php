<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Models\UserAuthApiModel;


class MgtUserAuthAPI extends Controller
{

    public function view(?string $id = null)
    {
        $user = [];
        if(!empty($id)){
            $user = UserAuthApiModel::whereId($id)->get()->toArray();
        }else{
            $user = UserAuthApiModel::get()->toArray();   
        }

        return response()->json([
            'success' => true,
            'message' => 'Success get data',
            'data' => $user
        ], 200);

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'apps_name' => 'required',
            'type_auth' => 'required',
            'base_url'  => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Crosscheck your parameters',
                'data'   => $validator->errors()
            ],401);

        }else{

            $user = new UserAuthApiModel;
            $user->apps_name = $request->input('apps_name');
            $user->type_auth = $request->input('type_auth');
            $user->base_url = $request->input('base_url');
            $user->credentials = json_encode($request->input('credentials'));
            $user->save();

            if($user){
                return response()->json([
                    'success' => true,
                    'message' => 'User Auth Berhasil Disimpan!',
                    'data' => $user
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'User Auth Gagal Disimpan!',
                    'data' => $user
                ], 400);
            }

        }
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'apps_name' => 'required',
            'type_auth' => 'required',
            'base_url'  => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Please Crosscheck your parameters',
                'data'   => $validator->errors()
            ],401);

        } else {
            $user = UserAuthApiModel::whereId($id)->update([
                'apps_name'  => $request->input('apps_name'),
                'type_auth'  => $request->input('type_auth'),
                'base_url'   => $request->input('base_url'),
            ]);

            if ($user) {

                return response()->json([
                    'success' => true,
                    'message' => 'Post Berhasil Diupdate!',
                    'data' => $user
                ], 200);

            } else {

                return response()->json([
                    'success' => false,
                    'message' => 'Post Gagal Diupdate!',
                ], 400);

            }
        }

    }

}
