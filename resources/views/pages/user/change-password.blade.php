@extends('layouts.master')

@section('title')
    Change Password | MicroMac
@endsection

@section('content')
    <div class="page-header">
      <div class="page-header-title">
            <h4>Change User Password</h4>
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
                {{-- <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a>
                </li> --}}
                <li class="breadcrumb-item"><a>Change User Password</a>
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
                        <form class="form-horizontal" action="{{ route('change_password.post', $user->id) }}" role="form"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="18">
                            <div class="form-group row">
                                <label for="inputStandard" class="col-lg-3 control-label">Employee Name</label>
                                <div class="col-lg-8">
                                    <label for="inputStandard" class="col-lg-3 control-label">{{ $user->name }}</label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputStandard" class="col-lg-3 control-label">User Name</label>
                                <div class="col-lg-8">
                                    <label for="inputStandard"
                                        class="col-lg-3 control-label">{{ $user->username }}</label>
                                </div>
                            </div>
                            {{-- <div class="form-group row">
                                <label for="inputStandard" class="col-lg-3 control-label">Old Password</label>
                                <div class="col-lg-8">
                                    <input type="password" name="old_password" id="old_password" class="form-control"
                                        required="required" value="" placeholder="Old Password">
                                </div>
                            </div> --}}
                            <div class="form-group row">
                                <label for="inputStandard" class="col-lg-3 control-label">New Password(Minimum 8
                                    character)</label>
                                <div class="col-lg-8">
                                    <input type="password" name="password" id="password" class="form-control"
                                        required="required" value="" placeholder="New Password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputStandard" class="col-lg-3 control-label">Re-Type New Password (Minimum 8
                                    character)</label>
                                <div class="col-lg-8">
                                    <input type="password_confirmation" name="password_confirmation" id="passconf"
                                        class="form-control" required="required" value="" placeholder=" Re-type Passowrd">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">&nbsp;</label>
                                <div style="float: right;" class="col-xs-2">
                                    <input type="submit" class="btn btn-hover btn-success btn-block"
                                        value="&nbsp; Save &nbsp;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Basic Form Inputs card end -->
            </div>
        </div>
    </div>
@endsection
