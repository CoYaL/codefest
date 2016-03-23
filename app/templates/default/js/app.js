/**
 * Created by Rohkin on 3/23/2016.
 */
String.prototype.format = function () {
    var s = this, i = arguments.length;
    while (i--) {
        s = s.replace(new RegExp('\\{' + i + '\\}', 'gm'), arguments[i]);
    }
    return s;
};
(function () {
    $(document).ready(function () {
        $('.datepicker').each(function () {
            $(this).datepicker({
                "format": "dd-mm-yyyy",
            });
        });
    });

})();