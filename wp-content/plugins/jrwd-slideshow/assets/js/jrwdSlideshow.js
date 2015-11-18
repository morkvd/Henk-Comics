(function ($) {
    $(document).ready( function() {
        // Delete from table
        $('.deleteMore').on('click', function(event) {
            var c = $('input[name="deleteItems[]"]:checked');
            if (c.length > 0) {
                if (confirm('Weet u het zeker?')) {
                    var d = [];
                    c.each( function() {
                        d.push($(this).val());
                    });

                    var href = window.location.href;
                    if (!href.match('deleteItems')) {
                        window.location = window.location.href + '&deleteItems=' + d.toString();
                    }
                }
            }

            event.preventDefault();
        });


        // Button handler
        $('.addButton').on('click', function(event) {
            console.log('test');

            event.preventDefault();
            buttonCount++;

            $(this).closest('div').prev().append(
                $('<input />').attr({
                    type: 'text',
                    name: 'buttons[text]['+ buttonCount +']',
                    class: 'buttonText',
                    placeholder: 'Tekst van de button'
                }),
                $('<input />').attr({
                    type: 'text',
                    name: 'buttons[url]['+ buttonCount +']',
                    class: 'buttonUrl',
                    placeholder: 'URL van de button'
                })
            )
        });

        var body = $('body');
        body.on('click', '.deleteButton', function(event) {
            event.preventDefault();

            if (buttonCount >= 0) {
                body.find('input[name="buttons[text][' + buttonCount + ']"]').remove();
                body.find('input[name="buttons[url][' + buttonCount + ']"]').remove();
                buttonCount--;
            }
        });


        // File selector
        var custom_file_frame;
        $('#selectFile').on('click', function(event) {
            event.preventDefault();

            if (typeof(custom_file_frame) !== 'undefined')
                custom_file_frame.close();

            custom_file_frame = wp.media.frames.customHeader = wp.media({
                title: 'Selecteer een afbeelding of video',
                library: {
                    type: 'image' //, video
                },
                button: {
                    text: 'Selecteren'
                },
                multiple: false
            });

            custom_file_frame.on('select', function() {
                var attachment = custom_file_frame.state().get('selection').first().toJSON();
                document.getElementById('file').value = attachment.url;
                document.getElementById('fileName').innerHTML = attachment.url;
            });

            custom_file_frame.open();
        });


        // Show/hide elements
        $('input#hideOverlying').on('change', function() {
            var t = $(this),
                parent = t.closest('fieldset');

            if (t.is(':checked')) {
                t.attr('value', 'Y');

                parent.next('div').hide();
                $('div.toggleHideOverlying').show();
            } else {
                t.attr('value', 'N');

                parent.next('div').show();
                $('div.toggleHideOverlying').hide();
            }
        });


        // Color picker
        $('#colorPickerField').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });


        // Sortable, jQuery ordering
        var sortable = $('#withOrder');
        sortable.sortable({
            axis: 'y',
            stop: function(event, ui) {
                sortable.find('tr').each( function() {
                   $(this).find('input[name="order[]"]').val( $(this).index() );
                });
            }
        });
        sortable.disableSelection();

    });
}(jQuery));