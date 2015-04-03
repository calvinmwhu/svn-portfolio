
$(document).ready(function () {

    $(".clickable-link").click(function () {
        var url=$(this).attr("data-linkToCode");
        var data_key = $(this).attr("data-key");
        var short_name = $(this).attr("data-shortname");
        var json_versions = $('#'+data_key).text();
        //console.log(json_versions);
        var json_obj = JSON.parse(json_versions);
        $("#table-of-pre-commits > tbody").empty();
        for(var i=0; i<json_obj.length; ++i){
            var obj = json_obj[i];
            var row = "<tr>";
            $.each(obj, function(key,value){
               //console.log(key,value);
                var col = "<th>"+value+"</th>";
                row=row+col;
                //$('#table-of-pre-commits > tbody:last')s.append()
            });
            row=row+"</tr>";
            //console.log(row);
            $('#table-of-pre-commits > tbody:last').append(row);
        }
        $("#myModalLabel").text(short_name);
        $("#iframe-to-code").attr("src", url);

    });


});


