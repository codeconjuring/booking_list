(function ($) {

    $.fn.filemanager = function (type, options) {
        type = type || 'file';

        this.on('click', function (e) {
            var imageInput     = $(this).data('input');
            var route_prefix   = (options && options.prefix) ? options.prefix : '/filemanager';
            var target_input   = $('#' + $(this).data('input'));
            var target_preview = $('#' + $(this).data('preview'));
            window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
            window.SetUrl = function (items) {
                var file_path = items.map(function (item) {
                    var thumbUrl = item.thumb_url.split('/storage/');
                    return thumbUrl[1];
                }).join(',');

                // set the value of the desired input to image url
                var old_input = target_input.val();
                if (old_input.length) {
                    var new_input = (old_input + ',' + file_path).replace(',,', ',');
                } else {
                    var new_input = file_path;
                }

                // target_input.val('').val(file_path).trigger('change');
                target_input.val(new_input).trigger('change');

                // clear previous preview
                // target_preview.html('');

                // set or change the preview image src
                items.forEach(function (item) {
                    var thumbUrl = item.thumb_url.split('/storage/');
                    var preview_images = `<div class="ic-thumb-item">
                                    <img src=" /storage/` + thumbUrl[1] + `" style="height: 5rem; margin-right: 15px">
                                    <span class="ic-remove-btn remove-product" data-imageSrc = "` + thumbUrl[1] + `" data-imageInput="` + imageInput + `" onclick="if (confirm('Are You Sure ?')){ removeImage(this)}"></span>
                                </div>`;
                    target_preview.append(preview_images);
                });

                // trigger change event
                target_preview.trigger('change');
            };
            return false;
        });
    }

})(jQuery);
