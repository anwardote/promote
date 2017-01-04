<!-- text input -->
<div class="{{ isset($field['parent_class'])?$field['parent_class']:'form-group' }}">
    <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>

    <textarea
            class="form-control {{ $field['class'] }}"
            name="{{ $field['name'] }}"
            id="{{ $field['name'] }}"
    >
        {{ old($field['name']) ? old($field['name']) : (isset($field['value'])?$field['value']:'') }}
    </textarea>
    <span class="text-danger">{!! $errors->first($field['name']) !!}</span>
    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
</div>
