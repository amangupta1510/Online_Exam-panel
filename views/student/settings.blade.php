@extends('layout/student_dashboard')
@extends('layout/details')
@section('inner_block')
<div class="inner-block col-md-10 " style="padding: 5%; background: #fff; border-radius: 10px; box-shadow: 0 1px 2px 1px rgba(154, 154, 204, .22);
    margin:1rem 1.5rem 1rem 1.5rem;">
    <form>
        @csrf
        <h3>UPDATE PASSWORD</h3>
        <p class="add-error text-center alert alert-danger hidden"></p>
        <p class="add-success text-center alert alert-success hidden">Password Updated Successfully...</p>
        <div class="col-12 text-center" style="margin-top: 20px; margin-right: 13%">
            <label>&nbsp;&nbsp;Old Password * </label>
            <input type="password" name="old_password" id="old_password">
        </div>
        <div class="col-12 text-center" style="margin-top: 20px; margin-right: 13%">
            <label>&nbsp;&nbsp;New Password * </label>
            <input type="password" name="password_1" id="password_1">
        </div>
        <div class="col-12 text-center" style="margin-top: 20px;margin-right: 15%">
            <label>Confirm Password</label>
            <input type="text" name="password_2" id="password_2">
        </div>
    </form>
    <div class="col-6" style="margin-top: 20px;">
        <button type="submit" id="sub" style="background-color: #fd6e70" class="btn center-block " name="change">UPDATE PASSWORD</button>
    </div>
</div>
<style type="text/css">
h3 {
    text-align: center;
    color: #4f4f4f;
    padding-top: 2%;
    font-family: 'Arial Black', Gadget, sans-serif;
    margin-bottom: 4%;
}

</style>
@endsection
@section('js')
<script type="text/javascript">
$(document).on('click', '#sub', function() {
    var loading = document.getElementById('loading');
    loading.style.display = '';
    if ($('input[name=old_password]').val() == '' || $('input[name=password_1]').val() == '' || $('input[name=password_2]').val() == '') {
        if (!$('.add-success').hasClass('hidden')) {
            $('.add-success').addClass('hidden');
        }
        if ($('.add-error').hasClass('hidden')) {
            $('.add-error').removeClass('hidden');
        }
        $('.add-error').text('Please Fill All Feild...');
        $("#loading").fadeOut(500);
    } else if ($('input[name=password_1]').val() != $('input[name=password_2]').val()) {
        if (!$('.add-success').hasClass('hidden')) {
            $('.add-success').addClass('hidden');
        }
        if ($('.add-error').hasClass('hidden')) {
            $('.add-error').removeClass('hidden');
        }
        $('.add-error').text('Confirm Password not Matched...');
        $("#loading").fadeOut(500);
    } else {
        $.ajax({
            type: 'POST',
            url: '{{ route('
            student - changepassword ') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'old': $('#old_password').val(),
                'new': $('#password_1').val()
            },
            success: function(data) {
                if ((data.errors)) {
                    if (!$('.add-success').hasClass('hidden')) {
                        $('.add-success').addClass('hidden');
                    }
                    $('.add-error').removeClass('hidden');
                    $('.add-error').text('Old Password not Matched...');
                    $("#loading").fadeOut(500);

                } else {
                    if (!$('.add-error').hasClass('hidden')) {
                        $('.add-error').addClass('hidden');
                    }
                    if ($('.add-success').hasClass('hidden')) {
                        $('.add-success').removeClass('hidden');
                        $("#loading").fadeOut(500);
                    }

                    $('#old_password').val('');
                    $('#password_1').val('');
                    $('#password_2').val('');
                    $("#loading").fadeOut(500);
                }

            },
        })
    }
});

</script>
@endsection
