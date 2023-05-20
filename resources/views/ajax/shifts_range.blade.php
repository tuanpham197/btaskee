@foreach ($shifts as $key => $shift)
<div class="col-md-2 col-4 m-1 px-2">
    <input type="radio" value="{{$shift}}" id="test_{{$key}}" class="shifts-time" name="times">
    <div class="p-2"><label class="box" for="test_{{$key}}" onclick="highlight(this)">{{$shift}}</label></div>
</div>
@endforeach

<script>

    $('.cell').click(function() {
        $('.cell').removeClass('select');
        $(this).addClass('select');
    });
</script>
