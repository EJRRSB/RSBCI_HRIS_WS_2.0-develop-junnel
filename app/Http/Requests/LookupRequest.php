<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Constants\EmployeeConstants as constant;
use App\Constants\CommonConstants as common;

/**
 * Class LookupRequest
 * @package App\Http\Requests
 * @author Junnel Miguel <junnel.miguel@rsb-consulting.com>
 * @version 1.0.0
 * @since 2022.05.18
 */
class LookupRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            constant::ATTRIBUTE_TYPE  => [common::REQUIRED, common::MIN_1, common::MAX_50],
            constant::ATTRIBUTE_CODE  => [common::REQUIRED, common::MIN_1, common::MAX_10],
            constant::ATTRIBUTE_VALUE => [common::REQUIRED, common::MIN_1, common::MAX_150]
        ];
    }
}
