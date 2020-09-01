<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Validator;
use App\User;
use App\Course;
use App\Lesson;
use App\CompletedLesson;


class CookingController extends Controller
{
    public function overview(){
        $course_blocks = array();
        $course_item = array(); 
        $courses = Course::orderBy('id', 'asc')->get();
        foreach($courses as $course){
            //コースの達成率を取得・計算
            $lesson_num
            =count(Lesson::where('course_id',$course->id)->get());
            $completed_lesson_num
             =count(CompletedLesson::where('user_id',Auth::user()->id)
              ->where('course_id',$course->id)->get());
            $achieved_rate = round($completed_lesson_num / $lesson_num * 100);
            array_push($course_item, [$course, $achieved_rate]);
        }
        array_push($course_blocks, $course_item);

        return view('overview', compact('course_blocks'));
    }


    public function course($course){
        $course_items=Course::where('english',$course)->first();
        $lessons = Lesson::where('course_id',$course_items->id)->orderBy('id', 'asc')->get();

        $completed_lessons = CompletedLesson::where('user_id',Auth::user()->id)
        ->where('course_id',$course_items->id)->get();
        //コースの達成率を取得・計算
        $lesson_num
        =count(Lesson::where('course_id',$course_items->id)->get());
        $completed_lesson_num
         =count($completed_lessons);
        $achieved_rate = round($completed_lesson_num / $lesson_num * 100);

        // レッスンの達成/未達成を取得
        $lesson_blocks = array();
        $lesson_item = array();
        foreach($lessons as $lesson){
            $check_if_finish = CompletedLesson::where('user_id',Auth::user()->id)
            ->where('course_id',$course_items->id)->where('lesson_id',$lesson->lesson_id)->value('id');
            array_push($lesson_item, [$lesson, $check_if_finish]);
        }
        array_push($lesson_blocks, $lesson_item);

        return view('course', compact('course_items','achieved_rate','lesson_blocks'));
    }


    public function lesson($course, $lesson){
        $course_items=Course::where('english',$course)->first();
        $lesson_items=Lesson::where('course_id', $course_items->id)->where('lesson_id', $lesson)->first();

        $check_if_finish = CompletedLesson::where('user_id',Auth::user()->id)
        ->where('course_id',$course_items->id)->where('lesson_id',$lesson_items->lesson_id)->value('id');
        return view('lesson', compact('lesson_items', 'check_if_finish'));
    }


    public function complete(Request $request){
    // バリデーション
    $validator = Validator::make($request->all(), [
        'course_id' => 'required',
        'lesson_id' => 'required',
        'user_id' => 'required',
    ]);
    //バリデーション:エラー 
    if ($validator->fails()) {
        return back()
            ->withInput()
            ->withErrors($validator);
    }

    $user = User::find($request->user_id);
    $user->level += $request->level_up;
    $user->save();

    $lessons = new CompletedLesson();
    $lessons->course_id = $request->course_id;
    $lessons->lesson_id = $request->lesson_id;
    $lessons->user_id = $request->user_id;
    $lessons->save();

    $course = Course::find($request->course_id);
    return redirect('/course/'.$course->english);
    }
}