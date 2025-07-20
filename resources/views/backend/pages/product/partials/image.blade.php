@if ($row->image)
    <img src="{{ asset($row->image) }}" width="50">
@else
    <span>No image</span>
@endif
