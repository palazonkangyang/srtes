<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class CourseType extends Model
{
  protected $table = 'tes_course_type';
	public $timestamps = true;

  public function course()
  {
      return $this->belongsTo('App\Http\Models\Course','course_type_id','id');
  }

  public static function selectedCourseTypeList($id)
  {
    $selectedCourseTypeList = CourseType::find($id);
    return $selectedCourseTypeList;
  }

  public static function nameRule()
  {
    return 'required|unique:tes_course_type,name|max:255';
  }

	public static function editNameRule($id)
  {
    return 'required|unique:tes_course_type,name,'.$id.'|max:255';
  }

  public static function courseTypeList()
  {
    $prepare = CourseType::with('course')->get();
    $course_type = $prepare;
    $course_type_list = array();
    foreach ($course_type as $ct ) {
      $course_type_list[$ct->id] = $ct->name;
    }
    return $course_type_list;
  }

  public static function courseTypeListArray()
  {
    $prepare = CourseType::get();
    $course_type = $prepare;
    $course_type_list_array = array();
    foreach ($course_type as $ct ) {
      $course_type_list_array[$ct->id] = $ct->name;
    }
    return $course_type_list_array;
  }

  public static function getCourseTypeName($course_type_id)
  {
    return CourseType::where('id', $course_type_id)->pluck('name');
  }
}
