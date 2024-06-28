import $ from 'jquery';

const displayUploadedImage = function displayUploadedImage(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = (event) => {
      let placeholderFile = $(input).closest('.img-block').find('.placeholder-file');
      const image = $(input).parent().siblings('.image');
      const type = input.files[0].name.split('.').pop();
      const fancyBlock = $(input).closest('.img-block').find('[data-fancy-image]');
      const imageName = $(input).closest('.image-change').find('.avatar-image-name');

      if (type !== 'doc' && type !== 'docx' && type !== 'pdf' && type !== 'xlsx') {
        if (image.length > 0) {
          fancyBlock.attr('href',  event.target.result);
          image.attr('src', event.target.result);
        } else {
          const img = $('<img class="ui small bordered image" alt="Uploaded image"/>');
          fancyBlock.attr('href',  event.target.result);
          img.attr('src', event.target.result);
          imageName.remove();

          const imageContainer = $(input).closest('.image-change').find('[data-image-container]');

          if (imageContainer.get(0)) {
            const currentImage = imageContainer.find('img');

            if (currentImage.get(0)) {
              currentImage.prop('src', event.target.result);
            } else {
              imageContainer.prepend(img);
            }
          } else {
            $(input).parent().before(img);
          }
        }
      } else {
        fancyBlock.attr('href',  event.target.result);

        if (placeholderFile.get(0)) {
          placeholderFile.removeAttr('class');
          placeholderFile.addClass(`placeholder-file ${type}`);

          $(input).closest('.img-block').prepend(placeholderFile);
          image.remove();
        } else {
          let placeholderFile = $(`<span class="placeholder-file ${ type }"/>`);
          $(input).closest('.img-block').prepend(placeholderFile);
        }
      }
    };

    reader.readAsDataURL(input.files[0]);
  }
};

$.fn.extend({
  previewUploadedImage(root) {
    $(root).on('change', 'input[type="file"]', function() {
      displayUploadedImage(this);
    });
  },
});
