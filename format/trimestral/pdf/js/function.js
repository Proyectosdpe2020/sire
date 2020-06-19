$(document).ready(function() {
});

function generateReport(){
    window.open("format/trimestral/pdf/report.php");
}


function info(){

    var link = 37;
    var period = 2;

    $.ajax({  
        type: "POST",  
        url: "format/trimestral/pdf/service/get_answer_records.php", 
        data: "link="+link+
              "&period="+period,
        success: function(response){

            //var content_records = JSON.parse(response);

            window.open("format/trimestral/pdf/report.php");

        }  
    });
}