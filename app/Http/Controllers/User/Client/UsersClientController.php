<?php

namespace App\Http\Controllers\User\Client;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersClientController extends Controller
{
    public $user; 
// new branch
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
      
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', 'Client');
        })->get();

        $organizations = Organization::all();
        $products = Product::all();
        return view('pages.user.client.index', compact('clients', 'organizations', 'products'));
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
        $clients = Role::where('name', 'Client')->get();
        $products = Product::all();
        $organizations = Organization::all();
        return view('pages.user.client.create', compact('products', 'clients', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|max:50|min:3',
            'email'             => 'required|unique:users,email',
            'registration_date' => 'nullable|date',
            'username'          => 'required|unique:users,username',
            'status'            => 'required',
            'product_id'        => 'required',
            'organization_id'   => 'required',

        ]);

            $user = new User();
            $user->name = $request->name;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->registration_date = $request->registration_date;
            $user->status = $request->status;
            $user->product_id = $request->product_id;
            $user->organization_id = $request->organization_id;
            $user->password = Hash::make('12345678');
            $user->save();
           
            if (isset($request->roles)) {
                $user->assignRole($request->roles);
            } else {
                return back()->with('error', 'Please assign role');
            }
   
        
        return redirect()->route('clients.index')->with('success', ' New Client has been added successfully');
    }

    /**
     * Display the specified resource.
     * new branch 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->user->hasPermissionTo('users.show')) {
            return abort(403, 'Unauthoeized!');
        }
        User::find($id)->update(['password' => Hash::make('12345678')]);
        return back()->with('success','Password has been reset');
        //   $notification = Notification::where('user_id',$authUserId)
        // ->where('is_seen',0)
        // ->update(['is_seen' => 1]);
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
        $client = User::find($id);
        $products = Product::all();
        $organizations = Organization::all();
        return view('pages.user.client.edit', compact('client', 'products', 'organizations'));
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
            'name'              => 'required|max:50|min:3',
            'email'             => 'required|unique:users,email,' . $id,
            'registration_date' => 'nullable|date',
            'username'          => 'required|unique:users,username,'.$id,
            'status'            => 'required',
            'product_id'        => 'required',
            'organization_id'   => 'required',


        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->registration_date = $request->registration_date;
        $user->status = $request->status;
        $user->product_id = $request->product_id;
        $user->organization_id = $request->organization_id;
        // $user->password = Hash::make('12345678');
        $user->save();
        // if ($request->roles) {
        //     $user->assignRole($request->roles);
        // } else {
        //     return back()->with('error', 'Please assign role');
        // }
        return redirect()->route('clients.index')->with('success', 'Client has been updated successfully');
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
        return back()->with('success', 'Client has been deleted successfully');
    }
}
