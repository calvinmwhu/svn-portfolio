

$(".dummy").click(function () {
    var name=$(this).attr("data-url");
    //alert(name);
    $("#myframe").attr("src", name);
});




$(".clickable-link").click(function () {
    var url=$(this).attr("data-linkToCode");
    var data_key = $(this).attr("data-key");

    //alert(data_key);

    $("#iframe-to-code").attr("src", url);
});


