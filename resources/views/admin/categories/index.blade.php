@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card m-3">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h4>Categories</h4>
            <span>List of categories</span>
            </div>
            <div class="text-right">
                @if($categories->first() && $parentCategory = @$categories->first()->parentCategory)
                <a href="{{ route('admin.categories.index',['parent_id'=>$parentCategory->parent_id]) }}" class="btn btn-secondary btn-sm">Back to {{ $parentCategory->name }}</a>
                @endif
                <a href="{{ route('admin.categories.show',$categories->first()->parent_id??0) }}" class="btn btn-warning btn-sm">Tree View</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Parent Category</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->count() > 0)
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($category->name) }}</td>
                                    <td>{{ $category->status }}</td>
                                    <td>{{ @$category->parentCategory->name??"N/A" }}</td>
                                    <td>{{ $category->created_at->format('jS M Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm ms-2">Edit</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE"> 
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-danger btn-sm ms-2">Delete</button>
                                            </form>
                                            @if($category->sub_categories_count > 0)
                                            <a href="{{ route('admin.categories.index', ['parent_id'=>$category->id]) }}" class="btn btn-info btn-sm ms-2">Sub Categories</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center"> No Data Available </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection