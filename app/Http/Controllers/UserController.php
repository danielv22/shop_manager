<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use App\Models\Checkout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::where('status',1)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        return response()->json(['user'=> $user], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->checkout = $user->Checkout;
        return $user;

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['user'=> $user], Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->status = 0;
        $user->save();
        return $user;
    }
    public function login(LoginFormRequest $request)
    {
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],false)){
            $user = Auth::user();
            $checkout = $user->Checkout;
            if(empty($checkout)){

                $new_checkout = new Checkout();
                $new_checkout->user_id = $user->id;
                $new_checkout->state = 1;
                $new_checkout->save();
                $new_checkout = $new_checkout->id;

            return $user;
        }
        $user->checkout_id = $checkout->id;
        return $user;
        }else{
            return response()->json(['errors'=>['login'=>['Los datos no son validos']]]);
        }
    }
}
