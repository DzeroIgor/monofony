(function ($) {
    'use strict';

    var calendarTextFr = {
        days: ['S', 'L', 'M', 'M', 'J', 'V', 'S'],
        months: ['Ianuarie', 'Februarie', 'Martie', 'Aprilie', 'Mai', 'Iunie', 'Iulie', 'August', 'Septembrie', 'Octombrie', 'Noiembrie', 'Decembrie'],
        monthsShort: ['Ian', 'Feb', 'Mart', 'April.', 'Mai', 'Iun', 'Iul', 'Aug', 'Sept', 'Oct', 'Noi', 'Dec'],
        today: 'Azi',
        now: 'Acum',
        am: 'AM',
        pm: 'PM'
    };

    $.fn.extend({
        /**
         * Date picker
         * @param options
         */
        datePicker: function (options = {}) {
            $(this).each(function () {
                var $element = $(this);

                $element.calendar({
                    type: 'date',
                    firstDayOfWeek: 1,
                    text: calendarTextFr,
                    formatter: {
                        date: function (date, settings) {
                            if (!date) return '';
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();

                            if (month < 10) {
                                month = "0" + month;
                            }
                            if (day < 10) {
                                day = "0" + day;
                            }

                            return day + '/' + month + '/' + year;
                        }
                    },
                    parser: {
                        date: function (text, settings) {
                            if (text instanceof Date) {
                                return text;
                            } else {
                                var dateAsArray = text.split('/');
                                return new Date(dateAsArray[2], dateAsArray[1] - 1, dateAsArray[0]);
                            }
                        }
                    },
                    ...options,
                });
            });
        }
    });

    $.fn.extend({
        dateTimePicker: function () {
            $(this).each(function () {
                var $element = $(this);

                $element.calendar({
                    type: 'datetime',
                    firstDayOfWeek: 1,
                    text: calendarTextFr,
                    disableMinute: true,
                    ampm: false,
                    formatter: {
                        date: function (date, settings) {
                            if (!date) return '';
                            var day = date.getDate();
                            var month = date.getMonth() + 1;
                            var year = date.getFullYear();

                            if (month < 10) {
                                month = "0" + month;
                            }

                            if (day < 10) {
                                day = "0" + day;
                            }

                            return day + '/' + month + '/' + year;
                        },
                        time: function (date, settings, forCalendar) {
                            var hours = date.getHours();
                            var minutes = date.getMinutes();

                            if (minutes < 10) {
                                minutes = "0" + minutes;
                            }

                            return hours + ':' + minutes;
                        }
                    }
                });
            });
        }
    });
})(jQuery);
