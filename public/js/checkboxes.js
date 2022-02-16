
$(document).ready(function() {
    $("div input#selectAll").click(function(e) {
        if ($(this).is(":checked")) {
            $(".ck:checkbox:not(:checked)").attr("checked", "checked");
        } else {
            $(".ck:checkbox:checked").removeAttr("checked");
        }

    });

});

$(document).ready(function() {
    $("input#otraOficina").click(function(event) {
        if ($(this).is(":checked")) {
            $("input#nuevaOficina").removeAttr("disabled");
        } else {
            $("input#nuevaOficina").attr("disabled", "");
        }
    });
  
    $("input#otroUso").click(function(event) {
        if ($(this).is(":checked")) {
            $("input#nuevoUso").removeAttr("disabled");
        } else {
            $("input#nuevoUso").attr("disabled", "");
        }
    });
  });