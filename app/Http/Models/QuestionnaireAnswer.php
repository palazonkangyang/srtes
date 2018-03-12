<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;


class QuestionnaireAnswer extends Model
{
  protected $table = 'tes_questionnaire_answer';
	public $timestamps = true;

  public static function questionRule()
  {
    return 'required';
  }

  public static function answerRule()
  {
    return 'required';
  }
}
