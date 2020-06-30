$(document).ready(function() {
});


function generateReport(year, period, unity, link){

    var name = "";

    $.ajax({  
        type: "POST",  
        url: "format/trimestral/pdf/service/get_unity_name.php", 
        data: "unity="+unity,
        success: function(response){

            name = response;

            $.ajax({  
                type: "POST",  
                url: "format/trimestral/pdf/service/get_answer_records.php", 
                data: "link="+link+
                      "&period="+period+
                      "&year="+year+
                      "&unity="+name,
                success: function(response){
        
                    window.open("format/trimestral/pdf/report.php");
        
                }  
            });

        }  
    });


    
}

function getUnityName(unity){

    var name = "";

    $.ajax({  
        type: "POST",  
        url: "format/trimestral/pdf/service/get_unity_name.php", 
        data: "unity="+unity,
        success: function(response){

            name = response;

        }  
    });

    return name;
}