<?php

namespace App\Http\Controllers;

use App\Http\Validation\User\StoreUserRequest;
use App\Http\Validation\User\UpdateUserRequest;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){

        $data = [
            'title'=> 'Data User',
            'users'=>User::paginate(10)];

        return view('user.index',$data);

    }

    public function create(){

        $data = ['title' =>'Tambah User'];

        return view('user.create',$data);

    }

    public function store(StoreUserRequest $request ){

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/user')->with('success','data user berhasil ditambahkan!');

    }

    public function edit($id){

        $user= User::find($id);

        $data = ['title'=> 'update User',
        'user'=> $user];

        return view('user.update', $data);

    }

    public function update(UpdateUserRequest $request, $id){

        $user= User::find($id);

        $validated = $request->validated();

        // Jika password diisi, hash dulu. Kalau kosong, jangan disertakan.
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user-> update($validated);

        return redirect('/user')->with('success','data user berhasil di update!');

    }

    public function destroy($id){

    $user= User::find($id);

    $user ->delete();

    return redirect('/user')->with('success','data user berhasil dihapus!');



    }

}