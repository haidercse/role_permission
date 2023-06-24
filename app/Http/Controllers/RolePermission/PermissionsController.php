<?php

namespace App\Http\Controllers\RolePermission;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Exists;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsController extends Controller
{

    public $user;

    public function __construct()
    {
        $this->middleware(function($request, $next){
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
        if (!$this->user->hasPermissionTo('permissions.list') ) {
            return abort(403, 'Unauthoeized !');

        }
       $permissions = Permission::all();
       return view('pages.permissions.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (!$this->user->hasPermissionTo('permissions.create') ) {
            return abort(403, 'Unauthoeized!');

        }

        return view('pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (!$this->user->hasPermissionTo('permissions.create') ) {
            return abort(403, 'Unauthoeized !');

        }

        $request->validate([
            'name.*' => 'required|unique:permissions,name',
            'group_name' => 'required|max:50',
        ]);

        foreach ($request->name as $name) {
            $permission = new Permission();
                $permission->guard_name = 'web';
                $permission->group_name = $request->group_name;
                $permission->name = $name;
                $permission->save();
        }
        return redirect()->route('permissions.index')->with('success','Permission has been Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  $permission = Permission::findById($id,'admin');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findById($id);

        return view('pages.permissions.edit',compact('permission'));
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
        if (!$this->user->hasPermissionTo('permissions.update') ) {
            return abort(403, 'Unauthoeized!');

        }
        // Validation Data
        $request->validate([
            'name' => 'nullable|unique:permissions,name,'.$id,
            'group_name' => 'nullable|max:50',
        ]);
        $permission = Permission::findById($id);
        $permission->guard_name = 'web';
        $permission->group_name = $request->group_name;
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permissions.index')->with('success',' Permission has been Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$this->user->hasPermissionTo('permissions.destroy') ) {
            return abort(403, 'Unauthoeized !');

        }
     $permission = Permission::findById($id);
        if (!is_null($permission)) {
         $permission->delete();
        }
        return redirect()->route('permissions.index')->with('success','Permission has been Deleted successfully!');
    }


}
