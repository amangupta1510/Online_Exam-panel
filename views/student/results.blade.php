@extends('layout/student_dashboard')
@extends('layout/details')
@section('popup')
{{-- Form show --}}
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainshow_result.css')}}">
<div id="show" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="table" class="modal-body">
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent_result.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Results</b>
                <div class="searchForm">
                    <form action="{{route('student-results')}}" method="get">
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
                            <th class="column2">Paper Name</th>
                            <th class="column3">Submit Time</th>
                            <th class="column4">Total Score</th>
                            <th class="column5">Time Used</th>
                            <th class="column6"></th>
                            <th class="column7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        <tr class="{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->paper }}</strong></td>
                            <td class="column3"><strong>{{ $user->created_at }}</strong></td>
                            <td class="column4"><strong>{{ $user->totalS }}</strong></td>
                            <td class="column5"><strong>{{ $user->lefttime }} mins</strong></td>
                            <td class="column6">@if($user->rank!='')
                                <a>AIR {{$user->rank}}</a>@endif</td>
                            <td class="column7" style="padding: 5px 5px 5px 5px;cursor:pointer;"><strong><a href="{{ route('student-result_analysis',['id'=>$user->id,])}}">RESULT</a></strong></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    <style type="text/css">
    li {
        list-style: none;
    }

    </style>
    @endsection
    @section('js')
    <script type="text/javascript">
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var url = $(this).attr('href').split('page=')[1];
        var year = $('input[name=s]').val();
        var img = "{{ route('student-results_page',['s'=>':year','page'=>':page']) }}";
        var img = img.replace('%3Ayear', year);
        var img = img.replace('%3Apage', url);
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#tbody').empty().html(data);
        })
        $("#loading").fadeOut(500);
    });

    $(document).on('click', '#show-button', function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var id = $(this).data('id');
        var img = "{{ route('student-resultshow',['id'=>':id']) }}";
        var img = img.replace('%3Aid', id);
        $.get(img, function(data) {
            $('#table').empty().html(data);
        })
    });

    </script>
    @endsection
