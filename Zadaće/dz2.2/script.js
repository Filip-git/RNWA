$(document).ready(function(){
        $("#employee_search").on("keyup", function(){
          var value = $(this).val();

          $.ajax({
            url:"employees_search.php",
            type: "get",
            data:{ s:value},
            success :function(response){
              if (value.length==0){
                $("#txtHint").load()
                $("#txtHint").css("border","0px");
                return;
              }
              $("#txtHint").html(response);
              
              
            
          },
            error:function(){
            alert("Error");
            }
          });

        })
      })