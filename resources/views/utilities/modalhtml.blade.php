<!-- Modal for resto, user, meal ...-->
<div class="modal fade" id="modelModal" tabindex="-1" role="dialog" aria-labelledby="modelModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modelModalLabel">{{ $title }}</h4>
        </div>
        <div class="modal-body">
                <div id="carousel-media" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        
                    </ol>
                    <div class="carousel-inner">
                        
                    </div>
                    <a class="left carousel-control" href="#carousel-media" data-slide="prev">
                        <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-media" data-slide="next">
                        <span class="fa fa-angle-right"></span>
                    </a>
                </div>
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