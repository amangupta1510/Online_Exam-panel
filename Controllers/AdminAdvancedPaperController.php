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

class AdminAdvancedPaperController extends Controller
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

    public function advancedpaperquesupload(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xadvanced', 'active' => '1'];
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
        return view('admin.adv_ques_upload', compact('question', 'solution'));
    }

    public function advancedpaperquesuploadsubmit(Request $request)
    {
        $where = ['id' => $request->id, 'active' => '1'];
        $where1 = ['pqtypeid' => $request->id . 'Xadvanced', 'active' => '1'];
        $users = advance_paper::where($where)->select('pname')
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
                $path = base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '/question';
                $file->move($path, $name);
                $qpqtypeid = $file_name . "X" . $request->id . 'Xadvanced';
                $img = 'Quiz/advanced_paper/' . $pname . '/question/' . $name;
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
        //return response()->json(json_encode($question));
        return back()->with('success', 'uploaded Successfully');
    }

    public function advancedpapersoluploadsubmit(Request $request)
    {
        $where = ['id' => $request->id, 'active' => '1'];
        $where1 = ['pqtypeid' => $request->id . 'Xadvanced', 'active' => '1'];
        $users = advance_paper::where($where)->select('pname')
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
                $path = base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '/solution';
                $file->move($path, $name);
                $qpqtypeid = $file_name . "X" . $request->id . 'Xadvanced';
                $img = 'Quiz/advanced_paper/' . $pname . '/solution/' . $name;
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

    public function advancedpaperansupload(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xadvanced', 'active' => '1'];
        $users = array();
        $user = new_question::where($where)->get();
        foreach ($user as $q)
        {
            $users = json_decode($q->questions);
            $id = $q->pqtypeid;
        }
        return view('admin.adv_ans_upload', compact('users', 'id'));
    }

    public function advancedpaperansuploadsubmit(Request $request)
    {
        $where = ['pqtypeid' => $request->pqtypeid, 'active' => '1'];
        $users = new_question::where($where)->update(['questions' => $request->data]);
        return response()
            ->json($users);
    }

    public function advancedpaperupload(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = advance_paper::where('pname', 'like', '%' . $studentsearch . '%')->orWhere('created_at', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.advanced_paper_upload_list', compact('users'));
        }
        else
        {
            $users = advance_paper::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.advanced_paper_upload_list', compact('users'));
        }
    }

    public function advancedpaperupload_page(Request $request)
    {
        if ($request->has('s') && $request->get('s') != '')
        {
            $studentsearch = $request->get('s');
            $users = advance_paper::where('pname', 'like', '%' . $studentsearch . '%')->orWhere('created_at', 'like', '%' . $studentsearch . '%');
            $users = $users->where(['active' => '1', 'test_series' => NULL])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.advanced_paper_upload_list_reload', compact('users'));
        }
        else
        {
            $users = advance_paper::where(['active' => '1', 'test_series' => NULL])->orderBy('id', 'desc')
                ->paginate(10);
            return view('admin.advanced_paper_upload_list_reload', compact('users'));
        }
    }

    public function advancedpaperpublish(Request $request)
    {
        $where = ['id' => $request->get('id') , 'active' => '1'];
        $users = advance_paper::where($where)->get();
        return view('admin.adv_publish', compact('users'));
    }

    public function advancedpaperpublishsubmit(Request $request)
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
        $file->type = 'advanced';
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

    public function editadvancedpaperpage(Request $request)
    {
        $users = advance_paper::where(['id' => $request->get('id') , 'active' => '1'])
            ->get();
        return view('admin.edit_adv_paper', compact('users'));
    }

    public function editadvancedpaper(Request $request)
    {
        $total_marks = ($request->P1Q * $request->P1M) + ($request->P2Q * $request->P2M) + ($request->P3Q * $request->P3M) + ($request->P4Q * $request->P4M) + ($request->P5Q * $request->P5M) + ($request->P6Q * $request->P6M) + ($request->C1Q * $request->C1M) + ($request->C2Q * $request->C2M) + ($request->C3Q * $request->C3M) + ($request->C4Q * $request->C4M) + ($request->C5Q * $request->C5M) + ($request->C6Q * $request->C6M) + ($request->M1Q * $request->M1M) + ($request->M2Q * $request->M2M) + ($request->M3Q * $request->M3M) + ($request->M4Q * $request->M4M) + ($request->M5Q * $request->M5M) + ($request->M6Q * $request->M6M);
        $paper = advance_paper::find($request->id);
        $paper->TT = $request->TT;
        $paper->total_marks = $total_marks;
        $paper->P1M = $request->P1M;
        $paper->P1N = $request->P1N;
        $paper->P2M = $request->P2M;
        $paper->P2N = $request->P2N;
        $paper->P3M = $request->P3M;
        $paper->P3N = $request->P3N;
        $paper->P4M = $request->P4M;
        $paper->P4N = $request->P4N;
        $paper->P5M = $request->P5M;
        $paper->P5N = $request->P5N;
        $paper->P6M = $request->P6M;
        $paper->P6N = $request->P6N;
        $paper->C1M = $request->C1M;
        $paper->C1N = $request->C1N;
        $paper->C2M = $request->C2M;
        $paper->C2N = $request->C2N;
        $paper->C3M = $request->C3M;
        $paper->C3N = $request->C3N;
        $paper->C4M = $request->C4M;
        $paper->C4N = $request->C4N;
        $paper->C5M = $request->C5M;
        $paper->C5N = $request->C5N;
        $paper->C6M = $request->C6M;
        $paper->C6N = $request->C6N;
        $paper->M1M = $request->M1M;
        $paper->M1N = $request->M1N;
        $paper->M2M = $request->M2M;
        $paper->M2N = $request->M2N;
        $paper->M3M = $request->M3M;
        $paper->M3N = $request->M3N;
        $paper->M4M = $request->M4M;
        $paper->M4N = $request->M4N;
        $paper->M5M = $request->M5M;
        $paper->M5N = $request->M5N;
        $paper->M6M = $request->M6M;
        $paper->M6N = $request->M6N;
        $paper->save();
        return Response::json($paper->id);
    }

    public function deleteadvpaper(Request $request)
    {
        $teacher = advance_paper::find($request->id);
        $teacher->active = '0';
        $teacher->save();
        $teacher = paper_link::where(['pid' => $request->id, 'type' => 'advanced'])
            ->update(['active' => '2']);
        return response()
            ->json($teacher);
    }

    public function adv_paper_download(Request $request)
    {
        if (Auth::user()->admin == 'yes')
        {
            $id = $request->get('id');
            $users = advance_paper::where('id', $id)->get();
            foreach ($users as $user)
            {
                $pname = $user->pname;

            }
            $userss = new_question::where(['pid' => $id, 'qtype' => 'advanced', 'active' => '1'])->get();
            $path = base_path() . '/public_html/Quiz/advanced_paper/' . $pname;
            if (file_exists($path . '.zip'))
            {
                $path1 = base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '.zip';
                $File = $pname . '.txt';
                $File1 = $pname . '_ans.txt';
                File::delete($path1);
                File::delete($File);
                File::delete($File1);
                $zip = Zip::create(base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '.zip');
                Storage::disk('downa')->put($File, $users);
                Storage::disk('downa')->put($File1, $userss);
                $zip->add($path);
                $zip->add($path . '.txt');
                $zip->add($path . '_ans.txt');
                $zip->close();
            }
            else
            {
                $File = $pname . '.txt';
                $File1 = $pname . '_ans.txt';
                $zip = Zip::create(base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '.zip');

                Storage::disk('downa')->put($File, $users);
                Storage::disk('downa')->put($File1, $userss);
                $zip->add($path);
                $zip->add($path . '.txt');
                $zip->add($path . '_ans.txt');
                $zip->close();
            }

            return response()
                ->download(base_path() . '/public_html/Quiz/advanced_paper/' . $pname . '.zip');
        }
    }
    public function adv_paper_upload(Request $request)
    {
        if (Auth::user()->admin == 'yes')
        {
            return view('admin.adv_ppr_upload');
        }
    }

    public function adv_paper_upload_submit(Request $request)
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
                $paper = new advance_paper();
                $paper->pname = $request->papername;
                $paper->plink = $File;
                $paper->active = '1';
                $paper->type = 'advanced';
                $paper->NOQ = $user['NOQ'];
                $paper->TT = $user['TT'];
                $paper->PQ = $user['PQ'];
                $paper->CQ = $user['CQ'];
                $paper->MQ = $user['MQ'];
                $paper->P1Q = $user['P1Q'];
                $paper->P1M = $user['P1M'];
                $paper->P1N = $user['P1N'];
                $paper->P2Q = $user['P2Q'];
                $paper->P2M = $user['P2M'];
                $paper->P2N = $user['P2N'];
                $paper->P3Q = $user['P3Q'];
                $paper->P3M = $user['P3M'];
                $paper->P3N = $user['P3N'];
                $paper->P4Q = $user['P4Q'];
                $paper->P4M = $user['P4M'];
                $paper->P4N = $user['P4N'];
                $paper->P5Q = $user['P5Q'];
                $paper->P5M = $user['P5M'];
                $paper->P5N = $user['P5N'];
                $paper->P6Q = $user['P6Q'];
                $paper->P6M = $user['P6M'];
                $paper->P6N = $user['P6N'];
                $paper->C1Q = $user['C1Q'];
                $paper->C1M = $user['C1M'];
                $paper->C1N = $user['C1N'];
                $paper->C2Q = $user['C2Q'];
                $paper->C2M = $user['C2M'];
                $paper->C2N = $user['C2N'];
                $paper->C3Q = $user['C3Q'];
                $paper->C3M = $user['C3M'];
                $paper->C3N = $user['C3N'];
                $paper->C4Q = $user['C4Q'];
                $paper->C4M = $user['C4M'];
                $paper->C4N = $user['C4N'];
                $paper->C5Q = $user['C5Q'];
                $paper->C5M = $user['C5M'];
                $paper->C5N = $user['C5N'];
                $paper->C6Q = $user['C6Q'];
                $paper->C6M = $user['C6M'];
                $paper->C6N = $user['C6N'];
                $paper->M1Q = $user['M1Q'];
                $paper->M1M = $user['M1M'];
                $paper->M1N = $user['M1N'];
                $paper->M2Q = $user['M2Q'];
                $paper->M2M = $user['M2M'];
                $paper->M2N = $user['M2N'];
                $paper->M3Q = $user['M3Q'];
                $paper->M3M = $user['M3M'];
                $paper->M3N = $user['M3N'];
                $paper->M4Q = $user['M4Q'];
                $paper->M4M = $user['M4M'];
                $paper->M4N = $user['M4N'];
                $paper->M5Q = $user['M5Q'];
                $paper->M5M = $user['M5M'];
                $paper->M5N = $user['M5N'];
                $paper->M6Q = $user['M6Q'];
                $paper->M6M = $user['M6M'];
                $paper->M6N = $user['M6N'];
                $paper->total_marks = $user['total_marks'];
                $paper->save();
                File::makeDirectory('Quiz/advanced_paper/' . $request->papername);
                File::makeDirectory('Quiz/advanced_paper/' . $request->papername . '/question');
                File::makeDirectory('Quiz/advanced_paper/' . $request->papername . '/solution');
                $results = '$results';
                $contents = "@extends($results==0 ? 'layout/advanced_paper' : 'layout/advanced_papershow')
      @extends('layout/details')";
                Storage::disk('advanced_paper')->put($File, $contents);
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

    public function adv_p_summary(Request $request)
    {
        $id = $request->get('id');
        $no = 0;
        $no = result::where(['pid' => $id, 'type' => 'advanced', 'active' => '1'])->count();
        if ($no > 0)
        {
            $users = result::where(['pid' => $id, 'type' => 'advanced', 'active' => '1'])->orderBy('totalS', 'desc')
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

    public function advancedimage(Request $request)
    {
        $where = ['pqtypeid' => $request->get('id') . 'Xadvanced', 'active' => '1'];
        $users = array();
        $pid = $request->get('id');
        if ($request->has('plid'))
        {
            $plid = $request->get('plid');
        }
        else
        {
            $plid = '';
        }
        $type = 'advanced';

        $user = new_question::where($where)->orderBy('id', 'asc')
            ->get();
        foreach ($user as $use)
        {
            $users = json_decode($use->questions);
        }
        return view('layout.paperview', compact('users', 'pid', 'plid', 'type'));
    }

}

