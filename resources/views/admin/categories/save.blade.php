@extends('layouts.app')
@section('title','Save Category')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-9 mx-auto">
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->id}}">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4>Save</h4>
                                <span>Save record for category</span>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Name <span class="text-danger">*</span></label>
                                        <input required type="text" minlength="8" name="name" class="form-control" value="{{ $category->name }}"
                                            placeholder="Enter Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Parent Category <span class="text-danger">*</span></label>
                                       <select name="parent_id" class="form-control" id="">
                                        <option value="">Select Parent Category</option>
                                        @foreach ($categories as $tempCategory)
                                            <option value="{{ $tempCategory->id }}" {{ $category->parent_id == $tempCategory->id ? 'selected' : ''}}>{{ $tempCategory->name }}</option>
                                        @endforeach
                                       </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control" id="">
                                           <option value="Active">Active</option>
                                           <option value="Inactive">Inactive</option>
                                        </select>
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
