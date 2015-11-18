<div class="box-body">
	<?php $tag_value = isset($tag->translate($lang)->tag) ? $tag->translate($lang)->tag : '' ?>
	<div class='form-group{{ $errors->has("$lang.tag") ? ' has-error' : '' }}'>
	    {!! Form::label("{$lang}[tag]", trans('tags::tag.form.tag')) !!}
	    {!! Form::text("{$lang}[tag]", Input::old("{$lang}[tag]", $tag_value), ['class' => 'form-control', 'placeholder' => trans('tags::tag.form.tag')]) !!}
	    {!! $errors->first("{$lang}.tag", '<span class="help-block">:message</span>') !!}
	</div>

	<?php $slug = isset($tag->translate($lang)->slug) ? $tag->translate($lang)->slug : '' ?>
	<div class='form-group{{ $errors->has("$lang.slug") ? ' has-error' : '' }}'>
	    {!! Form::label("{$lang}[slug]", trans('tags::tag.form.slug')) !!}
	    {!! Form::text("{$lang}[slug]", Input::old("{$lang}[slug]", $slug), ['class' => 'form-control', 'placeholder' => trans('tags::tag.form.slug')]) !!}
	    {!! $errors->first("{$lang}.slug", '<span class="help-block">:message</span>') !!}
	</div>
</div>