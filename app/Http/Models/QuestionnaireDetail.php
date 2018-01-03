<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class QuestionnaireDetail extends Model
{
  protected $table = 'tes_questionnaire_detail';
	public $timestamps = true;

  public static function selectedQuestionnaireDetail($id)
  {
    $result = QuestionnaireDetail::where('questionnaire_id',"=",$id)->get();
    return $result;
  }

  public static function questionRule()
  {
    return 'required|max:255';
  }

  public static function answerInputTypeRule()
  {
    return 'required';
  }

  public static function answerInputValueRule()
  {
    return 'required';
  }
}
