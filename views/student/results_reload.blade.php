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
