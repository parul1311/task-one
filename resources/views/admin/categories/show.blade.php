@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-9 mx-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4>Tree View</h4>
                                <span>Tree View of categories</span>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">Back to Table View</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach ($categories as $category)
                                    <li>
                                        <div class="d-flex mb-1">
                                            {{ $category->name }} 
                                            <div class="d-flex ms-2 action-btn">
                                                <a href="{{ route('admin.categories.edit', $category->id) }}" class="ms-2 btn btn-link">Edit</a>
                                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE"> 
                                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-link text-danger btn-sm m-1">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    @if($category->sub_categories_count > 0)
                                    <ul>
                                        @include('admin.categories.loop',['subCategories'=>$category->subCategories])
                                    </ul>
                                   @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
