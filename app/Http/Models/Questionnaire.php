<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class Questionnaire extends Model
{
  protected $table = 'tes_questionnaire';
	public $timestamps = true;

  public static function selectedQuestionnaire($id)
  {
    $result = Questionnaire::find($id);
    return $result;
  }

  public static function nameRule()
  {
    return 'required|unique:tes_questionnaire,name|max:255';
  }
}
