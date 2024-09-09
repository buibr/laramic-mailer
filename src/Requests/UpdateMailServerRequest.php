<?php

namespace Laramic\Mailer\MailServer;

use App\Enums\MailServerTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMailServerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'primary' => $this->primary ?? false,
        ]);
    }

    public function rules()
    {
        return [
            'mail_host'         => ['required', 'string'],
            'mail_port'         => ['required', 'string'],
            'primary'           => ['boolean'],
            //
            'type'              => ['string', 'in:' . implode(',', MailServerTypeEnum::toArray())],
            'mail_encryption'   => ['nullable', 'string'],
            'mail_username'     => ['nullable', 'string'],
            'mail_password'     => ['nullable', 'string'],
            'mail_from_address' => ['nullable', 'string'],
            'mail_from_name'    => ['nullable', 'string'],
        ];
    }
}
