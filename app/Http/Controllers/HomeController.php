<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\LanChapter;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $getCourses = DB::table('courses')
        ->join('user_courses','courses.subscription_code','user_courses.course_id')
        ->where('user_courses.user_id', Auth::user()->id)
        ->select('courses.*','user_courses.*','courses.id as courses_id')
        ->orderby('courses.id', 'desc')
        ->limit('3')
        ->get();

        
        $agent = new \Jenssegers\Agent\Agent;
   
        $result = $agent->isMobile();
       
        if($result == false){
            return view('home', ['getCourses' => $getCourses]);
        }else{
            return view('error.device');
        }
       
    }

    public function class(Request $request)
    {
       
       //get the class detals
       $classDetails = DB::table('courses')
       //->where(DB::raw('md5(id)'), $request->id)
       ->first();

       //get notification
       $getNotifications = DB::table('notification')
       ->where(DB::raw('md5(course_id)'), $request->id)
       ->orderby('id', 'desc')
       ->limit('12')
       ->get();
        
      
        return view('class', ['classDetails' => $classDetails, 'getNotifications' => $getNotifications]);
    }

    public function course(Request $request)
    {
       
       //get the class detals
       $classDetails = DB::table('courses')
       //->where(DB::raw('md5(id)'), $request->id)
       ->first();

       //get notification
       $getNotifications = DB::table('notification')
       ->where(DB::raw('md5(course_id)'), $request->id)
       ->orderby('id', 'desc')
       ->limit('12')
       ->get();
        
      
        return view('course', ['classDetails' => $classDetails, 'getNotifications' => $getNotifications]);
    }

    

    public function files()
    {
 
        return view('files');
    }


    public function test_yourself()
    {
 
        return view('test_yourself');
    }


    public function projects()
    {
    
        //get user classes
        
        $projects = DB::table('projects')
        ->orderby('sort')
        ->get();

       
       
        return view('projects',['tutorials' => $projects]);
    }


    public function settings()
    {
 
        return view('settings');
    }


    public function profile()
    {
      
       
        return view('profile');
    }
        
    public function test(){
        return view('user_projects.index');
    }
    

    

