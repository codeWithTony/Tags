<?php namespace Modules\Tags\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateTagRequest extends BaseFormRequest
{
    protected $translationsAttributesKey = 'tags::tag.validation.attributes';

    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        $id = $this->route()->getParameter('tags')->id;
        return [
            'tag' => 'required',
            "slug" => "required|unique:tags__tag_translations,slug,$id,tag_id,locale,$this->localeKey",
        ];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
        ];
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
