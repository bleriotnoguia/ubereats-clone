<!-- Modal for resto, user, meal ...-->
<div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modelModalLabel">{{ $title }}</h4>
        </div>
        <div class="modal-body">
                <table class="table table-hover">
                    {{ $slot }}
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>