public function getFiles( $directoryName ) {

    try {
        $filesArr = array();
        $this->folderPath = 'export'.DS.str_replace( '.', '_', $this->getCurrentShop->getCurrentShop()->shopify_domain ).DS.'exported_files'. DS . $directoryName;
        $folderPth = public_path( $this->folderPath );
        $files = File::allFiles( $folderPth ); 
        $replaceDocPath = str_replace( public_path(),'',$this->folderPath );

        foreach( $files as $file ) {

            $filesArr[] = array( 'fileName' => $file->getRelativePathname(), 'fileUrl' => url($replaceDocPath.DS.$file->getRelativePathname()) );

        }

        return view('backups/listfiles', compact('filesArr'));

    } catch (Exception $ex) {
        Log::error( $ex->getMessage() );
    }


}
    
    
    
    
    

    public function lng($id){
        //get the content for the lng
        $lng = request()->route()->getName();

        $chapters = DB::table('lan_chapter')
        ->where('code', $id)
        ->where('lan_code', $lng)
        ->get();

        $Allchapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->get();

     
       
        return view('codeDesk', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters]);
    }

    public function lng_sql($id){
        //get the content for the lng
        $lng = request()->route()->getName();

        $chapters = DB::table('lan_chapter')
        ->where('code', $id)
        ->where('lan_code', $lng)
        ->get();

        $Allchapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->get();

        return view('codeDeskSQL', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters]);
    }

    public function lng_php($id){
        //get the content for the lng
        $lng = request()->route()->getName();

        $chapters = DB::table('lan_chapter')
        ->where('code', $id)
        ->where('lan_code', $lng)
        ->get();

        $Allchapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->get();

        //get chapter id
        $SingleChapter = DB::table('lan_chapter')
        ->where('code', $id)
        ->where('lan_code', $lng)
        ->first();


      
        //chk if the course is open or not
        $progress = DB::table('user_streak_progress')
        ->where('user_id', Auth::user()->id)
        ->where('chapter_id', $SingleChapter->id)
        ->count();

        if($progress == 0){
            return view('codeDeskError', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters, 'progress'=>$progress]);
        }else{
            return view('codeDeskPHP', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters, 'progress'=>$progress]);
        }
       
    }
  
    public function defult($id){
        //get the content for the lng
        $lng = request()->route()->getName();

        $chapters = DB::table('lan_chapter')
        ->where('code', $id)
        ->get();

        $Allchapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->get();

        //get chapter id
        $SingleChapter = DB::table('lan_chapter')
        ->where('code', $id)
        ->where('lan_code', $lng)
        ->first();


      
        //chk if the course is open or not
        $progress = DB::table('user_streak_progress')
        ->where('user_id', Auth::user()->id)
        ->where('chapter_id', $SingleChapter->id)
        ->count();

        if($progress == 0){
            return view('codeDeskError', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters, 'progress'=>$progress]);
        }else{
            return view('codeDeskPHP', ['lng' => 'cpp', 'chapters' => $chapters, 'Allchapters' => $Allchapters, 'progress'=>$progress]);
        }
       
    }
    

    public function lanHome($lng){
        $lang = DB::table('available_languages')
        ->where('lan_code', $lng)
        ->first();

        $lan_name = $lang->langage_title;
        $description = $lang->description;

        $Allchapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->get();

       

        $noOfChapters = DB::table('lan_chapter')
        ->where('lan_code', $lng)
        ->count();

        return view('lanHome', ['lan_name' => $lan_name, 'description'=>$description, 'Allchapters' => $Allchapters, 'noOfChapters'=>$noOfChapters]);
    }

    public function joinClass(Request $request){
        $userId = $request->userId;
        $passcode = $request->passcode;

        //create helper function leta for this
        //chk if the user is subscribe to Join Class 
        $chk = DB::table('subscription_plan_item')
        ->where('item', 'Join Class')
        ->where('is_available', 1)
        ->first();
        
        $subId =  $chk->subscription_plan_id;

        //get user subscription plan
        $chk = DB::table('user_subscription')
        ->where('user_id', Auth::user()->id)
        ->orderby('id','DESC')
        ->first();

        if($chk){
            $UsersubId = $chk->subscription_id;
        }else{
            $UsersubId = 0;
        }
       

        if($UsersubId < $subId){
            return response()->json(['status' => 'error', 'result'=>'Sorry you can not join a class with the current subscription plan, Please upgrade to Gold'], 200);
        }else{

            //chk if the class exist
            $chk = DB::table('courses')
            ->where('subscription_code', $passcode)
            ->count();

       
           
            if($chk == 0){
                return response()->json(['status' => 'error', 'result'=>'Invalid Passcode'], 200);
            }else{
                 //chk if the student have subscrib with the ID b4
                 $chk = DB::table('user_courses')
                 ->where('course_id', $passcode)
                 ->where('user_id', Auth::user()->id)
                 ->count();

                 if($chk == 0){
                    //join
                    $data = [
                        'user_id' => Auth::user()->id,
                        'course_id' =>$passcode,
                        'userUniqId' => $userId,
                    ];

                    $sub = DB::table('user_courses')
                    ->insert($data);

                    if($sub){

                        $chk = DB::table('courses')
                        ->where('subscription_code', $passcode)
                        ->first();

                        $lan_code = $chk->lan_code;
                        
                        //   //get chapter id
                            $SingleChapter = DB::table('lan_chapter')
                            ->where('lan_code', $lan_code)
                            ->where('code', 'intro')
                            ->first();

                             $chapterId = $SingleChapter->id;

                            $data = [
                                'chapter_id' => $chapterId,
                                'user_id' => Auth::user()->id,
                            ];

                            $insert = DB::table('user_streak_progress')
                            ->insert($data);

                            if($insert){
                                return response()->json(['status' => 'success', 'result'=>'You have join the class successfully'], 200);
                            }

                      

                        
                    }

                 }else{
                    return response()->json(['status' => 'error', 'result'=>'You have already joined this class'], 200);
                 }
            }
           
            
        }

        
    }

    public function loadQuiz(Request $request){
        $chapterId = $request->token;
        //get quiz
        $getQuestion = DB::table('chapter_quiz')
        ->where("chapter_id", $chapterId)
        ->inRandomOrder()
        ->get();

        if($getQuestion){
       
            return response()->json(['status' => 'success', 'result'=>$getQuestion], 200);
        }else{
            return response()->json(['status' => 'error'], 201);
        }
       
    }

    public function saveAnswer(Request $request){
        $questionId = $request->id;
        $chapter_id = $request->chapter_id;
        $option = $request->option;

        //get the right answer of a question
        $getRightAnswer = DB::table('chapter_quiz')
        ->where('id', $questionId)
        ->first();

        $currectOption = $getRightAnswer->Answer;
        if($currectOption == $option){
            $isCurrect = 1;
        }else{
            $isCurrect = 0;
        }

        //chk if the user has answered this question b4
        //insert of not
        //else update

        if($chk = DB::table('user_streak')
        ->where('chapter_id', $chapter_id)
        ->where('user_id', Auth::user()->id)
        ->where('questionId', $questionId)
        ->exists()){
            //update answer
            $update = DB::table('user_streak')
            ->where('chapter_id', $chapter_id)
            ->where('user_id', Auth::user()->id)
            ->where('questionId', $questionId)
            ->update([
                'optionChoosen' => $option,
                'isCurrect' => $isCurrect,
            ]);
            if($update){
                return response()->json(['status' => 'success', 'result'=>''], 200);
            }else{
                return response()->json(['status' => 'success', 'result'=>''], 200);
            }
        }else{
            //insert
            $data = [
                'chapter_id' => $chapter_id,
               'user_id' => Auth::user()->id,
                'questionId' => $questionId,
                'optionChoosen' => $option,
                'isCurrect' => $isCurrect,
            ];
            
            $insert = DB::table('user_streak')
            ->insert($data);
            if($insert){
                return response()->json(['status' => 'success', 'result'=>''], 200);
            }else{
                return response()->json(['status' => 'error', 'result'=>'Sorry something went wrong'], 200);
            }
        }
    }

    public function submitStreak(Request $request){
        $chapter_id = $request->chapter_id;

        //submit
        $data = [
            'user_id' => Auth::user()->id,
            'chapter_id' => $chapter_id,
        ];

        $submit = DB::table('user_streak_submit_result')
        ->insert($data);

        if($submit){
            return response()->json(['status' => 'success', 'result'=>'Your Streak has been submited Successfully'], 200);
        }else{
            return response()->json(['status' => 'error', 'result'=>'Sorry something went wrong'], 200);
        }
    }

    public function myCourses(Request $request){
        $mycourses = "";
        return view('mycourses',['mycourses' => $mycourses]);
    }
}

