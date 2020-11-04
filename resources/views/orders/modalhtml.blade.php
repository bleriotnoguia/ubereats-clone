<!-- Modal for resto, user, meal ...-->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel">
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
                <h4>Liste des articles</h4>
                <table class="table table-hover items_list">
                    {{-- Le contenu est inseré avec le javascript --}}
                </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
        </div>
        </div>
    </div>
</div>