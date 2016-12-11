var _radioName = "input_type";
var _var = "custom";

$(document).ready(function(){
    var lastChecked = false;
    $("input[name=" + _radioName + "]").change(function() {
        if(this.id == _var) {
            lastChecked = true;
            $("input[name=dim_x1]").removeAttr('disabled');
            $("input[name=dim_x2]").removeAttr('disabled');
            $("input[name=dim_x3]").removeAttr('disabled');
            $("input[name=dim_y]").removeAttr('disabled');
            $("input[name=file]").removeAttr('disabled');
        } else if(lastChecked) {
            lastChecked = false;
            $("input[name=dim_x1]").attr('disabled', 'disabled').val(2);
            $("input[name=dim_x2]").attr('disabled', 'disabled').val(2);
            $("input[name=dim_x3]").attr('disabled', 'disabled').val(2);
            $("input[name=dim_y]").attr('disabled', 'disabled').val(2);
            $("input[name=file]").attr('disabled', 'disabled');
        }
    });
});