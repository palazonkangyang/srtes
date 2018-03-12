<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\ModelCore;

class Designation extends ModelCore {

	protected $table = 'tes_designation';
	public $timestamps = true;

  public static function selectedDesignationList($id)
  {
    $selectedDesignationList = Designation::find($id);
    return $selectedDesignationList;
  }

  public static function nameRule()
  {
    return 'required|unique:tes_designation,name|max:255';
  }

	public static function editNameRule($id)
  {
    return 'required|unique:tes_designation,name,'.$id.'|max:255';
  }
}
