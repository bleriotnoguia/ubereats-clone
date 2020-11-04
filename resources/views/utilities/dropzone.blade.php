 {{-- la variable model seras transmis au dropzone (init: )
 ce qui lui permettra de savoir les fichiers (document) enregistrés --}}
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('file.upload') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        dictCancelUpload: __("Cancel upload"),
        dictRemoveFile: __("Remove file"),
        dictMaxFilesExceeded: __("You can not upload any more files"),
        dictUploadCanceled: __("Upload canceled"),
        dictFileTooBig: __("File is too big")+" (\{\{filesize}}MiB). "+__("Max filesize")+": \{\{maxFilesize}}MiB.",
        dictCancelUploadConfirmation: __("Are you sure you want to cancel this upload ?"),
        acceptedFiles: "image/*",
        @if(isset($user))
            maxFiles: 1,
            dictDefaultMessage: '<b>Selectionner une seule image</b>',
        @else
            maxFiles: 5,
            dictDefaultMessage: '<b>Selectionner des images [ max : 5 ]</b>',
        @endif

        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        transformFile: function (file, done) {
            var context = this;
            // Create Dropzone reference for use in confirm button click handler
            var myDropZone = this;
            // Create the image editor overlay
            var editor = document.createElement('div');
            editor.setAttribute('id', 'cropper')
            editor.style.position = 'fixed';
            editor.style.left = 0;
            editor.style.right = 0;
            editor.style.height = '70%';
            editor.style.width = '80%';
            editor.style.margin = 'auto';
            editor.style.top = 0;
            editor.style.bottom = 0;
            editor.style.zIndex = 9999;
            editor.style.backgroundColor = '#000';
            document.body.appendChild(editor);

            // Create confirm button at the top left of the viewport
            var buttonConfirm = document.createElement('button');
            buttonConfirm.style.position = 'absolute';
            buttonConfirm.style.right = '10px';
            buttonConfirm.style.bottom = '10px';
            buttonConfirm.style.zIndex = 9999;
            buttonConfirm.textContent = __('Confirm');
            buttonConfirm.className = 'btn btn-info';
            editor.appendChild(buttonConfirm);
            buttonConfirm.addEventListener('click', function () {

                // Get the output file data from Croppie
                croppie.result({
                    type: 'blob',
                    size: {
                        width: 800,
                        height: 400
                    }
                }).then(function (blob) {

                    // Update the image thumbnail with the new image data
                    myDropZone.createThumbnail(
                        blob,
                        myDropZone.options.thumbnailWidth,
                        myDropZone.options.thumbnailHeight,
                        myDropZone.options.thumbnailMethod,
                        false,
                        function (dataURL) {

                            // Update the Dropzone file thumbnail
                            myDropZone.emit('thumbnail', file, dataURL);

                            // Return modified file to dropzone
                            done(blob);
                        }
                    );

                });


                // Remove the editor from the view
                document.body.removeChild(editor);

            });

            // Create cancel button at the top left of the viewport
            var buttonCancel = document.createElement('button');
            buttonCancel.style.position = 'absolute';
            buttonCancel.style.right = '100px';
            buttonCancel.style.bottom = '10px';
            buttonCancel.style.zIndex = 9999;
            buttonCancel.textContent = __('Cancel');
            buttonCancel.className = 'btn btn-danger';
            editor.appendChild(buttonCancel);
            buttonCancel.addEventListener('click', function () {
                context.removeFile(file);
                // Remove the editor from the view
                document.body.removeChild(editor);

            });

            // Create an image node for croppie.js
            var image = new Image();
            image.src = URL.createObjectURL(file);
            editor.appendChild(image);

            var options = {
                enableResize: false,
                viewport: {width: 800, height: 400},
                showZoomer: false,
            };

            // Create Croppie.js
            var croppie = new Croppie(image, options);

        }
        ,
        init: function () {
            @if(isset($model) && $model->getMedia('image'))
                var files = {!! json_encode($model->getMedia('image')) !!}
            @php
                $mediaLinks = [];
                foreach ($model->getMedia('image') as $key => $media) {
                    $urlParts = explode('public', $media->getPath());
                    $filePath = "storage" . $urlParts[sizeof($urlParts) - 1];
                    array_push($mediaLinks, $filePath);
                }
            @endphp

            var links = @json($mediaLinks);
            for (var i in files) {
                var file = files[i]
                filePath = "{{ asset('/') }}" + links[i];
                // this.emit("addedfile", file);
                this.options.addedfile.call(this, file)
                this.emit("thumbnail", file, filePath);
                // on redimentionne l'image pour qu'il soit visible au niveau du thumbnail
                $('.dz-image img').css('width', '100%');
                $('.dz-image img').css('height', '100%');
                $('.dz-image img').addClass('lazyload');
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="document[]" value="' + file.file_name + '">')
            }
            @endif
            this.files = files;
            this.on("addedfile", function (event) {
                if(this.files.length > this.options.maxFiles) {
                    swal({
                        title: "Nombre max atteint !",
                        text: "Vous ne pouvez pas importer plus de "+this.options.maxFiles+" image(s).",
                        icon: "warning"
                    });
                    this.removeFile(this.files[this.files.length-1]);
                }
            });
        }
    }
</script>