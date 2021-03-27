<table>
    <thead>
        <tr class="table100-head">
            <th class="column1">S.No</th>
            <th class="column2">paper name</th>
            <th class="column3"></th>
            <th class="column4"></th>
            <th class="column5"></th>
            <th class="column6">Attempt</th>
        </tr>
    </thead>
    <tbody>
        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
        @foreach($users as $user)
        <tr class="user{{$user->id}}">
            <td class="column1">{{ $no++ }}</td>
            <td class="column2">{{ $user->paper }}</td>
            <td id="{{$user->id}}" class="column3"></td>
            <td id="view{{$user->id}}" class="column4"></td>
            @if($user->type=='normal')<td class="column5"><a id="syllabus-button_nr" data-toggle="modal" data-target="#syllabus" data-id="{{$user->paper}}">
                    <i class="fa fa-book" style="color: #ff9933"></i> Syllabus</td>
            @elseif($user->type=='custom')<td class="column5"><a id="syllabus-button_cm" data-toggle="modal" data-target="#syllabus" data-id="{{$user->paper}}">
                    <i class="fa fa-book" style="color: #ff9933"></i> Syllabus</td>
            @elseif($user->type=='advanced')<td class="column5"><a id="syllabus-button_adv" data-toggle="modal" data-target="#syllabus" data-id="{{$user->paper}}">
                    <i class="fa fa-book" style="color: #ff9933"></i> Syllabus</td>
            @endif
            <td class="column6"><a href="{{ route('student-instructions',['id'=>$user->id]) }}" type="submit" id="button{{$user->id}}" class="btn btn-warning">&nbsp;&nbsp;Wait.&nbsp;&nbsp;</a></td>
        </tr>
        @endforeach
    </tbody>
    <div class="hidden disabledScroll" data-id="yes"></div>
</table>
<p>{{$users->onEachSide(1)->links()}}</p>
@section('js')
<script type="text/javascript">
$(". search-btn").click(function() {
    $(".search-input").toggleClass("active").focus;
    $(this).toggleClass("animate");
    $(".input").val("");
});

</script>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();
    var loading = document.getElementById('loading');
    loading.style.display = '';
    var url = $(this).attr('href').split('page=')[1];
    var year = $('input[name=s]').val();
    var img = "{{ route('student-online_tests_page',['s'=>':year','page'=>':page']) }}";
    var img = img.replace('%3Ayear', year);
    var img = img.replace('%3Apage', url);
    var img = img.replace('&amp;', '&');
    $.get(img, function(data) {
        $('#tbody').empty().html(data);
    })
    $("#loading").fadeOut(500);
});

</script>
<script src="{{ asset('js/testpapercounter.js') }}" type="text/javascript"></script>
<script type="text/javascript">
@foreach($users as $user)

$("#button{{$user->id}}").attr("disabled", true);
$('#{{$user->id}}').countdown('{{ $user->publishtime }}', function(event) {
    var i = 0;
    $(this).attr("style", 'color:#fd6e70;');
    $(this).html(event.strftime('<span>%D</span><span>days </span><span>%H:%M:%S'));
    if (event.strftime('%D%H%M%S') == '00000000') {
        var i = 2;
        $('#{{$user->id}}').empty().html('');
        @foreach($results as $result)
        @if($user - > pid.$user - > id == $result - > pid.$result - > plid)
        var i = 1;
        $('#button{{$user->id}}').empty().html('&nbsp;&nbsp;Open&nbsp;&nbsp;');
        $('#button{{$user->id}}').removeClass('btn-warning');
        $('#button{{$user->id}}').addClass('btn-info');
        $("#button{{$user->id}}").attr("disabled", false);
        $('#view{{$user->id}}').empty().html('<a id="show-button" class="btn btn-info" style="color: #fff" data-toggle="modal" data-target="#show" data-id="{{$user->pid}}" data-plid="{{$user->id}}" data-type="{{$user->type}}">View</a>');
        @endif
        @endforeach

    }
    if (i == 2) {
        $('#button{{$user->id}}').empty().html('Attempt');
        $('#view{{$user->id}}').empty().html('');
        $('#button{{$user->id}}').removeClass('btn-warning');
        $('#button{{$user->id}}').addClass('btn-success');
        $("#button{{$user->id}}").attr("disabled", false);
    }
});

@endforeach

</script>
<script type="text/javascript">
$(document).on('click', '#show-button', function() {
    var loading = document.getElementById('loading');
    loading.style.display = '';
    var id = $(this).data('id');
    var plid = $(this).data('plid');
    var type = $(this).data('type');
    var img = "{{ route('student-papershow',['id'=>':id','type'=>':type','plid'=>':plid']) }}";
    var img = img.replace('%3Aid', id);
    var img = img.replace('%3Aplid', plid);
    var img = img.replace('%3Atype', type);
    var img = img.replace('&amp;', '&');
    var img = img.replace('&amp;', '&');
    $.get(img, function(data) {
        $('#table').empty().html(data);
    })
});
$(document).on('click', '#syllabus-button_nr', function() {
    var a = "{{ asset('Quiz/normal_paper') }}/" + $(this).data('id') + "/question/syllabus.png";
    $.get(a)
        .done(function() {
            $('#syllabusimg').html('<img src="' + a + '">');

        }).fail(function() {
            $('#syllabusimg').html('Syllabus not available...');

        })


});
$(document).on('click', '#syllabus-button_adv', function() {
    var a = "{{ asset('Quiz/advanced_paper') }}/" + $(this).data('id') + "/question/syllabus.png";
    $.get(a)
        .done(function() {
            $('#syllabusimg').html('<img src="' + a + '">');

        }).fail(function() {
            $('#syllabusimg').html('Syllabus not available...');

        })


});

</script>
@endsection
