$('#editButton').click(function (){
    $(this).hide();
    $("#deleteButton").hide();
    $(".btn2").show();
    $(".selectImage").removeAttr("style");
    $("#passIn").val('');
    $(".input").removeAttr("disabled").removeClass("text-muted");
    $(".input").css("color","blueviolet").css("border","1px solid blueviolet").css("border-radius","2px");
});

$('#deleteButton').click(function (){
    $("section").empty();
    $(".alertaMsg").show();
});

$('#confirmButton').click(function (){
    $(".alertaMsg").hide();
    $(".confirmEmail").show();
});