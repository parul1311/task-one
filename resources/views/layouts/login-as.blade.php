@if(auth()->user() && session()->has("admin_user_id") && session()->has("temp_user_id"))
    <div class="alert alert-warning logged-in-as mb-4 mx-4">
        You are currently logged in as {{ auth()->user()->full_name }}. <a href="{{ route("logout-as") }}">Re-Login as {{ session()->get("admin_user_name") }}</a>.
    </div><!--alert alert-warning logged-in-as-->
@endif