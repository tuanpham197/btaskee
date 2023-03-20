@foreach ($wards as $ward)
    <option value="{{ $ward->id }}" {{isset($selected) && $selected == $ward->id ? 'selected' : ''}}>{{ $ward->name }}</option>
@endforeach
