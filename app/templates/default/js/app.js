/**
 * Created by Rohkin on 3/23/2016.
 */
(function () {
    $(document).ready(function () {
        $('.datepicker').each(function () {
            $(this).datepicker({
                "format": "dd-mm-yyyy",
            });
        });
    });

})();