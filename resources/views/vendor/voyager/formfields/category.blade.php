<li>
    <label>
        <input value="{{ $category->id }}" type="checkbox" name="category[]" style="margin-right: 5px;" {{ $categoriesForProduct->contains($category) ? 'checked' : '' }}>{{ $category->name }}
    </label>

    @if(count($category->children)>0)
        <ul>
            @foreach($category->children as $child)
                @include('vendor.voyager.formfields.category', ['category' => $child])
            @endforeach
        </ul>
    @endif
</li>
