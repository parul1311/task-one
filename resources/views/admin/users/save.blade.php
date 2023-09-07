@extends('layouts.app')
@section('title','Save User')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-9 mx-auto">
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id}}">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4>Save</h4>
                                <span>Save record for user</span>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Name <span class="text-danger">*</span></label>
                                        <input required type="text" minlength="8" name="name" class="form-control" value="{{ $user->name }}"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email <span class="text-danger">*</span></label>
                                        <input required type="email" minlength="8" name="email" class="form-control" value="{{ $user->email }}"
                                            placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="number" minlength="8" name="phone" class="form-control" value="{{ $user->phone }}"
                                            placeholder="Enter Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Role @if(!$user->id) <span class="text-danger">*</span> @endif</label>
                                        <select name="role" class="form-control" id="" @if($user->id) disabled @else required @endif>
                                            <option value="">Select Role</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}" @isset($user->roles) {{ in_array($role->id,$user->roles()->pluck('id')->toArray()) ? 'selected' : '' }} @endisset>{{ $role->display_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Password @if(!$user->id) <span class="text-danger">*</span> @endif</label>
                                        <input id="password" @if(!$user->id) required @endif type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Confirm Password @if(!$user->id) <span class="text-danger">*</span> @endif</label>
                                        <input id="password-confirm" @if(!$user->id) required @endif type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
