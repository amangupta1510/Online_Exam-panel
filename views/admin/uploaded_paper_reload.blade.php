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
