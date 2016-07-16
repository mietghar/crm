<?php namespace App\Services;

use App\User;
use DB;
use Mail;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		$user=User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
		]);
                
                $roots=DB::table('users')
                        ->where('admin','=','1')
                        ->select('email')
                        ->get();
                
                Mail::send('emails.welcome', $data ,function($message) use ($data){
                $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Rejestracja CRM mietech.pl');
                $message->to($data['email']);
                }
                );
                
                
                
                for($i=0; $i<count($roots);$i++)
                {
                Mail::send('emails.new_user', $data ,function($message) use ($data, $roots,$i){
                $message->from('no-reply@mietech.pl','CRM Mietech.pl')->subject('Nowy użytkownik w CRM mietech.pl');
                $message->to($roots[$i]->email);
                    });
                }
                
                
                return $user;
	}

}
