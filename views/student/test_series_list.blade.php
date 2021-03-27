@extends('layout/student_dashboard')
@extends('layout/details')
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/test_series_list.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Online Test Series</b>
                <div class="searchForm">
                    <form action="{{route('student-test_series_list')}}" method="get">
                        <input type="hidden" name="type" value="{{ app('request')->input('type')}}" placeholder="Search here" />
                        <input id="searchField" type="text" name="s" value="{{ app('request')->input('s')}}" placeholder="Search here" />
                        <div class="close">
                            <span class="front"></span>
                            <span class="back"></span>
                        </div>
                    </form>
                </div>
            </h4>
        </div>
    </div>
    <div class="container-table100">
        <div class="wrap-table100">
            <div class="table100" id="tbody">
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">S.No</th>
                            <th class="column2">Name</th>
                            <th class="column3">open</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        @if($user->active==1)
                        <?php $x = $user->count > 9?$user->count :  "0".$user->count;?>
                        <tr class="{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->name }}</strong></td>
                            <td class="column3"><a style="color: #fff;padding: 5px 8px; font-size: 14px;" class="btn btn-warning" @if(app('request')->input('type')=='normal') href="{{ route('admin-normal_test_series',['fid'=>$user->id,'f'=>$user->name]) }}" @else href="{{ route('student-test_series',['flid'=>$user->id,'f'=>$user->name]) }}"@endif >OPEN&nbsp;<i style="font-size: 11px;color:black;">({{$x}})</i></a></td>
                        </tr>
                        @endif
                    </tbody>
                    @endforeach
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript">
    window.no = { { $no } };
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var url = $(this).attr('href').split('page=')[1];
        var year = $('input[name=s]').val();
        var img = "{{ route('student-test_series_list_page',['s'=>':year','page'=>':page']) }}";
        var img = img.replace('%3Ayear', year);
        var img = img.replace('%3Apage', url);
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#tbody').empty().html(data);
        })
        $("#loading").fadeOut(500);

    });
    $('#searchField').keydown(function(e) {
        if (e.keyCode === 13) { // If Enter key pressed
            $(this).trigger('submit');
        }
    });
    $(".search-btn").click(function() {
        $(".search-input").toggleClass("active").focus;
        $(this).toggleClass("animate");
        $(".input").val("");
    });

    </script>
    @endsection
