<div style="display: flex;
    flex-direction: row;
    gap: 10px;">
    @if ($row->image)
        <img src="{{ asset($row->image) }}" width="40" style="border-radius: 7px;">
        <p style="height:5px ; align-self:center">{{ $row->name }}</p>
    @else
        <span>No image</span>
    @endif
</div>
