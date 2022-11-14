<?php

namespace App\Http\Requests;

use App\Rules\OnlyCodeOrUssd;
use Illuminate\Foundation\Http\FormRequest;

class RbtRequest extends FormRequest
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
        if ($this->route('rbt')) {
            return [
                'content_id'  => 'required|numeric|exists:contents,id',
                'code'        => ['required_without:ussd', new OnlyCodeOrUssd('ussd'), 'nullable', 'numeric', 'unique:rbts,code,'.$this->route('rbt')],
                'ussd'        => 'required_without:code|nullable|string|unique:rbts,ussd,'.$this->route('rbt'),
                'operator_id' => 'required|numeric|exists:operators,id'
            ];
        }

        return [
            'content_id'         => 'required|numeric|exists:contents,id',
            'rbts'               => 'required|array|min:1',
            'rbts.*.code'        => 'required_without:rbts.*.ussd|nullable|numeric|unique:rbts,code',
            'rbts.*.ussd'        => 'required_without:rbts.*.code|nullable|string|unique:rbts,ussd',
            'rbts.*.operator_id' => 'required|numeric|exists:operators,id'
        ];
    }

    public function attributes()
    {
        if ($this->route('rbt')) {
            return [
                'content_id'  => trans('menu.content'),
                'code'        => trans('inputs.code'),
                'ussd'        => trans('inputs.ussd'),
                'operator_id' => trans('menu.operator'),
            ];
        }

        return [
            'rbts'               => 'required|array|min:1',
            'rbts.*.content_id'  => trans('menu.content'),
            'rbts.*.code'        => trans('inputs.code'),
            'rbts.*.ussd'        => trans('inputs.ussd'),
            'rbts.*.operator_id' => trans('menu.operator')
        ];
    }
}
