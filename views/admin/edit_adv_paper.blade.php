@extends('layout/admin_dashboard')
@section('popup')
<div id="warning" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h4 id="warning_line"></h4>
            </div>
            <div class="modal-footer">
                </button>
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
@foreach($users as $user)
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/maincreatepaper.css')}}">
<div id="advanced_paper" class="col-md-12" style="zoom:0.8;">
    <h2>Update Paper</h2>
    <form id="advanced_form">
        {{csrf_field()}}
        <div class="tr1">
            <div class=" col-md-4">
                <label>paper name</label>
                <input type="hidden" name="id" value="{{$user->id}}" disabled="">
                <input class="form-control" type="text" id="advpapername" name="advpapername" placeholder="Paper name" value="{{$user->pname}}" disabled="">
            </div>
            <div class=" col-md-4">
                <label>Numer of Questions</label>
                <input class="form-control" id="advNOQ" type="number" name="advNOQ" placeholder="Numer of Questions" value="{{$user->NOQ}}" disabled="">
            </div>
            <div class="col-md-4">
                <label>Total Time(min)</label>
                <input class="form-control" id="advTT" type="number" name="advTT" placeholder="Total Time(min)" value="{{$user->TT}}">
            </div>
        </div>
</div>
<div class="tr2 col-md-12" style="display: none; zoom:0.8;">
    <div class="physics_row">
        <h3>Physics</h3>
    </div>
    <div class="physics_div" style="display: none;">
        <div class="col-md-2">
            <label></label>
            <h4>Single Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P1Q" type="number" name="P1Q" placeholder="Questions" value="{{$user->P1Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P1M" type="number" name="P1M" placeholder="Marks" value="{{$user->P1M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P1N" type="number" name="P1N" placeholder="Negative marks" value="{{$user->P1N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Multiple Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P2Q" type="number" name="P2Q" placeholder="Questions" value="{{$user->P2Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P2M" type="number" name="P2M" placeholder="Marks" value="{{$user->P2M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P2N" type="number" name="P2N" placeholder="Negative marks" value="{{$user->P2N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Integer Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P3Q" type="number" name="P3Q" placeholder="Questions" value="{{$user->P3Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P3M" type="number" name="P3M" placeholder="Marks" value="{{$user->P3M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P3N" type="number" name="P3N" placeholder="Negative marks" value="{{$user->P3N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Numerical Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P4Q" type="number" name="P4Q" placeholder="Questions" value="{{$user->P4Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P4M" type="number" name="P4M" placeholder="Marks" value="{{$user->P4M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P4N" type="number" name="P4N" placeholder="Negative marks" value="{{$user->P4N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Passage Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P5Q" type="number" name="P5Q" placeholder="Questions" value="{{$user->P5Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P5M" type="number" name="P5M" placeholder="Marks" value="{{$user->P5M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P5N" type="number" name="P5N" placeholder="Negative marks" value="{{$user->P5N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Match The Column</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="P6Q" type="number" name="P6Q" placeholder="Questions" value="{{$user->P6Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="P6M" type="number" name="P6M" placeholder="Marks" value="{{$user->P6M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="P6N" type="number" name="P6N" placeholder="Negative marks" value="{{$user->P6N}}">
        </div>
    </div>
</div>
<div class="tr3 col-md-12" style="display: none; zoom:0.8;">
    <div class="chemistry_row">
        <h3>&nbsp;&nbsp;&nbsp;Chemistry&nbsp;&nbsp;&nbsp;</h3>
        <a style="font-size: 15px;color: #fff;">same as Physics <input type="checkbox" name="adv_chemistry_check" disabled=""></a>
    </div>
    <div class="chemistry_div" style="display: none; ">
        <div class="col-md-2">
            <label></label>
            <h4>Single Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C1Q" type="number" name="C1Q" placeholder="Questions" value="{{$user->C1Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C1M" type="number" name="C1M" placeholder="Marks" value="{{$user->C1M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C1N" type="number" name="C1N" placeholder="Negative marks" value="{{$user->C1N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Multiple Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C2Q" type="number" name="C2Q" placeholder="Questions" value="{{$user->C2Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C2M" type="number" name="C2M" placeholder="Marks" value="{{$user->C2M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C2N" type="number" name="C2N" placeholder="Negative marks" value="{{$user->C2N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Integer Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C3Q" type="number" name="C3Q" placeholder="Questions" value="{{$user->C3Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C3M" type="number" name="C3M" placeholder="Marks" value="{{$user->C3M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C3N" type="number" name="C3N" placeholder="Negative marks" value="{{$user->C3N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Numerical Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C4Q" type="number" name="C4Q" placeholder="Questions" value="{{$user->C4Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C4M" type="number" name="C4M" placeholder="Marks" value="{{$user->C4M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C4N" type="number" name="C4N" placeholder="Negative marks" value="{{$user->C4N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Passage Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C5Q" type="number" name="C5Q" placeholder="Questions" value="{{$user->C5Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C5M" type="number" name="C5M" placeholder="Marks" value="{{$user->C5M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C5N" type="number" name="C5N" placeholder="Negative marks" value="{{$user->C5N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Match The Column</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="C6Q" type="number" name="C6Q" placeholder="Questions" value="{{$user->C6Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="C6M" type="number" name="C6M" placeholder="Marks" value="{{$user->C6M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="C6N" type="number" name="C6N" placeholder="Negative marks" value="{{$user->C6N}}">
        </div>
    </div>
</div>
<div class="tr4 col-md-12" style="display: none; zoom:0.8;">
    <div class="mathematics_row">
        <h3>Mathematics</h3>
        <a style="font-size: 15px;color: #fff;">same as Physics <input type="checkbox" name="adv_chemistry_check" disabled=""></a>
    </div>
    <div class="mathematics_div" style="display: none; ">
        <div class="col-md-2">
            <label></label>
            <h4>Single Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M1Q" type="number" name="M1Q" placeholder="Questions" value="{{$user->M1Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M1M" type="number" name="M1M" placeholder="Marks" value="{{$user->M1M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M1N" type="number" name="M1N" placeholder="Negative marks" value="{{$user->M1N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Multiple Correct</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M2Q" type="number" name="M2Q" placeholder="Questions" value="{{$user->M2Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M2M" type="number" name="M2M" placeholder="Marks" value="{{$user->M2M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M2N" type="number" name="M2N" placeholder="Negative marks" value="{{$user->M2N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Integer Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M3Q" type="number" name="M3Q" placeholder="Questions" value="{{$user->M3Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M3M" type="number" name="M3M" placeholder="Marks" value="{{$user->M3M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M3N" type="number" name="M3N" placeholder="Negative marks" value="{{$user->M3N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Numerical Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M4Q" type="number" name="M4Q" placeholder="Questions" value="{{$user->M4Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M4M" type="number" name="M4M" placeholder="Marks" value="{{$user->M4M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M4N" type="number" name="M4N" placeholder="Negative marks" value="{{$user->M4N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Passage Type</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M5Q" type="number" name="M5Q" placeholder="Questions" value="{{$user->M5Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M5M" type="number" name="M5M" placeholder="Marks" value="{{$user->M5M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M5N" type="number" name="M5N" placeholder="Negative marks" value="{{$user->M5N}}">
        </div>
        <div class="col-md-2">
            <label></label>
            <h4>Match The Column</h4>
        </div>
        <div class="form-group col-md-3">
            <label>Questions</label>
            <input class="form-control" id="M6Q" type="number" name="M6Q" placeholder="Questions" value="{{$user->M6Q}}" disabled="">
        </div>
        <div class="form-group col-md-3">
            <label>Question Mark</label>
            <input class="form-control" id="M6M" type="number" name="M6M" placeholder="Marks" value="{{$user->M6M}}">
        </div>
        <div class="form-group col-md-3">
            <label>Negative Mark</label>
            <input class="form-control" id="M6N" type="number" name="M6N" placeholder="Negative marks" value="{{$user->M6N}}">
        </div>
    </div>
    <div class="col-md-12 adv_sub">
        <a id="adv_submit" name="adv_submit" class="btn btn-block ">Update</a>
    </div>
</div>
</form>
</div>
@endforeach
@endsection
@section('js')
<script type="text/javascript">
$('#advanced_paper').show();
$('.tr1').show();
$('.tr2').show();
$('.tr3').show();
$('.tr4').show();
$('.adv_sub').show();
$(".physics_row").click(function() {
    $('.mathematics_div').slideUp(400);
    $('.chemistry_div').slideUp(400);
    $('.physics_div').slideDown(600);
});
$(".chemistry_row").click(function() {
    $('.physics_div').slideUp(400);
    $('.mathematics_div').slideUp(400);
    $('.chemistry_div').slideDown(600);
});
$(".mathematics_row").click(function() {
    $('.physics_div').slideUp(400);
    $('.chemistry_div').slideUp(400);
    $('.mathematics_div').slideDown(600);
});
$("#adv_submit").click(function() {
    var err = 0;
    var loading = document.getElementById('loading');
    loading.style.display = '';
    if ($('input[name=advpapername]').val() == '' || $('input[name=advNOQ]').val() == '' || $('input[name=advTT]').val() == '') {
        var err = 1;
        $("#loading").fadeOut();
        $('#warning').modal('show');
        $('#warning_line').text('Please Fill paper details on Top....');
    }
    //-----------------------------------------physics warning-------------------------------------------
    if (!$('input[name=P1Q]').val() == '' || !$('input[name=P1M]').val() == '' || !$('input[name=P1N]').val() == '') {
        if ($('input[name=P1Q]').val() == '' || $('input[name=P1M]').val() == '' || $('input[name=P1N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Single Correct) Section....');
        }
    }
    if (!$('input[name=P2Q]').val() == '' || !$('input[name=P2M]').val() == '' || !$('input[name=P2N]').val() == '') {
        if ($('input[name=P2Q]').val() == '' || $('input[name=P2M]').val() == '' || $('input[name=P2N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Multi Correct) Section....');
        }
    }
    if (!$('input[name=P3Q]').val() == '' || !$('input[name=P3M]').val() == '' || !$('input[name=P3N]').val() == '') {
        if ($('input[name=P3Q]').val() == '' || $('input[name=P3M]').val() == '' || $('input[name=P3N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Integer Type) Section....');
        }
    }
    if (!$('input[name=P4Q]').val() == '' || !$('input[name=P4M]').val() == '' || !$('input[name=P4N]').val() == '') {
        if ($('input[name=P4Q]').val() == '' || $('input[name=P4M]').val() == '' || $('input[name=P4N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Numerical Type) Section....');
        }
    }
    if (!$('input[name=P5Q]').val() == '' || !$('input[name=P5M]').val() == '' || !$('input[name=P5N]').val() == '') {
        if ($('input[name=P5Q]').val() == '' || $('input[name=P5M]').val() == '' || $('input[name=P5N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Passage Type) Section....');
        }
    }
    if (!$('input[name=P6Q]').val() == '' || !$('input[name=P6M]').val() == '' || !$('input[name=P6N]').val() == '') {
        if ($('input[name=P6Q]').val() == '' || $('input[name=P6M]').val() == '' || $('input[name=P6N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics (Match The Column) Section....');
        }
    }
    //-----------------------------------------Chemistry warning-------------------------------------------
    if (!$('input[name=C1Q]').val() == '' || !$('input[name=C1M]').val() == '' || !$('input[name=C1N]').val() == '') {
        if ($('input[name=C1Q]').val() == '' || $('input[name=C1M]').val() == '' || $('input[name=C1N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Single Correct) Section....');
        }
    }
    if (!$('input[name=C2Q]').val() == '' || !$('input[name=C2M]').val() == '' || !$('input[name=C2N]').val() == '') {
        if ($('input[name=C2Q]').val() == '' || $('input[name=C2M]').val() == '' || $('input[name=C2N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Multi Correct) Section....');
        }
    }
    if (!$('input[name=C3Q]').val() == '' || !$('input[name=C3M]').val() == '' || !$('input[name=C3N]').val() == '') {
        if ($('input[name=C3Q]').val() == '' || $('input[name=C3M]').val() == '' || $('input[name=C3N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Integer Type) Section....');
        }
    }
    if (!$('input[name=C4Q]').val() == '' || !$('input[name=C4M]').val() == '' || !$('input[name=C4N]').val() == '') {
        if ($('input[name=C4Q]').val() == '' || $('input[name=C4M]').val() == '' || $('input[name=C4N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Numerical Type) Section....');
        }
    }
    if (!$('input[name=C5Q]').val() == '' || !$('input[name=C5M]').val() == '' || !$('input[name=C5N]').val() == '') {
        if ($('input[name=C5Q]').val() == '' || $('input[name=C5M]').val() == '' || $('input[name=C5N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Passage Type) Section....');
        }
    }
    if (!$('input[name=C6Q]').val() == '' || !$('input[name=C6M]').val() == '' || !$('input[name=C6N]').val() == '') {
        if ($('input[name=C6Q]').val() == '' || $('input[name=C6M]').val() == '' || $('input[name=C6N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry (Match The Column) Section....');
        }
    }
    //-----------------------------------------Mathematics warning-------------------------------------------
    if (!$('input[name=M1Q]').val() == '' || !$('input[name=M1M]').val() == '' || !$('input[name=M1N]').val() == '') {
        if ($('input[name=M1Q]').val() == '' || $('input[name=M1M]').val() == '' || $('input[name=M1N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Single Correct) Section....');
        }
    }
    if (!$('input[name=M2Q]').val() == '' || !$('input[name=M2M]').val() == '' || !$('input[name=M2N]').val() == '') {
        if ($('input[name=M2Q]').val() == '' || $('input[name=M2M]').val() == '' || $('input[name=M2N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Multi Correct) Section....');
        }
    }
    if (!$('input[name=M3Q]').val() == '' || !$('input[name=M3M]').val() == '' || !$('input[name=M3N]').val() == '') {
        if ($('input[name=M3Q]').val() == '' || $('input[name=M3M]').val() == '' || $('input[name=M3N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Integer Type) Section....');
        }
    }
    if (!$('input[name=M4Q]').val() == '' || !$('input[name=M4M]').val() == '' || !$('input[name=M4N]').val() == '') {
        if ($('input[name=M4Q]').val() == '' || $('input[name=M4M]').val() == '' || $('input[name=M4N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Numerical Type) Section....');
        }
    }
    if (!$('input[name=M5Q]').val() == '' || !$('input[name=M5M]').val() == '' || !$('input[name=M5N]').val() == '') {
        if ($('input[name=M5Q]').val() == '' || $('input[name=M5M]').val() == '' || $('input[name=M5N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Passage Type) Section....');
        }
    }
    if (!$('input[name=M6Q]').val() == '' || !$('input[name=M6M]').val() == '' || !$('input[name=M6N]').val() == '') {
        if ($('input[name=M6Q]').val() == '' || $('input[name=M6M]').val() == '' || $('input[name=M6N]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathemaatic (Match The Column) Section....');
        }
    }
    if (err == 0) {
        $('.tr2 :input').each(function() {
            if ($(this).val() == '') {
                $(this).val(0);
            }
        });
        $('.tr3 :input').each(function() {
            if ($(this).val() == '') {
                $(this).val(0);
            }
        });
        $('.tr4 :input').each(function() {
            if ($(this).val() == '') {
                $(this).val(0);
            }
        });
        var totalQ = parseInt('0' + $('input[name=advNOQ]').val());
        var totalPQ = parseInt('0' + $('input[name=P1Q]').val()) + parseInt('0' + $('input[name=P2Q]').val()) + parseInt('0' + $('input[name=P3Q]').val()) + parseInt('0' + $('input[name=P4Q]').val()) + parseInt('0' + $('input[name=P5Q]').val()) + parseInt('0' + $('input[name=P6Q]').val());
        var totalCQ = parseInt('0' + $('input[name=C1Q]').val()) + parseInt('0' + $('input[name=C2Q]').val()) + parseInt('0' + $('input[name=C3Q]').val()) + parseInt('0' + $('input[name=C4Q]').val()) + parseInt('0' + $('input[name=C5Q]').val()) + parseInt('0' + $('input[name=C6Q]').val());
        var totalMQ = parseInt('0' + $('input[name=M1Q]').val()) + parseInt('0' + $('input[name=M2Q]').val()) + parseInt('0' + $('input[name=M3Q]').val()) + parseInt('0' + $('input[name=M4Q]').val()) + parseInt('0' + $('input[name=M5Q]').val()) + parseInt('0' + $('input[name=M6Q]').val());
        var totalQ1 = parseInt(totalPQ) + parseInt(totalCQ) + parseInt(totalMQ);
        if (totalQ != totalQ1) {
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Number of Question and Total Questions not Matched....');
        } else {
            $.ajax({
                type: 'POST',
                url: '{{ route('
                admin - editadvancedpaper ') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'papername': $('input[name=advpapername]').val(),
                    'id': $('input[name=id]').val(),
                    'NOQ': $('input[name=advNOQ]').val(),
                    'TT': $('input[name=advTT]').val(),
                    'P1Q': $('input[name=P1Q]').val(),
                    'P1M': $('input[name=P1M]').val(),
                    'P1N': $('input[name=P1N]').val(),
                    'P2Q': $('input[name=P2Q]').val(),
                    'P2M': $('input[name=P2M]').val(),
                    'P2N': $('input[name=P2N]').val(),
                    'P3Q': $('input[name=P3Q]').val(),
                    'P3M': $('input[name=P3M]').val(),
                    'P3N': $('input[name=P3N]').val(),
                    'P4Q': $('input[name=P4Q]').val(),
                    'P4M': $('input[name=P4M]').val(),
                    'P4N': $('input[name=P4N]').val(),
                    'P5Q': $('input[name=P5Q]').val(),
                    'P5M': $('input[name=P5M]').val(),
                    'P5N': $('input[name=P5N]').val(),
                    'P6Q': $('input[name=P6Q]').val(),
                    'P6M': $('input[name=P6M]').val(),
                    'P6N': $('input[name=P6N]').val(),
                    'C1Q': $('input[name=C1Q]').val(),
                    'C1M': $('input[name=C1M]').val(),
                    'C1N': $('input[name=C1N]').val(),
                    'C2Q': $('input[name=C2Q]').val(),
                    'C2M': $('input[name=C2M]').val(),
                    'C2N': $('input[name=C2N]').val(),
                    'C3Q': $('input[name=C3Q]').val(),
                    'C3M': $('input[name=C3M]').val(),
                    'C3N': $('input[name=C3N]').val(),
                    'C4Q': $('input[name=C4Q]').val(),
                    'C4M': $('input[name=C4M]').val(),
                    'C4N': $('input[name=C4N]').val(),
                    'C5Q': $('input[name=C5Q]').val(),
                    'C5M': $('input[name=C5M]').val(),
                    'C5N': $('input[name=C5N]').val(),
                    'C6Q': $('input[name=C6Q]').val(),
                    'C6M': $('input[name=C6M]').val(),
                    'C6N': $('input[name=C6N]').val(),
                    'M1Q': $('input[name=M1Q]').val(),
                    'M1M': $('input[name=M1M]').val(),
                    'M1N': $('input[name=M1N]').val(),
                    'M2Q': $('input[name=M2Q]').val(),
                    'M2M': $('input[name=M2M]').val(),
                    'M2N': $('input[name=M2N]').val(),
                    'M3Q': $('input[name=M3Q]').val(),
                    'M3M': $('input[name=M3M]').val(),
                    'M3N': $('input[name=M3N]').val(),
                    'M4Q': $('input[name=M4Q]').val(),
                    'M4M': $('input[name=M4M]').val(),
                    'M4N': $('input[name=M4N]').val(),
                    'M5Q': $('input[name=M5Q]').val(),
                    'M5M': $('input[name=M5M]').val(),
                    'M5N': $('input[name=M5N]').val(),
                    'M6Q': $('input[name=M6Q]').val(),
                    'M6M': $('input[name=M6M]').val(),
                    'M6N': $('input[name=M6N]').val()
                },
                success: function(data) {
                    if ((data.error)) {
                        $("#loading").fadeOut();
                        $('#warning').modal('show');
                        $('#warning_line').text('Somthing went wrong...');
                    } else {
                        $("#loading").fadeOut();
                        $('#warning').modal('show');
                        $('#warning_line').text('Paper Updated Successfully....');
                    }
                },
            });
        }
    }
});

</script>
@endsection
