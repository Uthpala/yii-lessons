$(document).ready(function(){
    $('#commentsForm').on('submit',function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        var form = $(this);

        $.ajax({
              url    : '/index.php?r=comments/create',
              type   : 'POST',
              data   : form.serialize(),
              success: function (response) 
              {             
                 $('#comments-list').append("<li>"+ response.body +"</li>")
                 form.find("input[type=text], textarea").val("");
                 return false;
              },
              error  : function (e) 
              {
                  console.log(e);
                  return false;
              }
          });
    })
})