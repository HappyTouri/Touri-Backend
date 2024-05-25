<?php

namespace App\Http\Controllers;

use App\Mail\CancelMailable;
use App\Mail\EmalMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendController extends Controller
{

  public function send()
  {

    $data = [
      'name' => 'John Doe',
      'message' => 'This is a test message',
    ];
    Mail::to("tbilisitraveler@gmail.com")->send(new EmalMailable($data));

    return ('email sent');
  }


  public function cancel()
  {

    $data = [
      'name' => 'John Doe',
      'message' => 'This is a cancel message',
    ];
    Mail::to("tbilisitraveler@gmail.com")->send(new CancelMailable($data));

    return ('email Canceld');
  }
}
