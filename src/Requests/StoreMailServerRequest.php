<?php

namespace Laramic\Mailer\MailServer;

use App\Enums\MailServerTypeEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreMailServerRequest extends FormRequest
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


    protected function prepareForValidation()
    {
        $this->merge([
            'author_id' => Auth::user()?->id,
            'primary'   => $this->primary ?? false,
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'uuid'              => ['nullable', 'string', 'unique:mail_servers,uuid'],
            'author_id'         => ['nullable', 'integer', 'exists:users,id'],
            'type'              => ['string', 'in:' . implode(',', MailServerTypeEnum::toArray())],
            'primary'           => ['nullable', 'boolean'],
            'mail_host'         => ['required', 'string'],
            'mail_port'         => ['required', 'string'],
            'mail_encryption'   => ['nullable', 'string'],
            'mail_username'     => ['nullable', 'string'],
            'mail_password'     => ['nullable', 'string'],
            'mail_from_address' => ['nullable', 'string'],
            'mail_from_name'    => ['nullable', 'string'],
        ];
    }
}
