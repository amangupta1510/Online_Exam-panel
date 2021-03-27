@extends('layout/admin_dashboard')
@extends('layout/details')
@section('popup')
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
<div id="delete" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">delete</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="modal">
                    {{csrf_field()}}
                    <h4 id="delete-name"></h4>
                    <p id="delete-id" class="hidden"></p>
                </form>
            </div>
            <div class="modal-footer">
                <button style="background-color: #fd6e70" class="btn btn-warning" type="submit" id="delete_p">
                    Delete
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
{{-- Form notification --}}
<div id="notification" class="modal fade " role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p class="msg_done" style="border: 2px solid #ebecef; padding:5px 5px; background: #1cc88a42;border-radius: 5px;text-align: center;margin-bottom: 5px;">Done</p>
                <div style="border: 2px solid #e9e9e9; padding:5px 5px; background: #ebecef;border-radius: 10px;"><a class="notification_name" style="font-weight: 400; font-size: 20px;"></a>
                    <div style="float: right;"><a class="msg-button msg-btn" data-channel="" data-title="Message to all users" data-event="message_all"><i class="fa fa-comment-o" style="color: #ff5c33; font-size: 20px;"></i></a>&nbsp;&nbsp;&nbsp;
                        <a class="msg-button reload-btn" data-channel="" data-title="Relaod paper of all users" data-event="reload_all"><i class="fa fa-refresh" style="color: #ff5c33; font-size: 20px;"></i></a>&nbsp;&nbsp;&nbsp;
                        <a class="msg-button submit-btn" data-channel="" data-title="Submit paper of all users" data-event="submit_all"><i class="fa fa-check-square-o" style="color: #ff5c33; font-size: 20px;"></i></a></div>
                </div>
                <p class="participants" data-count="0">Participants (0)</p>
                <ul id="notification_table">Participants</ul>
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
<link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainuploaded_paper_list.css')}}">
<div class="limiter">
    <div class="title">
        <div class="searchBox">
            <h4><b>Uploaded Paper</b>
                <div class="searchForm">
                    <form action="{{route('admin-uploaded_paper')}}" method="get">
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
                            <th class="column3">Cl.|Co.|Co.t.|Gr.</th>
                            <th class="column4">Publish Time</th>
                            <th class="column5">Edit</th>
                            <th class="column6">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $n = app('request')->input('page'); if($n>1||$n!=""){$no=$n*10-9;}else{$no=1;} ?>
                        @foreach($users as $user)
                        <tr class="user{{$user->id}}">
                            <td class="column1"><strong>{{ $no++ }}</strong></td>
                            <td class="column2"><strong>{{ $user->paper }}</strong></td>
                            <td class="column3"><strong>{{ $user->classid.'|'.$user->courseid.'|'.$user->coursetypeid.'|'. $user->groupid }}</strong></td>
                            <td class="column4"><strong>{{ $user->publishtime }}</strong></td>
                            <td class="column5"><a title="Paper Preview" id="show-button" data-toggle="modal" data-target="#show" data-plid="{{$user->id}}" data-pid="{{$user->pid}}" data-name="{{$user->pname}}" data-type="{{$user->type}}">
                                    <i class="fa fa-eye" style="color: #5b84d7"></i></a>&nbsp;&nbsp;&nbsp;<a id="notification-button" data-toggle="modal" data-target="#notification" data-pid="{{$user->pid}}" data-id="{{$user->id}}" data-name="{{$user->paper}}" data-type="{{$user->type}}"><i class="fa fa-bell" style="color: #ff9933"></i></a>&nbsp;&nbsp;&nbsp;<a class="detail-button{{$user->id}}" id="detail-button" data-pid="{{$user->pid}}" data-id="{{$user->id}}" data-type="{{$user->type}}" data-name="{{$user->paper}}">
                                    <i class="fa fa-server" style="color: #ff9933"></i></a>
                            <td class="column6">
                                @if($user->test_series !='true' || Auth::user()->admin=='yes')<a style="color: #fff" href="{{  route('admin-uploaded_paper_edit',['id'=>$user->id]) }}"> <i class="glyphicon glyphicon-pencil" style="color:#ff9933"></i></a>&nbsp;&nbsp;&nbsp;<a id="delete-button" data-toggle="modal" data-target="#delete" data-name="{{$user->paper}}" data-id="{{$user->id}}">
                                    <i class="glyphicon glyphicon-trash" style="color: #ff5c33"></i></a>@else<a>NA&nbsp;&nbsp;&nbsp;NA</a>@endif</td>
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
    <script type="text/javascript">
    $(".search-btn").click(function() {
        $(".search-input").toggleClass("active").focus;
        $(this).toggleClass("animate");
        $(".input").val("");
    });

    </script>
    <script type="text/javascript">
    $('.msg_done').hide();
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var url = $(this).attr('href').split('page=')[1];
        var year = $('input[name=s]').val();
        var img = "{{ route('admin-uploaded_paper_page',['s'=>':year','page'=>':page']) }}";
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
        var plid = $(this).data('plid');
        var pid = $(this).data('pid');
        if ($(this).data('type') == "normal") {
            var img = "{{ route('admin-nr_image',['id'=>':id','plid'=>':plid']) }}";
        } else {
            var img = "{{ route('admin-adv_image',['id'=>':id','plid'=>':plid']) }}";
        }
        var img = img.replace('%3Aid', pid);
        var img = img.replace('%3Aplid', plid);
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $('#table').empty().html(data);
            $("#loading").fadeOut(500);
        })
    });

    $(document).on('click', '#delete-button', function() {
        $('#delete').modal({ backdrop: 'false' });
        $('#delete-name').text('Are You sure want to delete (' + $(this).data('name') + ')....');
        $('#delete-id').text($(this).data('id'));

    });
    $('#delete_p').click(function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $.ajax({
            type: 'POST',
            url: '{{ route('
            admin - delete_link ') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#delete-id').text(),
            },
            success: function(data) {
                $('.user' + $('#delete-id').text()).hide();
                $('#delete').modal('hide');
                $("#loading").fadeOut(500);
            }
        });
    });
    $(document).on('click', '#detail-button', function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        $(".spinner").hide();
        $('.socket_title').text('Details');
        $("#socket").show("closed");
        $('.socket_body').empty().html('');
        var img = "{{ route('admin-paper_link_details',['id'=>':id']) }}";
        var img = img.replace('%3Aid', $(this).data('id'));
        var img = img.replace('&amp;', '&');
        var type = $(this).data('type');
        var pid = $(this).data('pid');
        $.get(img, function(data) {

            for (var i = 0; i < data.length; i++) {
                var todayTime = new Date(data[i].created_at);
                var month = todayTime.getMonth();
                var day = todayTime.getDate();
                var hour = todayTime.getHours() >= 12 ? todayTime.getHours() - 12 : todayTime.getHours();
                var j = todayTime.getHours() >= 12 ? 'pm' : 'am';
                var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                var minute = todayTime.getMinutes() < 10 ? '0' + todayTime.getMinutes() : todayTime.getMinutes();
                var year = todayTime.getFullYear();
                var date = day + " " + months[month] + ' at ' + hour + ':' + minute + ' ' + j;
                if (data[i].result == 'Submited') {
                    $('.socket_body').append('<li style="font-size:13px; border-bottom:1px solid grey;"><div>' + data[i].s_name + '<div><a style="font-size:12px; border:1px;">entry:' + date + ', remain ' + parseInt(data[i].timeleft / 60) + ' mins</a>&nbsp;&nbsp;<a style="font-size:12px;">Submited</a></div></div></li>');
                } else {
                    $('.socket_body').append('<li style="font-size:13px; padding-bottom:3px; border-bottom:1px solid grey;"><div>' + data[i].s_name + '<div><a style="font-size:12px; border:1px;">entry:' + date + ', remain ' + parseInt(data[i].timeleft / 60) + ' mins</a>&nbsp;&nbsp;<a class="btn btn-success submit_result" data-type="' + type + '" data-pid="' + pid + '" data-plid="' + data[i].plid + '" data-sid="' + data[i].sid + '" style="font-size:12px;padding: .175rem .45rem;color:#fff;display:inline;">Submit</a></div></div></li>');
                }
            }
            $("#loading").fadeOut(500);
        })
    });


    $("body").delegate(".submit_result", "click", function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var img = "{{ route('admin-get_ans',['sid'=>':sid','plid'=>':plid','pid'=>':pid','type'=>':type']) }}";
        var img = img.replace('%3Asid', $(this).data('sid'));
        var img = img.replace('%3Aplid', $(this).data('plid'));
        var img = img.replace('%3Apid', $(this).data('pid'));
        var img = img.replace('%3Atype', $(this).data('type'));
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var type = $(this).data('type');
        var plid = $(this).data('plid');
        var sid = $(this).data('sid');
        $.get(img, function(data) {
            if (type == 'normal') {
                var pname = data.paper[0].pname;
                TT = data.paper[0].TT;
                NOQ = data.paper[0].NOQ;
                total_marks = data.paper[0].total_marks;
                PQ = data.paper[0].PQ;
                PM = data.paper[0].PM;
                PN = data.paper[0].PN;
                CQ = data.paper[0].CQ;
                CM = data.paper[0].CM;
                CN = data.paper[0].CN;
                MQ = data.paper[0].MQ;
                MM = data.paper[0].MM;
                MN = data.paper[0].MN;
                BQ = data.paper[0].BQ;
                BM = data.paper[0].BM;
                BN = data.paper[0].BN;

                var PQN = parseInt(PQ)
                var CQN = parseInt(PQ) + parseInt(CQ);
                var MQN = parseInt(PQ) + parseInt(CQ) + parseInt(MQ);
                var BQN = parseInt(PQ) + parseInt(CQ) + parseInt(MQ) + parseInt(BQ);

                var no = 0;
                var MinP = 0;
                var CinP = 0;
                var WinP = 0;
                var MinC = 0;
                var CinC = 0;
                var WinC = 0;
                var MinM = 0;
                var CinM = 0;
                var WinM = 0;
                var MinB = 0;
                var CinB = 0;
                var WinB = 0;
                for (var i = 0; i < data.data.length; i++) {
                    if (data.data[i].qid <= PQN) {
                        if ((data.data[i].a1 == data.data[i].a7 || data.data[i].a7 == "Bonus") && (data.data[i].a8 == "save" || data.data[i].a8 == "save_mark")) {
                            var MinP = parseInt(MinP) + parseInt(PM);
                            CinP++;
                        } else if ((data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinP = parseInt(MinP) - parseInt(PN);
                            WinP++;
                        }
                    } else if (data.data[i].qid <= CQN && data.data[i].qid > PQN) {
                        if ((data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinC = parseInt(MinC) + parseInt(CM);
                            CinC++;
                        } else if ((data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinC = parseInt(MinC) - parseInt(CN);
                            WinC++;
                        }
                    } else if (data.data[i].qid <= MQN && data.data[i].qid > CQN) {
                        if ((data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinM = parseInt(MinM) + parseInt(MM);
                            CinM++;
                        } else if ((data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinM = parseInt(MinM) - parseInt(MN);
                            WinM++;
                        }
                    } else if (data.data[i].qid <= BQN && data.data[i].qid > MQN) {
                        if ((data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 == data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinB = parseInt(MinB) + parseInt(BM);
                            CinB++;
                        } else if ((data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save") || (data.data[i].a1 != data.data[i].a7 && data.data[i].a8 == "save_mark")) {
                            var MinB = parseInt(MinB) - parseInt(BN);
                            WinB++;
                        }
                    }
                }
                var totalS = parseInt(MinP) + parseInt(MinC) + parseInt(MinM) + parseInt(MinB);
                var totalQ = parseInt(NOQ);
                var totalC = parseInt(CinP) + parseInt(CinC) + parseInt(CinM) + parseInt(CinB);
                var totalW = parseInt(WinP) + parseInt(WinC) + parseInt(WinM) + parseInt(WinB);
                var totalA = parseInt(totalC) + parseInt(totalW);
                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin-auto_submit_result') }}",
                        data: { type: type, sid: sid, plid: plid, pid: data.paper[0].id, pname: data.paper[0].pname, TT: data.paper[0].TT, PQN: PQN, CQN: CQN, MQN: MQN, BQN: BQN, total_marks: total_marks, totalQ: totalQ, totalA: totalA, totalC: totalC, totalW: totalW, totalS: totalS, CinP: CinP, WinP: WinP, MinP: MinP, CinC: CinC, WinC: WinC, MinC: MinC, CinM: CinM, WinM: WinM, MinM: MinM, CinB: CinB, WinB: WinB, MinB: MinB },
                        success: function(data) {
                            $(".detail-button" + plid).trigger('click');
                        }
                    });
                }, 1000);
            } else if (type == 'custom') {
                var total_marks = data.paper[0].total_marks;
                var totalS = 0;
                var totalQ = data.paper[0].NOQ;
                var totalC = 0;
                var totalW = 0;
                var totalA = 0;
                var totalP = 0;

                var qn = 0;
                var k = 0;
                var ans = new Array();
                for (var i = 0; i < JSON.parse(data.paper[0].structure)[0].pattern.length; i++) {
                    var subject = JSON.parse(data.paper[0].structure)[0].pattern[i];
                    var correct = 0;
                    var incorrect = 0;
                    var score = 0;
                    var attempt = 0;
                    var pending = 0;
                    var time_usedC = 0;
                    var time_usedW = 0;
                    var time_usedU = 0;
                    var time_usedP = 0;
                    if (subject.question > 0) {
                        var qnl = subject.question;
                        for (var i = qn + 1; i <= (qn + qnl); i++) {
                            for (var j = k; j < data.data.length; j++) {
                                if (data.data[j].qid == i) {
                                    if ((data.data[j].answer == "Correct" || data.data[j].answer == 'Partially Correct') && (data.data[j].ans_type == "save" || data.data[j].ans_type == "save_mark")) {
                                        totalS += parseInt(data.data[j].marks);
                                        score += parseInt(data.data[j].marks);
                                        totalC++;
                                        totalA++;
                                        correct++;
                                        attempt++;
                                        time_usedC += parseInt(data.data[j].time_used);
                                    } else if (data.data[j].answer == "Incorrect" && (data.data[j].ans_type == "save" || data.data[j].ans_type == "save_mark")) {
                                        totalS -= parseInt(data.data[j].marks);
                                        score -= parseInt(data.data[j].marks);
                                        totalW++;
                                        totalA++;
                                        incorrect++;
                                        attempt++;
                                        time_usedW += parseInt(data.data[j].time_used);
                                    } else if (data.data[j].answer == "Pending" && (data.data[j].ans_type == "save" || data.data[j].ans_type == "save_mark")) {
                                        totalP++;
                                        pending++;
                                        time_usedP += parseInt(data.data[j].time_used);
                                    } else { time_usedU += data.data[j].time_used; }
                                    var k = parseInt(j) + parseInt(1);
                                    break;
                                }
                            }
                        }
                        ans.push({ 'subject': subject.subject, 'question': subject.question, 'total_marks': subject.marks, 'totalS': score, 'totalA': attempt, 'totalC': correct, 'totalW': incorrect, 'totalP': pending, 'time_usedC': time_usedC, 'time_usedW': time_usedW, 'time_usedP': time_usedP, 'time_usedU': time_usedU });
                        qn += subject.question;
                    }
                }
                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin-auto_submit_result') }}",
                        data: { type: type, sid: sid, plid: plid, pid: data.paper[0].id, pname: data.paper[0].pname, TT: data.paper[0].TT, PQN: 0, CQN: 0, MQN: 0, BQN: 0, total_marks: total_marks, totalQ: totalQ, totalA: totalA, totalC: totalC, totalW: totalW, totalP: totalP, totalS: totalS, CinP: CinP, WinP: 0, MinP: 0, CinC: 0, WinC: 0, MinC: 0, CinM: 0, WinM: 0, MinM: 0, CinB: 0, WinB: 0, MinB: 0, custom_structure: JSON.stringify(ans) },
                        success: function(data) {
                            $(".detail-button" + plid).trigger('click');
                        }
                    });
                }, 1000);
            } else {
                var pname = data.paper[0].pname;
                TT = data.paper[0].TT;
                NOQ = data.paper[0].NOQ;
                total_marks = data.paper[0].total_marks;
                P1Q = data.paper[0].P1Q;
                P1M = data.paper[0].P1M;
                P1N = data.paper[0].P1N;
                P2Q = data.paper[0].P2Q;
                P2M = data.paper[0].P2M;
                P2N = data.paper[0].P2N;
                P3Q = data.paper[0].P3Q;
                P3M = data.paper[0].P3M;
                P3N = data.paper[0].P3N;
                P4Q = data.paper[0].P4Q;
                P4M = data.paper[0].P4M;
                P4N = data.paper[0].P4N;
                P5Q = data.paper[0].P5Q;
                P5M = data.paper[0].P5M;
                P5N = data.paper[0].P5N;
                P6Q = data.paper[0].P6Q;
                P6M = data.paper[0].P6M;
                P6N = data.paper[0].P6N;
                C1Q = data.paper[0].C1Q;
                C1M = data.paper[0].C1M;
                C1N = data.paper[0].C1N;
                C2Q = data.paper[0].C2Q;
                C2M = data.paper[0].C2M;
                C2N = data.paper[0].C2N;
                C3Q = data.paper[0].C3Q;
                C3M = data.paper[0].C3M;
                C3N = data.paper[0].C3N;
                C4Q = data.paper[0].C4Q;
                C4M = data.paper[0].C4M;
                C4N = data.paper[0].C4N;
                C5Q = data.paper[0].C5Q;
                C5M = data.paper[0].C5M;
                C5N = data.paper[0].C5N;
                C6Q = data.paper[0].C6Q;
                C6M = data.paper[0].C6M;
                C6N = data.paper[0].C6N;
                M1Q = data.paper[0].M1Q;
                M1M = data.paper[0].M1M;
                M1N = data.paper[0].M1N;
                M2Q = data.paper[0].M2Q;
                M2M = data.paper[0].M2M;
                M2N = data.paper[0].M2N;
                M3Q = data.paper[0].M3Q;
                M3M = data.paper[0].M3M;
                M3N = data.paper[0].M3N;
                M4Q = data.paper[0].M4Q;
                M4M = data.paper[0].M4M;
                M4N = data.paper[0].M4N;
                M5Q = data.paper[0].M5Q;
                M5M = data.paper[0].M5M;
                M5N = data.paper[0].M5N;
                M6Q = data.paper[0].M6Q;
                M6M = data.paper[0].M6M;
                M6N = data.paper[0].M6N;

                var PQN = parseInt(P1Q) + parseInt(P2Q) + parseInt(P3Q) + parseInt(P4Q) + parseInt(P5Q) + parseInt(P6Q);
                var PQN1 = parseInt(P1Q) + parseInt(P2Q) + parseInt(P3Q) + parseInt(P4Q);
                var PQN2 = parseInt(P1Q) + parseInt(P2Q) + parseInt(P3Q) + parseInt(P4Q) + parseInt(P5Q);
                var PQN3 = parseInt(P1Q);
                var PQN4 = parseInt(P1Q) + parseInt(P2Q);
                var PQN5 = parseInt(P1Q) + parseInt(P2Q) + parseInt(P3Q);
                var CQN = parseInt(PQN) + parseInt(C1Q) + parseInt(C2Q) + parseInt(C3Q) + parseInt(C4Q) + parseInt(C5Q) + parseInt(C6Q);
                var CQN1 = parseInt(PQN) + parseInt(C1Q) + parseInt(C2Q) + parseInt(C3Q) + parseInt(C4Q);
                var CQN2 = parseInt(PQN) + parseInt(C1Q) + parseInt(C2Q) + parseInt(C3Q) + parseInt(C4Q) + parseInt(C5Q);
                var CQN3 = parseInt(PQN) + parseInt(C1Q);
                var CQN4 = parseInt(PQN) + parseInt(C1Q) + parseInt(C2Q);
                var CQN5 = parseInt(PQN) + parseInt(C1Q) + parseInt(C2Q) + parseInt(C3Q);
                var MQN = parseInt(CQN) + parseInt(M1Q) + parseInt(M2Q) + parseInt(M3Q) + parseInt(M4Q) + parseInt(M5Q) + parseInt(M6Q);
                var MQN1 = parseInt(CQN) + parseInt(M1Q) + parseInt(M2Q) + parseInt(M3Q) + parseInt(M4Q);
                var MQN2 = parseInt(CQN) + parseInt(M1Q) + parseInt(M2Q) + parseInt(M3Q) + parseInt(M4Q) + parseInt(M5Q);
                var MQN3 = parseInt(CQN) + parseInt(M1Q);
                var MQN4 = parseInt(CQN) + parseInt(M1Q) + parseInt(M2Q);
                var MQN5 = parseInt(CQN) + parseInt(M1Q) + parseInt(M2Q) + parseInt(M3Q);
                var no = 0;
                var MinP = 0;
                var CinP = 0;
                var WinP = 0;
                var MinC = 0;
                var CinC = 0;
                var WinC = 0;
                var MinM = 0;
                var CinM = 0;
                var WinM = 0;

                for (var i = 0; i < data.data.length; i++) {
                    if (data.data[i].qtype == 'single' || data.data[i].qtype == 'passage' || data.data[i].qtype == 'match_column') {
                        if (data.data[i].qid <= PQN) {
                            if (data.data[i].qid <= P1Q) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) + parseInt(P1M);
                                    CinP++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) - parseInt(P1N);
                                    WinP++;
                                }
                            } else if (data.data[i].qid <= PQN2 && data.data[i].qid > PQN1) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) + parseInt(P5M);
                                    CinP++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) - parseInt(P5N);
                                    WinP++;
                                }
                            } else if (data.data[i].qid <= PQN && data.data[i].qid > PQN2) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) + parseInt(P6M);
                                    CinP++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinP = parseInt(MinP) - parseInt(P6N);
                                    WinP++;
                                }
                            }
                        } else if (data.data[i].qid > PQN && data.data[i].qid <= CQN) {
                            if (data.data[i].qid <= CQN3) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) + parseInt(C1M);
                                    CinC++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) - parseInt(C1N);
                                    WinC++;
                                }
                            } else if (data.data[i].qid <= CQN2 && data.data[i].qid > CQN1) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) + parseInt(C5M);
                                    CinC++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) - parseInt(C5N);
                                    WinC++;
                                }
                            } else if (data.data[i].qid <= CQN && data.data[i].qid > CQN2) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) + parseInt(C6M);
                                    CinC++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinC = parseInt(MinC) - parseInt(C6N);
                                    WinC++;
                                }
                            }
                        } else if (data.data[i].qid > CQN && data.data[i].qid <= MQN) {
                            if (data.data[i].qid <= MQN3) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) + parseInt(M1M);
                                    CinM++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) - parseInt(M1N);
                                    WinM++;
                                }
                            } else if (data.data[i].qid <= MQN2 && data.data[i].qid > MQN1) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) + parseInt(M5M);
                                    CinM++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) - parseInt(M5N);
                                    WinM++;
                                }
                            } else if (data.data[i].qid <= MQN && data.data[i].qid > MQN2) {
                                if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) + parseInt(M6M);
                                    CinM++;
                                } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                    var MinM = parseInt(MinM) - parseInt(M6N);
                                    WinM++;
                                }
                            }
                        }

                    } else if (data.data[i].qtype == 'multiple') {
                        if (data.data[i].qid <= PQN4 && data.data[i].qid > PQN3) {
                            if (((data.data[i].a1 == data.data[i].a5 && data.data[i].a2 == data.data[i].a6 && data.data[i].a3 == data.data[i].a7 && data.data[i].a4 == data.data[i].a8) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) + parseInt(P2M);
                                CinP++;
                            } else if (((data.data[i].a1 != data.data[i].a5 && data.data[i].a1 != "") || (data.data[i].a2 != data.data[i].a6 && data.data[i].a2 != "") || (data.data[i].a3 != data.data[i].a7 && data.data[i].a3 != "") || (data.data[i].a4 != data.data[i].a8 && data.data[i].a4 != "")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) - parseInt(P2N);
                                WinP++;
                            } else { if (data.data[i].a1 == data.data[i].a5 && data.data[i].a1 != "") { var MinP = parseInt(MinP) + parseInt(1); } if (data.data[i].a2 == data.data[i].a6 && data.data[i].a2 != "") { var MinP = parseInt(MinP) + parseInt(1); } if (data.data[i].a3 == data.data[i].a7 && data.data[i].a3 != "") { var MinP = parseInt(MinP) + parseInt(1); } if (data.data[i].a4 == data.data[i].a8 && data.data[i].a4 != "") { var MinP = parseInt(MinP) + parseInt(1); } CinP++; }
                        } else if (data.data[i].qid <= CQN4 && data.data[i].qid > CQN3) {
                            if (((data.data[i].a1 == data.data[i].a5 && data.data[i].a2 == data.data[i].a6 && data.data[i].a3 == data.data[i].a7 && data.data[i].a4 == data.data[i].a8) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) + parseInt(C2M);
                                CinC++;
                            } else if (((data.data[i].a1 != data.data[i].a5 && data.data[i].a1 != "") || (data.data[i].a2 != data.data[i].a6 && data.data[i].a2 != "") || (data.data[i].a3 != data.data[i].a7 && data.data[i].a3 != "") || (data.data[i].a4 != data.data[i].a8 && data.data[i].a4 != "")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) - parseInt(C2N);
                                WinC++;
                            } else { if (data.data[i].a1 == data.data[i].a5 && data.data[i].a1 != "") { var MinC = parseInt(MinC) + parseInt(1); } if (data.data[i].a2 == data.data[i].a6 && data.data[i].a2 != "") { var MinC = parseInt(MinC) + parseInt(1); } if (data.data[i].a3 == data.data[i].a7 && data.data[i].a3 != "") { var MinC = parseInt(MinC) + parseInt(1); } if (data.data[i].a4 == data.data[i].a8 && data.data[i].a4 != "") { var MinC = parseInt(MinC) + parseInt(1); } CinC++; }
                        } else if (data.data[i].qid <= MQN4 && data.data[i].qid > MQN3) {
                            if (((data.data[i].a1 == data.data[i].a5 && data.data[i].a2 == data.data[i].a6 && data.data[i].a3 == data.data[i].a7 && data.data[i].a4 == data.data[i].a8) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) + parseInt(M2M);
                                CinM++;
                            } else if (((data.data[i].a1 != data.data[i].a5 && data.data[i].a1 != "") || (data.data[i].a2 != data.data[i].a6 && data.data[i].a2 != "") || (data.data[i].a3 != data.data[i].a7 && data.data[i].a3 != "") || (data.data[i].a4 != data.data[i].a8 && data.data[i].a4 != "")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) - parseInt(M2N);
                                WinM++;
                            } else { if (data.data[i].a1 == data.data[i].a5 && data.data[i].a1 != "") { var MinM = parseInt(MinM) + parseInt(1); } if (data.data[i].a2 == data.data[i].a6 && data.data[i].a2 != "") { var MinM = parseInt(MinM) + parseInt(1); } if (data.data[i].a3 == data.data[i].a7 && data.data[i].a3 != "") { var MinM = parseInt(MinM) + parseInt(1); } if (data.data[i].a4 == data.data[i].a8 && data.data[i].a4 != "") { var MinM = parseInt(MinM) + parseInt(1); } CinM++; }
                        }
                    } else if (data.data[i].qtype == 'integer') {
                        if (data.data[i].qid <= PQN5 && data.data[i].qid > PQN4) {
                            if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) + parseInt(P3M);
                                CinP++;
                            } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) - parseInt(P3N);
                                WinP++;
                            }
                        } else if (data.data[i].qid <= CQN5 && data.data[i].qid > CQN4) {
                            if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) + parseInt(C3M);
                                CinC++;
                            } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) - parseInt(C3N);
                                WinC++;
                            }
                        } else if (data.data[i].qid <= MQN5 && data.data[i].qid > MQN4) {
                            if ((data.data[i].a1 == data.data[i].a5 || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) + parseInt(M3M);
                                CinM++;
                            } else if ((data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save") || (data.data[i].a1 != data.data[i].a5 && data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) - parseInt(M3N);
                                WinM++;
                            }
                        }
                    } else if (data.data[i].qtype == 'numerical') {
                        if (data.data[i].qid <= PQN1 && data.data[i].qid > PQN5) {
                            if (((Number(data.data[i].a1) >= Number(data.data[i].a5) && Number(data.data[i].a1) <= Number(data.data[i].a6)) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) + parseInt(P4M);
                                CinP++;
                            } else if (((Number(data.data[i].a1) < Number(data.data[i].a5) || Number(data.data[i].a1) > Number(data.data[i].a6)) && data.data[i].ans_type == "save") || ((Number(data.data[i].a1) < Number(data.data[i].a5) || Number(data.data[i].a1) > Number(data.data[i].a6)) && data.data[i].ans_type == "save_mark")) {
                                var MinP = parseInt(MinP) - parseInt(P4N);
                                WinP++;
                            }
                        } else if (data.data[i].qid <= CQN1 && data.data[i].qid > CQN5) {
                            if (((Number(data.data[i].a1) >= Number(data.data[i].a5) && Number(data.data[i].a1) <= Number(data.data[i].a6)) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) + parseInt(C4M);
                                CinC++;
                            } else if (((Number(data.data[i].a1) < Number(data.data[i].a5) || Number(data.data[i].a1) > Number(data.data[i].a6)) && data.data[i].ans_type == "save") || ((Number(data.data[i].a1) < Number(data.data[i].a5) || Number(data.data[i].a1) > Number(data.data[i].a6)) && data.data[i].ans_type == "save_mark")) {
                                var MinC = parseInt(MinC) - parseInt(C4N);
                                WinC++;
                            }
                        } else if (data.data[i].qid <= MQN1 && data.data[i].qid > MQN5) {
                            if (((Number(data.data[i].a1) >= Number(data.data[i].a5) && Number(data.data[i].a1) <= Number(data.data[i].a6)) || (data.data[i].a5 == "0" && data.data[i].a6 == "0" && data.data[i].a7 == "0" && data.data[i].a8 == "0")) && (data.data[i].ans_type == "save" || data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) + parseInt(M4M);
                                CinM++;
                            } else if (((Number(data.data[i].a1) < Number(data.data[i].a5) || Number(data.data[i].a1) > Number(data.data[i].a6)) && data.data[i].ans_type == "save") || ((Number(data.data[i].a1) < Number(data.data[i].a5) || data.data[i].a1 > Number(data.data[i].a6)) && data.data[i].ans_type == "save_mark")) {
                                var MinM = parseInt(MinM) - parseInt(M4N);
                                WinM++;
                            }
                        }
                    }

                }
                var totalS = parseInt(MinP) + parseInt(MinC) + parseInt(MinM);
                var totalQ = parseInt(NOQ);
                var totalC = parseInt(CinP) + parseInt(CinC) + parseInt(CinM);
                var totalW = parseInt(WinP) + parseInt(WinC) + parseInt(WinM);
                var totalA = parseInt(totalC) + parseInt(totalW);
                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('admin-auto_submit_result') }}",
                        data: { type: type, sid: sid, plid: plid, pid: data.paper[0].id, pname: data.paper[0].pname, TT: data.paper[0].TT, PQN: PQN, CQN: CQN, MQN: MQN, total_marks: total_marks, totalQ: totalQ, totalA: totalA, totalC: totalC, totalW: totalW, totalS: totalS, CinP: CinP, WinP: WinP, MinP: MinP, CinC: CinC, WinC: WinC, MinC: MinC, CinM: CinM, WinM: WinM, MinM: MinM },
                        success: function(data) {
                            $(".detail-button" + plid).trigger('click');
                        }
                    });
                }, 1000);
            }
        })
    });

    $(document).on('click', '#notification-button', function() {
        var loading = document.getElementById('loading');
        loading.style.display = '';
        var type = $(this).data('type');
        socket($(this).data('pid'), $(this).data('id'), type);
        $('#notification_table').empty().html('');
        $('.participants').text('Participants (0)');
        $('.participants').data('count', 0);
        $('.notification_name').text($(this).data('name'));
        if (type == 'normal') { $('.msg-button').data('channel', 'normal_paper_' + $(this).data('pid')); } else { $('.msg-button').data('channel', 'advanced_paper_' + $(this).data('pid')); }
        $('.msg-btn').data('event', 'message_plink_' + $(this).data('id'));
        $('.reload-btn').data('event', 'reload_plink_' + $(this).data('id'));
        $('.submit-btn').data('event', 'submit_plink_' + $(this).data('id'));
        var img = "{{ route('admin-paper_sockets',['channel'=>':channel','event'=>':event']) }}";
        if (type == 'normal') { var img = img.replace('%3Achannel', 'normal_paper_' + $(this).data('pid')); } else { var img = img.replace('%3Achannel', 'advanced_paper_' + $(this).data('pid')); }
        var img = img.replace('%3Aevent', 'online_' + $(this).data('id'));
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {
            $("#loading").fadeOut(500);
        })
    });


    function socket(i, j, type) {
        if (type == 'normal') {
            var channel = Echo.leave('admin_normal_paper_' + i);
            var channel = Echo.channel('admin_normal_paper_' + i);
            var pp = "normal_paper_";
        } else {
            var channel = Echo.leave('admin_advanced_paper_' + i);
            var channel = Echo.channel('admin_advanced_paper_' + i);
            var pp = "advanced_paper_";
        }
        channel.listen('.online_' + j, function(data) {
            var count = $('.participants').data('count');
            var count = parseInt(count) + parseInt(1);
            $('.participants').data('count', count);
            $('.participants').text('Participants (' + count + ')');
            $('#notification_table').append('<li><div><a style="display:inline-block; white-space: nowrap; width: 140px; overflow: hidden;text-overflow: ellipsis;">' + data.channel.message.sname + '</a><div style="float:right;"><a style="font-size:14px; border:1px;">remain ' + parseInt(data.channel.message.timeleft / 60) + ' mins</a>&nbsp;&nbsp;<a class="msg-button" data-channel="' + pp + i + '" data-title="Message to ' + data.channel.message.sname + '" data-event="message_' + j + '_' + data.channel.message.sid + '"><i class="fa fa-comment-o" style="color: #ff5c33; font-size: 16px;"></i></a>&nbsp;&nbsp;<a class="msg-button" data-channel="' + pp + i + '"  data-title="Relaod paper of user (' + data.channel.message.sname + ')" data-event="reload_' + j + '_' + data.channel.message.sid + '"><i class="fa fa-refresh" style="color: #ff5c33; font-size: 16px;"></i></a>&nbsp;&nbsp;<a class="msg-button" data-channel="' + pp + i + '" data-title="Submit paper of user (' + data.channel.message.sname + ')" data-event="submit_' + j + '_' + data.channel.message.sid + '"><i class="fa fa-check-square-o" style="color: #ff5c33; font-size: 16px;"></i></a></div></li><li style="height:1px;background:#858796;"></li>');
        });
    }




    $("body").delegate(".msg-button", "click", function() {
        $(".spinner").hide();
        $('.socket_title').text($(this).data('title'));
        $('.socket_body').empty().html('<p class="msg_error"></p><input type="text" class="msg_title" placeholder="title" required><input input type="text" class="msg_body"  placeholder="body" required><br><a class="btn btn-warning submit_event" data-channel="' + $(this).data('channel') + '" data-event="' + $(this).data('event') + '" >submit</a>');
        $("#socket").show("closed");
    });

    $("body").delegate(".submit_event", "click", function(e) {
        e.preventDefault();
        if ($('.msg_title').val() != '' && $('.msg_body').val() != '') {
            $("#socket").hide();
            var img = "{{ route('admin-paper_sockets',['channel'=>':channel','event'=>':event','title'=>':title','body'=>':body']) }}";
            var img = img.replace('%3Achannel', $(this).data('channel'));
            var img = img.replace('%3Aevent', $(this).data('event'));
            var img = img.replace('%3Atitle', $('.msg_title').val());
            var img = img.replace('%3Abody', $('.msg_body').val());
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            $.get(img, function(data) {
                $('.msg_done').toggle('slideDown');
                setTimeout(function() { $('.msg_done').toggle('slideUp'); }, 4000);
            })
        } else {
            $('.msg_error').text('**Please fill title and Body');
        }
    })

    </script>
    @endsection
