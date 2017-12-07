$(document).ready(function(){

    // listen to if a checkbox is changed 
    $("input[type=checkbox]").on('change', function(){
        var checkbox = this;
        var checkboxValue = checkbox.value;
        var parentValue = $('#authitemchild-parent').val();
        if( checkbox.checked ){
            // add a row to the auth item child table             
            $.post('index.php?r=auth-item-child/create', { parent: parentValue, child: checkboxValue }, function(response){
                $('#message').html(response);
            });
        }else{
            $.post('index.php?r=auth-item-child/delete&parent='+ parentValue +'&child='+ checkboxValue , {}, function(response){
                $('#message').html(response);
            });
            // delete the row from the auth item child table 
        }
    });
    // check if it checked or unchecked 

    // get the value of the checkbox 

    // depending on that we are going to send a ajax request 


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
                // check if there is a error 
                if ( response.error ){
                    // show the error message 
                    $('#comment-error').html(response.message);
                }else{
                 $('#comments-list').append("<li>"+ response.body +"</li>")
                 form.find("input[type=text], textarea").val("");
                }
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