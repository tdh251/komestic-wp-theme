;(function ($) {

    "use strict";

    $(document).ready(function () {
        $('.pxl-form-date input').datetimepicker({
            timepicker: false,
            format:'D, F j, Y',
            scrollInput : false,
            onClose: function(obj) {
              var t = new Date(obj);
              var m =  t.getMonth() + 1;
              var m_zeroe = '';
              var d_zeroe = '';
              if(t.getMonth() < 10) {
                var m_zeroe = '0';
              }
              if(t.getDate() < 10) {
                var d_zeroe = '0';
              }
              var str = t.getFullYear() + '-' + m_zeroe + m + '-' + d_zeroe + t.getDate();
              var time = $('#pxl-open-table-time').val();
              $('[name="dateTime"]').val(str + 'T' + time);
            }
        });
        
        var pxl_day_name = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
        var pxl_month_name = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        function pxl_date_today(d) {
          var t = new Date(d);
          return pxl_day_name[t.getDay()] + ', ' + pxl_month_name[t.getMonth()] + ' ' + t.getDate() + ', ' + t.getFullYear();
        }

        function pxl_opentable_date_today(d) {
          var t = new Date(d);
          var m =  t.getMonth() + 1;
          var m_zeroe = '';
          var d_zeroe = '';
          if(t.getMonth() < 10) {
            var m_zeroe = '0';
          }
          if(t.getDate() < 10) {
            var d_zeroe = '0';
          }
          return t.getFullYear() + '-' + m_zeroe + m + '-' + d_zeroe + t.getDate();
        }

        var pxl_date_today_result = pxl_date_today(new Date());
        $('.pxl-form-date input').val(pxl_date_today_result);

        var pxl_opentable_date_today_result = pxl_opentable_date_today(new Date());
        var time = $('#pxl-open-table-time').val();
        $('[name="dateTime"]').val(pxl_opentable_date_today_result + 'T' + time);


        $('#pxl-open-table-time').on('change', function(e) {
            e.preventDefault();
            var time_up = $(this).val();
            $('[name="dateTime"]').val(pxl_opentable_date_today_result + 'T' + time_up);
        });

    });

})(jQuery);