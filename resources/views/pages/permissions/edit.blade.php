@extends('layouts.master')
@section('title')
    Update Permission | MicroMac
@endsection


@section('content')

    <div class="page-header ">
        <div class="page-header-title">
            <h4>Add User Permissions</h4>
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
                <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">User
                        Permissions</a>
                </li>
                <li class="breadcrumb-item"><a href="{{ route('permissions.create') }}">Add User Permissions</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="page-body">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts.partials.message')
                    <div class="card">

                        <div class="card-body">
                            <form action="{{ route('permissions.update',$permission->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="add_item">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Permission Name</label>
                                                <input type="text" name="group_name" class="form-control" id="name" value="{{ $permission->group_name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Permission Name</label>
                                                <input type="text" name="name" class="form-control" id="name" value="{{ $permission->name }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endsection

