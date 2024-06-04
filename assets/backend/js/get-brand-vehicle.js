import $ from 'jquery';

const handleBrandSelect = function handleBrandSelect() {
    const form = document.getElementsByName('vehicle')[0];
    const form_select_brand = document.getElementById('vehicle_brand');
    const form_select_model = document.getElementById('vehicle_model');

    const updateForm = async (data, url, method) => {
        const req = await fetch(url, {
            method: method,
            body: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'charset': 'utf-8',
                '_format': 'html'
            }
        });

        const text = await req.text();

        return text;
    };

    const parseTextToHtml = (text) => {
        const parser = new DOMParser();
        const html = parser.parseFromString(text, 'text/html');

        return html;
    };

    const changeOptions = async (e) => {
        const requestBody = e.target.getAttribute('name') + '=' + e.target.value;
        const updateFormResponse = await updateForm(requestBody, form.getAttribute('action'), form.getAttribute('method'));
        const html = parseTextToHtml(updateFormResponse);

        const new_form_select_model = html.getElementById('vehicle_model');
        form_select_model.innerHTML = new_form_select_model.innerHTML;
    };

    form_select_brand.addEventListener('change', (e) => changeOptions(e));
};

$.fn.extend({
    handleBrandSelect() {
    },
});




