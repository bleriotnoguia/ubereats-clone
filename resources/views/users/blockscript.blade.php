<script>
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

        elems.forEach(function (html) {
            var switchery = new Switchery(html, {size: 'small'});
        });

        function ttoggleBlockCallback(elem) {
            var toggleState = {
                _token: CSRF_TOKEN,
                user_id: elem.data('user-id'),
                is_enable: elem.get(0).checked ? 'on' : 'off'
            };
            var _this = elem;
            $.ajax({
                type: "POST",
                url: "{{ route('users.block') }}",
                data: toggleState,
                dataType: "json",

                success: function (response) {
                    if (response.data.is_enable) {
                        $.toast({
                            heading: 'Success',
                            text: response.message,
                            icon: 'success',
                            hideAfter: 6000,
                            showHideTransition: 'slide',
                            position: "bottom-right",
                        });
                        _this.parent().parent().prev().html("<span class='label label-success'>"+__('not blocked')+"</span>");
                    } else {
                        $.toast({
                            heading: 'Information',
                            text: response.message,
                            icon: 'info',
                            hideAfter: 6000,
                            showHideTransition: 'slide',
                            position: "bottom-right",
                        });
                        _this.parent().parent().prev().html("<span class='label label-danger'>"+__('blocked')+"</span>");
                    }

                },
                error: function (response) {
                    var if_message_exist = typeof(response.responseJSON) != 'undefined' && typeof(response.responseJSON.message) != 'undefined';
                    $.toast({
                        heading: 'Erreur',
                        text: if_message_exist ? response.responseJSON.message : 'Echec de mise à jour. \n C\'est peut etre un problème de connexion.',
                        icon: 'error',
                        hideAfter: 6000,
                        showHideTransition: 'slide',
                        position: "bottom-right",
                        afterShown: function () {
                            _this.off('change');
                            _this.trigger('click');
                            _this.on('change', function(){
                                ttoggleBlockCallback($(this))
                                })
                        },
                    });
                }

            });
        }

        $(elems).on("change", function (){
            ttoggleBlockCallback($(this));
        });
    </script>