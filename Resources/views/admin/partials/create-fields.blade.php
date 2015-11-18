<div class="box-body">
	<div class='form-group{{ $errors->has("$lang.tag") ? ' has-error' : '' }}'>
	    {!! Form::label("{$lang}[tag]", trans('tags::tag.form.tag')) !!}
	    {!! Form::text("{$lang}[tag]", Input::old("{$lang}[tag]"), ['class' => 'form-control tag slugify', 'placeholder' => trans('tags::tag.form.tag')]) !!}
	    {!! $errors->first("{$lang}.tag", '<span class="help-block">:message</span>') !!}
	</div>
	<div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
	    {!! Form::label("{$lang}[slug]", trans('tags::tag.form.slug')) !!}
	    {!! Form::text("{$lang}[slug]", Input::old("{$lang}[slug]"), ['class' => 'form-control slug', 'placeholder' => trans('tags::tag.form.slug')]) !!}
	    {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
	</div>
</div>