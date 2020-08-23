<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Helpers\LinkHelper;

class LinkShorten extends FormRequest
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
    public function rules()
    {
        return [
            'link-url' => 'required|url'
        ];
    }

    public function messages()
    {
        return [
            'link-url.required' => 'Link is required',
            'link-url.url' => 'Provided Link should be a url'
        ];
    }

    public function dbColumns()
    {
        $shortUrl = LinkHelper::createShortLink($this->input('link-url'));
        
        $columns = [
            'user_id' => $this->user_id,
            'short_url' => $shortUrl,
            'long_url' => $this->input('link-url'),
            'long_url_hash' => LinkHelper::longUrlHash($this->input('link-url')),
            'is_disabled' => 0
        ];

        return $columns;
    }

    

}