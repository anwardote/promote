<!-- text input -->
<?php $name= $field['name'];?>
<div class="{{ isset($field['parent_class'])?$field['parent_class']:'form-group' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
    <input
            type="{{ $field['type'] }}"
            class="form-control {{ $field['class'] }}"
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
            value="{{ old($field['name']) ? old($field['name']) : (isset($data->$name)? $data->$name:'') }}"
    >
    <span class="text-danger">{!! $errors->first($field['name']) !!}</span>
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
