function callComment(){
jQuery(document).ready(function($){
$("#formComments").submit(function(){
    cComment = this.comment.value;
    submitter = this.submitter;

    // you can use PHP for double validation
    if( cComment=="" )
        $("#errAll").html('<p>No Comment Posted. Please try again.</p>');
    
    var data = {
        comment:cComment 
    };
    $.post("module-1.php", data, function( response ) {
            submitter.value="Comment posted"; 
            submitter.disabled=true; 
            $(response).appendTo($(".formCommentsBox")); 
    });

    return false;

});
 })};
