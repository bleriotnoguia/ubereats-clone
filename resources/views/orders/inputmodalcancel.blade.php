<!-- Modal for resto, user, meal ...-->
<div class="modal fade" id="cancelOrderModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelModalLabel">Raison du rejet de la commande</h4>
            </div>
            <form role="form" method="POST" action="" accept-charset="UTF-8" id="cancelForm" >
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="status" value="canceled">
                    {{-- <div class="input-group" style="width: 100%;">
                        <label for="">Titre du message</label>
                        <input type="text" name="message_title" class="form-control message-title" placeholder="Titre"> 
                    </div> --}}
                    <div class="form-group">
                        <div class="form-group">
                            <label>
                                {!! Form::radio('cancellation_reason', 'Article(s) manquant(s)', null, [ ] ) !!}
                                {{ __('Article(s) manquant(s)') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('cancellation_reason', 'Ingrédient(s) manquant(s)', null, [ ] ) !!}
                                {{ __('Ingrédient(s) manquant(s)') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('cancellation_reason', 'Trafic important', null, [ ] ) !!}
                                {{ __('Trafic important') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('cancellation_reason', 'Fermeture de la boutique / restaurant', null, [ ] ) !!}
                                {{ __('Fermeture de la boutique / restaurant') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="submit">Confirmer</button>
                </div>
            </form>
        </div>
    </div>
</div>