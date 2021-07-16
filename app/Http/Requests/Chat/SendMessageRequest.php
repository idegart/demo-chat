<?php

namespace App\Http\Requests\Chat;

use App\Models\Chat;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->chat()->members()->where('user_id', \Auth::id())->exists();
    }

    public function rules(): array
    {
        return [
            'text' => [
                'required',
                'string',
            ],
        ];
    }

    private function chat(): Chat
    {
        return $this->route('chat');
    }

    public function text(): string
    {
        return $this->input('text');
    }
}
