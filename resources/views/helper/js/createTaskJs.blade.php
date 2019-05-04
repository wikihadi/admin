<script src="/admin-core/persiandatapicker/persianDatepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script>
    $(function () {
        let pd11 = new persianDate();

        $("#gStartDate").persianDatepicker({


            cellWidth: 30,
            cellHeight: 30,
            fontSize: 15,
            onSelect: function () {
                var start = $("#gStartDate").attr("data-gdate");
                $("#startDate").val(start);


            },
        });
        $("#gEndDate").persianDatepicker({
            startDate: pd11.now().toString("YYYY/MM/DD"),

            endDate: pd11.now().addYear(1).toString("YYYY/MM/DD"),
            cellWidth: 30,
            cellHeight: 30,
            fontSize: 15,
            onSelect: function () {


                var end = $("#gEndDate").attr("data-gdate");
                $("#endDate").val(end);
            },
        });


        // $(".pdp-data-jdate").persianDatepicker({
        //
        // onSelect: function () {
        // var start = $("#gStartDate").attr("data-gdate");
        // $("#startDate").val(start);
        // var end = $("#gEndDate").attr("data-gdate");
        // $("#endDate").val(end);
        // },
        //
        // });


    });
    // $(".custom-file-input").on("change", function() {
    // var fileName = $(this).val().split("\\").pop();
    // $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    // });

    function formToggle() {
        $(".formChange").toggle();
    }

    function selectToggle() {
        $(".selectType").toggle();
    }

    $(function(){
        var d = new Date(),
            h = d.getHours(),
            m = d.getMinutes();
        if(h < 10) h = '0' + h;
        if(m < 10) m = '0' + m;
        $('input[type="time"][value="now"]').each(function(){
            $(this).attr({'value': h + ':' + m});
        });
    });
    $(function () {
        let today = new Date().toISOString().substr(0, 10);
        $('#startDate').val(today);
    })
    $(function () {
        let today = new Date().toISOString().substr(0, 10);
        $('#endDate').val(today);
    })


    function clearContents(element) {

        // element.value = "";

    }
    $('.timepicker').timepicker({
        timeFormat: 'H:mm',
        interval: 30,
        minTime: '8',
        maxTime: '7:00pm',
        defaultTime: '8',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });
    $('.timepicker2').timepicker({
        timeFormat: 'H:mm',
        interval: 30,
        minTime: '8',
        maxTime: '7:00pm',
        defaultTime: '19',
        startTime: '8:00',
        dynamic: false,
        dropdown: true,
        scrollbar: true
    });

    function clearTeam() {
        $('#team').hide();
    }
    function addTeam() {
        $('#team').show();
    }


</script>