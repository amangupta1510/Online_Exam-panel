<style type="text/css">
html {
    margin: 15px;
    padding: 15px;
    zoom: 50%;
}

</style>
@if(file_exists('img/delta.png'))<img style="margin-left: 200px; margin-top: 20px;" src="{{ asset('img/delta.png') }}" width="350">@endif
<br>
<div style="background-color: #d9534f;max-height:65px;">
    <h2 style="text-align: center;font:bold;font-size: 25px;color:#fff;">{{$pname}} - Answer Key</h2>
</div>
<br>
<?php $n=1;?>
<table style="margin-left: 210px;width: 70%;">
    <thead>
        <tr>
            <th class="column1">Q. no.</th>
            <th class="column2">Answer</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="column1"><a>{{$user->qid}}</a></td>
            @if($user->type=='normal')
            @if($user->q1!=NULL)
            <td class="column2" style="color: #555555;"><a>{{$user->q1}}</a></td>
            @else
            <td class="column2" style="color: #555555;"><a>Not Available</a></td>
            @endif
            @else
            @if($user->q1==NULL&&$user->q2==NULL&&$user->q3==NULL&&$user->q4==NULL)
            <td class="column2" style="color: #555555;"><a>Not Available</a></td>
            @elseif($user->q1=='0'&&$user->q2=='0'&&$user->q3=='0'&&$user->q4=='0')
            <td class="column2" style="color: #555555;"><a>Bonus</a></td>
            @else
            @if($user->type=='single'||$user->type=='integer'||$user->type=='passage'||$user->type=='match_column')
            <td class="column2" style="color: #555555;"><a>{{$user->q1}}</a></td>
            @elseif($user->type=='multiple')
            <td class="column2" style="color: #555555;"><a>{{$user->q1 .' , '. $user->q2 .' , '. $user->q3 .' , '. $user->q4 }}</a></td>
            @elseif($user->type=='numerical')
            <td class="column2" style="color: #555555;"><a>Between {{$user->q1}} To {{$user->q2}}</a></td>
            @endif
            @endif
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
<style type="text/css">
table {
    border-collapse: collapse;
    width: 400px;
}

th {
    height: 50px;
    text-align: center;
}

td {
    text-align: center;
    height: 25px;
}

table,
th,
td {
    border: 1px solid black;
}

</style>
