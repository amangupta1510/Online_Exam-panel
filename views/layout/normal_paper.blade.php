@extends('layout/details')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Pragma" content="no-cache">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="expires" content="0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    @yield('title')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" />
    <link href="{{asset('web1/css/style4.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/preloader.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.default.css')}}" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
    <script src="{{ asset('js/2_2_4_jquery.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" charset="utf-8"></script>
    <link href="{{asset('css/swipereload_new.css')}}" rel="stylesheet" type="text/css" media="all">
    <style type="text/css">
    #page-top {
        overscroll-behavior: none
    }

    #all {
        -ms-touch-action: pan-y;
        touch-action: pan-y;
    }

    </style>
    <script type="text/javascript">
    document.onkeydown = function(e) {
        return true;
    }

    function preventBack() { window.history.forward(); }
    setTimeout("preventBack()", 0);
    window.onunload = function() { null };

    </script>
</head>
@if($method=='supported')
@if($results==0)

<body class="cbp-spmenu-push" id="page-top" onload="preloader()" oncontextmenu="return false">
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="object" id="object_four"></div>
                <div class="object" id="object_three"></div>
                <div class="object" id="object_two"></div>
                <div class="object" id="object_one"></div>
            </div>
        </div>
    </div>
    <div id="socket" class="socket-container">
        <div class="socket">
            <h4 class="btn-cancel"> &times;</h4>
            <h4 class="socket_title"></h4>
            <div>
                <svg class="spinner" width="27px" height="27px" viewBox="0 0 68 68" xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="9" stroke-linecap="round" cx="34" cy="34" r="27"></circle>
                </svg>
                <p class="socket_body"></p>
                <p class="socket_body_main"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#socket").hide();
    $(".open-socket").on("click", function(event) {
        event.preventDefault();
        event.stopPropagation();
        $("#socket").show("closed");
    });

    $("body").delegate(".btn-cancel", "click", function() {
        $("#socket").fadeOut(500);
    });

    </script>
    <style type="text/css">
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
        background: #fff;
        border-radius: .35rem;
        border: 1px solid #fd6e70;
        margin-top: 5px;
    }


    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.4);
    }

    .card_btn {
        box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.2);
        transition: 0.3s;
    }


    .card_btn:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
    }

    .spinner {
        width: 35px;
        height: 35px;
        float: left;
        -webkit-animation: rotator 1.4s linear infinite;
        animation: rotator 1.4s linear infinite;
    }

    @-webkit-keyframes rotator {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(270deg);
            transform: rotate(270deg);
        }
    }

    @keyframes rotator {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(270deg);
            transform: rotate(270deg);
        }
    }

    .path {
        stroke-dasharray: 187;
        stroke-dashoffset: 0;
        -webkit-transform-origin: center;
        transform-origin: center;
        -webkit-animation: dash 1.4s ease-in-out infinite, colors 5.6s ease-in-out infinite;
        animation: dash 1.4s ease-in-out infinite, colors 5.6s ease-in-out infinite;
    }

    @-webkit-keyframes colors {
        0% {
            stroke: #4285F4;
        }

        25% {
            stroke: #DE3E35;
        }

        50% {
            stroke: #F7C223;
        }

        75% {
            stroke: #1B9A59;
        }

        100% {
            stroke: #4285F4;
        }
    }

    @keyframes colors {
        0% {
            stroke: #4285F4;
        }

        25% {
            stroke: #DE3E35;
        }

        50% {
            stroke: #F7C223;
        }

        75% {
            stroke: #1B9A59;
        }

        100% {
            stroke: #4285F4;
        }
    }

    @-webkit-keyframes dash {
        0% {
            stroke-dashoffset: 187;
        }

        50% {
            stroke-dashoffset: 46.75;
            -webkit-transform: rotate(135deg);
            transform: rotate(135deg);
        }

        100% {
            stroke-dashoffset: 187;
            -webkit-transform: rotate(450deg);
            transform: rotate(450deg);
        }
    }

    @keyframes dash {
        0% {
            stroke-dashoffset: 187;
        }

        50% {
            stroke-dashoffset: 46.75;
            -webkit-transform: rotate(135deg);
            transform: rotate(135deg);
        }

        100% {
            stroke-dashoffset: 187;
            -webkit-transform: rotate(450deg);
            transform: rotate(450deg);
        }
    }

    .socket-container:before {
        content: "";
        background-color: rgba(0, 0, 0, 0.6);
        display: block;
        position: fixed;
        z-index: 9999999;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    .socket-container:closed {
        display: none;
    }

    .socket,
    .network {
        position: fixed;
        top: 30%;
        left: 0px;
        right: 0px;
        margin: 0 auto;
        display: block;
        background: white;
        padding: 10px;
        width: 400px;
        max-width: 80%;
        z-index: 99999999999;
    }

    .btn-cancel {
        border-radius: 50%;
        width: 26px;
        text-align: center;
        border: 2px solid #e2e2e2;
        color: #a6a6a6;
        height: 26px;
        cursor: pointer;
        outline: none;
        float: right;
    }

    .btn-cancel:hover {
        background-color: #e5e5e5;
    }

    button#btn-cancel {
        color: #e5e5e5;
    }

    button#btn-cancel:hover {
        background-color: transparent;
    }

    </style>
    <div id="noty_main" class="noty-container" style="z-index: 9999999999; position: fixed;right:10px;bottom: 10px; border-radius: 10px;width: 300px;  "></div>
    <link rel="stylesheet" type="text/css" href="{{ asset('table/css/mainstudent_show_paper.css')}}">
    <div id="show" class="modal fade " role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="table" class="modal-body">
                    @foreach($questions as $ques)
                    @if($ques->quesimg!="" && file_exists($ques->quesimg))
                    <li class="hidden ques-all ques-img{{$ques->qid}}" style="list-style: none;">Question {{$ques->qid}}</li>
                    <div class="ques-img_div ques-img_div{{$ques->qid}}" data-id="{{$ques->qid}}">
                        <a class="ques-img_text ques-img_text{{$ques->qid}}" data-id="{{$ques->qid}}" style="position:absolute;text-decoration: none;color: #3c3a3a;z-index: 9; text-align: center;font-weight: 800;width: 90%;cursor: pointer;"><br><br>Click to view..</a>
                        <li class="hidden ques-all ques-img ques-img{{$ques->qid}}" style="list-style: none;filter: blur(5px);"><img src="{{ asset("$ques->quesimg").'?'.$ques->remember_token}}" />
                            <?php $names = pathinfo($ques->quesimg);
                          $img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
                            @if(file_exists($img_1))<img src="{{ asset("$img_1").'?'.$ques->remember_token}}" class="img-responsive">@endif
                            @if(file_exists($img_2))<img src="{{ asset("$img_2").'?'.$ques->remember_token}}" class="img-responsive">@endif
                        </li>
                    </div>
                    @else
                    <div class="ques-img_div ques-img_div{{$ques->qid}}" data-id="{{$ques->qid}}">
                        <a class="ques-img_text ques-img_text{{$ques->qid}}" data-id="{{$ques->qid}}" style="position:absolute;text-decoration: none;color: #3c3a3a;z-index: 9; text-align: center;font-weight: 800;width: 90%;cursor: pointer;"><br><br>Click to view..</a>
                        <p>Question : {{$ques->qid}} not available. Please Contact to Instructor.</p>
                    </div>
                    @endif
                    <li class="hidden ques-all ques-img{{$ques->qid}}" style="list-style: none; height: 1px;background-color: rgba(244,132,83,0.8);"></li>
                    @endforeach
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
    <script type="text/javascript">
    var loading = document.getElementById('loading');

    function preloader() {
        loading.style.display = 'none';
    }
    $(".ques-img_div").on("click", function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(".ques-img_text").show();
        $(".ques-img").css('filter', 'blur(5px)');
        $(".ques-img_text" + id).hide();
        $(".ques-img" + id).css('filter', 'none');
        $(".pageno" + id).click();
    });

    </script>
    @foreach ($papers as $paper)
    @foreach ($plinks as $plink)
    @foreach ($timelefts as $timeleft)
    <?php $CQ1 = $paper->PQ + 1;
         $PQN = $paper->PQ;  $CQN = $paper->PQ + $paper->CQ; $MQN = $paper->PQ + $paper->CQ + $paper->MQ;
          $BQN=$paper->PQ + $paper->CQ + $paper->MQ + $paper->BQ;  
         $MQ1=$paper->PQ + $paper->CQ + 1;
         $BQ1=$paper->PQ + $paper->CQ + $paper->MQ + 1;  ?>
    <div class="hover_bkgr_fricc" style="display: none;">
        <span class="helper"></span>
        <div style="margin: 0px;padding: 0px;">
            <div class="popupCloseButton">X</div>
            <h4 style="color: #f7931e;margin-top: 7%;font-size: 20px; ">You Are Not Connected to the Internet</h4>
        </div>
    </div>
    <div id="all">
        <div class="top-bar">
            <div class="container">
                <div class="col-md-12">
                    <div class="top-links"> </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <header class="main-header">
            <div class="navbar" data-spy="affix" data-offset-top="200">
                <div class="navbar navbar-default yamm" role="navigation" id="navbar">
                    <div class="container">
                        <div class="navbar-header">
                            <a class="navbar-brand home">
                                <img src="{{asset('img/delta.png')}}" alt="deltatrek logo" class="img-responsive" width="300">
                            </a>
                        </div>
                        <div class="col-md-5 pull-right">
                            <div class="navbar-collapse">
                                <ul class="nav navbar-nav pull-right">
                                    <li class="user-profile">
                                        <table>
                                            <tr>
                                                <td style="padding: 5px 15px;">
                                                    <img style="float: left;" src="{{asset('student/images/'.Auth::user()->photo)}}" width="100">
                                                    <table>
                                                        <tr>
                                                            <td style="padding: 0px 5px;">Candidate Name</td>
                                                            <td> : <span style="color: #fd6e70; font-weight: bold">{{Auth::user()->name}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 0px 5px;">Subject Name</td>
                                                            <td> : <span style="color: #fd6e70; font-weight: bold">{{$paper->pname}}</span></td>
                                                        </tr>
                                                        <tr id="time1">
                                                            <td style="padding: 0px 5px;">Remaining Time</td>
                                                            <td>
                                                                : <span class="timer-title time-started">00:00</span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                                <input type="hidden" id="hdfTestDuration" data-entry='{{$timeleft->created_at}}' value="{{$timeleft->timeleft}}" />
                                <input type="hidden" class="blur-time" value="0" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="clear"></div>
        <div>
            <div id="heading-breadcrumbs" style="background-color:#5a5c69;">
                <div class="container">
                    <img class="portrait_rotate" src="{{ asset('img/portrait rotate.png') }}" height="40" style="display: none;border-radius: 5px;">
                    <img class="landscape_rotate" src="{{ asset('img/landscape rotate.png') }}" height="40" style="border-radius: 5px;">
                    <div id="arrwrapper" class="row">
                        <span id="arrows" class="arrows"></span>
                    </div>
                    <div class="row" id="heading-breadcru">
                        <div class="col-md-7 pull-left">
                            <table class="stream">
                                <tr class="full-width">
                                    <td class="full-width">
                                        <h1> {{$paper->pname}} </h1>
                                    </td>
                                    @if ($paper->PQ!=0)
                                    <td class="full-width">
                                        <a style="background: #fd6e70;color: #fff;border-radius: 5px" class="mb5 btn stream_1 full-width" href="javascript:void(0);" data-href="page1">Physics</a>
                                        <div class="clear-xs"></div>
                                    </td>
                                    @endif @if ($paper->CQ!=0)
                                    <td class="full-width"><a style="background: #fd6e70;color: #fff;border-radius: 5px" class="mb5 btn stream_1 full-width" href="javascript:void(0);" data-href="page{{$CQ1}}">Chemistry</a></td>
                                    @endif @if ($paper->MQ!=0)
                                    <td class="full-width"><a style="background: #fd6e70;color: #fff;border-radius: 5px" class="mb5 btn stream_1 full-width" href="javascript:void(0);" data-href="page{{$MQ1}}">Mathmatics</a></td>
                                    @endif @if ($paper->BQ!=0)
                                    <td class="full-width"><a style="background: #fd6e70;color: #fff;border-radius: 5px" class="mb5 btn stream_1 full-width" href="javascript:void(0);" data-href="page{{$BQ1}}">Biology</a></td>
                                    @endif
                                </tr>
                            </table>
                        </div>
                        <div class="clear-xs"></div>
                        <div class="col-md-2 col-sm-12" id="divdrplngcng" @*style="margin: 15px 0 0 0" *@>
                            <text style="color:white; font-weight:bold">Paper View:</text>
                            <select class="form-control paperview">
                                <option selected value="">Select</option>
                                <option value="all">Full Paper</option>
                                @if ($paper->PQ!=0)
                                <option value="Physics">Physics</option>
                                @endif
                                @if ($paper->CQ!=0)
                                <option value="Chemistry">Chemistry</option>
                                @endif
                                @if ($paper->MQ!=0)
                                <option value="Mathmatics">Mathmatics</option>
                                @endif
                                @if ($paper->BQ!=0)
                                <option value="Biology">Biology</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="content" style="background: #eeeeee;">
            <div class="container">
                <div class="row exam-paper">
                    <div class="col-md-8" id="quest" style="padding: 0;">
                        <table style="width: 100%">
                            <tr>
                                <td>
                                    <div class="panel panel-default card" style="padding:0;margin-left: 3px; margin-right: 3px; margin-top: 10px;">
                                        <div class="panel-body mb0" style="padding-top:0;">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <?php $allquestion=0; ?>
                                                    @foreach($questions as $ques)
                                                    <?php $allquestion++ ?>
                                                    @if ($ques->qid==1)
                                                    <div style="" class="tab-content div-question mb0" id="page1">
                                                        <input type="hidden" value="1" class="hdfQuestionID">
                                                        <input type="hidden" data-id="{{$ques->q1}}" class="Question_data_{{$ques->qid}}">
                                                        <input type="hidden" value="1" class="hdfPaperSetID">
                                                        <input type="hidden" value="" class="hdfCurrectAns">
                                                        <div class="question-height">
                                                            <span class="btn-info timeof-1" data-time="0">00:00</span>
                                                            <h4 class="question-title"> Question 1:</h4>
                                                            @if($ques->quesimg!="" && file_exists($ques->quesimg))
                                                            <img id="img1" alt="Question" src="{{ asset("$ques->quesimg").'?'.$ques->remember_token}}" class="img-responsive">
                                                            <?php $names = pathinfo($ques->quesimg);
                                                 $img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
                                                            @if(file_exists($img_1))<img src="{{ asset("$img_1").'?'.$ques->remember_token}}" class="img-responsive">@endif
                                                            @if(file_exists($img_2))<img src="{{ asset("$img_2").'?'.$ques->remember_token}}" class="img-responsive">@endif
                                                            @else
                                                            <p>Question : 1 not available. Please Contact to Instructor.</p>
                                                            @endif<br>
                                                            <table class="table table-borderless mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <input type="radio" value="A" name="radiospage1" id="rOption1_1"> a ) </td>
                                                                        <td> <input type="radio" value="B" name="radiospage1" id="rOption1_1"> b ) </td>
                                                                        <td> <input type="radio" value="C" name="radiospage1" id="rOption1_1"> c ) </td>
                                                                        <td> <input type="radio" value="D" name="radiospage1" id="rOption1_1"> d ) </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <h4 class="question-footer"></h4>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div style="display: none;" class="tab-content div-question mb0" id="page{{$ques->qid}}">
                                                        <input type="hidden" value="1" class="hdfQuestionID">
                                                        <input type="hidden" data-id="{{$ques->q1}}" class="Question_data_{{$ques->qid}}">
                                                        <input type="hidden" value="1" class="hdfPaperSetID">
                                                        <input type="hidden" value="" class="hdfCurrectAns">
                                                        <div class="question-height">
                                                            <span class="btn-info timeof-{{$ques->qid}}" data-time="0">00:00</span>
                                                            <h4 class="question-title"> Question&nbsp;{{$ques->qid}}:</h4>
                                                            @if($ques->quesimg!="" && file_exists($ques->quesimg))
                                                            <img alt="Question" src="{{ asset("$ques->quesimg").'?'.$ques->remember_token}}" class="img-responsive">
                                                            <?php $names = pathinfo($ques->quesimg);
                                                    $img_1 = $names['dirname'].'/'.$names['filename'].'_1.'.$names['extension']; $img_2 = $names['dirname'].'/'.$names['filename'].'_2.'.$names['extension'];?>
                                                            @if(file_exists($img_1))<img src="{{ asset("$img_1").'?'.$ques->remember_token}}" class="img-responsive">@endif
                                                            @if(file_exists($img_2))<img src="{{ asset("$img_2").'?'.$ques->remember_token}}" class="img-responsive">@endif
                                                            @else
                                                            <p>Question : {{$ques->qid}} not available. Please Contact to Instructor.</p>
                                                            @endif<br>
                                                            <table class="table table-borderless mb0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td> <input type="radio" value="A" name="radiospage{{$ques->qid}}" id="rOption{{$ques->qid}}_1"> a ) </td>
                                                                        <td> <input type="radio" value="B" name="radiospage{{$ques->qid}}" id="rOption{{$ques->qid}}_1"> b ) </td>
                                                                        <td> <input type="radio" value="C" name="radiospage{{$ques->qid}}" id="rOption{{$ques->qid}}_1"> c ) </td>
                                                                        <td> <input type="radio" value="D" name="radiospage{{$ques->qid}}" id="rOption{{$ques->qid}}_1"> d ) </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <h4 class="question-footer"></h4>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button class="mb5 card_btn full-width btn btn-success btn-block btn-save-answer">Save &amp; Next</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="mb5 card_btn full-width btn btn-warning btn-block btn-save-mark-answer">Save &amp; Mark For Review</button>
                                                </div>
                                                <div class="col-md-4" style="margin-bottom: 5px;">
                                                    <button class="mb5 card_btn full-width btn btn-default btn-block btn-reset-answer">Clear Response</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="mb5 card_btn full-width btn btn-primary btn-block btn-mark-answer">Mark For Review &amp; Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel-footer card" style="margin: 0px 3px;">
                                        <div class="row">
                                            <div class="col-md-12"> <button id="hhh" class="btn btn-success btn-submit-all-answers pull-right card_btn">Submit</button>&nbsp;&nbsp;
                                                <a href="javascript:void(0);" class="btn btn-default pull-left card_btn" id="btnPrevQue">
                                                    << Back </a>&nbsp;&nbsp; <a href="javascript:void(0);" class="btn btn-default pull-left card_btn" id="btnNextQue">Next >>
                                                </a>&nbsp;&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="full_scn_btn">
                                    <div class="full_screen pull-right" style="cursor: pointer; background-color: #000; color: #fff; padding: 5px;">
                                        <i class="fa fa-angle-right fa-2x"></i>
                                    </div>
                                    <div class="collapse_screen hidden pull-right" style="cursor: pointer; background-color: #000; color: #fff; padding: 5px;">
                                        <i class="fa fa-angle-left fa-2x"></i>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4" id="pallette" style="background: #eeeeee;">
                        <div class="panel panel-default mb0 " style="background: #eeeeee;">
                            <div class="panel-body card" style="background: #fff;">
                                <table class="table table-borderless mb0" style="font-size: 13px;">
                                    <tr>
                                        <td class="full-width"> <a class="test-ques-stats que-not-attempted lblNotVisited">0</a>&nbsp;Not&nbsp;Visited</td>
                                        <td class="full-width"> <a class="test-ques-stats que-not-answered lblNotAttempted">0</a>&nbsp;Not&nbsp;Answered</td>
                                    </tr>
                                    <tr>
                                        <td class="full-width"> <a class="test-ques-stats que-save lblTotalSaved">0</a> Answered </td>
                                        <td class="full-width"> <a class="test-ques-stats que-mark lblTotalMarkForReview">0</a>&nbsp;Marked&nbsp;for&nbsp;Review</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"> <a class="test-ques-stats que-save-mark lblTotalSaveMarkForReview">0</a> Answered &amp; Marked for Review (will be considered for evaluation) </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="panel panel-default" style="background: #eeeeee;">
                            <div class="panel-body  card" style="height:320px;overflow-y:scroll; background: #fff; color: #d8d8d8;">
                                <ul class="pagination test-questions" style="background: #fff; color: #d8d8d8;">
                                    <li class="active" data-seq="1" id="1"><a class="test-ques que-not-answered pageno1" href="javascript:void(0);" data-href="page1">1</a></li>
                                    @foreach($questions as $ques)
                                    @if ($ques->qid>1)
                                    <li data-seq="1" class="" id="{{$ques->qid}}">
                                        <a class="test-ques que-not-attempted pageno{{$ques->qid}}" href="javascript:void(0);" data-href="page{{$ques->qid}}">{{$ques->qid}}</a>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 exam-summery" style="display:none;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h3 class="text-center">Exam Summary</h3>
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Answered</th>
                                            <th>Not Answered</th>
                                            <th>Marked for Review</th>
                                            <th>Save & Marked for Review(will be considered for evaluation)</th>
                                            <th>Not Visited</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="lblTotalSaved"></td>
                                            <td class="lblNotAttempted"></td>
                                            <td class="lblTotalMarkForReview"></td>
                                            <td class="lblTotalSaveMarkForReview"></td>
                                            <td class="lblNotVisited"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr />
                                <div class="col-md-12 text-center">
                                    <h4> Are you sure you want to submit for final marking?<br />No changes will be allowed after submission. <br /></h4>
                                    <a class="btn btn-success" style="padding: 10px 40px;" id="btnYesSubmit">Yes</a> <a class="btn btn-default btn-lg" id="btnNoSubmit">No</a>
                                    <br>
                                    <h5>Auto Submit in </h5>
                                    <a class="btn-danger btn auto-submit-clock" disabled>00:00</a><br>
                                </div>
                                <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Question No.</th>
                                            <th>Your Responses</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody class="final_response">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 exam-confirm" style="display:none;">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-12 text-center">
                                    <h4> Thank You, your responses will be submitted for final marking - click OK to complete final submission. <br /> </h4>
                                    <a class="btn btn-default btn-lg" id="btnYesSubmitConfirm">Ok</a> <a class="btn btn-default btn-lg" id="btnNoSubmitConfirm">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <div class="col-md-12">
                @yield('footer')
            </div>
        </div>
    </div>
    <form id="logout-form" action="{{ route('student-logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
        <input type="hidden" name="token" id="fcm_token">
    </form>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{asset('js/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('js/swipereload_new.js') }}"></script>
    <script type="text/javascript">
    $('.full_screen').click(function() {
        $('#quest').removeClass('col-md-8');
        $('#quest').addClass('col-md-12');
        $('#pallette').addClass('hidden');
        $('.full_screen').addClass('hidden');
        $('.collapse_screen').removeClass('hidden');
    });

    $('.collapse_screen').click(function() {
        $('#quest').removeClass('col-md-12');
        $('#quest').addClass('col-md-8');
        $('#pallette').removeClass('hidden');
        $('.full_screen').removeClass('hidden');
        $('.collapse_screen').addClass('hidden');

    });
    if ($(window).width() < 777) {
        $('.full_scn_btn').hide();
    }
    if ($(window).width() > 776 || !window.AndroidFunction) {
        $('.landscape_rotate').hide();
        $('.portrait_rotate').hide();
    }

    $(document).ready(function() {
        //Disable full page
        $("body").on("contextmenu", function(e) {
            return true;
        });
    });

    $('#all').mkPullFresh(function(end) {
        var url = window.location.protocol + "//" + window.location.host + "/" + window.location.pathname + window.location.search;
        $.get(url, function(response) {
            //var result = $(response).find(".limiter_change").html();
            end();
            window.location.reload();
            // var newHTML = document.open("text/html", "replace"); 
            // newHTML.write(response); 
            // newHTML.close(); 
        })
    });
    if (window.AndroidButton) {
        AndroidButton.disableScroll();
    }
    $(window).bind('beforeunload', function() {
        if (window.AndroidButton) {
            AndroidButton.enableScroll();
        }
    });
    document.getElementById('arrwrapper').onclick = function() {
        $('#heading-breadcru').toggle();
        $(this).toggleClass('active');
        $('#heading-breadcrumbs').toggleClass('active');
    };

    </script>
    <script type="text/javascript">
    if (window.indexedDB !== undefined) {
        window.sttype = 'indexedDB';
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onerror = function(event) {
            console.log('[onerror]', request.error);
        };
        request.onupgradeneeded = function(event) {
            var db = event.target.result;
            var productsStore = db.createObjectStore('responses', { keyPath: 'qid' });
            var productsStore = db.createObjectStore('timer', { keyPath: 'qid' });
            var productsStore = db.createObjectStore('submit', { keyPath: 'id' });
        };
    }

    $('.keyboard .row-keyboard div').on('click', function(e) {
        e.preventDefault();
        var inputtext = $('#username').val();

        if (e.target.id == 'del') {
            var temp = inputtext.substring(0, inputtext.length - 1);
            $('#username').val(temp);
        } else {
            var temp = $(this).data('value');
            temp = inputtext + temp;
            $('#username').val(temp);
        }

    });

    </script>
    <script type="text/javascript">
    var channel = Echo.channel('normal_paper_{{$paper->id}}');
    channel.listen('.online', function(data) {
        var img = "{{ route('student-paper_sockets',['channel'=>'admin_normal_paper_'.$paper->id,'event'=>'online','plid'=>$plink->id,'sid'=>Auth::user()->id,'sname'=>Auth::user()->name,'timeleft'=>':timeleft','entry'=>':entry']) }}";
        var img = img.replace('%3Atimeleft', $("#hdfTestDuration").val());
        var img = img.replace('%3Aentry', $("#hdfTestDuration").data('entry'));
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {})
    });
    channel.listen('.online_{{$plink->id}}', function(data) {
        var img = "{{ route('student-paper_sockets',['channel'=>'admin_normal_paper_'.$paper->id,'event'=>'online_'.$plink->id,'plid'=>$plink->id,'sid'=>Auth::user()->id,'sname'=>Auth::user()->name,'timeleft'=>':timeleft','entry'=>':entry']) }}";
        var img = img.replace('%3Atimeleft', $("#hdfTestDuration").val());
        var img = img.replace('%3Aentry', $("#hdfTestDuration").data('entry'));
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        var img = img.replace('&amp;', '&');
        $.get(img, function(data) {})
    });
    channel.listen('.message_all', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_message(title, body);
    });
    channel.listen('.reload_all', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_reload(title, body);
    });
    channel.listen('.submit_all', function(data) {
        socket_submit();
    });
    channel.listen('.message_plink_{{$plink->id}}', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_message(title, body);
    });
    channel.listen('.reload_plink_{{$plink->id}}', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_reload(title, body);
    });
    channel.listen('.submit_plink_{{$plink->id}}', function(data) {
        socket_submit();
    });
    channel.listen('.message_student_{{Auth::user()->id}}', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_message(title, body);
    });
    channel.listen('.reload_student_{{Auth::user()->id}}', function(data) {
        var title = data.channel.message.title;
        var body = data.channel.message.body;
        socket_reload(title, body);
    });
    channel.listen('.submit_student_{{Auth::user()->id}}', function(data) {
        socket_submit();
    });
    channel.listen('.message_{{$plink->id.'
        _ '.Auth::user()->id}}',
        function(data) {
            var title = data.channel.message.title;
            var body = data.channel.message.body;
            socket_message(title, body);
        });
    channel.listen('.reload_{{$plink->id.'
        _ '.Auth::user()->id}}',
        function(data) {
            var title = data.channel.message.title;
            var body = data.channel.message.body;
            socket_reload(title, body);
        });
    channel.listen('.submit_{{$plink->id.'
        _ '.Auth::user()->id}}',
        function(data) {
            socket_submit();
        });
    channel.listen('.logout_{{$plink->id.'
        _ '.Auth::user()->id}}',
        function(data) {
            var val = parseInt(data.channel.message.plid);
            var val2 = parseInt({ { $random } });
            if (val != val2) {
                document.getElementById('logout-form').submit();
            }
        });
    $(document).ready(function() {
        var Interval_time = Math.floor(Math.random() * 90000) + 80000;
        setInterval(function() {
            var img = "{{ route('student-paper_sockets',['channel'=>'normal_paper_'.$paper->id,'event'=>'logout_'.$plink->id.'_'.Auth::user()->id,'plid'=>$random,'sid'=>'x','sname'=>'x','timeleft'=>'x','entry'=>'x']) }}";
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            $.get(img, function(data) {});
        }, Interval_time);
        setTimeout(function() {
            var img = "{{ route('student-paper_sockets',['channel'=>'normal_paper_'.$paper->id,'event'=>'logout_'.$plink->id.'_'.Auth::user()->id,'plid'=>$random,'sid'=>'x','sname'=>'x','timeleft'=>'x','entry'=>'x']) }}";
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            var img = img.replace('&amp;', '&');
            $.get(img, function(data) {});
        }, 2000);
    });

    </script>
    <script type="text/javascript">
    var num = Math.floor(Math.random() * 300000) + 200000;
    setInterval(
        function(e) {
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onsuccess = function(event) {
                var db = event.target.result;
                var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
                var timeStore = db.transaction("timer", "readwrite").objectStore("timer");
                objectStore.getAll().onsuccess = function(event) {
                    var answer = JSON.stringify(event.target.result);
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('student-saveanswer') }}",
                        data: {
                            data: answer,
                            pid: { { $paper - > id } },
                            plid: { { $plink - > id } },
                            sid: { { Auth::user() - > id } }
                        },
                        success: function(data) {},
                    });
                }
                timeStore.getAll().onsuccess = function(event) {
                    var answer = JSON.stringify(event.target.result);
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('student-timeleft') }}",
                        data: {
                            data: answer
                        },
                        success: function(data) {
                            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                                _ '.$plink->id}}', 2);
                            request.onsuccess = function(event) {
                                for (var i = 0; i < data.length; i++) {
                                    event.target.result.transaction("timer", "readwrite").objectStore("timer").delete(data[i]);
                                }
                            }
                        },
                    });
                }
            }
        }, num);

    var btn1p = 0;
    var btn2p = 0;
    var btn3p = 0;
    $('#btnViewResult').on('click', function(e) {
        e.preventDefault();
        $('.exam-result').show();
        $(".exam-thankyou").hide();
    });

    </script>
    <?php $plid = $plink->id;
         $pid = $paper->id;
         $sid= Auth::user()->id; ?>
    <script type="text/javascript">
    var myInterval, submitInterval, blurInterval, AttemptedAns = [],
        question_time = [@foreach($questions as $element) 0, @endforeach 0],
        TotalTime = 0;
    window.onload = function() {
        <?php  $s=0; $sm=0; $m=0;  $v=0; ?>
        @foreach($answers as $answer)
        question_time[{ { $answer - > qid } }] = parseInt({ { $answer - > time_used } });
        var s = parseInt('{{$answer->time_used}}' % 60);
        var m = parseInt('{{$answer->time_used}}' / 60);
        $(".timeof-{{$answer->qid}}").html((m = m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s));

        var w = $(".test-questions").find("li.active");
        w.removeClass("active");
        var nowQ = $(".test-questions").find("li#{{$answer->qid}}");
        if (!nowQ.hasClass("active")) {
            nowQ.addClass("active");
        }
        @if($answer - > a1 == 'A') $('input:radio[name="radiospage{{$answer->qid}}"][value="A"]').prop('checked', true).trigger("click");
        @elseif($answer - > a1 == 'B') $('input:radio[name="radiospage{{$answer->qid}}"][value="B"]').prop('checked', true).trigger("click");
        @elseif($answer - > a1 == 'C') $('input:radio[name="radiospage{{$answer->qid}}"][value="C"]').prop('checked', true).trigger("click");
        @elseif($answer - > a1 == 'D') $('input:radio[name="radiospage{{$answer->qid}}"][value="D"]').prop('checked', true).trigger("click");
        @endif

        @if($answer - > a8 == 'save')
        var t = $(".test-questions").find("li.active");
        t.find("a").addClass("que-save");
        t.find("a").removeClass("que-not-attempted");
        <?php $s++;?>
        @elseif($answer - > a8 == 'save_mark')
        var t = $(".test-questions").find("li.active");
        t.find("a").addClass("que-save-mark");
        t.find("a").removeClass("que-not-attempted");
        <?php $sm++;?>
        @elseif($answer - > a8 == 'mark')
        var t = $(".test-questions").find("li.active");
        t.find("a").addClass("que-mark");
        t.find("a").removeClass("que-not-attempted");
        <?php $m++;?>
        @elseif($answer - > a8 == 'visited')
        var t = $(".test-questions").find("li.active");
        t.find("a").addClass("que-not-answered");
        t.find("a").removeClass("que-not-attempted");
        <?php $v++;?>
        @endif
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
            var req = objectStore.openCursor(parseInt({ { $answer - > qid } }));
            req.onsuccess = function(e) {
                var cursor = e.target.result;
                if (!cursor) { // key already exist
                    objectStore.add({ sid: parseInt({ { $answer - > sid } }), qid: parseInt({ { $answer - > qid } }), pid: "{{$answer->pid}}", plid: "{{$answer->plid}}", qtype: "{{$answer->qtype}}", qplsid: "{{$answer->qplsid}}", qplsqtypeid: "{{$answer->qplsqtypeid}}", a1: "{{$answer->a1}}", a2: "{{$answer->a2}}", a3: "{{$answer->a3}}", a4: "{{$answer->a4}}", a5: "{{$answer->a5}}", a6: "{{$answer->a6}}", a7: "{{$answer->a7}}", a8: "{{$answer->a8}}", ans_type: "{{$answer->ans_type}}", answer: "{{$answer->answer}}", time_used: { { $answer - > time_used } } });
                }
            };
        };
        @endforeach
        @if($method == 'supported')
        if (window.indexedDB !== undefined) {
            window.sttype = 'indexedDB';
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onerror = function(event) {
                console.log('[onerror]', request.error);
            };
            request.onupgradeneeded = function(event) {
                var db = event.target.result;
                var productsStore = db.createObjectStore('responses', { keyPath: 'qid' });
                var productsStore = db.createObjectStore('timer', { keyPath: 'qid' });
                var productsStore = db.createObjectStore('submit', { keyPath: 'id' });
            };
        }
        var plid = '{{$plid}}';
        var pid = '{{$pid}}';
        var sid = { { Auth::user() - > id } };
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
            objectStore.getAll().onsuccess = function(event) {
                event.target.result.forEach(function(answer) {
                    question_time[answer.qid] = parseInt(answer.time_used);
                    var s = parseInt(answer.time_used % 60);
                    var m = parseInt(answer.time_used / 60);
                    $(".timeof-" + answer.qid).html((m = m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s));
                    var w = $(".test-questions").find("li.active");
                    w.removeClass("active");
                    var nowQ = $(".test-questions").find("li#" + answer.qid);
                    if (!nowQ.hasClass("active")) {
                        nowQ.addClass("active");
                    }
                    if (answer.a1 == 'A') { $('input:radio[name="radiospage' + qid + '"][value="A"]').prop('checked', true).trigger("click"); } else if (answer.a1 == 'B') { $('input:radio[name="radiospage' + qid + '"][value="B"]').prop('checked', true).trigger("click"); } else if (answer.a1 == 'C') { $('input:radio[name="radiospage' + qid + '"][value="C"]').prop('checked', true).trigger("click"); } else if (answer.a1 == 'D') { $('input:radio[name="radiospage' + qid + '"][value="D"]').prop('checked', true).trigger("click"); }

                    if (answer.a8 == 'save') {
                        var t = $(".test-questions").find("li.active");
                        t.find("a").addClass("que-save");
                        t.find("a").removeClass("que-not-attempted");
                        <?php $s=$s + 1;?>
                    } else if (answer.a8 == 'save_mark') {
                        var t = $(".test-questions").find("li.active");
                        t.find("a").addClass("que-save-mark");
                        t.find("a").removeClass("que-not-attempted");
                        <?php $sm=$sm + 1;?>
                    } else if (answer.a8 == 'mark') {
                        var t = $(".test-questions").find("li.active");
                        t.find("a").addClass("que-mark");
                        t.find("a").removeClass("que-not-attempted");
                        <?php $m=$m + 1;?>
                    } else if (answer.a8 == 'visited') {
                        var t = $(".test-questions").find("li.active");
                        t.find("a").addClass("que-not-answered");
                        t.find("a").removeClass("que-not-attempted");
                        <?php $v=$v + 1;?>
                    }
                });
            };
        };
        @endif
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var objectStore = db.transaction("submit", "readwrite").objectStore("submit");
            var req = objectStore.openCursor('autosubmit');
            req.onsuccess = function(e) {
                var cursor = e.target.result;
                if (cursor) { // key already exist
                    $('.btn-submit-all-answers').attr('disabled', true);
                    setTimeout(function() { socket_submit(); }, 5000);
                }
            };
            var req = objectStore.openCursor('blur_time');
            req.onsuccess = function(e) {
                var cursor = e.target.result;
                if (cursor) { // key already exist
                    $('.blur-time').val(cursor.value.time);
                }
            };
        };

        var w = $(".test-questions").find("li.active");
        w.removeClass("active");
        window.page = '1';
        var nowQ = $(".test-questions").find("li#1");
        if (!nowQ.hasClass("active")) {
            nowQ.addClass("active");
        }
        $('.lblTotalSaved').text('{{ intval($s)}}');
        $('.lblTotalSaveMarkForReview').text('{{ intval($sm)}}');
        $('.lblTotalMarkForReview').text('{{ intval($m)}}');
        $('.lblNotAttempted').text('{{ intval($v)}}');
        $('.lblNotVisited').text('{{ intval($BQN)- intval($v)- intval($s)- intval($m)- intval($sm)}}');

        setTimeout(function() { $(".pageno1").click(); }, 1000);
        //setTimeout(function(){CoundownTimer(parseInt($("#hdfTestDuration").val())); }, 6000);
        CoundownTimer(parseInt($("#hdfTestDuration").val()));
        if ($(window).width() > 776 || !window.AndroidFunction) {
            $('.landscape_rotate').hide();
            $('.portrait_rotate').hide();
        }
        $("#loading").fadeOut(500);
    };
    //------------------------------------------------event listener function------------------------------------------------------        
    function NextQuestion(e) {
        var t = $(".test-questions").find("li.active");
        CheckNextPrevButtons();
        if (!t.is(":last-child")) {
            var id = parseInt(t.attr("id")) + 1;
            $('.pageno' + id).trigger('click');
        }

    }

    function PrevQuestion(e) {
        var t = $(".test-questions").find("li.active");
        CheckNextPrevButtons();
        if (!t.is(":first-child")) {
            var id = parseInt(t.attr("id")) - 1;
            $('.pageno' + id).trigger('click');
        }
    }

    function CheckNextPrevButtons() {
        var e = $(".test-questions").find("li.active");
        $("#btnPrevQue").removeAttr("disabled"), $("#btnNextQue").removeAttr("disabled"), e.is(":first-child") ? $("#btnPrevQue").attr("disabled", "disabled") : e.is(":last-child") && $("#btnNextQue").attr("disabled", "disabled")
    }

    function pad(e, t) {
        for (var a = e + ""; a.length < t;) a = "0" + a;
        return a
    }

    function OpenCurrentQue(e) {
        $(".tab-content").hide(), $("#lblQueNumber").text(e.text()), $("#" + e.attr("data-href")).show();
        var t = e.parent().attr("data-seq");
        $(".nav-tab-sections").find("li").removeClass("active"), $(".nav-tab-sections").find("li[data-id=" + t + "]").addClass("active"), CheckQueAttemptStatus()
    }

    function CoundownTimer(e) {
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var timeStore = db.transaction("timer", "readwrite").objectStore("timer");
            timeStore.get('total_time').onsuccess = function(event) {
                var t = event.target.result.time;
                myInterval = setInterval(function() {
                    myTimeSpan = 1e3 * t, $(".timer-title").text(GetTime(myTimeSpan)), t < 600 ? ($(".timer-title").addClass("time-ending"), $(".timer-title").removeClass("time-started")) : ($(".timer-title").addClass("time-started"), $(".timer-title").removeClass("time-ending")), t > 0 ? t -= 1 : CleartTimer()
                }, 1e3)
            }
            timeStore.get('total_time').onerror = function(event) {
                var t = '{{$timeleft->timeleft}}';
                myInterval = setInterval(function() {
                    myTimeSpan = 1e3 * t, $(".timer-title").text(GetTime(myTimeSpan)), t < 600 ? ($(".timer-title").addClass("time-ending"), $(".timer-title").removeClass("time-started")) : ($(".timer-title").addClass("time-started"), $(".timer-title").removeClass("time-ending")), t > 0 ? t -= 1 : CleartTimer()
                }, 1e3)
            }
        }
    }

    function CoundownTimerNew(t) {
        myInterval = setInterval(function() {
            myTimeSpan = 1e3 * t, $(".timer-title").text(GetTime(myTimeSpan)), t < 600 ? ($(".timer-title").addClass("time-ending"), $(".timer-title").removeClass("time-started")) : ($(".timer-title").addClass("time-started"), $(".timer-title").removeClass("time-ending")), t > 0 ? t -= 1 : CleartTimer()
        }, 1e3)
    }

    function autosubmit(t) {
        submitInterval = setInterval(function() {
            myTimeSpan = 1e3 * t, $(".auto-submit-clock").text(SubmitTime(myTimeSpan)), t > 0 ? t -= 1 : $('#btnYesSubmit').trigger('click')
        }, 1e3);
    }


    function CleartTimer() {
        if (navigator.onLine) {
            clearInterval(myInterval);
            $('#socket').hide();
            $("#btnNoSubmit").hide();
            $(".btn-submit-all-answers").trigger("click");
        } else {
            clearInterval(myInterval);
            $(".btn-cancel").show();
            $('.socket_title').text('Connection Failed');
            $('.socket_body').text('Please Check Internet Connection... Failed Server Connection...');
            $("#socket").show("closed");
            setTimeout(function() { CleartTimer(); }, 2000)
        }
    }

    function SubmitTime(e) {
        parseInt(e % 1e3 / 100);
        var t = parseInt(e / 1e3 % 60),
            a = parseInt(e / 6e4 % 60),
            n = parseInt(e / 36e5 % 24),
            tt = (n * 60 * 60) + (a * 60) + t,
            a = n * 60 + a;
        return (a = a < 10 ? "0" + a : a) + ":" + (t < 10 ? "0" + t : t)

    }

    function GetTime(e) {
        $("#hdfTestDuration").val(e / 1e3);
        parseInt(e % 1e3 / 100);
        var t = parseInt(e / 1e3 % 60),
            a = parseInt(e / 6e4 % 60),
            n = parseInt(e / 36e5 % 24),
            tt = (n * 60 * 60) + (a * 60) + t,
            a = n * 60 + a;
        if (window.page == '1') { qq = $(".test-questions").find("li#1");
            window.page = 'active';
            $(".test-questions").find("li#1").addClass('active'); } else { qq = $(".test-questions").find("li.active"); }
        qid = qq.attr("id");
        q = parseInt(question_time[qid]) + parseInt(1);
        question_time[qid] = q;
        s = parseInt(q % 60);
        m = parseInt(q / 60);
        w = $(".timeof-" + qid).html((m = m < 10 ? "0" + m : m) + ":" + (s < 10 ? "0" + s : s));
        if (t % 2 == 0) {
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onsuccess = function(event) {
                var db = event.target.result;
                var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
                var req = objectStore.openCursor(parseInt(qid));
                req.onsuccess = function(e) {
                    var cursor = e.target.result;
                    if (cursor) { // key already exist
                        const updateData = cursor.value;
                        updateData.time_used = question_time[updateData.qid];
                        cursor.update(updateData);
                    }
                };
            };
        } else {
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onsuccess = function(event) {
                var db = event.target.result;
                var objectStoretime = db.transaction("timer", "readwrite").objectStore("timer");
                var reqs = objectStoretime.openCursor('total_time');
                reqs.onsuccess = function(e) {
                    var cursor = e.target.result;
                    if (cursor) { // key already exist
                        const updateData = cursor.value;
                        updateData.time = tt;
                        cursor.update(updateData);
                    } else { // key not exist
                        objectStoretime.add({ qid: 'total_time', plid: { { $plink - > id } }, time: tt });
                    }
                };
            };
        }
        return (a = a < 10 ? "0" + a : a) + ":" + (t < 10 ? "0" + t : t)

    }

    function pretty_time_string(e) {
        return (e < 10 ? "0" : "") + e
    }


    function CheckQueExists(e) {
        $.each(AttemptedAns, function(t, a) {
            void 0 !== a && a[1] == e && AttemptedAns.splice(t, 1)
        })
    }

    function CheckQueAttemptStatus() {
        var e = 0,
            t = 0,
            a = 0,
            n = 0,
            s = 0,
            i = 0;
        $(".test-questions").find("li").each(function() {
            var r = $(this);
            e += 1, r.children().hasClass("que-save") ? a += 1 : r.children().hasClass("que-save-mark") ? n += 1 : r.children().hasClass("que-mark") ? s += 1 : r.children().hasClass("que-not-answered") ? t += 1 : i += 1
        }), $(".lblTotalQuestion").text(e), $(".lblNotAttempted").text(t), $(".lblTotalSaved").text(a), $(".lblTotalSaveMarkForReview").text(n), $(".lblTotalMarkForReview").text(s), $(".lblNotVisited").text(i)
    }



    $(document).ready(function() {
        $("#page01").show();
        $(".exam-paper").show();
        CheckNextPrevButtons();
        CheckQueAttemptStatus();
        $("#btnPrevQue").click(function() {
            PrevQuestion(!0)
        });
        $("#btnNextQue").click(function() {
            NextQuestion(!0)
        });
        $(".test-ques").click(function() {
            var e = $(".test-questions").find("li.active").find("a");
            $(".test-questions").find("li").removeClass("active"),
                $(this).parent().addClass("active"),
                $(this).hasClass("que-save") || $(this).hasClass("que-save-mark") || $(this).hasClass("que-mark") || ($(this).addClass("que-not-answered"), $(this).removeClass("que-not-attempted")), e.hasClass("que-save") || e.hasClass("que-save-mark") || e.hasClass("que-mark") || (e.addClass("que-not-answered"), e.removeClass("que-not-attempted")), OpenCurrentQue($(this));
            var t = $(".test-questions").find("li.active"),
                qid = t.attr("id"),
                time = question_time[qid];
            a = t.find("a").attr("data-href");
            if ($("input[name='radios" + a + "']").is(":checked")) { ans = $("input[name='radios" + a + "']:checked").val(); } else { ans = ''; }
            plid = '{{$plink->id}}';
            pid = '{{$paper->id}}';
            sid = { { Auth::user() - > id } };
            p_type = '{{$plink->type}}';
            var type = 'visited';
            var ans_value = $('.Question_data_' + qid).data('id');
            if (ans_value == 'Bonus') {
                var a1 = 'Bonus';
                var a7 = 'Bonus';
                var type = 'save';
                var answer = 'Correct';
            } else {
                if (ans == ans_value) {
                    var answer = 'Correct';
                } else {
                    var answer = 'Incorrect';
                }
                var a1 = ans;
                var a7 = ans_value;
            }
            if (ans == '') {
                var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                    _ '.$plink->id}}', 2);
                request.onsuccess = function(event) {
                    var db = event.target.result;
                    var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
                    var req = objectStore.openCursor(parseInt(qid));
                    req.onsuccess = function(e) {
                        var cursor = e.target.result;
                        if (cursor) { // key already exist
                            cursor.update({ sid: parseInt(sid), qid: parseInt(qid), pid: pid, plid: plid, qtype: type, qplsid: qid + 'X' + plid + 'X' + sid, qplsqtypeid: qid + 'X' + plid + 'X' + sid + 'X' + type, a1: a1, a2: "", a3: "", a4: "", a5: "", a6: "", a7: a7, a8: type, answer: answer, ans_type: "", time_used: time });
                        } else { // key not exist
                            objectStore.add({ sid: parseInt(sid), qid: parseInt(qid), pid: pid, plid: plid, qtype: type, qplsid: qid + 'X' + plid + 'X' + sid, qplsqtypeid: qid + 'X' + plid + 'X' + sid + 'X' + type, a1: a1, a2: "", a3: "", a4: "", a5: "", a6: "", a7: a7, a8: type, answer: answer, ans_type: "", time_used: time });
                        }
                    };
                };
            }
        });
        $(".btn-save-answer").click(function(e) {
            e.preventDefault();
            var t = $(".test-questions").find("li.active"),
                qid = t.attr("id"),
                type = 'save',
                a = t.find("a").attr("data-href"),
                ans = $("input[name='radios" + a + "']:checked").val(),
                n = ($("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), !1);

            if ($("input[name='radios" + a + "']").each(function() {
                    $(this).is(":checked") && (n = !0)
                }), 0 == n) { return !1 };
            $("input[name='radios" + a + "']:checked").val(),
                btn_save_answer(ans, qid, type),
                t.find("a").removeClass("que-save-mark"), t.find("a").removeClass("que-mark"), t.find("a").addClass("que-save"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()

        });
        $(".btn-save-mark-answer").click(function(e) {
            e.preventDefault();
            var t = $(".test-questions").find("li.active"),
                qid = t.attr("id"),
                type = 'save_mark',
                a = t.find("a").attr("data-href"),
                ans = $("input[name='radios" + a + "']:checked").val(),
                n = ($("#" + a).find(".hdfQuestionID").val(),
                    $("#" + a).find(".hdfPaperSetID").val(),
                    $("#" + a).find(".hdfCurrectAns").val(),
                    $("#" + a).find(".hdfCurrectAns").val(), !1);
            if ($("input[name='radios" + a + "']").each(function() {
                    $(this).is(":checked") && (n = !0)
                }), 0 == n) { return !1 };
            $("input[name='radios" + a + "']:checked").val(),
                btn_save_answer(ans, qid, type),
                t.find("a").removeClass("que-save"), t.find("a").removeClass("que-mark"), t.find("a").addClass("que-save-mark"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()
        });
        $(".btn-mark-answer").click(function(e) {
            e.preventDefault();
            var t = $(".test-questions").find("li.active"),
                qid = t.attr("id"),
                type = 'mark',
                a = t.find("a").attr("data-href"),
                ans = '';
            if ($("input[name='radios" + a + "']").is(":checked")) {
                ans = $("input[name='radios" + a + "']:checked").val();
            }
            btn_save_answer(ans, qid, type),
                $("#" + a).find(".hdfQuestionID").val(),
                $("#" + a).find(".hdfPaperSetID").val(), $("#" + a).find(".hdfCurrectAns").val(), $("#" + a).find(".hdfCurrectAns").val(), t.find("a").removeClass("que-save-mark"), t.find("a").removeClass("que-save"), t.find("a").addClass("que-mark"), t.find("a").removeClass("que-not-answered"), t.find("a").removeClass("que-not-attempted"), NextQuestion(!1), CheckQueAttemptStatus()
        });
        $(".btn-reset-answer").click(function(e) {
            e.preventDefault();
            var t = $(".test-questions").find("li.active"),
                qid = t.attr("id"),
                type = 'visited',
                ans = '',
                a = t.find("a").attr("data-href");
            btn_save_answer(ans, qid, type),
                $("#" + a).attr("data-queid"), t.find("a").removeClass("saved-que"),
                $("input[name='radios" + a + "']:checked").each(function() {
                    $(this).prop("checked", !1).change()
                }), $("input[name='chk" + a + "']").each(function() {
                    $(this).prop("checked", !1).change()
                }), $("input[type=checkbox]").prop("checked", !1).change(),
                $("input[type=text]").val(""), a = t.find("a").attr("data-href"),
                $("#" + a).find(".hdfQuestionID").val(), $("#" + a).find(".hdfPaperSetID").val(),
                $("#" + a).find(".hdfCurrectAns").val(), $("#" + a).find(".hdfCurrectAns").val(),
                t.find("a").removeClass("que-save-mark"),
                t.find("a").removeClass("que-mark"),
                t.find("a").removeClass("que-save"),
                t.find("a").removeClass("que-not-attempted"),
                t.find("a").addClass("que-not-answered"),
                //NextQuestion(!1),
                CheckQueAttemptStatus()
        });

        $(".btn-submit-all-answers").click(function(e) {
            e.preventDefault();
            if (navigator.onLine) {
                var con = 1;
            } else {
                var con = 0;
            }
            if (con == 1) {
                clearInterval(myInterval);
                $(".btn-cancel").hide();
                $('.socket_title').text('Submiting');
                $('.socket_body').text('Please wait... Connecting to the server...');
                $("#socket").show("closed");
                var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                    _ '.$plink->id}}', 2);
                request.onsuccess = function(event) {
                    var db = event.target.result;
                    var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
                    var timeStore = db.transaction("timer", "readwrite").objectStore("timer");
                    objectStore.getAll().onsuccess = function(event) {
                        var answer = JSON.stringify(event.target.result);
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('student-saveanswer') }}",
                            data: {
                                data: answer,
                                pid: { { $paper - > id } },
                                plid: { { $plink - > id } },
                                sid: { { Auth::user() - > id } }
                            },
                            success: function(data) {
                                var num = Math.floor(Math.random() * 1000) + 600;
                                setTimeout(function() { SubmitResult(data); }, num);
                            },
                        });
                    }

                    timeStore.getAll().onsuccess = function(event) {
                        var answer = JSON.stringify(event.target.result);
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('student-timeleft') }}",
                            data: {
                                data: answer
                            },
                            success: function(data) {
                                var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                                    _ '.$plink->id}}', 2);
                                request.onsuccess = function(event) {
                                    for (var i = 0; i < data.length; i++) {
                                        event.target.result.transaction("timer", "readwrite").objectStore("timer").delete(data[i]);
                                    }
                                }
                            },
                        });
                    }
                }
                var con = 0;
            } else {
                clearInterval(myInterval);
                $(".btn-cancel").show();
                $('.socket_title').text('Connection Failed');
                $('.socket_body').text('Please Check Internet Connection... Failed Server Connection...');
                $("#socket").show("closed");
            }
        });


        function sortByProperty(property) {
            return function(a, b) {
                if (a[property] > b[property])
                    return 1;
                else if (a[property] < b[property])
                    return -1;

                return 0;
            }
        }

        function SubmitResult(datas) {
            $('.final_response').empty();
            var data = datas.sort(sortByProperty("qid"));
            for (var i = 0; i < data.length; i++) {
                if (data[i].a8 == 'save') { var a8 = 'Saved' }
                if (data[i].a8 == 'save_mark') { var a8 = 'Save & Mark For Review' }
                if (data[i].a8 == 'mark') { var a8 = 'Mark For Review' }
                if (data[i].a8 == 'visited') { var a8 = 'Visited' }
                $('.final_response').append('<tr><th>' + data[i].qid + '</th><td>' + data[i].a1 + '</td><td>' + a8 + '</td></tr>');
            }
            $("#socket").fadeOut(500);
            $(".exam-paper").hide();
            $(".stream_1").hide();
            $("#divdrplngcng").hide();
            $(".exam-summery").show();
            if (submitInterval) { clearInterval(submitInterval); }
            autosubmit(120);

            var pname = '{{$paper->pname}}';
            TT = '{{$paper->TT}}';
            NOQ = '{{$paper->NOQ}}';
            total_marks = '{{$paper->total_marks}}';
            PQ = '{{$paper->PQ}}';
            PM = '{{$paper->PM}}';
            PN = '{{$paper->PN}}';
            CQ = '{{$paper->CQ}}';
            CM = '{{$paper->CM}}';
            CN = '{{$paper->CN}}';
            MQ = '{{$paper->MQ}}';
            MM = '{{$paper->MM}}';
            MN = '{{$paper->MN}}';
            BQ = '{{$paper->BQ}}';
            BM = '{{$paper->BM}}';
            BN = '{{$paper->BN}}';

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

            for (var i = 0; i < data.length; i++) {

                if (data[i].qid <= PQN) {
                    if ((data[i].a1 == data[i].a7 || data[i].a7 == "Bonus") && (data[i].a8 == "save" || data[i].a8 == "save_mark")) {
                        var MinP = parseInt(MinP) + parseInt(PM);
                        CinP++;
                    } else if ((data[i].a1 != data[i].a7 && data[i].a8 == "save") || (data[i].a1 != data[i].a7 && data[i].a8 == "save_mark")) {
                        var MinP = parseInt(MinP) - parseInt(PN);
                        WinP++;
                    }
                } else if (data[i].qid <= CQN && data[i].qid > PQN) {
                    if ((data[i].a1 == data[i].a7 || data[i].a7 == "Bonus") && (data[i].a8 == "save" || data[i].a8 == "save_mark")) {
                        var MinC = parseInt(MinC) + parseInt(CM);
                        CinC++;
                    } else if ((data[i].a1 != data[i].a7 && data[i].a8 == "save") || (data[i].a1 != data[i].a7 && data[i].a8 == "save_mark")) {
                        var MinC = parseInt(MinC) - parseInt(CN);
                        WinC++;
                    }
                } else if (data[i].qid <= MQN && data[i].qid > CQN) {
                    if ((data[i].a1 == data[i].a7 || data[i].a7 == "Bonus") && (data[i].a8 == "save" || data[i].a8 == "save_mark")) {
                        var MinM = parseInt(MinM) + parseInt(MM);
                        CinM++;
                    } else if ((data[i].a1 != data[i].a7 && data[i].a8 == "save") || (data[i].a1 != data[i].a7 && data[i].a8 == "save_mark")) {
                        var MinM = parseInt(MinM) - parseInt(MN);
                        WinM++;
                    }
                } else if (data[i].qid <= BQN && data[i].qid > MQN) {
                    if ((data[i].a1 == data[i].a7 || data[i].a7 == "Bonus") && (data[i].a8 == "save" || data[i].a8 == "save_mark")) {
                        var MinB = parseInt(MinB) + parseInt(BM);
                        CinB++;
                    } else if ((data[i].a1 != data[i].a7 && data[i].a8 == "save") || (data[i].a1 != data[i].a7 && data[i].a8 == "save_mark")) {
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
            var blurtime = $('.blur-time').val();
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onsuccess = function(event) {
                var db = event.target.result;
                var objectStore = db.transaction("submit", "readwrite").objectStore("submit");
                var req = objectStore.openCursor('result_submit');
                req.onsuccess = function(e) {
                    var cursor = e.target.result;
                    if (cursor) { // key already exist
                        cursor.update({ id: 'result_submit', plid: '{{$plink->id}}', pid: '{{$paper->id}}', pname: '{{$paper->pname}}', TT: '{{$paper->TT}}', blurtime: blurtime, PQN: PQN, CQN: CQN, MQN: MQN, BQN: BQN, total_marks: total_marks, totalQ: totalQ, totalA: totalA, totalC: totalC, totalW: totalW, totalS: totalS, CinP: CinP, WinP: WinP, MinP: MinP, CinC: CinC, WinC: WinC, MinC: MinC, CinM: CinM, WinM: WinM, MinM: MinM, CinB: CinB, WinB: WinB, MinB: MinB });
                    } else { // key not exist
                        objectStore.add({ id: 'result_submit', plid: '{{$plink->id}}', pid: '{{$paper->id}}', pname: '{{$paper->pname}}', TT: '{{$paper->TT}}', blurtime: blurtime, PQN: PQN, CQN: CQN, MQN: MQN, BQN: BQN, total_marks: total_marks, totalQ: totalQ, totalA: totalA, totalC: totalC, totalW: totalW, totalS: totalS, CinP: CinP, WinP: WinP, MinP: MinP, CinC: CinC, WinC: WinC, MinC: MinC, CinM: CinM, WinM: WinM, MinM: MinM, CinB: CinB, WinB: WinB, MinB: MinB });
                    }
                };
            };
        }
        var el = 'yes';
        $("#btnYesSubmit").on("click", function(e) {
            event.preventDefault();
            if (navigator.onLine) {
                if (el == 'no') { return false; }
                clearInterval(submitInterval);
                $(".btn-cancel").hide();
                $('.socket_title').text('Result Submiting');
                $('.socket_body').text('Please wait... Submiting Result...');
                $("#socket").show("closed");
                el = 'no';
                setTimeout(function() { el = "yes";
                    $(".btn-cancel").show(); }, 15000);
                var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                    _ '.$plink->id}}', 2);
                request.onsuccess = function(event) {
                    var db = event.target.result;
                    var objectStore = db.transaction("submit", "readwrite").objectStore("submit");
                    objectStore.get('result_submit').onsuccess = function(event) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('student-submit_result') }}",
                            data: event.target.result,
                            success: function(data) {
                                $('.socket_title').text('Redirecting to Results');
                                $('.socket_body').text('Please wait... Sending To Results Section...');
                                var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                                    _ '.$plink->id}}', 2);
                                request.onsuccess = function(event) {
                                    event.target.result.transaction("submit", "readwrite").objectStore("submit").delete('autosubmit');
                                    event.target.result.transaction("submit", "readwrite").objectStore("submit").delete('result_submit');
                                    event.target.result.transaction("submit", "readwrite").objectStore("submit").delete('blur_time');
                                    event.target.result.transaction("timer", "readwrite").objectStore("timer").delete('total_time');
                                    event.target.result.transaction("responses", "readwrite").objectStore("responses").clear();
                                    window.indexedDB.deleteDatabase('normal_paper_{{Auth::user()->id.'
                                        _ '.$plink->id}}', 2);
                                    var img = '{{ route('
                                    student - result_analysis ',['
                                    id '=>': year ']) }}';
                                    var img = img.replace('%3Ayear', data);
                                    var num = Math.floor(Math.random() * 1000) + 600;
                                    var num1 = Math.floor(Math.random() * 5000) + 3600;
                                    setTimeout(function() { el = "no";
                                        $(".btn-cancel").hide(); }, 15000);
                                    setTimeout(function() { window.location.assign(img); }, num);
                                    setTimeout(function() {
                                        $(".btn-cancel").hide();
                                        $(".spinner").hide();
                                        $('.socket_title').text('Result Submitted successfully');
                                        $('.socket_body').text('');
                                        $('.socket_body_main').html('<p>Click Below to see Your Result..</p><br><a class="btn btn-success btn-outline-danger" href="' + img + '">Open Result</a>');
                                    }, num1);

                                }
                            },
                        });
                    }
                }
            } else {
                clearInterval(myInterval);
                $(".btn-cancel").show();
                $('.socket_title').text('Connection Failed');
                $('.socket_body').text('Please Check Internet Connection... Failed Server Connection...');
                $("#socket").show("closed");
            }

        });
        $("#btnNoSubmit").on("click", function(e) {
            CoundownTimerNew(parseInt($("#hdfTestDuration").val()));
            clearInterval(submitInterval);
            e.preventDefault(), $(".exam-paper").show(), $(".stream_1").show(), $(".exam-summery").hide(), $("#divdrplngcng").show()
        });

        $("#btnNoSubmitConfirm").on("click", function(e) {
            var btn1p = 0;
            var btn2p = 0;
            e.preventDefault(), $(".exam-paper").show(), $(".stream_1").show(), $(".exam-confirm").hide(), $("#divdrplngcng").show()
        });

        function btn_save_answer(ans, qid, typed) {
            var plid = '{{$plink->id}}';
            pid = '{{$paper->id}}';
            sid = { { Auth::user() - > id } };
            p_type = '{{$plink->type}}';
            time = question_time[qid];
            var ans_value = $('.Question_data_' + qid).data('id');
            var type = typed;
            if (ans_value == 'Bonus') {
                var a1 = 'Bonus';
                var a7 = 'Bonus';
                var type = 'save';
                var answer = 'Correct';
            } else {
                if (ans == ans_value) {
                    var answer = 'Correct';
                } else {
                    var answer = 'Incorrect';
                }
                var a1 = ans;
                var a7 = ans_value;
            }
            var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
                _ '.$plink->id}}', 2);
            request.onsuccess = function(event) {
                var db = event.target.result;
                var objectStore = db.transaction("responses", "readwrite").objectStore("responses");
                var req = objectStore.openCursor(parseInt(qid));
                req.onsuccess = function(e) {
                    var cursor = e.target.result;
                    if (cursor) { // key already exist
                        cursor.update({ sid: parseInt(sid), qid: parseInt(qid), pid: pid, plid: plid, qtype: 'single', qplsid: qid + 'X' + plid + 'X' + sid, qplsqtypeid: qid + 'X' + plid + 'X' + sid + 'Xsingle', a1: a1, a2: "", a3: "", a4: "", a5: "", a6: "", a7: a7, a8: type, answer: answer, ans_type: "", time_used: time });
                    } else { // key not exist
                        objectStore.add({ sid: parseInt(sid), qid: parseInt(qid), pid: pid, plid: plid, qtype: 'single', qplsid: qid + 'X' + plid + 'X' + sid, qplsqtypeid: qid + 'X' + plid + 'X' + sid + 'Xsingle', a1: a1, a2: "", a3: "", a4: "", a5: "", a6: "", a7: a7, a8: type, answer: answer, ans_type: "", time_used: time });
                    }
                };
            };
        };

        $('.paperview').on('change', function(e) {
            e.preventDefault();
            var id = $(".test-questions").find("li.active").attr("id");
            $(".ques-img_text").show();
            $(".ques-img").css('filter', 'blur(5px)');
            $(".ques-img_text" + id).hide();
            $(".ques-img" + id).css('filter', 'none');
            $(".pageno" + id).click();

            if ($(this).val() == 'all') {
                $('#show').modal('show');
                $(".ques-img_div").show();
                $('.ques-all').removeClass('hidden');

            } else if ($(this).val() == 'Physics') {
                $('.ques-all').addClass('hidden');
                $('#show').modal('show');
                $(".ques-img_div").hide();
                for (var i = 1; i <= { { $PQN } }; i++) {
                    $('.ques-img' + i).removeClass('hidden');
                    $(".ques-img_div" + i).show();
                }
            } else if ($(this).val() == 'Chemistry') {
                $('.ques-all').addClass('hidden');
                $('#show').modal('show');
                $(".ques-img_div").hide();
                for (var i = { { $PQN + 1 } }; i <= { { $CQN } }; i++) {
                    $('.ques-img' + i).removeClass('hidden');
                    $(".ques-img_div" + i).show();
                }
            } else if ($(this).val() == 'Mathmatics') {
                $('.ques-all').addClass('hidden');
                $('#show').modal('show');
                $(".ques-img_div").hide();
                for (var i = { { $CQN + 1 } }; i <= { { $MQN } }; i++) {
                    $('.ques-img' + i).removeClass('hidden');
                    $(".ques-img_div" + i).show();
                }
            } else if ($(this).val() == 'Biology') {
                $('.ques-all').addClass('hidden');
                $('#show').modal('show');
                $(".ques-img_div").hide();
                for (var i = { { $MQN + 1 } }; i <= { { $BQN } }; i++) {
                    $('.ques-img' + i).removeClass('hidden');
                    $(".ques-img_div" + i).show();
                }
            }

        });
        $('.stream_1').on('click', function(e) {
            e.preventDefault();
            var current_herf = $(this).attr('data-href');
            var a = $(".test-questions").find("li").find("a[data-href=" + current_herf + "]");
            a.trigger('click');
        });

        $('#btnRBack').on('click', function(e) {
            e.preventDefault();
            window.location.href = "online_tests";
        });
    });


    function socket_message(title, body) {
        clearInterval(myInterval);
        $(".spinner").hide();
        $(".btn-cancel").show();
        $('.socket_title').text(title);
        $('.socket_body').text(body);
        $("#socket").show("closed");
    }

    function socket_reload(title, body) {
        $(".btn-cancel").hide();
        $('.socket_title').text("Your Paper Reloading...");
        if (body != null) { $('.socket_body').text(body); } else { $('.socket_body').text("your Paper will reload in 5 sec. by institute"); }

        $("#socket").show("closed");
        clearInterval(myInterval);
        setTimeout(function() { location.reload(); }, 6000);
    }

    function socket_submit() {
        clearInterval(myInterval);
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var objectStore = db.transaction("submit", "readwrite").objectStore("submit");
            var req = objectStore.openCursor('autosubmit');
            req.onsuccess = function(e) {
                var cursor = e.target.result;
                if (cursor) { // key already exist
                    cursor.update({ id: 'autosubmit' });
                } else { // key not exist
                    objectStore.add({ id: 'autosubmit' });
                }
            };
        };
        $(".btn-cancel").hide();
        $("#btnNoSubmit").hide();
        $('.socket_title').text("Automatic Submiting...");
        $('.socket_body').text("Please wait... Your Paper will Automatic Submit in 5 sec.");
        $("#socket").show("closed");
        $('.btn-submit-all-answers').trigger('click');
    }
    $(".btn-cancel").click(function() {
        if ($('.exam-paper').css('display') != 'none') {
            CoundownTimer(parseInt($("#hdfTestDuration").val()));
        }
    });

    function blurpage() {
        var t = $('.blur-time').val();
        blurInterval = setInterval(function() {
            t++;
            $('.blur-time').val(t);
        }, 1e3);
    }

    function focuspage() {
        clearInterval(blurInterval);
        var t = $('.blur-time').val();
        var request = window.indexedDB.open('normal_paper_{{Auth::user()->id.'
            _ '.$plink->id}}', 2);
        request.onsuccess = function(event) {
            var db = event.target.result;
            var objectStore = db.transaction("submit", "readwrite").objectStore("submit");
            var req = objectStore.openCursor('blur_time');
            req.onsuccess = function(e) {
                var cursor = e.target.result;
                if (cursor) { // key already exist
                    cursor.update({ id: 'blur_time', plid: t });
                } else { // key not exist
                    objectStore.add({ id: 'blur_time', plid: t });
                }
            };
        };
    }
    $(window).blur(function() {
        blurpage();
    });
    $(window).focus(function() {
        focuspage();
    });

    $('.portrait_rotate').on('click', function(e) {
        e.preventDefault();
        if (window.AndroidFunction) {
            $('.landscape_rotate').show();
            $('.portrait_rotate').hide();
            AndroidFunction.portrait();
        }
    });
    $('.landscape_rotate').on('click', function(e) {
        e.preventDefault();
        if (window.AndroidFunction) {
            $('.landscape_rotate').hide();
            $('.portrait_rotate').show();
            AndroidFunction.landscape();
        }

    });
    $(window).bind('beforeunload', function() {
        if (window.AndroidFunction) {
            AndroidFunction.portrait();
        }
    });

    </script>
    @endforeach
    @endforeach
    @endforeach
    <style type="text/css">
    #heading-breadcrumbs.active {
        background: transparent;
    }

    #heading-breadcrumbs #arrwrapper {
        min-width: 35px;
        min-height: 35px;
        margin-right: 5px;
        margin-bottom: 5px;
        border-radius: 50%;
        background: rgba(43, 43, 51, 0.8);
        border: 1.5px solid #fff;
        float: right;
        transition: 0.15s ease;
    }

    .arrows:before,
    .arrows:after {
        background-color: #fd6e70;
    }

    #heading-breadcrumbs.active .arrows:before {
        background-color: #fff;
    }

    #heading-breadcrumbs.active .arrows:after {
        background-color: #fff;
    }

    #heading-breadcrumbs.active #arrwrapper {
        border: 1.5px solid #fd6e70;
    }

    #heading-breadcrumbs {
        background: #2b2b33;
        color: #fff;
    }

    </style>
</body>
@endif
@else
<h1 style=" text-align: center; font-family: sans-serif;font-weight: 400;font-size: 40px; color: #4d4d4d; padding-top: 20%;">Your Browser/Device Not Supporting. Please use Chrome / Firefox letest version</h1>
@endif

</html>
