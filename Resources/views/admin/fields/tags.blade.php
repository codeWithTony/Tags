<div class="form-group">
    {!! Form::label($zone, ucfirst($zone) . ':') !!}
    {!! Form::textarea($zone, Input::old($zone, Tags::toString($project->tags)), ['class' => 'form-control', 'placeholder' => trans('tags::tag.form.tags')]) !!}
</div>