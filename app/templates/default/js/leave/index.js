/**
 * Created by Connor on 24/03/2016.
 */
(function(){
    $(document).ready(function(){
        $("input[name=leave_type]").change(function(){
            $("#end_date").removeAttr("required");
            if($("#leave_holiday").prop("checked") == true){
                console.log('TEST');
                $("#end_date").attr('required',true);
            }
        });
    });

})();