(function ($) {
    var settings_preimage = {
        'scale': 'contain', // cover
        'prefix': 'prev_',
        'maxWidth': 800,
        'maxHeight': 800,
        'types': ['image/gif', 'image/png', 'image/jpeg'],
        'mime': {'jpe': 'image/jpeg', 'jpeg': 'image/jpeg', 'jpg': 'image/jpeg', 'gif': 'image/gif', 'png': 'image/png', 'x-png': 'image/png', 'tif': 'image/tiff', 'tiff': 'image/tiff'}
    };

    var methods = {
        init: function (options) {
            settings_preimage = $.extend(settings_preimage, options);

            /*this.maxWidth = ((options.maxWidth)) ? options.maxWidth : 800;
            this.maxHeight = ((options.maxHeight)) ? options.maxHeight : 800;*/

            return this.each(function () {
                $(this).bind('change', methods.change);
                //$('#'+settings_preimage['prefix']+this.id).html('').addClass(settings_preimage['prefix']+'container');
            });
        },
        destroy: function () {
            return this.each(function () {
                $(this).unbind('change');
            })
        },
        base64_encode: function (data) {
            // http://kevin.vanzonneveld.net
            // +   original by: Tyler Akins (http://rumkin.com)
            // +   improved by: Bayron Guevara
            // +   improved by: Thunder.m
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   bugfixed by: Pellentesque Malesuada
            // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
            // +   improved by: Rafał Kukawski (http://kukawski.pl)
            // *     example 1: base64_encode('Kevin van Zonneveld');
            // *     returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
            // mozilla has this native
            // - but breaks in 2.0.0.12!
            //if (typeof this.window['btoa'] == 'function') {
            //    return btoa(data);
            //}
            var b64 = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";
            var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
                ac = 0,
                enc = "",
                tmp_arr = [];

            if (!data) {
                return data;
            }

            do { // pack three octets into four hexets
                o1 = data.charCodeAt(i++);
                o2 = data.charCodeAt(i++);
                o3 = data.charCodeAt(i++);

                bits = o1 << 16 | o2 << 8 | o3;

                h1 = bits >> 18 & 0x3f;
                h2 = bits >> 12 & 0x3f;
                h3 = bits >> 6 & 0x3f;
                h4 = bits & 0x3f;

                // use hexets to index into b64, and append result to encoded string
                tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
            } while (i < data.length);

            enc = tmp_arr.join('');

            var r = data.length % 3;

            return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);

        },
        change: function (event) {
            var id = this.id,
                base64_values;

            $('#' + settings_preimage['prefix'] + id).html('');

            if (window.FileReader) {
                for (i = 0; i < this.files.length; i++) {
                    if (!$.inArray(this.files[i].type, settings_preimage['types']) == -1) {
                        window.alert("File of not allowed type");
                        return false
                    }
                }

                for (i = 0; i < this.files.length; i++) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var image = new Image();
                        image.src = e.target.result;
                        image.onload = function(el) {
                            base64_values = e.target.result;
							if ((image.width > settings_preimage.maxWidth) || (image.height > settings_preimage.maxHeight)) {
                                // create an off-screen canvas
                                var elem = document.createElement('canvas'), //create a canvas
                                    scaleFactor;
                                //scale the image keep aspect ratio
                                if (image.width > image.height) {
                                    scaleFactor = settings_preimage.maxWidth / el.target.width;
                                    elem.width = settings_preimage.maxWidth;
                                    elem.height = el.target.height * scaleFactor;
                                } else {
                                    scaleFactor = settings_preimage.maxHeight / el.target.height;
                                    elem.height = settings_preimage.maxHeight;
                                    elem.width = el.target.width * scaleFactor;
                                }

                                //draw in canvas
                                var ctx = elem.getContext('2d');
                                ctx.drawImage(el.target, 0, 0, elem.width, elem.height);

                                //get the base64-encoded Data URI from the resize image
                                base64_values = ctx.canvas.toDataURL(el.target, 'image/jpeg', 0);
                            }

                            $('<div />').css({'background-image': ('url(' + base64_values + ')'), 'background-repeat': 'no-repeat', 'background-size': 'cover'}).addClass(settings_preimage['prefix'] + 'thumb').appendTo($('#' + settings_preimage['prefix'] + id));
						}
                    };
                    reader.readAsDataURL(this.files[i]);
                }
            } else {
                if (window.confirm('Internet Explorer do not support required HTML5 features. \nPleas, download better browser - Firefox, Google Chrome, Opera... \nDo you want to download and install Google Chrome now?')) {
                    window.location("//google.com/chrome");
                }
            }
        }
    };

    $.fn.preimage = function (method) {
        if (methods[method]) {
            return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.preimage');
        }

    };

})(jQuery);

