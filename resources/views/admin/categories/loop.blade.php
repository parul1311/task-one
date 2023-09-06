@foreach ($subCategories as $childCategory)
    <li>
        <div class="d-flex mb-1">
            {{ $childCategory->name }}
            <div class="d-flex ms-2 action-btn">
                <a href="{{ route('admin.categories.edit', $childCategory->id) }}" class="ms-2 btn btn-link">Edit</a>
                <form action="{{ route('admin.categories.destroy', $childCategory->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE"> 
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');" class="btn btn-link text-danger btn-sm m-1">Delete</button>
                </form>
            </div>
        </div>
    </li>
    @if ($childCategory->subCategories()->count() > 0)
        <ul>
            @include('admin.categories.loop', ['subCategories' => $childCategory->subCategories])
        </ul>
    @endif
@endforeach
