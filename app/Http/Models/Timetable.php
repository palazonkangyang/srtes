<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;
use Carbon\Carbon;

class Timetable extends Model
{
  protected $table = 'tes_timetable';
	public $timestamps = true;

  public static function selectedTimetableList($id)
  {
    $today = Carbon::today()->toDateString();

    $selected_timetable_list = Timetable::where('course_id','=',$id)->whereDate('start_date', '>=', $today)->get();
    return $selected_timetable_list;
  }
}
