$(document).ready(function(){
    $('#table2').hide();
});

$( "#btnProduct" ).click(function() {
    $( "#table2" ).hide();
    $( "#table1" ).show();
});
$( "#btnRepair" ).click(function() {
    $( "#table1" ).hide();
    $( "#table2" ).show();
});;