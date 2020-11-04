@extends('layouts.app')

@section('breadcrumbs')
    {{ Breadcrumbs::render('documentation') }}
@stop

@section('main')

    <div class="row">
        <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <i class="fa fa-text-width"></i>
                    <h3 class="box-title">Documentation {{ config('app.name')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <h2>I. Dashboard</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus, error.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat dolorem eligendi incidunt nisi mollitia! Quis tempore dolores, excepturi esse ratione officiis libero deserunt pariatur, quas sed distinctio fugiat quod temporibus unde, illo nemo. Non deserunt, saepe quaerat culpa eligendi laborum nam cupiditate atque optio est earum, nesciunt esse, nisi ipsa.</p>
                        <img src="{{ asset('img/dashboard.png') }}" style="width: 100%;" alt=" dashboard img">
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Esse, animi dolores. Repellat delectus, maxime pariatur explicabo eveniet quisquam! Accusantium ducimus quo tempora itaque harum omnis nihil reprehenderit quisquam inventore veniam!</p>
                    
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium nemo magnam nulla doloremque, consequuntur numquam natus velit facere odit delectus dolore totam eos. Necessitatibus provident sunt consectetur, aut vero quisquam perferendis sequi totam maxime labore fugiat non sed in sit eveniet ducimus quod maiores praesentium cumque ullam deleniti minus officiis.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
        </div>
    </div>
    <div class="row">
            <div class="col-md-6">
                <div class="box box-solid">
                    <div class="box-header with-border">
                    <h3 class="box-title">Collapsible Accordion</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="box-group" id="accordion">
                        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                        <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Collapsible Group Item #1
                            </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                            labore sustainable VHS.
                            </div>
                        </div>
                        </div>
                        <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                Collapsible Group Danger
                            </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="box-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                            labore sustainable VHS.
                            </div>
                        </div>
                        </div>
                        <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                Collapsible Group Success
                            </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="box-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3
                            wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum
                            eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla
                            assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred
                            nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer
                            farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus
                            labore sustainable VHS.
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <div class="col-md-6">
                    <div class="box box-solid">
                      <div class="box-header with-border">
                        <h3 class="box-title">Carousel</h3>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="item active">
                              <img src="http://placehold.it/900x500/39CCCC/ffffff&amp;text=I+Love+Ubereats" alt="First slide">
          
                              <div class="carousel-caption">
                                First Slide
                              </div>
                            </div>
                            <div class="item">
                              <img src="http://placehold.it/900x500/3c8dbc/ffffff&amp;text=I+Love+Ubereats" alt="Second slide">
          
                              <div class="carousel-caption">
                                Second Slide
                              </div>
                            </div>
                            <div class="item">
                              <img src="http://placehold.it/900x500/f39c12/ffffff&amp;text=I+Love+Ubereats" alt="Third slide">
          
                              <div class="carousel-caption">
                                Third Slide
                              </div>
                            </div>
                          </div>
                          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="fa fa-angle-left"></span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="fa fa-angle-right"></span>
                          </a>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
    </div>
@stop