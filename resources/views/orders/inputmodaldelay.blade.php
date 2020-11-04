<!-- Modal for resto, user, meal ...-->
<div class="modal fade" id="delayOrderModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modelModalLabel">Retarder de combien de minute</h4>
            </div>
            <form role="form" method="POST" action="" accept-charset="UTF-8" id="delayForm" >
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    {{-- <div class="input-group" style="width: 100%;">
                        <label for="">Titre du message</label>
                        <input type="text" name="message_title" class="form-control message-title" placeholder="Titre"> 
                    </div> --}}
                    <div class="form-group">
                        <div class="form-group">
                            <label>
                                {!! Form::radio('delay_added', '00:05:00', null, [ ] ) !!}
                                {{ __('5 Minutes') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('delay_added', '00:10:00', null, [ ] ) !!}
                                {{ __('10 Minutes') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('delay_added', '00:15:00', null, [ ] ) !!}
                                {{ __('15 Minutes') }}
                            </label>
                        </div>
                        <div class="form-group">
                            <label>
                                {!! Form::radio('delay_added', '00:20:00', null, [ ] ) !!}
                                {{ __('20 Minutes') }}
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