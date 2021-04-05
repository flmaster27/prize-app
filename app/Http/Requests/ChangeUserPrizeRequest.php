<?php

namespace App\Http\Requests;

use App\Contracts\Entities\UserPrizeContract;
use Illuminate\Foundation\Http\FormRequest;

class ChangeUserPrizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return
            (
                auth()->id()
                ==
                data_get($this->route('userPrize'), UserPrizeContract::FIELD_USER_ID)
            )
            &&
            (
                is_null(data_get($this->route('userPrize'), UserPrizeContract::FIELD_DELIVERED))
            )
        ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
