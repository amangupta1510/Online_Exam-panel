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
