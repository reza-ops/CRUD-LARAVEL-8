$('.input-only-img').attr("accept", "image/*");
$('.input-only-img').on('change', function(e) {
    $( this ).parent().find("img").remove();
    var get_rundom_numer = randomIntFromInterval(1, 100);
    $( this ).parent().append( '<img id="output-img'+get_rundom_numer+'" class="img-thumbnail" width="20%" style="margin-top:5px"/>' );
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('output-img'+get_rundom_numer+'');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
});
function randomIntFromInterval(min,max) {
    return Math.floor(Math.random()*(max-min+1)+min);
}
