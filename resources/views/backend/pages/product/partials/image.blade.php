@if ($image)
    <img src="{{ asset($image) }}" width="50">
@else
    <span>No image</span>
@endif
