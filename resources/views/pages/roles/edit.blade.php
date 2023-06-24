@extends('layouts.master')
@section('title')
    Roles Update | MicroMac
@endsection
@section('content')

    <div class="page-header ">
        <div class="page-header-title">
            <h4>Add User Roles</h4>
        </div>
        <div class="page-header-breadcrumb">
            <ul class="breadcrumb-title">
                <li class="breadcrumb-item">
                    <a href="index.html">
                        <i class="icofont icofont-home"></i>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">User
                        Roles</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('roles.create') }}">Add User Roles</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <!-- Basic Form Inputs card start -->
                <div class="card">
                    @include('layouts.partials.message')
                    <div class="card-block">
                        <form action="{{ route('roles.update',$role->id) }}" role="form"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" value="{{ $role->name }}" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Is Internal</label>
                                <div class="col-sm-10">
                                    <select name="is_internal" id="is_internal" class="form-control" "="">
                                       <option  value="1" {{ $role->is_internal == 1 ? 'selected': '' }}>Yes</option>
                                        <option value="0" {{ $role->is_internal == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role Details</label>
                                <div class="col-sm-10">
                                    <textarea rows="5" name="description" cols="5" class="form-control"placeholder="Details">
                                        {{ $role->description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group ml-5">
                                <label for="name">Permissions</label>

                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="checkPermissionAll">All</label>
                                </div>
                                <hr>
                                @php $i = 1; @endphp
                                @foreach ($permission_groups as $group)
                                    <div class="row">
                                        @php
                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                            $j = 1;
                                        @endphp

                                        <div class="col-3">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                            </div>
                                        </div>

                                        <div class="col-9 role-{{ $i }}-management-checkbox">

                                            @foreach ($permissions as $permission)
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                    <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                </div>
                                                @php  $j++; @endphp
                                            @endforeach
                                            <br>
                                        </div>

                                    </div>
                                    @php  $i++; @endphp
                                @endforeach
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>

                                <div style="float: right;" class="col-xs-2"><input type="submit"
                                        class="btn btn-success" value="Save"></div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Basic Form Inputs card end -->
            </div>
        </div>
    </div>
    @push('custom-scripts')
        @include('pages.roles.partials.scripts')
    @endpush
@endsection
