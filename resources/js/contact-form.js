$(document).ready(function() {

    $('#contact-submit').click(function(event) {
        
        var data = { name: "John", 
                    email: "2pm", 
                    findus: "find us", 
                    message: "hello world" 
        };
        alert("about to call post");
        $.post( "/mailer.php", data, function() {
                alert( "success" );
            }).done(function() {
                alert( "second success" );
            }).fail(function() {
                alert( "error" );
            }).always(function() {
                alert( "finished" );
            });

        
        $("#contact").fadeOut( "slow", function() {
            
            // Animation complete.
            
            // reset all form input values
            $("#name").val("");
            $("#email").val("");
            $("#find-us").val("friends");
            $("#message").val("");
            
            // show div with success message
            
            
            
            $("#contact").fadeIn( "slow", function() {
                
            // Animation complete.
            
            });
            
        });
        event.preventDefault()
//        return false;
    });
});