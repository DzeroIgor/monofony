import {translitraite} from '../utils/utils';
import EE from '../../../common/js/utils/EventEmitter';
import $ from "jquery";

$.fn.extend({
  autoComplete() {
    this.each((idx, el) => {
      const element = $(el);
      const criteriaName = element.data('criteria-name');
      const choiceName = element.data('choice-name');
      const choiceValue = element.data('choice-value');
      const autocompleteValue = element.find('input.autocomplete').val();
      const loadForEditUrl = element.data('load-edit-url');
      let allowAdditions = false;

      if (element.hasClass('allow-add')) {
        allowAdditions = true;
      }

      if (element.hasClass('search-autocomplete')) {
        let input = element.find('[data-search-input]');

        element.find('input.search').on('change', (event) => {
          input.val(event.target.value);
        });
      }

      // clearable
      element.dropdown({
        allowAdditions,
        delay: {
          search: 250,
        },
        forceSelection: false,
        /**
         * On change dropdown
         * @param code
         * @param test
         * @param el
         */
        onChange: (code, test, el) => {
          if (code) {
            element.addClass('has-value', code);
          } else {
            element.removeClass('has-value', code);
          }

          if (element.hasClass('search-autocomplete')) {
            element.find('[data-search-input]').val(test);
          }

          EE.emit('autocomplete:change', {
            value: code,
            name: test,
          });

          if (el) {
            const parent = el.closest('[data-address]').get(0);

            if (parent) {
              EE.emit('dropdown:change', {
                type: el.closest('[data-url]').data('type'),
                parent,
                code,
                el,
              });
            }
          }
        },
        apiSettings: {
          dataType: 'JSON',
          cache: false,
          beforeSend(settings, data) {
            const params = element.get(0).dataset.params ? JSON.parse(element.get(0).dataset.params) : {};

            settings.data[criteriaName] = translitraite(settings.urlData.query);

            for (let prop in params) {
              settings.data[prop] = params[prop];
            }

            return settings;
          },
          onResponse(response) {
            EE.emit('autocomplete:response:success', {
              data: response,
            });

            return {
              success: true,
              results: response.map(item => {
                let name = `${item[choiceName]}`;

                return ({
                  value: item[choiceValue],
                  name,
                });
              }),
            };
          },
        },
      });

      if (autocompleteValue && autocompleteValue.split(',').filter(String).length > 0) {
        const menuElement = element.find('div.menu');
        const text = element.find('.text');

        element.addClass('loading-default-data');
        menuElement.api({
          on: 'now',
          method: 'GET',
          url: loadForEditUrl,
          beforeSend(settings) {
            settings.data[choiceValue] = autocompleteValue.split(',').filter(String);

            return settings;
          },
          onSuccess(response) {
            response.forEach((item) => {
              if (response.length === 1 && !element.hasClass('multiple')) {
                text.removeClass('default');
                text.text(item[choiceName]);
              }

              menuElement.append((
                $(`<div class="item" data-value="${item[choiceValue]}">${item[choiceName]}</div>`)
              ));
            });

            setTimeout(() => {
              element.dropdown('set selected', autocompleteValue.split(',').filter(String));
              element.removeClass('loading-default-data');
              element.addClass('has-value');
            }, 0);
          },
          onError: () => {
            element.removeClass('loading-default-data');
          }
        });
      }
    });
  },
});
