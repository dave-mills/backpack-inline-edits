{{-- regular object attribute --}}
@php
    $value = data_get($entry, $column['name']);
    if ($value != null) {
        $value = number_format($value,
            array_key_exists('decimals', $column) ? $column['decimals'] : 0,
            array_key_exists('dec_point', $column) ? $column['dec_point'] : '.',
            array_key_exists('thousands_sep', $column) ? $column['thousands_sep'] : ','
         );
    }

    else {
        $value = " ~enter value~ ";
    }
@endphp
<a class="editable_number"
    data-pk="{{ $entry->getKey() }}"
    data-type="text"
    data-url="{{ url(trim($crud->getRoute(), '/') . '/editable' ) }}"
    data-title="{{ $column['label'] }}"
    data-name="{{ $column['name'] }}"
    >{{ (array_key_exists('prefix', $column) ? $column['prefix'] : '').$value.(array_key_exists('suffix', $column) ? $column['suffix'] : '') }}</a>


@if(! $crud->getOperationSetting('loaded.editable_number'))

@php
    $crud->setOperationSetting('loaded.editable_number', true);
@endphp




<script>


if (typeof setupEditableNumberColumn != 'function') {



    function setupEditableNumberColumn(element) {

        console.log("hello")


        $("a.editable_number").editable({
            "mode": "inline",
            "tpl": "<input type='number'>",
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

crud.addFunctionToDataTablesDrawEventQueue('setupEditableNumberColumn');
</script>
@endif