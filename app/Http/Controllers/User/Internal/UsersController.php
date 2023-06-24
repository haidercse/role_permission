<?php

namespace App\Http\Controllers\User\Internal;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public $user;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if (!$this->user->hasPermissionTo('users.list')) {
            return abort(403, 'Unauthoeized!');
        }

        // $users = User::all();
        // $users = User::whereHas('roles', function ($query) {
        //     $query->where('name', '!=', 'Client');
        // })->get();
        $users = User::whereHas('roles')->get();
     
        return view('pages.user.internal.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->user->hasPermissionTo('users.create')) {
            return abort(403, 'Unauthoeized!');
        }
        $roles = Role::where('name', '!=', 'super-admin')->get();
     
        return view('pages.user.internal.create', compact( 'roles', ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|max:50|min:3',
            'email' => 'required|unique:users,email',
            'registration_date' => 'nullable|date',
            'username' => 'required|unique:users,username',
            'status' => 'required',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->registration_date = $request->registration_date;
        $user->status = $request->status;
        $user->password = Hash::make('12345678');
        $user->save();

        if ($request->roles) {
            $user->assignRole($request->roles);
        } else {
            $user->delete();
            return back()->with('error', 'Please assign role');
        }
        return redirect()->route('users.index')->with('success', 'New User has been added successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->user->hasPermissionTo('users.show')) {
            return abort(403, 'Unauthoeized!');
        }
        User::find($id)->update(['password' => Hash::make('12345678')]);
        return back()->with('success', 'Password has been reset');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$this->user->hasPermissionTo('users.edit')) {
            return abort(403, 'Unauthoeized!');
        }
        $user = User::find($id);
        $roles = Role::all();
        return view('pages.user.internal.edit', compact('user', 'roles'));
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

        if (!$this->user->hasPermissionTo('users.update')) {
            return abort(403, 'Unauthoeized!');
        }

        $request->validate([
            'name' => 'required|max:50|min:3',
            'email' => 'required|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'status' => 'required',

        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = $request->status;
        $user->save();


        if ($request->roles) {
            $user->roles()->detach();
            $user->assignRole($request->roles);
        } else {
            return back()->with('error', 'Please assign role');
        }

        return redirect()->route('users.index')->with('success', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->user->hasPermissionTo('users.destroy')) {
            return abort(403, 'Unauthoeized!');
        }
        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }
        return back()->with('success', 'User has been Deleted successfully');
    }

    public function changePasswordView()
    {
        $user = Auth::user();

        return view('pages.user.change-password', compact('user'));
    }


    //change password authenticate user
    public function changePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|max:20|min:8|confirmed',
        ]);

        $user = User::find($id);
        $user = $user->update([
            'password' => Hash::make($request->password),
        ]);
        if (!$user) {
            return back()->with('error', 'Not Updated');
        }
        return back()->with('success', 'successfully changed password');

        // return redirect()->route('home')->with('success','successfully changeed password');
    }
}