$(document).on("click",".btn-rm", function(){
    var parent = $(this).parents('tr');
    parent.remove();
})

$(document).on("click",".btn-add", function(){
    var ref = $(".item-reference").html();
    $(".table-item").append(ref);
});