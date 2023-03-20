@foreach ($districts as $district)
    <option value="{{ $district->id }}" {{isset($selected) && $selected == $district->id ? 'selected' : ''}}>{{ $district->name }}</option>
@endforeach
