

<div style="display: flex;
    flex-direction: row;
    gap: 10px;">

    @php
        $imagePath = public_path($row->image);
    @endphp


    @if (file_exists($imagePath))
        <img src="{{ asset($row->image) }}" width="40" style="border-radius: 7px;">
        <p style="height:5px ; align-self:center">{{ $row->name }}</p>

    @else
        <img src="{{ asset('images/placeholder.png') }}" width="40" style="border-radius: 7px;">
        <p style="height:5px ; align-self:center">{{ $row->name }}</p>

    @endif
</div>
