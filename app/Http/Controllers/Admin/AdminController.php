<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
   public function dashboard()
   {
    return view('admin.file.dashboard');

   }

   public function user()
   {
      $users = User::all();
      return view('admin.file.user_view',compact('users'));

   }
   public function admin()
   {
      $admin = Admin::all();

      return view('admin.file.admin',compact('admin'));

   }

   public function store(Request $request)
   {
      
      $rulse = [
         "name"       => 'required',
         "email"      => 'required|unique:users',

     ];
     $customMessage = [
         'name.required'             => "Name is required",
         'email.required'            => "Email is required",
         'email.unique'            => "Email is already exist",
     ];

     $validator = Validator::make($request->all(), $rulse, $customMessage);
     if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
     }

     User::Create(
         [
             'name'      => $request->name,
             'email'     => $request->email,
             'phone'     => $request->phone,
             'address'     => $request->address,
             'country'     => $request->country,
             'city'     => $request->city,
         ]
     );

     return response()->json(['success' => 'User Create successfully.']);
   }

   public function getData()
   {
      $user = User::all();
      return response()->json([
         'user' => $user,
      ]);
   }
   public function edit(User $user)
    {
        return response()->json($user);
    }

    public function destroy(User $user)
    {
      if (is_null($user)) {
         return response()->json(["message" => "Recode Not Found !"], 404);
     }

     try {
         //code...
         $user->delete();
     } catch (\Exception $e) {
         //throw $th;
         if ($e->getCode() == 23000) {
             return response()->json([
                 'status'    => false,
                 'message'   => "You can not delete it. Because it has some item",
             ], 405);
         } else {
             return response()->json([
                 'status'    => false,
                 'message'   => $e->getMessage(),
             ], 405);
         }
     }
     return response()->json([
         'status' => false,
         'message' => 'User has been deleted Successfull',
     ], 200);     
    }


    public function adminPost(Request $request)
    {
      $rulse = [
         "name"       => 'required',
         "email"      => 'required|unique:admins',

     ];
     $customMessage = [
         'name.required'             => "Name is required",
         'email.required'            => "Email is required",
         'email.unique'            => "Email is already Exist",
     ];

     $validator = Validator::make($request->all(), $rulse, $customMessage);
     if ($validator->fails()) {
         return response()->json($validator->errors(), 422);
     }

   
     Admin::Create(
         [
             'name'      => $request->name,
             'email'     => $request->email,
             'phone'     => $request->phone,
             'address'   => $request->address,
             'city'      => $request->city,
             'user_type' => 1,
             'password'  => bcrypt($request->password),
         ]
     );

     return response()->json(['success' => 'Admin Create successfully.']);
    }

    public function admingetData()
    {
      $admin = Admin::all();
      return response()->json([
         'user' => $admin,
      ]);
    }
}
