<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PhonebookRequest extends FormRequest
{
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
    public function rules(Request $request)
    {
        $user_id=1;
        $friend_email=$request->friend_email;
        return [
            //
            'friend_name' => 'required | max:255',
            'friend_phone_number' => 'required |regex:/[0-9]/|not_regex:/[a-z]/|min:11',
            'friend_email' => [
                'required',
                Rule::unique('phonebook','friend_email')->ignore($request->id,'id')
                ->where(function ($query) use($user_id,$friend_email) {
                    return $query->where('user_id', $user_id)
                ->where('friend_email', $friend_email);
            })]
        ];
    }
}
