<aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class=""><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          {{-- <li class=""><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li> --}}
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab" data-toggle="tab">
              <h3 class="control-sidebar-heading">{{__('Changer la langue')}}</h3>
              <ul class="control-sidebar-menu">
                <li>
                  <a href="{{ url('lang/en') }}" onclick="goTo('{{ url('lang/en') }}')">
                    <i class="menu-icon fa fa-language {{ App::isLocale('en') ? 'bg-green' : 'bg-red' }}"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Anglais</h4>
                      <p>Choose this language</p>
                    </div>
                  </a>
                </li>
                <li>
                  <a href="{{ url('lang/fr') }}" onclick="goTo('{{ url('lang/fr') }}')">
                    <i class="menu-icon fa fa-language {{ App::isLocale('fr') ? 'bg-green' : 'bg-red' }}"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Français</h4>
                      <p>Choisir cette langue</p>
                    </div>
                  </a>
                </li>
              </ul>
              @if (Auth::user()->isSuperAdmin())
                <h3 class="control-sidebar-heading">Autres options</h3>
                <ul class="control-sidebar-menu">
                <li>
                    <a href="{{ route('restaurants.index') }}" onclick="goTo('{{ route('restaurants.index') }}')">
                      <i class="menu-icon fa fa-cutlery bg-light-blue"></i>
        
                      <div class="menu-info">
                        <h4 class="control-sidebar-subheading">Toutes les boutiques</h4>
        
                        <p>Toutes les boutiques</p>
                      </div>
                    </a>
                  </li>
                </ul>
              @endif
              {{-- <div>
                  <h4 class="control-sidebar-heading">Layout Options</h4>
                  <div class="form-group">
                    <label class="control-sidebar-subheading">
                    <input type="checkbox" data-layout="fixed" class="pull-right"> Fixed layout</label>
                    <p>Activate the fixed layout. You can't use fixed and boxed layouts together</p>
                  </div>
              </div>

            <!-- /.control-sidebar-menu -->
    
            {{-- <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript:;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="pull-right-container">
                        <span class="label label-danger pull-right">70%</span>
                      </span>
                  </h4>
    
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul> --}}
            <!-- /.control-sidebar-menu -->
    
          </div>
          <!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
          <!-- /.tab-pane -->
          <!-- Settings tab content -->
          {{-- <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
    
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
    
                <p>
                  Some information about this general settings option
                </p>
              </div>
              <!-- /.form-group -->
            </form>
          </div> --}}
          <!-- /.tab-pane -->
        </div>
      </aside>