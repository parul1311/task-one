@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card m-3">
        <div class="card-header d-flex justify-content-between">
            <div>
                <h4>Users</h4>
            <span>List of users</span>
            </div>
            <div class="text-right">
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">Add New</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ ucwords($user->name) }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone??"N/A" }}</td>
                                    <td>{{ $user->role_name }}</td>
                                    <td>{{ $user->created_at->format('jS M Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-sm ms-2">Edit</a>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE"> 
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');" class="btn btn-danger btn-sm ms-2">Delete</button>
                                            </form>
                                            @if($user->id != auth()->id() && !$user->hasRole('admin'))
                                            <a href="{{ route('login-as', $user->id) }}" class="btn btn-info btn-sm ms-2">Login As</a>
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection