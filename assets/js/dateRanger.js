$(function() {
    $('input[name="datefilter"]').daterangepicker({
        autoUpdateInput: false,
        opens: 'left'
    }, function(start, end, label) {
        $("#check_in_date").val(start.format('YYYY-MM-DD'));
        $("#check_out_date").val(end.format('YYYY-MM-DD'));
        
        var duration = end.diff(start, 'days');
        $('#booking_duration').text(duration); 

        $("#secondStepBtn").prop('disabled', true);
        $("#reserveRoomType")[0].selectedIndex = 0;
        $("#availableRooms")[0].selectedIndex = 0;
    });

    $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
        $("#check_in_date").val('');
        $("#check_out_date").val('');
    });
});
