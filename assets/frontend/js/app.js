import '../scss/main.scss';

import 'babel-polyfill';
import './shim-semantic-ui';
import 'sylius/ui/js/app';
import '../../common/app-date-time-picker';

$(document).ready(function () {
    $('.app-date-picker').datePicker();
    $('.app-date-time-picker').dateTimePicker();

    $(document).on('collection-form-add', () => {
        $('.app-date-picker').datePicker();
        $('.app-date-time-picker').dateTimePicker();
    });
});
