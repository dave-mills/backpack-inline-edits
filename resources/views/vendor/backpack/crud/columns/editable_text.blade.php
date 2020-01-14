{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);

    if (is_array($value)) {
        $value = json_encode($value);
    }
@endphp

<a class="editable_text"
    data-pk="{{ $entry->getKey() }}"
    data-type="text"
    data-url="{{ url(trim($crud->getRoute(), '/') . '/editable' ) }}"
    data-title="{{ $column['label'] }}"
    data-name="{{ $column['name'] }}"
    >
{{ (array_key_exists('prefix', $column) ? $column['prefix'] : '').str_limit(strip_tags($value), array_key_exists('limit', $column) ? $column['limit'] : 40, "[...]").(array_key_exists('suffix', $column) ? $column['suffix'] : '') }}</a>


@if(! $crud->getOperationSetting('loaded.editable_text'))

@php
    $crud->setOperationSetting('loaded.editable_text', true);
@endphp




<script>


if (typeof setupEditableTextColumn != 'function') {



    function setupEditableTextColumn(element) {

        console.log("hello")




        $("a.editable_text").editable({
            "mode": "inline",
            "ajaxOptions": {
                type: 'POST',
                dataType: 'json',
            },
            "send": 'always',
            success: function(response, newValue){
                console.log(response);
                console.log(newValue);
            }
        });
    }
}

crud.addFunctionToDataTablesDrawEventQueue('setupEditableTextColumn');
</script>
@endif