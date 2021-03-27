<?php
namespace App\Http\Controllers;
use Validator;
use Response;
use File;
use Storage;
use disk;
use Auth;
use PDF;
use Zip;
use Session;
use newImage;
use ZanySoft\Zip\ZipManager;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\http\Requests;
use Illuminate\Http\Request;
use App\paper_link;
use App\student;
use App\result;
use App\teacher;
use App\time_left;
use App\admin;
use App\dpp;
use App\enquiry;
use App\dpp_link;
use App\advance_paper;
use App\answer;
use App\new_answer;
use App\normal_paper;
use App\online;
use App\question;
use App\new_question;
use App\chatbox;
use App\ts_folder;
use App\ts_folder_link;
use App\task_board;
use App\lecture;
use App\lecture_folder;
use App\lecture_link;
use App\lecture_subfolder;
use App\message;
use App\message_template;
use App\notification;
use App\notification_template;
use App\image;
use App\token;
use DB;
use Carbon\Carbon;

class AdminSimplePaperController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function normalpaperupload(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = normal_paper::where('pname', 'like', '%' . $studentsearch . '%')->orWhere('created_at', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.normal_paper_upload_list', compact('users'));
        }
        else
        {
            $users = normal_paper::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.normal_paper_upload_list', compact('users'));
        }
    }

    public function normalpaperupload_page(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = normal_paper::where('pname', 'like', '%' . $studentsearch . '%')->orWhere('created_at', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.normal_paper_upload_list_reload', compact('users'));
        }
        else
        {
            $users = normal_paper::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.normal_paper_upload_list_reload', compact('users'));
        }
    }

    public function normalpaperquesupload(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xnormal', 'active' => '1'];
        $question = 0;
        $solution = 0;
        $ques = array();
        $quest = new_question::where($where)->get();
        foreach ($quest as $q)
        {
            $ques = json_decode($q->questions);
        }
        foreach ($ques as $q)
        {
            if ($q->quesimg != NULL || $q->quesimg != "")
            {
                $question = $question + 1;
            }
            if ($q->solimg != NULL || $q->solimg != "")
            {
                $solution = $solution + 1;
            }
        }
        return view('admin.nr_ques_upload', compact('question', 'solution'));
    }

    public function normalpaperquesuploadsubmit(Request $request)
    {
        $where = ['id' => $request->id, 'active' => '1'];
        $where1 = ['pqtypeid' => $request->id . 'Xnormal', 'active' => '1'];
        $users = normal_paper::where($where)->select('pname')
            ->get();
        $questions = new_question::where($where1)->get();
        $question = array();
        $id = '';
        foreach ($users as $user)
        {
            $pname = $user->pname;
        }
        foreach ($questions as $user)
        {
            $question = json_decode($user->questions);
            $id = $user->id;
        }
        $this->validate($request, ['filenames' => 'required']);
        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {
                $name = $file->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                $path = base_path() . '/public_html/Quiz/normal_paper/' . $pname . '/question';
                $file->move($path, $name);
                $qpqtypeid = $file_name . "X" . $request->id . "X" . 'normal';
                $img = 'Quiz/normal_paper/' . $pname . '/question/' . $name;
                foreach ($question as $q)
                {
                    if ($q->qpqtypeid == $qpqtypeid)
                    {
                        $q->quesimg = $img;
                        $q->remember_token = time();
                    }
                }
            }
            $filea = new_question::where(['id' => $id])->update(['questions' => json_encode($question) ]);
        }
        return back()->with('success', 'uploaded Successfully');
    }
    public function normalpapersoluploadsubmit(Request $request)
    {
        $where = ['id' => $request->id, 'active' => '1'];
        $where1 = ['pqtypeid' => $request->id . 'Xnormal', 'active' => '1'];
        $users = normal_paper::where($where)->select('pname')
            ->get();
        $questions = new_question::where($where1)->get();
        $question = array();
        $id = '';
        foreach ($users as $user)
        {
            $pname = $user->pname;
        }
        foreach ($questions as $user)
        {
            $question = json_decode($user->questions);
            $id = $user->id;
        }
        $this->validate($request, ['filenames' => 'required']);
        if ($request->hasfile('filenames'))
        {
            foreach ($request->file('filenames') as $file)
            {
                $name = $file->getClientOriginalName();
                $file_name = pathinfo($name, PATHINFO_FILENAME);
                $path = base_path() . '/public_html/Quiz/normal_paper/' . $pname . '/solution';
                $file->move($path, $name);
                $qpqtypeid = $file_name . "X" . $request->id . "X" . 'normal';
                $img = 'Quiz/normal_paper/' . $pname . '/solution/' . $name;
                foreach ($question as $q)
                {
                    if ($q->qpqtypeid == $qpqtypeid)
                    {
                        $q->solimg = $img;
                        $q->remember_token = time();
                    }
                }
            }
            $filea = new_question::where(['id' => $id])->update(['questions' => json_encode($question) ]);
        }
        return back()->with('success', 'uploaded Successfully');
    }

    public function normalpaperansupload(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xnormal', 'active' => '1'];
        $users = array();
        $user = new_question::where($where)->get();
        foreach ($user as $q)
        {
            $users = json_decode($q->questions);
            $id = $q->pqtypeid;
        }
        return view('admin.nr_ans_upload', compact('users', 'id'));
    }

    public function normalpaperansuploadsubmit(Request $request)
    {
        $where = ['pqtypeid' => $request->pqtypeid, 'active' => '1'];
        $users = new_question::where($where)->update(['questions' => $request->data]);
        return response()
            ->json($users);
    }

    public function get_results_json(Request $request)
    {
        if ($request->get('type') == 'normal')
        {
            $paper = normal_paper::where(['id' => $request->get('id') , 'active' => '1'])
                ->get();
            $answers = new_answer::where(['pid' => $request->get('id') , 'p_type' => 'normal', 'active' => '1'])
                ->get();
            $where = ['pqtypeid' => $request->get('id') . 'Xnormal', 'active' => '1'];
            $questions = array();
            $user = new_question::where($where)->get();
            foreach ($user as $q)
            {
                $questions = json_decode($q->questions);
            }
            return response()
                ->json(['paper' => $paper, 'answers' => $answers, 'questions' => $questions]);
        }
        else
        {
            $paper = advance_paper::where(['id' => $request->get('id') , 'active' => '1'])
                ->get();
            $answers = new_answer::where(['pid' => $request->get('id') , 'p_type' => 'advanced', 'active' => '1'])
                ->get();
            $where = ['pqtypeid' => $request->get('id') . 'Xadvanced', 'active' => '1'];
            $questions = array();
            $user = new_question::where($where)->get();
            foreach ($user as $q)
            {
                $questions = json_decode($q->questions);
            }
            return response()
                ->json(['paper' => $paper, 'answers' => $answers, 'questions' => $questions]);
        }
    }
    public function update_results_submit(Request $request)
    {
        foreach (json_decode($request->answers) as $data)
        {
            $users = new_answer::where('id', $data->id)
                ->update(['answers' => json_encode($data->answers) ]);
        }
        foreach (json_decode($request->results) as $data)
        {
            $users = result::where(['pid' => $data->pid, 'plid' => $data->plid, 'sid' => $data->sid, 'active' => '1'])
                ->update(['totalQ' => $data->totalQ, 'totalA' => $data->totalA, 'totalC' => $data->totalC, 'totalW' => $data->totalW, 'totalS' => $data->totalS, 'totalCinP' => $data->CinP, 'totalWinP' => $data->WinP, 'totalSinP' => $data->MinP, 'totalCinC' => $data->CinC, 'totalWinC' => $data->WinC, 'totalSinC' => $data->MinC, 'totalCinM' => $data->CinM, 'totalWinM' => $data->WinM, 'totalSinM' => $data->MinM, 'totalCinB' => $data->CinB, 'totalWinB' => $data->WinB, 'totalSinB' => $data->MinB]);
            //---------------------------------------------------------------------Notification section--------------------------------------------
            $student = result::where(['pid' => $data->pid, 'plid' => $data->plid, 'sid' => $data->sid, 'active' => '1'])
                ->get();
            foreach ($student as $s)
            {
                $body = "Results for " . $s->paper . " have been updated.
 Your Score is : " . $s->totalS . "/" . $s->total_marks;
                if ($s->PQ != 0)
                {
                    $body = $body . "
 Physics         :  " . $s->totalSinP . "   Marks";
                }
                if ($s->CQ != 0)
                {
                    $body = $body . "
 Chemistry     :  " . $s->totalSinC . "   Marks";
                }
                if ($s->MQ != 0)
                {
                    $body = $body . "
 Mathmatics :  " . $s->totalSinM . "   Marks";
                }
                if ($s->BQ != 0)
                {
                    $body = $body . "
 Biology          :  " . $s->totalSinB . "   Marks";
                }
                $acd_id = Auth::user()->acd_id;
                $acd_name = Auth::user()->acd_name;
                $notification_type = 'right_icon_long';
                $title = 'Updated Result.';
                $body = $body;
                $title_long = 'Updated Result.';
                $body_long = $body;
                $title_line = null;
                $body_line1 = null;
                $body_line2 = null;
                $body_line3 = null;
                $body_line4 = null;
                $body_line5 = null;
                $body_line6 = null;
                $body_line7 = null;
                $body_line8 = null;
                $body_line9 = null;
                $body_line10 = null;
                $summary = "Result Update";
                $icon = asset('') . env('NOTI_ICON');
                $image = asset('') . env('NOTI_ICON');

                $browser_token = array();
                $br_tk = 0;
                $app_tk = 0;
                $app_token = array();
                $url = 'https://fcm.googleapis.com/fcm/send';
                $use = token::where(['user_id' => $s->sid, 'user_type' => 'student', 'active' => '1'])
                    ->get();
                foreach ($use as $user)
                {
                    if ($user->token_type == "Application")
                    {
                        $app_token[$app_tk] = $user->token;
                        $app_tk++;
                    }
                    else
                    {
                        $browser_token[$br_tk] = $user->token;
                        $br_tk++;
                    }
                }

                $headers = array(
                    "Authorization: key=" . env('FCM_SERVER_KEY') ,
                    'Content-Type: application/json'
                );
                $app_tokens = array_chunk($app_token, 999, true);
                foreach ($app_tokens as $token)
                {
                    $app_fields = array(
                        'registration_ids' => $token,
                        'data' => array(
                            "title" => $title,
                            "body" => $body,
                            "title_long" => $title_long,
                            "body_long" => $body_long,
                            "title_line" => $title_line,
                            "body_line1" => $body_line1,
                            "body_line2" => $body_line2,
                            "body_line3" => $body_line3,
                            "body_line4" => $body_line4,
                            "body_line5" => $body_line5,
                            "body_line6" => $body_line6,
                            "body_line7" => $body_line7,
                            "body_line8" => $body_line8,
                            "body_line9" => $body_line9,
                            "body_line10" => $body_line10,
                            "summary" => $summary,
                            "icon" => $icon,
                            "sound" => "notification",
                            "noti_id" => rand(1, 1000) ,
                            "channel_id" => "Notification",
                            "image" => $image,
                            "type" => $notification_type,
                            "click_action" => "https://deltatrek.in/user/login"
                        )
                    );

                    $fields = json_encode($app_fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    $results = curl_exec($ch);
                    curl_close($ch);
                }
                $browser_tokens = array_chunk($browser_token, 999, true);
                foreach ($browser_tokens as $token)
                {
                    if ($notification_type == 'no_icon')
                    {
                        $title = $title;
                        $body = $body;
                        $image = '';
                        $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                    }
                    elseif ($notification_type == 'right_icon' || $notification_type == 'left_icon')
                    {
                        $title = $title;
                        $body = $body;
                        $image = '';
                        $icon = $icon;
                    }
                    elseif ($notification_type == 'right_icon_long')
                    {
                        $title = $title_long;
                        $body = $body_long;
                        $image = '';
                        $icon = $icon;
                    }
                    elseif ($notification_type == 'no_icon_long')
                    {
                        $title = $title_long;
                        $body = $body_long;
                        $image = '';
                        $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                    }
                    elseif ($notification_type == 'no_icon_image')
                    {
                        $title = $title;
                        $body = $body;
                        $image = $image;
                        $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                    }
                    elseif ($notification_type == 'right_icon_image_hide' || $notification_type == 'right_icon_image_show')
                    {
                        $title = $title;
                        $body = $body;
                        $image = $image;
                        $icon = $icon;
                    }
                    elseif ($notification_type == 'no_icon_lines')
                    {
                        $title = $title_line;
                        $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                        $image = '';
                        $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                    }
                    elseif ($notification_type == 'right_icon_lines')
                    {
                        $title = $title_line;
                        $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                        $image = '';
                        $icon = $icon;
                    }
                    $browser_fields = array(
                        'registration_ids' => $token,
                        'notification' => array(
                            "title" => $title,
                            "body" => $body,
                            "icon" => $icon,
                            "sound" => "notification",
                            "noti_id" => rand(1, 1000) ,
                            "image" => $image,
                            "click_action" => "https://deltatrek.in/user/login"
                        )
                    );

                    $fields = json_encode($browser_fields);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                    $results = curl_exec($ch);
                    curl_close($ch);
                }
            }
        }
        return response()->json('Results And Answers Updated Successfully');
    }

    /*public function bonus_question(Request $request){
          $where=['qpqtypeid'=>$request->qpqtypeid,
        'active'=>'1'];
        $users= question::where($where)->get();
          foreach ($users as $user) {
        
           if($user->type=='normal'){
               $use= question::where($where)->update(['q1' => 'Bonus']); 
           }else{
               $use= question::where($where)->update(['q1' => '0','q2' => '0','q3' => '0','q4' => '0']); 
           }
          }
    
          return response()->json($use);
      }*/

    public function normalpaperpublish(Request $request)
    {
        $where = ['id' => $request->get('id') , 'active' => '1'];
        $users = normal_paper::where($where)->get();
        return view('admin.nr_publish', compact('users'));
    }

    public function normalpaperupdateresultpage(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xnormal', 'active' => '1'];
        $users = array();
        $user = new_question::where($where)->get();
        foreach ($user as $use)
        {
            $users = json_decode($use->questions);
        }
        return view('admin.nr_ans_upload_updates', compact('users'));
    }

    /*public function normalpaperupdateresult(Request $request){
          $where=['pid'=>$request->pid,'type'=>'normal'];
          $where1=['qpqtypeid'=>$request->id."X".$request->pid."X".'normal','active'=>'1'];
           $pname =""; $PQ =""; $PM =""; $PN =""; $CQ =""; $CM =""; $CN =""; $MQ =""; $MM =""; $MN =""; $BQ =""; $BM =""; $BN =""; $TT="";$NOQ="";
       $where2=['id'=>$request->pid,'active'=>'1'];
        $papers = normal_paper::where($where2)->get();
        foreach ($papers as $paper) {
          $pname =$paper->pname; $PQ =$paper->PQ; $PM =$paper->PM; $PN =$paper->PN; $CQ =$paper->CQ; $CM =$paper->CM; $CN =$paper->CN; $MQ =$paper->MQ; $MM =$paper->MM; $MN =$paper->MN; $BQ =$paper->BQ; $BM =$paper->BM; $BN =$paper->BN; $TT=$paper->TT;$NOQ=$paper->NOQ; $total_marks=$paper->total_marks;
        }
        $PQN = $PQ; $CQN = $PQ + $CQ; $MQN = $PQ + $CQ + $MQ; $BQN = $PQ + $CQ + $MQ + $BQ;
         $questions = question::where($where1)->select('q1')->get();
          $users = paper_link::where($where)->get();
          foreach ($users as $user) {
             $where3=['pid'=>$request->pid,'qid'=>$request->id,'plid'=>$user->id,'active'=>'1'];
             foreach ($questions as $ques) {
                $q7=$ques->q1;
                $answer=answer::where($where3)->get();
                foreach ($answer as $anse) {
                 if ($ques->q1==$anse->a1) {
            $q2='Correct';
             $answerq = answer::find($anse->id)->update(['a7'=>$ques->q1,'answer'=>$q2]);
            
            }
             elseif ($q7=='Bonus') {
                  $q2='Correct';
                  $answerq = answer::find($anse->id)->update(['a1'=>'Bonus','a7'=>'Bonus','a8'=>'save','answer'=>$q2]);
               }
               else{
              $q2='Incorrect';
               $answerq = answer::find($anse->id)->update(['a7'=>$ques->q1,'answer'=>$q2]);
                
            }
         $results=result::where(['plid'=>$user->id,'sid'=>$anse->sid])->get();
         foreach ($results as $res) {
            $where4=['pplsid'=>$request->pid."X".$user->id."X".$anse->sid,'active'=>'1'];
        $answers = answer::where($where4)->get();
        $no =0; $MinP=0; $CinP=0; $WinP=0; $MinC=0; $CinC=0; $WinC=0; $MinM=0; $CinM=0; $WinM=0; $MinB=0; $CinB=0; $WinB=0;
        foreach ($answers as $ans) {
          if($ans->qid<= $PQN){
            if (($ans->a1==$ans->a7 && $ans->a8=="save") || ($ans->a1==$ans->a7 && $ans->a8=="save_mark")) {
             $MinP = $MinP + $PM;
             $CinP++;
            }
            else if (($ans->a1!=$ans->a7 && $ans->a8=="save") || ($ans->a1!=$ans->a7 && $ans->a8=="save_mark")){
               $MinP = $MinP - $PN;
               $WinP++;
            }
          }
          else if($ans->qid<= $CQN && $ans->qid >$PQN){
            if (($ans->a1==$ans->a7 && $ans->a8=="save") || ($ans->a1==$ans->a7 && $ans->a8=="save_mark")) {
             $MinC = $MinC + $CM;
             $CinC++;
            }
            else if (($ans->a1!=$ans->a7 && $ans->a8=="save") || ($ans->a1!=$ans->a7 && $ans->a8=="save_mark")){
               $MinC = $MinC - $CN;
               $WinC++;
            }
          }
          else if($ans->qid<= $MQN && $ans->qid >$CQN){
            if (($ans->a1==$ans->a7 && $ans->a8=="save") || ($ans->a1==$ans->a7 && $ans->a8=="save_mark")) {
             $MinM = $MinM + $MM;
             $CinM++;
            }
            else if (($ans->a1!=$ans->a7 && $ans->a8=="save") || ($ans->a1!=$ans->a7 && $ans->a8=="save_mark")){
               $MinM = $MinM - $MN;
               $WinM++;
            }
          }
         else if($ans->qid<= $BQN && $ans->qid >$MQN){
            if (($ans->a1==$ans->a7 && $ans->a8=="save") || ($ans->a1==$ans->a7 && $ans->a8=="save_mark")) {
             $MinB = $MinB + $BM;
             $CinB++;
            }
            else if (($ans->a1!=$ans->a7 && $ans->a8=="save") || ($ans->a1!=$ans->a7 && $ans->a8=="save_mark")){
               $MinB = $MinB - $BN;
               $WinB++;
            }
          }
         
        }
         $totalS= $MinP +  $MinC + $MinM + $MinB;
           $totalQ = $NOQ;
           $totalC = $CinP + $CinC + $CinM + $CinB;
           $totalW = $WinP + $WinC + $WinM + $WinB;
            $totalA= $totalC + $totalW;
    
             $result = result::find($res->id);
              $result->type='normal';
              $result->totalQ=$totalQ;
              $result->totalA=$totalA;
              $result->totalC=$totalC;
              $result->totalW=$totalW;
              $result->totalS=$totalS;
              $result->totalCinP=$CinP;
              $result->totalWinP=$WinP;
              $result->totalSinP=$MinP;
              $result->totalCinC=$CinC;
              $result->totalWinC=$WinC;
              $result->totalSinC=$MinC;
              $result->totalCinM=$CinM;
              $result->totalWinM=$WinM;
              $result->totalSinM=$MinM;
              $result->totalCinB=$CinB;
              $result->totalWinB=$WinB;
              $result->totalSinB=$MinB;
               $result->save();
         }
         }
         }
         }
    return response()->json($users);
         
      }*/

    public function normalpaperpublishsubmit(Request $request)
    {
        $this->validate($request, ['class' => 'required', 'course' => 'required', 'coursetype' => 'required', 'publishtime' => 'required', 'radio' => 'required', 'radio1' => 'required', 'view' => 'required', 'pname' => 'required', 'plink' => 'required', 'pid' => 'required', 'hardness' => 'required']);
        $folder_notification = "no";
        $folder_paper_notification = "no";
        $paper_notification = "yes";
        $id = NULL;
        if ($request->folder_id != NULL)
        {
            $folder_paper_notification = "yes";
            $paper_notification = "no";
            $n = 0;
            $fx = ts_folder::find($request->folder_id);
            $n = ts_folder_link::where(['folder_id' => $fx->id, 'cccgid' => $request->class . $request->course . $request->coursetype . $request->radio, 'active' => '1'])
                ->count();
            if ($n == 0)
            {
                $files = new ts_folder_link();
                $files->acd_id = $fx->acd_id;
                $files->acd_name = $fx->acd_name;
                $files->folder_id = $fx->id;
                $files->name = $fx->name;
                $files->folder_type = $fx->folder_type;
                $files->classid = $request->class;
                $files->courseid = $request->course;
                $files->coursetypeid = $request->coursetype;
                $files->groupid = $request->radio;
                $files->cccgid = $request->class . $request->course . $request->coursetype . $request->radio;
                $files->count = 1;
                $files->active = 1;
                $files->save();
                $id = $files->id;
                $folder_notification = "yes";

            }
            else
            {
                $count = 0;
                $users = ts_folder_link::where(['folder_id' => $fx->id, 'cccgid' => $request->class . $request->course . $request->coursetype . $request->radio, 'active' => '1'])
                    ->get();
                foreach ($users as $use)
                {
                    $count = $use->count + 1;
                    $id = $use->id;
                }
                $users = ts_folder_link::where(['folder_id' => $fx->id, 'cccgid' => $request->class . $request->course . $request->coursetype . $request->radio, 'active' => '1'])
                    ->update(['count' => $count]);
            }
        }
        $file = new paper_link();
        $file->pid = $request->pid;
        $file->classid = $request->class;
        $file->courseid = $request->course;
        $file->coursetypeid = $request->coursetype;
        $file->groupid = $request->radio;
        $file->cccgid = $request->class . $request->course . $request->coursetype . $request->radio;
        $file->paper = $request->pname;
        $file->plink = $request->plink;
        $file->hardness = $request->hardness;
        $file->view = $request->view;
        $file->rank = $request->radio1;
        $file->test_series = $request->test_series;
        $file->folder_link_id = $id;
        $file->publishtime = $request->publishtime;
        $file->type = 'normal';
        $file->active = 1;
        $file->save();
        //---------------------------------------------------------------------Notification section--------------------------------------------
        

        if ($folder_notification == "yes")
        {
            $title = "New Folder Published";
            $body = $fx->name . " has been published in online test series section.
Kindly attempt it as per the time allotted.";
            $summary = "Folder Publish";

            $acd_id = Auth::user()->acd_id;
            $acd_name = Auth::user()->acd_name;
            $notification_type = 'right_icon_long';
            $title = $title;
            $body = $body;
            $title_long = $title;
            $body_long = $body;
            $title_line = null;
            $body_line1 = null;
            $body_line2 = null;
            $body_line3 = null;
            $body_line4 = null;
            $body_line5 = null;
            $body_line6 = null;
            $body_line7 = null;
            $body_line8 = null;
            $body_line9 = null;
            $body_line10 = null;
            $summary = $summary;
            $icon = asset('') . env('NOTI_ICON');
            $image = asset('') . env('NOTI_ICON');
            $class = $request->class;
            $course = $request->course;
            $coursetype = $request->coursetype;
            $group = $request->radio;
            $cccgid = $request->class . $request->course . $request->coursetype . $request->radio;
            $publishtime = $request->publishtime;

            $browser_token = array();
            $br_tk = 0;
            $app_tk = 0;
            $app_token = array();
            $url = 'https://fcm.googleapis.com/fcm/send';

            $userss = student::where(['class' => $class, 'course' => $course, 'coursetype' => $coursetype, 'groupid' => $group, 'active' => '1'])->select('id')
                ->get();
            foreach ($userss as $users)
            {
                $use = token::where(['user_id' => $users->id, 'user_type' => 'student', 'active' => '1'])
                    ->get();
                foreach ($use as $user)
                {
                    if ($user->token_type == "Application")
                    {
                        $app_token[$app_tk] = $user->token;
                        $app_tk++;
                    }
                    else
                    {
                        $browser_token[$br_tk] = $user->token;
                        $br_tk++;
                    }
                }
            }

            $headers = array(
                "Authorization: key=" . env('FCM_SERVER_KEY') ,
                'Content-Type: application/json'
            );
            $app_tokens = array_chunk($app_token, 999, true);
            foreach ($app_tokens as $token)
            {
                $app_fields = array(
                    'registration_ids' => $token,
                    'data' => array(
                        "title" => $title,
                        "body" => $body,
                        "title_long" => $title_long,
                        "body_long" => $body_long,
                        "title_line" => $title_line,
                        "body_line1" => $body_line1,
                        "body_line2" => $body_line2,
                        "body_line3" => $body_line3,
                        "body_line4" => $body_line4,
                        "body_line5" => $body_line5,
                        "body_line6" => $body_line6,
                        "body_line7" => $body_line7,
                        "body_line8" => $body_line8,
                        "body_line9" => $body_line9,
                        "body_line10" => $body_line10,
                        "summary" => $summary,
                        "icon" => $icon,
                        "sound" => "notification",
                        "noti_id" => rand(1, 1000) ,
                        "channel_id" => "Paper Publish",
                        "image" => $image,
                        "type" => $notification_type,
                        "click_action" => "https://deltatrek.in/user/login"
                    )
                );

                $fields = json_encode($app_fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                $result = curl_exec($ch);
                curl_close($ch);
            }
            $browser_tokens = array_chunk($browser_token, 999, true);
            foreach ($browser_tokens as $token)
            {
                if ($notification_type == 'no_icon')
                {
                    $title = $title;
                    $body = $body;
                    $image = '';
                    $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                }
                elseif ($notification_type == 'right_icon' || $notification_type == 'left_icon')
                {
                    $title = $title;
                    $body = $body;
                    $image = '';
                    $icon = $icon;
                }
                elseif ($notification_type == 'right_icon_long')
                {
                    $title = $title_long;
                    $body = $body_long;
                    $image = '';
                    $icon = $icon;
                }
                elseif ($notification_type == 'no_icon_long')
                {
                    $title = $title_long;
                    $body = $body_long;
                    $image = '';
                    $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                }
                elseif ($notification_type == 'no_icon_image')
                {
                    $title = $title;
                    $body = $body;
                    $image = $image;
                    $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                }
                elseif ($notification_type == 'right_icon_image_hide' || $notification_type == 'right_icon_image_show')
                {
                    $title = $title;
                    $body = $body;
                    $image = $image;
                    $icon = $icon;
                }
                elseif ($notification_type == 'no_icon_lines')
                {
                    $title = $title_line;
                    $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                    $image = '';
                    $icon = 'https://deltatrek.in/img/mobile%20ins.png';
                }
                elseif ($notification_type == 'right_icon_lines')
                {
                    $title = $title_line;
                    $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                    $image = '';
                    $icon = $icon;
                }
                $browser_fields = array(
                    'registration_ids' => $token,
                    'notification' => array(
                        "title" => $title,
                        "body" => $body,
                        "icon" => $icon,
                        "sound" => "notification",
                        "noti_id" => rand(1, 1000) ,
                        "image" => $image,
                        "click_action" => "https://deltatrek.in/user/login"
                    )
                );

                $fields = json_encode($browser_fields);
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
                $result = curl_exec($ch);
                curl_close($ch);
            }
        }
        if ($folder_paper_notification == "yes")
        {
            $title = "New Paper Published";
            $dateTimestamp1 = strtotime($request->publishtime);
            $dateTimestamp2 = time();
            if ($dateTimestamp2 < $dateTimestamp1)
            {
                $body = $request->pname . " has been scheduled for " . date_format(date_create($request->publishtime) , "jS M, h:i a") . " under the folder " . $fx->name . " in online test series section.
Kindly attempt it as per the schedule.";
            }
            else
            {
                $body = $request->pname . " has been published under the folder " . $fx->name . " in online test series section.
Kindly attempt it as per the schedule.";
            }
            $summary = "Test Series Publish";

        }
        else
        {
            $title = "New Paper Published";
            $dateTimestamp1 = strtotime($request->publishtime);
            $dateTimestamp2 = time();
            if ($dateTimestamp2 < $dateTimestamp1)
            {
                $body = $request->pname . " has been scheduled for " . date_format(date_create($request->publishtime) , "jS M, h:i a") . ".
Kindly attempt it as per the schedule.";
            }
            else
            {
                $body = $request->pname . " is active Now.
Kindly attempt it at the earliest.";
            }
            $summary = "Paper Publish";
        }

        $acd_id = Auth::user()->acd_id;
        $acd_name = Auth::user()->acd_name;
        $notification_type = 'right_icon_long';
        $title = $title;
        $body = $body;
        $title_long = $title;
        $body_long = $body;
        $title_line = null;
        $body_line1 = null;
        $body_line2 = null;
        $body_line3 = null;
        $body_line4 = null;
        $body_line5 = null;
        $body_line6 = null;
        $body_line7 = null;
        $body_line8 = null;
        $body_line9 = null;
        $body_line10 = null;
        $summary = $summary;
        $icon = asset('') . env('NOTI_ICON');
        $image = asset('') . env('NOTI_ICON');
        $class = $request->class;
        $course = $request->course;
        $coursetype = $request->coursetype;
        $group = $request->radio;
        $cccgid = $request->class . $request->course . $request->coursetype . $request->radio;
        $publishtime = $request->publishtime;

        $browser_token = array();
        $br_tk = 0;
        $app_tk = 0;
        $app_token = array();
        $url = 'https://fcm.googleapis.com/fcm/send';

        $userss = student::where(['class' => $class, 'course' => $course, 'coursetype' => $coursetype, 'groupid' => $group, 'active' => '1'])->select('id')
            ->get();
        foreach ($userss as $users)
        {
            $use = token::where(['user_id' => $users->id, 'user_type' => 'student', 'active' => '1'])
                ->get();
            foreach ($use as $user)
            {
                if ($user->token_type == "Application")
                {
                    $app_token[$app_tk] = $user->token;
                    $app_tk++;
                }
                else
                {
                    $browser_token[$br_tk] = $user->token;
                    $br_tk++;
                }
            }
        }

        $headers = array(
            "Authorization: key=" . env('FCM_SERVER_KEY') ,
            'Content-Type: application/json'
        );
        $app_tokens = array_chunk($app_token, 999, true);
        foreach ($app_tokens as $token)
        {
            $app_fields = array(
                'registration_ids' => $token,
                'data' => array(
                    "title" => $title,
                    "body" => $body,
                    "title_long" => $title_long,
                    "body_long" => $body_long,
                    "title_line" => $title_line,
                    "body_line1" => $body_line1,
                    "body_line2" => $body_line2,
                    "body_line3" => $body_line3,
                    "body_line4" => $body_line4,
                    "body_line5" => $body_line5,
                    "body_line6" => $body_line6,
                    "body_line7" => $body_line7,
                    "body_line8" => $body_line8,
                    "body_line9" => $body_line9,
                    "body_line10" => $body_line10,
                    "summary" => $summary,
                    "icon" => $icon,
                    "sound" => "notification",
                    "noti_id" => rand(1, 1000) ,
                    "channel_id" => "Paper Publish",
                    "image" => $image,
                    "type" => $notification_type,
                    "click_action" => "https://deltatrek.in/user/login"
                )
            );

            $fields = json_encode($app_fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $result = curl_exec($ch);
            curl_close($ch);
        }
        $browser_tokens = array_chunk($browser_token, 999, true);
        foreach ($browser_tokens as $token)
        {
            if ($notification_type == 'no_icon')
            {
                $title = $title;
                $body = $body;
                $image = '';
                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
            }
            elseif ($notification_type == 'right_icon' || $notification_type == 'left_icon')
            {
                $title = $title;
                $body = $body;
                $image = '';
                $icon = $icon;
            }
            elseif ($notification_type == 'right_icon_long')
            {
                $title = $title_long;
                $body = $body_long;
                $image = '';
                $icon = $icon;
            }
            elseif ($notification_type == 'no_icon_long')
            {
                $title = $title_long;
                $body = $body_long;
                $image = '';
                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
            }
            elseif ($notification_type == 'no_icon_image')
            {
                $title = $title;
                $body = $body;
                $image = $image;
                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
            }
            elseif ($notification_type == 'right_icon_image_hide' || $notification_type == 'right_icon_image_show')
            {
                $title = $title;
                $body = $body;
                $image = $image;
                $icon = $icon;
            }
            elseif ($notification_type == 'no_icon_lines')
            {
                $title = $title_line;
                $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                $image = '';
                $icon = 'https://deltatrek.in/img/mobile%20ins.png';
            }
            elseif ($notification_type == 'right_icon_lines')
            {
                $title = $title_line;
                $body = $body_line1 . ' ' . $body_line2 . ' ' . $body_line3 . ' ' . $body_line4 . ' ' . $body_line5 . ' ' . $body_line6 . ' ' . $body_line7 . ' ' . $body_line8 . ' ' . $body_line9 . ' ' . $body_line10;
                $image = '';
                $icon = $icon;
            }
            $browser_fields = array(
                'registration_ids' => $token,
                'notification' => array(
                    "title" => $title,
                    "body" => $body,
                    "icon" => $icon,
                    "sound" => "notification",
                    "noti_id" => rand(1, 1000) ,
                    "image" => $image,
                    "click_action" => "https://deltatrek.in/user/login"
                )
            );

            $fields = json_encode($browser_fields);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            $result = curl_exec($ch);
            curl_close($ch);
        }

        return back()->with('success', 'uploaded Successfully');
    }

    public function paper_pdf_download(Request $request)
    {
        $pname = urldecode($request->get('pname'));
        $user = new_question::where(['pqtypeid' => $request->get('id') . 'X' . $request->get('type') , 'active' => '1'])
            ->get();
        foreach ($user as $use)
        {
            $users = json_decode($use->questions);
        }
        //return view('admin.paper_answer_pdf',compact('users','pname'));
        if ($request->get('ans') == 'no')
        {
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadview('admin.paper_pdf', compact('users', 'pname'));
            return $pdf->download($pname . '_paper.pdf');
        }
        if ($request->get('ans') == 'yes')
        {
            $pdfn = \App::make('dompdf.wrapper');
            $pdfn->loadview('admin.paper_answer_pdf', compact('users', 'pname'));
            return $pdfn->download($pname . '_answer_key.pdf');
        }
    }

    function editnormalpaperpage(Request $request)
    {
        $users = normal_paper::where(['id' => $request->get('id') , 'active' => '1'])
            ->get();
        return view('admin.edit_nr_paper', compact('users'));
    }

    function editnormalpaper(Request $request)
    {
        $total_marks = ($request->PQ * $request->PM) + ($request->CQ * $request->CM) + ($request->MQ * $request->MM) + ($request->BQ * $request->BM);
        $paper = normal_paper::find($request->id);
        $paper->TT = $request->TT;
        $paper->total_marks = $total_marks;
        $paper->PM = $request->PM;
        $paper->PN = $request->PN;
        $paper->CM = $request->CM;
        $paper->CN = $request->CN;
        $paper->MM = $request->MM;
        $paper->MN = $request->MN;
        $paper->BM = $request->BM;
        $paper->BN = $request->BN;
        $paper->save();
        return Response::json($paper->id);
    }

    public function normalimage(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xnormal', 'active' => '1'];
        $users = array();
        $pid = $request->get('id');
        $type = 'normal';
        if ($request->has('plid'))
        {
            $plid = $request->get('plid');
        }
        else
        {
            $plid = '';
        }
        $user = new_question::where($where)->orderBy('id', 'asc')
            ->get();
        foreach ($user as $use)
        {
            $users = json_decode($use->questions);
        }
        return view('layout.paperview', compact('users', 'pid', 'plid', 'type'));
    }

    public function delete_image(Request $request)
    {
        $name = explode("/", $request->img);
        $pname = $name[count($name) - 3];
        $type = $name[count($name) - 4];
        if ($type == 'normal_paper')
        {
            $paper = normal_paper::where(['pname' => $pname, 'active' => '1'])->get();
        }
        else
        {
            $paper = advance_paper::where(['pname' => $pname, 'active' => '1'])->get();
        }
        foreach ($paper as $p)
        {
            $id = $p->id;
            $ptype = $p->type;
        }
        $user = new_question::where(['pqtypeid' => $id . 'X' . $ptype, 'active' => '1'])->get();
        foreach ($user as $use)
        {
            $question = json_decode($use->questions);
            $q_id = $use->id;
        }

        if ($request->img_type == 'ques')
        {
            foreach ($question as $q)
            {
                if ($q->quesimg == $request->img)
                {
                    $q->quesimg = NULL;
                    $teachers = new_question::where('id', $q_id)->update(['questions' => json_encode($question) ]);
                }
            }
        }
        else if ($request->img_type == 'sol')
        {
            foreach ($question as $q)
            {
                if ($q->solimg == $request->img)
                {
                    $q->solimg = NULL;
                    $teachers = new_question::where('id', $q_id)->update(['questions' => json_encode($question) ]);
                }
            }
        }
        File::delete($request->img);
        return response()
            ->json($teachers);
    }

    public function nr_p_summary(Request $request)
    {
        $id = $request->get('id');
        $no = 0;
        $no = result::where(['pid' => $id, 'type' => 'normal', 'active' => '1'])->count();
        if ($no > 0)
        {
            $users = result::where(['pid' => $id, 'type' => 'normal', 'active' => '1'])->orderBy('totalS', 'desc')
                ->get();
            $users = $users->sortByDesc('totalS');
            foreach ($users as $user)
            {
                $name = $user->paper;
            }

            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadview('admin.result_summary', compact('users', 'name'));
            return $pdf->download($name . ' full result summary.pdf');
        }
        return back();
    }
    public function nr_paper_download(Request $request)
    {
        if (Auth::user()->admin == 'yes')
        {
            $id = $request->get('id');
            $users = normal_paper::where('id', $id)->get();
            foreach ($users as $user)
            {
                $pname = $user->pname;

            }
            $userss = new_question::where(['pid' => $id, 'qtype' => 'normal', 'active' => '1'])->get();
            $path = base_path() . '/public_html/Quiz/normal_paper/' . $pname;
            if (file_exists($path . '.zip'))
            {
                $path1 = base_path() . '/public_html/Quiz/normal_paper/' . $pname . '.zip';
                $File = $pname . '.txt';
                $File1 = $pname . '_ans.txt';
                File::delete($path1);
                File::delete($File);
                File::delete($File1);
                $zip = Zip::create(base_path() . '/public_html/Quiz/normal_paper/' . $pname . '.zip');

                Storage::disk('downn')->put($File, $users);
                Storage::disk('downn')->put($File1, $userss);
                $zip->add($path);
                $zip->add($path . '.txt');
                $zip->add($path . '_ans.txt');
                $zip->close();
            }
            else
            {
                $File = $pname . '.txt';
                $File1 = $pname . '_ans.txt';
                $zip = Zip::create(base_path() . '/public_html/Quiz/normal_paper/' . $pname . '.zip');

                Storage::disk('downn')->put($File, $users);
                Storage::disk('downn')->put($File1, $userss);
                $zip->add($path);
                $zip->add($path . '.txt');
                $zip->add($path . '_ans.txt');
                $zip->close();
            }

            return response()
                ->download(base_path() . '/public_html/Quiz/normal_paper/' . $pname . '.zip');
        }
    }
    public function nr_paper_upload(Request $request)
    {
        if (Auth::user()->admin == 'yes')
        {
            return view('admin.nr_ppr_upload');
        }
    }
    public function nr_paper_upload_submit(Request $request)
    {
        if (Auth::user()->admin == 'yes')
        {
            $data = json_decode(file_get_contents($request->file('paper')) , true);
            $data2 = json_decode(file_get_contents($request->file('answer')) , true);
            $uniquename = time() . uniqid(rand());
            $File = $uniquename . '.blade.php';

            // processing the array of objects
            foreach ($data as $user)
            {
                $File = $user['plink'];
                $NOQ = $user['NOQ'];
                $TT = $user['TT'];
                $total_marks = $user['total_marks'];
                $PQ = $user['PQ'];
                $PM = $user['PM'];
                $PN = $user['PN'];
                $CQ = $user['CQ'];
                $CM = $user['CM'];
                $CN = $user['CN'];
                $MQ = $user['MQ'];
                $MM = $user['MM'];
                $MN = $user['MN'];
                $BQ = $user['BQ'];
                $BM = $user['BM'];
                $BN = $user['BN'];

                $paper = new normal_paper();
                $paper->pname = $request->papername;
                $paper->plink = $File;
                $paper->active = '1';
                $paper->type = 'normal';
                $paper->NOQ = $NOQ;
                $paper->TT = $TT;
                $paper->total_marks = $total_marks;
                $paper->PQ = $PQ;
                $paper->PM = $PM;
                $paper->PN = $PN;
                $paper->CQ = $CQ;
                $paper->CM = $CM;
                $paper->CN = $CN;
                $paper->MQ = $MQ;
                $paper->MM = $MM;
                $paper->MN = $MN;
                $paper->BQ = $BQ;
                $paper->BM = $BM;
                $paper->BN = $BN;
                $paper->save();
                File::makeDirectory('Quiz/normal_paper/' . $request->papername);
                File::makeDirectory('Quiz/normal_paper/' . $request->papername . '/question');
                File::makeDirectory('Quiz/normal_paper/' . $request->papername . '/solution');
                $results = '$results';
                $contents = "@extends($results==0 ? 'layout/normal_paper' : 'layout/normal_papershow')
       @extends('layout/details')";
                Storage::disk('normal_paper')->put($File, $contents);
                $pid = $paper->id;
            }
            foreach ($data2 as $user)
            {
                $array = json_decode($user['questions']);
                foreach ($array as $a)
                {
                    $a->pid = $pid;
                }

                $paper = new new_question();
                $paper->acd_id = $user['acd_id'];
                $paper->acd_name = $user['acd_name'];
                $paper->pid = $pid;
                $paper->qtype = $user['qtype'];
                $paper->pqtypeid = $pid . "X" . $user['qtype'];
                $paper->questions = json_encode($array);
                $paper->active = '1';
                $paper->save();

            }

            return response()
                ->json('done');
        }
    }

    public function move_to_test_series(Request $request)
    {
        if ($request->type == "normal")
        {
            $file = normal_paper::find($request->get('pid'));
            $file->test_series = "true";
            $file->folder_id = $request->get('fid');
            $file->save();
            $files = ts_folder::find($request->get('fid'));
            $files->count = $files->count + 1;
            $files->save();
            return back()
                ->with('success', 'uploaded Successfully');
        }
        else
        {
            $file = advance_paper::find($request->get('pid'));
            $file->test_series = "true";
            $file->folder_id = $request->get('fid');
            $file->save();
            $files = ts_folder::find($request->get('fid'));
            $files->count = $files->count + 1;
            $files->save();
            return back()
                ->with('success', 'uploaded Successfully');
        }
    }

    public function list_of_folder(Request $request)
    {
        $users = ts_folder::where(['active' => '1', 'folder_type' => $request->get("type") ])
            ->orderBy('name', 'asc')
            ->get();
        return Response::json($users);
    }

    public function deletenrpaper(Request $request)
    {
        $teacher = normal_paper::find($request->id);
        $teacher->active = '0';
        $teacher->save();
        $teacher = paper_link::where(['pid' => $request->id, 'type' => 'normal'])
            ->update(['active' => '2']);
        return response()
            ->json($teacher);
    }

}

