<div class="mb-3">
    <label for="{!! $name !!}" class="form-label text-muted">{!! $label !!}</label>
    <select @if(!empty($wire)) {!! implode(" ", $wire) !!} @endif class="form-control" id="{!! $id !!}" name="{!! $name !!}" data-choices {!! implode(" ", $data_choices_opts) !!}>
        @if( !empty($place_holder_option) )
            <option value="{!! $place_holder_option['value'] !!}">{!! $place_holder_option['name'] !!}</option>
        @endif
        @foreach($options as $key => $value)
            <option value="{!! $key !!}">{!! $value !!}</option>
        @endforeach
    </select>
</div>
@pushonce('scripts')
    @vite('resources/js/plugin/init_choices.js')
@endpushonce