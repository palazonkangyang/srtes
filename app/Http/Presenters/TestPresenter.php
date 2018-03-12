<?php

namespace App\Http\Presenters;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Core\PresenterCore;

use App\Factories\LibraryFactory;
use App\Factories\ModelFactory;

class TestPresenter extends PresenterCore
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $personToReceiveEmail = $this->selectUserBy(\Auth::User()->idsrc_login, array('loginname','emailadd'));
        $setEmail = LibraryFactory::getInstance('Email');
        $setEmail->personToReceive = $personToReceiveEmail;
        $setEmail->subject = '[SRC-AMS] Title [Case #123] - Form name';
        $setEmail->layout = 'mail.test';
        $mailData = [
            'receiver_name' => $personToReceiveEmail->loginname, 
            'sender_name' => 'Ryan Cayabyab',
            'date' => date('d/m/Y h:i A'),
            'url' => url('/application/view_details/1', $secure = null),
        ];
        $setEmail->send($mailData);
        echo 'successfully send';
        
    }

    public function selectUserBy($id, $select){
        return ModelFactory::getInstance('User')
                    ->where('idsrc_login', '=', $id)
                    ->first($select);
    }
}
