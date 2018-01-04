<?php

namespace App\Libraries;

use App\Interfaces\SingletonInterface;
use App\Core\LibraryCore;
use App\Factories\ModelFactory;
use Mail;

class EmailLibrary extends LibraryCore implements SingletonInterface
{
	/**
	 * $from
	 * @var string
	 */
	protected $from = 'do-not-reply@redcross.sg';

	/**
	 * $companyName
	 * @var string
	 */
	protected $companyName = 'SRC Approval Management System';

	/**
	 * $subject
	 * @var null
	 */
	public $subject;

	/**
	 * personToReceive
	 * @var array
	 */
	public $personToReceive;

	/**
	 * Blade layout selected
	 * @var [type]
	 */
	public $layout;


	/**
	 * Magic clone method
	 */
	public function __clone()
	{
		// throw exception here since Singleton can't be cloned
		throw new RuntimeException(get_class($this) . ' is a Singleton and cannot be cloned.');
	}

  public function send($data)
	{
    $fromEmail = $this->from;
    $compName = $this->companyName;
    $getPerson = $this->personToReceive;
    $subjectEmail = $this->subject;

		// dd($getPerson->emailadd);

    Mail::send($this->layout, $data, function($message) use ($getPerson, $subjectEmail, $fromEmail, $compName)
		{
    	$message->from($fromEmail, $compName);
      $message->to($getPerson->emailadd)->subject($subjectEmail);
  	});
  }
}
