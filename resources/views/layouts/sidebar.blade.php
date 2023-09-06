@auth
<div class="sidebar">
    <ul class="menu">
        @if(auth()->user()->hasRole('admin'))
      <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
      <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>Users</a></li>
      <li><a href="{{ route('admin.categories.index') }}"><i class="fas fa-cog"></i>Categories</a></li>
      @else
      <li><a href="{{ route('home') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
      @endif
    </ul>
  </div>
@endauth