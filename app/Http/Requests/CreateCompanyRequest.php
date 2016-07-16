<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCompanyRequest extends Request {

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
                    'name' => 'required|unique:companies|min:2',
                    'nip' => 'required|unique:nips|integer|digits_between:9,10',
                    'postal' => 'required|size:6|regex:/^\d{2}[-]\d{3}$/',
                    'email' => 'email|max:50',
                    'email_desc' => 'max:50',
                    'phone' => 'integer|digits_between:9,15',
                    'phone_desc' => 'max:20',
                    'city' => 'required',
                    'street' => 'required'
		];
	}

}
