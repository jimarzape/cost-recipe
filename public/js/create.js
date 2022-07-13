$(document).on("click", ".btn-add", function(){
    var html = template();
    $(".tbl-ingredient").append(html);
});

$(document).on("click",".btn-rm", function(){
    var parent = $(this).parents('tr');
    parent.remove();
});

function template () 
{
    var html = `
        <tr>
            <td>
                <input type="text" class="form-control" name="ingredient[]" required >
            </td>
            <td>
                <input type="text" class="form-control" name="brand[]" value="N/A">
            </td>
            <td>
                <input type="number" class="form-control" name="scale[]" step="any" required>
            </td>
            <td>
                <select class="form-control" name="unit[]" required>
                    <option value="g">g</option>
                    <option value="pc">pc</option>
                    <option value="can">can</option>
                </select>
            </td>
            <td>
                <input type="number" class="form-control" name="cost[]" step="any" required>
            </td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm btn-rm"><i class="fa fa-times"></i></button>
            </td>
        </tr>
    `;

    return html;
}

$(document).on("change",".times-unit", function(){
    var time =parseFloat($(this).val());
    $(".unit-reference").each(function(){
        var ref = parseFloat($(this).html());
        var target = $(this).parents('tr').find('.unit-times');
        var val = ref * time;
        target.html(val);
    });
});