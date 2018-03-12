<?php
namespace App\Http\Models\Auth;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use OwenIt\Auditing\AuditingTrait;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
  
    use Authenticatable, CanResetPassword;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $connection = 'mysql2';

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['loginid', 'emailadd', 'passwd'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    /*protected $hidden = ['password', 'remember_token'];*/
    protected $hidden = ['passwd'];


    protected $primaryKey = 'idsrc_login';

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword() {
        return $this->passwd;
    }


    public function getRememberToken()
    {
        return null; // not supported
    }
    public function setRememberToken($value)
    {
        // not supported
    }
    public function getRememberTokenName()
    {
        return null; // not supported
    }
    /**
    * Overrides the method to ignore the remember token.
    */
    public function setAttribute($key, $value)
    {
        $isRememberTokenAttribute = $key == $this->getRememberTokenName();
        
        if (!$isRememberTokenAttribute)
        {
            parent::setAttribute($key, $value);
        }
    }
}