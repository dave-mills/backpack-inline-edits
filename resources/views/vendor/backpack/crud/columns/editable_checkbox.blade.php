<span>
    <input type="checkbox"
            class="editable_checkbox"
            data-pk="{{ $entry->getKey() }}"
            data-type="checklist"
            data-url="{{ url(trim($crud->getRoute(), '/') . '/editable' ) }}"
            data-title="{{ $column['label'] }}"
            data-name="{{ $column['name'] }}"
            style="width: 16px; height: 16px;"
            @if(data_get($entry, $column['name']))checked @endif>
</span>

@if(! $crud->getOperationSetting('loaded.editable_checkbox'))

@php
    $crud->setOperationSetting('loaded.editable_checkbox', true);
@endphp


<script>

if (typeof setupEditableCheckboxColumn != 'function') {


    function setupEditableCheckboxColumn(element) {


        $("input.editable_checkbox").click( function(e) {

            e.stopPropagation();

            var checked = this.checked ? 1 : 0;
            var pk = $(this).attr('data-pk');
            var name = $(this).attr('data-name');

            $.ajax({
                url: $(this).attr('data-url'),
                method: "POST",
                data: {
                    'value': checked,
                    'pk': pk,
                    'name': name,
                },
                success: function(response){
                    console.log("response", response);
                },
                error: function(xhr, status, error) {
                    console.log("error", xhr.responseText);
                }
            });
        });
    }
}

crud.addFunctionToDataTablesDrawEventQueue('setupEditableCheckboxColumn');
</script>
@endif