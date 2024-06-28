import EE from './EventEmitter';

export const queryStringParser = (object = {}) => {
    let string = '';

    for (let prop in object) {
        string += !string ? `${prop}=${object[prop]}` : `&${prop}=${object[prop]}`;
    }

    return string;
};

export const translitraite = (string) => {
    return string.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
};

export const masksInit = (masks) => {
    for (let prop in masks) {
        const element = $(`input[name="${prop}"]`);

        if (element.get(0)) {
            element.mask(masks[prop].mask, masks[prop].options);
        }
    }
};

export const errorValidation = {
    highlight: (element) => {
        const label = $(element).next('.invalid-feedback');
        const $el = $(element).closest('.field');

        if (!$el.hasClass('error')) {
            $el.addClass('error');
            $el.find('.form-control, .input100').addClass('is-invalid state-invalid');
            label.removeClass('hidden');

            EE.emit('errors:update', {
                addError: true,
                element,
            });
        }
    },
    unhighlight: (element) => {
        const label = $(element).next('.invalid-feedback');
        const $el = $(element).closest('.field');
        const el = $(element);

        if ($el.hasClass('error')) {
            $el.find('.form-control, .input100').removeClass('is-invalid state-invalid');
            $el.removeClass('error');
            label.addClass('hidden');
            EE.emit('errors:update', {
                addError: false,
            });
        }
    },
};

export const errorValidationLabelType = {
    highlight: (element) => {
        const label = $(element).next('.sylius-validation-error');
        const $el = $(element).closest('.input-row');
        const el = $(element);

        if (!$el.hasClass('error')) {
            $el
              .addClass('error')
              .addClass('error-label')
            ;

            label.removeClass('hidden');

            EE.emit('errors:update', {
                addError: true,
                element,
            });
        }
    },
    unhighlight: (element) => {
        const label = $(element).next('.sylius-validation-error');
        const $el = $(element).closest('.input-row');
        const el = $(element);

        if ($el.hasClass('error')) {
            $el
              .removeClass('error')
              .removeClass('error-label')
            ;

            label.addClass('hidden');
            EE.emit('errors:update', {
                addError: false,
                element,
            });
        }
    },
};

export const isMobile = () => {
  return navigator && navigator.userAgent
    && /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || window.outerWidth < 768;
}
