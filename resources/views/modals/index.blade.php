<div class="modal fade" id="uploadForm"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="image-upload-form">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="favoritesModalLabel">Upload image</h4>
                </div>
                <div class="modal-body">
                    <input type="text" name="image-title" id="image-title" placeholder="Title"/>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="image-type" id="image-type">
                    <input type="hidden" name="parent-id" id="parent-id">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <label class="btn btn-primary" for="my-file-selector">
                        <input id="my-file-selector" name="image" type="file" style="display:none;"
                               onchange="displayImagePath(this)">
                        Upload
                    </label>
                    <span class='label label-success' id="upload-file-info"></span>
                </div>
                <div class="modal-body" id="modal-body-error">

                </div>
                <div class="modal-footer">
                    <span class="pull-right">
                        <input type="button" class="btn btn-primary"
                               onclick="sendImage('#image-upload-form')" value="Send">
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal"
     tabindex="-1" role="dialog"
     aria-labelledby="favoritesModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="image-upload-form">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img style="width:100%" id="modal-image"/>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function sendImageParams(p, t) {
        $('#parent-id').val(p);
        $('#image-type').val(t);
        $("#modal-body-error").html('');
        $("#upload-file-info").html('');
        $("#image-title").val('');
    }

    function displayImagePath(i) {
        $("#modal-body-error").html('');
        $('#upload-file-info').html($(i).val());
    }

    function sendImage(f) {
        $.ajax({
            url: '/image/send',
            type: 'POST',
            data: new FormData($(f)[0]),
            success: function (data) {
                var err = data.error;
                if (err == 0) {
                    $('#uploadForm').modal('hide');
                    updatePage();
                } else {
                    $("#modal-body-error").html('');
                    displayErrors(err.image);
                    displayErrors(err["image-title"]);
                }
            },
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });


    }

    function sendImageToModal(s) {
        $('#modal-image').attr('src', s);
    }

    function updatePage() {
        $.ajax({
            url: document.location.pathname,
            type: 'GET',
            success: function (data) {
                $('#table').html($(data).find('#table').html());
            },
            async: false,
            cache: false,
            contentType: false,
            processData: false
        });
    }

    function displayErrors(errors) {
        if (errors) {
            for (i = 0; i < errors.length; i++) {
                message = '<p style="display:block" class="label label-danger">' + errors[i] + '</p>';
                $("#modal-body-error").append(message);
            }
        }
    }
</script>