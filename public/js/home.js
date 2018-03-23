$(document).ready(function(){
    
    $("#searchForm").validate({
        submitHandler: function(form) {
            $("main").hide();
            $("#loader").toggleClass('invisible');
            form.submit();
        }
    });
    
    $('#searchForm').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
            e.preventDefault();
            return false;
        }
    });
});