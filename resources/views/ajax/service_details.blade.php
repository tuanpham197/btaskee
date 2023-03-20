@foreach ($details as $detail)
<div class="form-check">
    <input class="form-check-input" value="{{$detail->id}}" type="radio" name="service_detail_id"
        id="service_detail_{{$detail->id}}" {{isset($selected) && $selected == $detail->id ? 'checked' : ''}}>
    <label class="form-check-label" for="service_detail_{{$detail->id}}">
        {{$detail->name}}
    </label>
</div>
@endforeach
