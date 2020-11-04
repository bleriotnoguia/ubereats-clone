<script>
var modelsList = @json($models->all());

function showModal(id){
    var modelDetails = modelsList.find(
        function checkModel(item){
            return item.id == id;
        }
    );
    // Dislay the slider
    $('div.carousel-inner').empty();
    $('ol.carousel-indicators').empty();
    if(modelDetails.media_links.length > 0){
        var cpt = -1;
        for(var link of modelDetails.media_links){
            cpt++;
            filePath= "{{ asset('/') }}"+ link;
            $('ol.carousel-indicators').append('<li data-target="#carousel-media" data-slide-to="'+cpt+'"></li>');
            $('div.carousel-inner').append('<div class="item"> <img src="' + filePath + '" alt="default text image"></div>');
        }
    }else{
        $('div.carousel-inner').append('<div class="item"> <img src="{{ asset('img/default.png') }}" alt="default text image"><div class="carousel-caption">Image par defaut</div></div>');
        $('ol.carousel-indicators').append('<li data-target="#carousel-media" data-slide-to="0"></li>');
    }
    $('div.carousel-inner div.item').first().addClass('active');
    $('ol.carousel-indicators').children().first().addClass('active');
    
    //Remove .carousel-control there are just one media
    if($("div.carousel-inner").children().length == 1){
        $('.carousel-control').hide();
        $('ol.carousel-indicators').hide();
    }else{
        $('.carousel-control').show();
        $('ol.carousel-indicators').show();
    }
    // Decorer modelmodal avec les valeurs du model
    for(var key in modelDetails){
        if(key == 'address'){
            for(var address_key in modelDetails.address){
                if(document.querySelector(`#modelModal .address_${address_key}`)){
                    document.querySelector(`#modelModal .address_${address_key}`).innerHTML = modelDetails.address[address_key];
                }
            }
        }else{
            if(document.querySelector(`#modelModal .${key}`)){
                if(key == 'cuisine' || key == 'category' || key == 'menu'){
                    if(modelDetails[key] != null){
                        document.querySelector(`#modelModal .${key}`).innerHTML = modelDetails[key].name;
                    }
                }else if(key == 'cuisines'){
                    var cuisines = modelDetails['cuisines'].map(
                        function (item){
                            return item.name
                        }
                    ).join(', ');
                    document.querySelector(`#modelModal .${key}`).innerHTML = cuisines;
                }else if(key == 'price'){
                    document.querySelector(`#modelModal .${key}`).innerHTML = formatter.format(modelDetails[key]);
                }else{
                    document.querySelector(`#modelModal .${key}`).innerHTML = modelDetails[key];
                }   
            }
        }
    };
    $('#modelModal').modal('toggle');
}
</script>