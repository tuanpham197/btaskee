@foreach ($details as $detail)
<div class="form-check">
    <input class="form-check-input" value="{{$detail->i}}" type="radio" name="service_detail"
        id="service_detail_{{$detail->id}}">
    <label class="form-check-label" for="service_detail_{{$detail->id}}">
        {{$detail->name}}
    </label>
</div>
@endforeach
