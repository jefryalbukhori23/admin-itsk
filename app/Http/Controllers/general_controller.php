<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    lecture,
    lesson,
    lesson_teacher,
    schedule_lesson,
    days,
    hours,
    class_room,
    batch_year,
    sub_by,
};

use Helper;
use DataTables;

class general_controller extends Controller
{
    public function get_lesson_teacher($id_lesson){
        $lesson_teacher = lesson_teacher::join('lecture','lesson_teacher.id_lecture','lecture.id')
                                        ->where('lesson_teacher.status','Y')
                                        ->where('lesson_teacher.id_lesson',$id_lesson)->get();

        $lecture = array();
        foreach($lesson_teacher as $key => $row){
            $yohohoho = Helper::yohohoho($row->place_birth);
            $name = Helper::haha($yohohoho,$row->name);
            $lecture[$key]['id_lecture'] = $row->id_lecture;
            $lecture[$key]['name'] = $name;
        }

        return response()->json(
            [
                'lecture' => $lecture,
            ],
            200
        );
    }
    public function get_class_schedule_lesson($id_days,$id_hours){
        $classes = class_room::where('id_prodi',auth()->user()->id_prodi)->get();
        $schedule = schedule_lesson::where('id_days',$id_days)->where('id_hours',$id_hours)->get();
        $all_class = array();
        $set_class = array();
        foreach($classes as $row){
            $all_class[] = $row->id;
        }
        foreach($schedule as $row){
            $set_class[] = $row->id_class_room;
        }
        $class = array_values(array_diff($all_class,$set_class));

        $data = array();
        for($i=0;$i<count($class);$i++){
            $available_class = class_room::find($class[$i]);
            $yohohoho = Helper::yohohoho($available_class->build);
            $class_name = Helper::haha($yohohoho,$available_class->name);

            $lesson = lesson::find($available_class->id_lesson);
            $yohohoho = Helper::yohohoho($lesson->image);
            $lesson_code = Helper::haha($yohohoho,$lesson->code);
            $lesson_name = Helper::haha($yohohoho,$lesson->name);

            $lecture = lecture::find($available_class->id_lecture);
          	if($lecture){
              $yohohoho = Helper::yohohoho($lecture->place_birth);
              $lecture_name = Helper::haha($yohohoho,$lecture->name);
            }else{
            	$lecture_name = "-";
            }
            $data[$i]['id_class_room'] = $available_class->id;
            $data[$i]['name'] = $class_name." | ".$lesson_code."-".$lesson_name." | ".$lecture_name;
        }
        return response()->json(
            [
                'class' => $data,
            ],
            200
        );

    }
    public function get_class_schedule_lessons($id_days,$id_hours){
        $schedule = schedule_lesson::where('id_days',$id_days)->where('id_hours',$id_hours)->get();
        $set_class = array();

        $data = array();
        foreach($schedule as $key => $row){
            $available_class = class_room::find($row->id_class_room);
          	if($available_class){
              $yohohoho = Helper::yohohoho($available_class->build);
              $class_name = Helper::haha($yohohoho,$available_class->name);
              $id_class = $available_class->id;
              $lesson = lesson::find($available_class->id_lesson);
              if($lesson){
                $yohohoho = Helper::yohohoho($lesson->image);
                $lesson_code = Helper::haha($yohohoho,$lesson->code);
                $lesson_name = Helper::haha($yohohoho,$lesson->name);
              }else{
                $lesson_code = "-";
                $lesson_name ="";
              }

              $lecture = lecture::find($available_class->id_lecture);
              if($lecture){
                $yohohoho = Helper::yohohoho($lecture->place_birth);
                $lecture_name = Helper::haha($yohohoho,$lecture->name);
              }else{
                  $lecture_name = "-";
              }
            }else{
            	$class_name ="-";
              	$lecture_name = "-";
                $lesson_code = "-";
                $lesson_name ="";
              	$id_class = "";
            }


            $data[$key]['id'] = $row->id;
            $data[$key]['id_class_room'] = $id_class;
            $data[$key]['class_name'] = $class_name;
            $data[$key]['lesson_code'] = $lesson_code;
            $data[$key]['lesson_name'] = $lesson_name;
            $data[$key]['lecture_name'] = $lecture_name;
        }
        return response()->json(
            [
                'class' => $data,
            ],
            200
        );

    }
    public function get_class_schedule($id_class_room){
        $class_room = class_room::find($id_class_room);
        $yohohoho = Helper::yohohoho($class_room->build);
        $class_name = Helper::haha($yohohoho,$class_room->name);

        $lessons = $lessons = lesson::find($class_room->id_lesson);
        $yohohoho = Helper::yohohoho($lessons->image);
        $name_lesson = Helper::haha($yohohoho,$lessons->name);

        $lectures = lecture::find($class_room->id_lecture);
        $yohohoho = Helper::yohohoho($lectures->place_birth);
        $lecture_name = Helper::haha($yohohoho,$lectures->name);

        $schedule_lesson = schedule_lesson::where('id_class_room',$id_class_room)->get();
        $schedule = array();
        foreach($schedule_lesson as $key => $row){
            $days = days::find($row->id_days);
            $hours = hours::find($row->id_hours);
            $schedule[$key]['day'] = $days->name;
            $schedule[$key]['hour'] = $hours->start." - ".$hours->end;
        }

        return response()->json(
            [
                'schedule' => $schedule,
                'lecture_name' => $lecture_name,
                'lesson_name' => $name_lesson,
                'class_name' => $class_name,
            ],
            200
        );

    }
    public function get_sub_by($id){
        $sub_by = sub_by::where('id_batch_year',$id)->get();

        return response()->json(
            [
                'sub_by' => $sub_by,
            ],200
        );
    }
}
