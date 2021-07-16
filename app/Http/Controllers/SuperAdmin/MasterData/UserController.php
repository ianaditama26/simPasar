<?php

namespace App\Http\Controllers\SuperAdmin\MasterData;

use App\Http\Controllers\Controller;
use App\Models\MasterData\Pasar;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \view('super_admin.user.index', [
            'users' => User::latest()->whereNotIn('id', [3])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super_admin.user.create', [
            'pasars' => Pasar::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|string|exists:roles,name',
            'pasar_id' => 'required'
        ]);

        $user = User::firstOrCreate([
            'email' => $request->email
        ], [
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'pasar_id' => $request->pasar_id
        ]);
        
        //buat milih role user
        $user->assignRole($request->role);

        return \redirect(route('super_admin.user.index'))->with(['message' => 'User: ' . $user->name . ' Ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('super_admin.user.edit', [
            'user' => $user,
            'pasars' => Pasar::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
            'pasar_id' => 'required'
        ]);

        $user = User::findOrFail($id);
        $password = !empty($request->password) ? bcrypt($request->password):$user->password;
        $user->update([
            'name' => $request->name,
            'password' => $password
        ]);
        return \redirect(route('super_admin.user.index'))->with(['message' => 'User: ' . $user->name . ' Diubah']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!empty($user->borrowing) && $user->borrowing->status == 0) {
            $success = true;
            $message = 'User dalam status peminjaman, tidak dapat dihapus';
        } elseif(!empty($user->borrowing) && $user->borrowing->status == 1) {
            $success = false;
            $user->update(['statusDelete' => 1]);
        } else {
            $success = \false;
            $message = 'sip';
            $user->delete();
        }
        return \response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
