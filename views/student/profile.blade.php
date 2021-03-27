@extends('layout/student_dashboard')
@extends('layout/details')
@section('analysis')
@csrf
<div class="col-md-12 col-xl-12 mb-4 pt-4  pr-0 pl-0">
    <div class="card shadow border-success">
        <div class="card-body">
            <div class="row align-items-center no-gutters">
                <div class="col ml-3 mb-2 mt-2">
                    <div class="text-capitalize text-danger font-weight-bold text-s"><span>{{Auth::user()->name}}</span></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Username &nbsp;: &nbsp;{{Auth::user()->username}}</a></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Email&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; : &nbsp;{{Auth::user()->email}}</a></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Contact &nbsp; &nbsp;&nbsp; : &nbsp;{{Auth::user()->mobile}}</a></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Class &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp;: &nbsp;{{Auth::user()->class}}</a></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Course&nbsp; &nbsp; &nbsp;&nbsp; : &nbsp;{{Auth::user()->course}}</a></div>
                    <div class="text-dark font-weight-bold text-xs"><span></span><a style="font-size: 12px;">Group &nbsp; &nbsp; &nbsp;&nbsp; : &nbsp;{{Auth::user()->groupid}}</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <?php $date_show='true'; $no=0;  $date=0;?>
    @foreach($users as $user)
    <?php if($user->priority=="High"){$lable = "danger";} if($user->priority=="Medium"){$lable = "warning";} if($user->priority=="Low"){$lable = "primary";}  ?>
    <?php if(date_format(date_create($user->publish_date),"d/m/Y") != $date || $no==0){ $date_show='true'; $no=1; $date = date_format(date_create($user->publish_date),"d/m/Y"); }else{$date_show='false'; }
    $data=json_decode($user->complete, true);
    $status="unread";$progress=0;
    if($user->complete!=NULL){
      for($i=0;$i<sizeof($data);$i++) {
       if($data[$i]['s_id']==Auth::user()->id){ 
        $status = $data[$i]['mark'];$progress = $data[$i]['complete'];
       }}}
 if(date_format(date_create($user->publish_date),"YmdHi")>date_format(date_create(),"YmdHi")){continue;}?>
    @if($date_show=='true')
    <h5 style="text-align: center;width: 100%;font-weight: bold;">{{date_format(date_create($user->publish_date),"jS M, Y")}}</h5>
    @endif
    <div class="col-md-6 col-xl-3 mb-4">
        <div class="card shadow border-left-{{$lable}}">
            <div class="card-body">
                <div class="row align-items-center no-gutters">
                    <div class="col mr-2">
                        <div class="text-capitalize text-{{$lable}} font-weight-bold text-xs"><span>{{$user->t_name}} sir</span> <span style="float: right;">Priority : {{$user->priority}}</span></div>
                        <div class="text-dark font-weight-bold mb-0 text-xs"><span></span><a style="font-size: 14px;">{{$user->title}}</a></div>
                        <div class="text-dark mb-3 text-xs description" data-data="{{$user->description}}"></div>
                        <div class="text-dark mb-3 text-xs"><span></span>
                            <div class="slidecontainer"><a class="text-dark font-weight-bold">Progress </a><input style="background:linear-gradient(to right, #82CFD0 0%, #82CFD0 {{$progress}}%, #d3d3d3 {{$progress}}%, #d3d3d3 100%);" type="range" min="1" max="100" value="{{$progress}}" class="slider" id="slider{{$user->id}}" onchange="slider(this.value,{{$user->id}})">&nbsp;<a class="val{{$user->id}} text-dark font-weight-bold">{{$progress}}%</a></div>
                            <div class="text-dark mb-1 text-xs font-weight-bold"><span></span><input style=" width:25px;float:left;" type="checkbox" id="read_mark{{$user->id}}" name="read_mark" data-id="{{$user->id}}" @if($status=='read' )checked @endif><a style="float:left;font-size: 13px;padding-top: 1px;">Mark as read</a><a style="float:right;font-size: 11px;padding-top: 1px;">Posted : {{date_format(date_create($user->publish_date),"h:i a")}}</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<p>{{$users->onEachSide(1)->links()}}</p>
</div>
<style type="text/css">
.card-body {
    padding: .25rem 1.15rem;
}

.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 70%;
    height: 8px;
    padding: 0;
    border-radius: 5px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #4CAF50;
    cursor: pointer;
}

.description {
    font-size: 12px;
}

.description p {
    margin: 0;
}

</style>
@endsection
@section('js')
<script type="text/javascript">
function checkupdate() {
    if (window.AndroidFunction) {
        var code = AndroidFunction.Version_Code();
        if (code < 13) {
            if (code > 12) {
                AndroidFunction.showUpdate_Box();
            } else {
                AndroidFunction.forceUpdate_Box();
            }
        }
    }
}
checkupdate();

</script>
<script type="text/javascript">
function fn1() {
    AndroidButton.hideZoom();
}

function fn2() {
    AndroidButton.showZoom();
}

function fn3() {
    AndroidButton.allowScreenshot();
}

function fn4() {
    AndroidButton.notallowScreenshot();
}

function desc() {
    $('.description').each(function(e) {
        $(this).html($(this).data("data"));

    });
}
desc();

function slider(val, id) {
    $('#slider' + id).css('background', 'linear-gradient(to right, #82CFD0 0%, #82CFD0 ' + val + '%, #d3d3d3 ' + val + '%, #d3d3d3 100%)');
    $(".val" + id).text(val + '%');
    $.ajax({
        type: 'POST',
        url: '{{ route('
        student - task_progress_update ') }}',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'val': val,
        },
        success: function(data) {

        }
    });
}

$('input[name=read_mark]').change(function() {
    var id = $(this).data("id");
    if ($(this).is(':checked')) {
        mark = "read";
    } else {
        mark = "unread";
    }
    $.ajax({
        type: 'POST',
        url: '{{ route('
        student - task_status_update ') }}',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': id,
            'mark': mark,
        },
        success: function(data) {

        }
    });
});

</script>
@endsection
