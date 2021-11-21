// Check off todo list items
$("ul").on("click", "li", function() {
    $(this).toggleClass("completed");
});


//Click on the X to delete Todo
$("ul").on("click", "span", function(event) {
   $(this).parent().fadeOut(500,function(){
        $(this).remove();
   });
    event.stopPropagation();
});

$("input[type='text'").keypress(function(event){
    if(event.which === 13) {
        //grabbing new todo text from input
        var todoText = $(this).val();
        $(this).val("");
        //create a new li and add to ul
        $("ul").append(" <li><span><i class='far fa-trash-alt'></i></span>" +  todoText + " <i class='fas fa-arrow-right'></i></li>")
    }
});


$(".fa-edit").click(function() {
    $("input[type='text']").focus();
});

