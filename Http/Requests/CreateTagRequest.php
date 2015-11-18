<?php namespace Modules\Tags\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class CreateTagRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'tags::tag.validation.attributes';

    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        $id = null;
        $locale = $this->localeKey;

        return [
            'tag' => 'required',
            "slug" => "required|unique:tags__tag_translations,slug,$id,tag_id,locale,$locale",
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [
            'tag.required' => trans('tags::messages.tag is required'),
            'slug.required' => trans('tags::messages.slug is required'),
            'slug.unique' => trans('tags::messages.slug is unique'),
        ];
    }
}
