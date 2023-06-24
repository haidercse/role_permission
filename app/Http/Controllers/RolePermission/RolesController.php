<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
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
        if (!$this->user->hasPermissionTo('roles.list')) {
            return abort(403, 'Unauthoeized !');
        }
        //    $roles = Role::where('name','!=','super-admin')->get();
        $roles = Role::all();
        return view('pages.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!$this->user->hasPermissionTo('roles.create')) {
            return abort(403, 'Unauthoeized !');
        }
        $all_permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('pages.roles.create', compact('all_permissions', 'permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->user->hasPermissionTo('roles.create')) {
            return abort(403, 'Unauthoeized !');
        }
        $request->validate([
            'name' => 'required',
            'description' => 'nullable|max:255',
            'is_internal' => 'required',
        ]);

        $role =  Role::create([
            'name' => $request->name,
            'is_internal' => $request->is_internal,
            'description' => $request->description,

        ]);

        $permissions = $request->input('permissions');
        if (!empty($permissions)) {

            $role->syncPermissions($permissions);
            //$permission->syncRoles($roles);
        }
        return redirect()->route('roles.index')->with('success', 'Permission has been Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  $role = Role::findById($id,'admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (!$this->user->hasPermissionTo('roles.edit')) {
            return abort(403, 'Unauthoeized!');
        }
        if (Auth::user()->is_super_admin == 1) {
            $all_permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();
            $role = Role::findById($id);
            return view('pages.roles.edit', compact('role', 'all_permissions', 'permission_groups'));
        } else {
            return back()->with('error', 'You are not super admin so can not access this.');
        }
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
        if (!$this->user->hasPermissionTo('roles.update')) {
            return abort(403, 'Unauthoeized!');
        }
        // Validation Data
        $request->validate([
            'name' => 'required|max:100|unique:roles,name,' . $id,
            'description' => 'nullable|max:255',
            'is_internal' => 'nullable',
        ], [
            'name.requried' => 'Please give a role name'
        ]);

        $role = Role::findById($id);
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->name = $request->name;
            $role->is_internal = $request->is_internal;
            $role->description = $request->description;
            $role->save();
            $role->syncPermissions($permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Roles has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // if super admin , then this role will not deleted!
        $roleInfo = Role::where('id', $id)->first();
        if (!$this->user->hasPermissionTo('roles.destroy')) {
            return abort(403, 'Unauthoeized !');
        }
        if ($roleInfo->name == 'super-admin') {
            return back()->with('error', 'Super admin will not deleted!');
        } else {
            $role = Role::findById($id);

            if (!is_null($role)) {
                if(!($roleInfo->users->isEmpty())){
                    return back()->with('error', 'This Role is not deleted');
                }else{
                    $role->delete();
                }

            }
            return redirect()->route('roles.index')->with('success', 'Permission has been Deleted successfully');
        }
    }
}
