<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Log;

trait Logging
{

  public function createLogTypeA($format, $number, $name, $action)
  {
    $user_login = session()->get('user_login');
    $users = User::where('login', $user_login)->first();
    Log::create([
      'log' => sprintf($format, $number, $name, $action),
      'user_id' => $users['id'],
    ]);
  }

  public function createLogTypeB($format, $id, $before_number, $before_status, $after_number, $after_status)
  {
    $user_login = session()->get('user_login');
    $users = User::where('login', $user_login)->first();
    Log::create([
      'log' => sprintf($format, $id, $before_number, $before_status, $after_number, $after_status),
      'user_id' => $users['id'],
    ]);
  }

  public function createLogTypeC($format, $number_json, $name_json, $action)
  {
    $user_login = session()->get('user_login');
    $users = User::where('login', $user_login)->first();
    Log::create([
      'log' => sprintf($format, $number_json, $name_json, $action),
      'user_id' => $users['id'],
    ]);
  }
}
