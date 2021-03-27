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
<div id="normal_paper" class="p-5 mb-4">
    <h2>Update Paper</h2>
    <form id="normal_form">
        {{csrf_field()}}
        <div class="col-md-12 subject_div">
            <div class="col-md-2"></div>
            <div class="form-group col-md-3">
                <label>paper name</label>
                <input type="hidden" name="id" disabled="" value="{{$user->id}}">
                <input class="form-control" type="text" id="papername" name="papername" placeholder="Paper name" disabled="" value="{{$user->pname}}">
            </div>
            <div class="form-group col-md-3">
                <label>Numer of Questions</label>
                <input class="form-control" id="NOQ" type="number" name="NOQ" placeholder="Numer of Questions" disabled="" value="{{$user->NOQ}}">
            </div>
            <div class="form-group col-md-3">
                <label>Total Time(min)</label>
                <input class="form-control" id="TT" type="number" name="TT" placeholder="Total Time(min)" value="{{$user->TT}}">
            </div>
        </div>
        <div class="col-md-12 subject_div1">
            <div class="col-md-2 subject"><b>Physics</b></div>
            <div class="form-group col-md-3">
                <label>Questions</label>
                <input class="form-control" id="PQ" type="number" name="PQ" placeholder="Physics Questions" disabled="" value="{{$user->PQ}}">
            </div>
            <div class="form-group col-md-3">
                <label>Question Mark</label>
                <input class="form-control" id="PM" type="number" name="PM" placeholder="Physics Q. Marks" value="{{$user->PM}}">
            </div>
            <div class="form-group col-md-3">
                <label>Negative Mark</label>
                <input class="form-control" id="PN" type="number" name="PN" placeholder="Negative marks" value="{{$user->PN}}">
            </div>
        </div>
        <div class="col-md-12 subject_div2">
            <div class="col-md-2 subject"><b>Chemistry</b></div>
            <div class="form-group col-md-3">
                <label>Questions</label>
                <input class="form-control" id="CQ" type="number" name="CQ" placeholder="Chemistry Questions" disabled="" value="{{$user->CQ}}">
            </div>
            <div class="form-group col-md-3">
                <label>Question Mark</label>
                <input class="form-control" id="CM" type="number" name="CM" placeholder="Chemistry Q. Marks" value="{{$user->CM}}">
            </div>
            <div class="form-group col-md-3">
                <label>Negative Mark</label>
                <input class="form-control" id="CN" type="number" name="CN" placeholder="Negative marks" value="{{$user->CN}}">
            </div>
        </div>
        <div class="col-md-12 subject_div3">
            <div class="col-md-2 subject"><b>Mathematic</b></div>
            <div class="form-group col-md-3">
                <label>Questions</label>
                <input class="form-control" id="MQ" type="number" name="MQ" placeholder="Mathematic Questions" disabled="" value="{{$user->MQ}}">
            </div>
            <div class="form-group col-md-3">
                <label>Question Mark</label>
                <input class="form-control" id="MM" type="number" name="MM" placeholder="Mathematic Q. Marks" value="{{$user->MM}}">
            </div>
            <div class="form-group col-md-3">
                <label>Negative Mark</label>
                <input class="form-control" id="MN" type="number" name="MN" placeholder="Negative marks" value="{{$user->MN}}">
            </div>
        </div>
        <div class="col-md-12 subject_div4">
            <div class="col-md-2 subject"><b>Biology</b></div>
            <div class="form-group col-md-3">
                <label>Questions</label>
                <input class="form-control" id="BQ" type="number" name="BQ" placeholder="Biology Questions" disabled="" value="{{$user->BQ}}">
            </div>
            <div class="form-group col-md-3">
                <label>Question Mark</label>
                <input class="form-control" id="BM" type="number" name="BM" placeholder="Biology Q. Marks" value="{{$user->BM}}">
            </div>
            <div class="form-group col-md-3">
                <label>Negative Mark</label>
                <input class="form-control" id="BN" type="number" name="BN" placeholder="Negative marks" value="{{$user->BN}}">
            </div>
        </div>
        <div class="col-md-11" style="margin-top: 30px;">
            <a id="normal_submit" name="normal_submit" style="background-color: #fd6e70" class="btn btn-block  mb-4">Update</a>
        </div>
    </form>
