<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMeetingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
                    'companyname' => 'required|min:2',
                    'personname' => 'required|min:2',
                    'comment' => 'required|min:5|max:255',
                    'date' => 'required|size:10|regex:/^\d{4}[-]\d{2}[-]\d{2}$/',
                    'time' => 'required|size:5|regex:/^\d{2}[:]\d{2}$/'
		];
	}

}
