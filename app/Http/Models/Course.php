<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class Course extends Model
{
  protected $table = 'tes_course';
	public $timestamps = true;

  public function courseType()
  {
    return $this->hasOne('App\Http\Models\CourseType','id','course_typeid');
  }

  public static function courseList()
  {
    $courseList = Course::get();
    foreach($courseList as $cl){
      $cl['course_type_name'] = CourseType::getCourseTypeName($cl['course_type_id']);
    }
    return $courseList;
  }

  public static function courseListArray()
  {
    $prepare = Course::get();
    $course = $prepare;
    $course_list_array = array();
    foreach ($course as $c ) {
      $course_list_array[$c->id] = $c->name;
    }
    return $course_list_array;
  }

  public static function selectedCourseList($id)
  {
    $selectedCourseList = Course::find($id);
    return $selectedCourseList;
  }

  public static function searchCourseByCourseTypeId($id)
  {
    $result = Course::where("course_type_id","=",$id)->get();
    return $result;
  }

  public static function codeRule()
  {
    return 'required|unique:tes_course,code|max:255';
  }

  public static function editCodeRule($id)
  {
    return 'required|unique:tes_course,code,'.$id.'|max:255';
  }

  public static function nameRule()
  {
    return 'required|unique:tes_course,name|max:255';
  }

  public static function editNameRule($id)
  {
    return 'required|unique:tes_course,name,'.$id.'|max:255';
  }

  public static function providerRule()
  {
    return 'max:255';
  }

  public static function courseTypeIdRule()
  {
    return 'required';
  }

  public static function durationRule()
  {
    return 'required';
  }

  public static function budgetAvailabilityRule()
  {
    return 'required';
  }

  public static function isFundsRule()
  {
    return 'required';
  }

  public static function fundsRule()
  {
    return '';
  }

  public static function feeRule()
  {
    return '';
  }

  public static function minimumAttendeeRule()
  {
    return 'required|min:1|max:99';
  }

  public static function maximumAttendeeRule()
  {
    return 'required|min:1|max:99';
  }

  public static function descriptionRule()
  {
    return '';
  }

}