</div>
@endforeach
@endsection
@section('js')
<script type="text/javascript">
//-------------------------------------------------normal paper--------------------------------------------
$("#normal_submit").click(function() {
    var err = 0;
    var loading = document.getElementById('loading');
    loading.style.display = '';
    if ($('input[name=papername]').val() == '' || $('input[name=NOQ]').val() == '' || $('input[name=TT]').val() == '') {
        var err = 1;
        $("#loading").fadeOut();
        $('#warning').modal('show');
        $('#warning_line').text('Please Fill paper details on Top....');
    }
    if (!$('input[name=PQ]').val() == '' || !$('input[name=PM]').val() == '' || !$('input[name=PN]').val() == '') {
        if ($('input[name=PQ]').val() == '' || $('input[name=PM]').val() == '' || $('input[name=PN]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Physics Section....');
        }
    }
    if (!$('input[name=CQ]').val() == '' || !$('input[name=CM]').val() == '' || !$('input[name=CN]').val() == '') {
        if ($('input[name=CQ]').val() == '' || $('input[name=CM]').val() == '' || $('input[name=CN]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Chemistry Section....');
        }
    }
    if (!$('input[name=MQ]').val() == '' || !$('input[name=MM]').val() == '' || !$('input[name=MN]').val() == '') {
        if ($('input[name=MQ]').val() == '' || $('input[name=MM]').val() == '' || $('input[name=MN]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Mathematics Section....');
        }
    }
    if (!$('input[name=BQ]').val() == '' || !$('input[name=BM]').val() == '' || !$('input[name=BN]').val() == '') {
        if ($('input[name=BQ]').val() == '' || $('input[name=BM]').val() == '' || $('input[name=BN]').val() == '') {
            var err = 1;
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Please Fill Biology Section....');
        }
    }
    if (err == 0) {
        $('#normal_form :input').each(function() {
            if ($(this).val() == '') {
                $(this).val(0);
            }
        });
        var totalQ = parseInt('0' + $('input[name=NOQ]').val());
        var totalPQ = parseInt('0' + $('input[name=PQ]').val());
        var totalCQ = parseInt('0' + $('input[name=CQ]').val());
        var totalMQ = parseInt('0' + $('input[name=MQ]').val());
        var totalBQ = parseInt('0' + $('input[name=BQ]').val());

        var totalQ1 = parseInt(totalPQ) + parseInt(totalCQ) + parseInt(totalMQ) + parseInt(totalBQ);
        if (totalQ != totalQ1) {
            $("#loading").fadeOut();
            $('#warning').modal('show');
            $('#warning_line').text('Number of Question and Total Questions not Matched....');
        } else {
            $.ajax({
                type: 'POST',
                url: '{{ route('
                admin - editnormalpaper ') }}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'papername': $('input[name=papername]').val(),
                    'id': $('input[name=id]').val(),
                    'NOQ': $('input[name=NOQ]').val(),
                    'TT': $('input[name=TT]').val(),
                    'PQ': $('input[name=PQ]').val(),
                    'PM': $('input[name=PM]').val(),
                    'PN': $('input[name=PN]').val(),
                    'CQ': $('input[name=CQ]').val(),
                    'CM': $('input[name=CM]').val(),
                    'CN': $('input[name=CN]').val(),
                    'MQ': $('input[name=MQ]').val(),
                    'MM': $('input[name=MM]').val(),
                    'MN': $('input[name=MN]').val(),
                    'BQ': $('input[name=BQ]').val(),
                    'BM': $('input[name=BM]').val(),
                    'BN': $('input[name=BN]').val()
                },
                success: function(data) {
                    if ((data.error)) {
                        $("#loading").fadeOut();
                        $('#warning').modal('show');
                        $('#warning_line').text('Something went wrong...');
                    } else {
                        $("#loading").fadeOut();
                        $('#warning').modal('show');
                        $('#warning_line').text('Paper Updated Successfully....');
                    }
                }
            });
        }
    }
});

</script>
@endsection
