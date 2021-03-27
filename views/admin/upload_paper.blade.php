@extends('layout/admin_dashboard')
@extends('layout/details')
@section('inner_block')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/util.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Upload Paper</b>
                <div class="searchForm">
                    <form action="{{route('admin-upload_paper_list_search')}}" method="get">
                        <input type="hidden" name="id" value="{{ Request::get('id') }}" />
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
            <div class="table100">
                <table>
                    <thead>
                        <tr class="table100-head">
                            <th class="column1">S.No</th>
                            <th class="column2">Paper Name</th>
                            <th class="column3">Link</th>
                            <th class="column4">paper</th>
                            <th class="column5">Answer</th>
                            <th class="column6">Publish</th>
                            <th class="column7">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        <tr class="{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->paper }}</strong></td>
                            <td class="column3"><strong>{{ $user->plink }}</strong></td>
                            <td class="column4"><a style="color: #fff" class="btn btn-primary" href="{{ url('ques_upload?id='.$user->id) }}">Upload paper</a></td>
                            <td class="column5"><a style="color: #fff" class="btn btn-danger" href="{{ url('ans_upload?id='.$user->id) }}">Upload Ans.</a></td>
                            <td class="column6"><a style="color: #fff" class="btn btn-warning" href="{{ url('publish?id='.$user->id) }}">Publish</a></td>
                            <td class="column7"> <a id="delete-button" data-toggle="modal" data-target="#delete" data-name="{{$user->name}}" data-id="{{$user->id}}">
                                    <i class="glyphicon glyphicon-trash" style="color: #ff5c33"></i></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>{{$users->onEachSide(1)->links()}}</p>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script type="text/javascript" src="{{asset('js/upload_paper.js')}}"> </script>
    <script type="text/javascript">
    $(". search-btn").click(function() {
        $(".search-input").toggleClass("active").focus;
        $(this).toggleClass("animate");
        $(".input").val("");
    });

    </script>
    @endsection
