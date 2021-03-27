<html>

<head>
    <title>Inspire Academy || IIT-JEE, NEET & MHT-CET</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Best success rate in all over maharashtra in JEE, NEET, CET & Olympiads.Inspire Academy achieves more than 80% selections from classroom courses and crash courses each year.Branches : Kolhapur,Karad & Satara
Add.: 2nd floor,Tathastu Corner,Shahupuri,Opp.railway Gate-416001 Contact:7972961299">
    <meta name="keywords" content="inspire kolhapur, inspire, inspire Academy, inspire portal, inspirekolhapur, inspirekolhapur.com">
    <link rel="canonical" href="https://inspirekolhapur.in" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta http-equiv="Pragma-directive: no-cache">
    <meta http-equiv="Cache-directive: no-cache">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/style.default.css')}}" rel="stylesheet" />
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
</head>

<body oncontextmenu="return false">
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
                            <a class="navbar-brand home"><img src="{{asset('img/delta.png')}}" width="300" alt="inspirekolhapur logo" class="img-responsive"> </a>
                        </div>
                        <div class="col-md-5 pull-right">
                            <div class="navbar-collapse">
                                <ul class="nav navbar-nav pull-right exam-paper ">
                                    <li class="user-profile">
                                        <table>
                                            <tr>
                                                <td style="padding: 0% 20px 16px 0%;"><img src="{{asset('student/images/'.Auth::user()->photo)}}" height="50"></td>
                                                <td>
                                                    <table>
                                                        <tr>
                                                            <td style="padding: 5px 5px;">Candidate Name</td>
                                                            <td> : <span style="color: #f7931e; font-weight: bold">{{Auth::user()->name}}</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="padding: 5px 5px;">Subject Name</td>
                                                            <td> : <span style="color: #f7931e; font-weight: bold">{{ $pname }}</span></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="clear"></div>
        <div>
            <div id="heading-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="pull-left">General Instructions</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div id="content">
                <div class="container">
                    <section>
                        <div class="row">
                            <div class="col-md-12 exam-confirm">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-12" id="en">
                                            <h4 class="text-center">Please read the instructions carefully</h4>
                                            <h4><strong><u>General Instructions:</u></strong></h4>
                                            <ol>
                                                <li>The clock will be set at the server. The countdown timer in the top right corner of screen will display the remaining time available for you to complete the examination. When the timer reaches zero, the
                                                    examination will end by itself. You will not be required to end or submit your examination.</li>
                                                <li>
                                                    The Questions Palette displayed on the right side of screen will show the status of each question using one of the following symbols:
                                                    <ol>
                                                        <li><img src="{{asset('img/QuizIcons/Logo1.png')}}" /> You have not visited the question yet.<br /><br /></li>
                                                        <li><img src="{{asset('img/QuizIcons/Logo2.png')}}" /> You have not answered the question.<br /><br /></li>
                                                        <li><img src="{{asset('img/QuizIcons/Logo3.png')}}" /> You have answered the question.<br /><br /></li>
                                                        <li><img src="{{asset('img/QuizIcons/Logo4.png')}}" /> You have NOT answered the question, but have marked the question for review.<br /><br /></li>
                                                        <li><img src="{{asset('img/QuizIcons/Logo5.png')}}" /> The question(s) "Answered and Marked for Review" will be considered for evalution.<br /><br /></li>
                                                    </ol>
                                                </li>
                                                <li>You can click on the "&gt;" arrow which apperes to the left of question palette to collapse the question palette thereby maximizing the question window. To view the question palette again, you can click
                                                    on "&lt;" which appears on the right side of question window.</li>
                                                <li>You can click on your "Profile" image on top right corner of your screen to change the language during the exam for entire question paper. On clicking of Profile image you will get a drop-down to change
                                                    the question content to the desired language.</li>
                                            </ol>
                                            <h4><strong><u>View Full Paper:</u></strong></h4>
                                            <ol start="5">
                                                <li>
                                                    To View Full Paper at once go to the Paper View tab and select the Subject to View Paper
                                                    of a particular Subject.
                                                </li>
                                            </ol>
                                            <h4><strong><u>Navigating to a Question:</u></strong></h4>
                                            <ol start="6">
                                                <li>
                                                    To answer a question, do the following:
                                                    <ol type="a">
                                                        <li>Click on the question number in the Question Palette at the right of your screen to go to that numbered question directly. Note that using this option does NOT save your answer to the current question.</li>
                                                        <li>Click on <strong>Save & Next</strong> to save your answer for the current question and then go to the next question.</li>
                                                        <li>Click on <strong>Mark for Review & Next</strong> to save your answer for the current question, mark it for review, and then go to the next question.</li>
                                                    </ol>
                                                </li>
                                            </ol>
                                            <h4><strong><u>Answering a Question:</u></strong></h4>
                                            <ol start="7">
                                                <li>
                                                    Procedure for answering a multiple choice type question:
                                                    <ol type="a">
                                                        <li>To select you answer, click on the button of one of the options.</li>
                                                        <li>To deselect your chosen answer, click on the button of the chosen option again or click on the <strong>Clear Response</strong> button</li>
                                                        <li>To change your chosen answer, click on the button of another option</li>
                                                        <li>To save your answer, you MUST click on the Save & Next button.</li>
                                                        <li>To mark the question for review, click on the Mark for Review & Next button.</li>
                                                    </ol>
                                                </li>
                                                <li>To change your answer to a question that has already been answered, first select that question for answering and then follow the procedure for answering that type of question.</li>
                                            </ol>
                                            <h4><strong><u>Navigating through sections:</u></strong></h4>
                                            <ol start="9">
                                                <li>Sections in this question paper are displayed on the top bar of the screen. Questions in a section can be viewed by click on the section name.</li>
                                                <li>You can shuffle between sections and questions anything during the examination as per your convenience only during the time stipulated.</li>
                                            </ol>
                                            <h4><strong><u> Final Submit:</u></strong></h4>
                                            <ol start="11">
                                                <li>Your responses will automatically Submit after the timer reaches zero.</li>
                                            </ol>
                                            <ol start="12">
                                                <li>
                                                    <ol type="a">
                                                        <li>Incase you want to submit before the actual alloted time then Click on the <strong>Submit</strong> button at bottom right side of your Question palette.</li>
                                                        <li>After Clicking Submit but an extra summary appear Click <strong>Yes</strong> if the summary displayed is Ok else Click <strong>No</strong> to continue the Paper solving again.</li>
                                                        <li>After that Click <strong>Ok</strong> for final submit. And You will be redirected to your Result section. </li>
                                                    </ol>
                                                </li>
                                            </ol>
                                            <hr>
                                            <div class="col-md-4 col-md-offset-4 text-center">
                                                <button type="submit" id="link" class="btn btn-primary btn-block">Proceed</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="text-center">© 2020 Delta Trek. | Designed by <a>Delta Trek</a> </p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('adminsa/js/jquery-2.1.1.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    if (window.indexedDB !== undefined) { var indexdb = 'supported'; } else { var indexdb = 'unsupported'; }
    var id = "{{$plink}}";
    var plid = "{{$id}}";
    var link = "{{ route('student-testpaper') }}";
    var id = id.replace(".blade.php", "");
    $("body").delegate("#link", "click", function() {
        window.location.href = link + '?' + 'id=' + id + '&plid=' + plid + '&indexdb=' + indexdb;
    });

    </script>
</body>

</html>
