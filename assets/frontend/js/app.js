import '../scss/main.scss';

import 'babel-polyfill';
import './shim-semantic-ui';
import 'sylius/ui/js/app';
import '../../common/app-date-time-picker';

// Components
import './components';

$(document).ready(function () {

    const initPlugins = (parent) => {
        // parent.previewUploadedImage('.image-change');
        $('.tag-input-dropdown').dropdown({
            allowAdditions: true
        });

        parent.find('.app-date-picker:not(.custom)').datePicker();
        parent.find('.app-date-time-picker').dateTimePicker();

        const dropdowns = parent.find('.dropdown');

        dropdowns.each((index, item) => {
            const el = $(item);

            el.dropdown({
                onChange: (code) => {
                    const parent = el.closest('.ui.dropdown');

                    if (code) {
                        parent.addClass('has-value');
                    } else {
                        parent.removeClass('has-value');
                    }
                },
            });
        });

        parent.find('.sylius-autocomplete').autoComplete();
        parent.find('.toggle').checkbox();
    };

    initPlugins($('body'));

    $(document).on('collection-form-add', () => {
        $('.app-date-picker').datePicker();
        $('.app-date-time-picker').dateTimePicker();
    });
});
