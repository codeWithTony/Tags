<script src="{{ Module::asset('tags:js/mtag.js') }}" type="text/javascript"></script>
<link href="{{ Module::asset('tags:css/mtag.css') }}" rel="stylesheet" type="text/css" />
<div class="form-group">
    {!! Form::label($zone, ucfirst($zone) . ':') !!}
    {!! Form::text($zone, Input::old($zone, ((!empty($project))? Tags::toString($project->tags): null)), ['class' => 'form-control mtag', 'placeholder' => trans('tags::tag.form.tags')]) !!}
</div>