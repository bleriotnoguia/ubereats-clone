<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset(Auth::user()->profile_img) }}" class="img-circle lazyload" alt="User Image" style="height: 50px">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->first_name }} {{ isset($_restaurant) ? '('.str_limit($_restaurant->name, 10, '...').')' : '' }}</p>
                <!-- Status -->
                <a href="{{ auth()->user()->isShopAdmin() && auth()->user()->restaurant ? route('restaurants.show', Auth::user()->restaurant) : route('users.show', Auth::user()) }}"><i class="fa fa-circle text-success"></i>{{ __('online') }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-tachometer"></i> <span>Tableau de bord</span></a>
            </li>
            @hasrole('super-admin')
            @include('layouts.partials.treeview', [
                'icon' => 'fa-users',
                'type' => 'multilevel',
                'label' => __('Users'),
                'items' => [
                [
                    'route' => route('customers.index'),
                    'label' => __('Liste des clients'),
                    'icon' => 'fa-users',
                    'color' => 'white',
                ],
                [
                    'route' => route('users.index'),
                    'label' => __('Liste des administrateurs'),
                    'icon' => 'fa-users',
                    'color' => 'white',
                ],
                [
                    'route' => route('shippers.index'),
                    'label' => __('Liste des expéditeurs'),
                    'icon' => 'fa-truck',
                    'color' => 'white',
                ],
                [
                    'route' => route('users.create'),
                    'label' => __('Ajouter un utilisateur'),
                    'icon' => 'fa-plus',
                    'color' => 'white',
                ],
                ],
            ])
            <li><a href="{{ route("cuisines.index") }}"><i class="fa fa-cubes"></i> <span>Cuisines</span></a></li>
            {{-- @include('layouts.partials.treeview', [
                'icon' => 'fa-users',
                'type' => 'multilevel',
                'label' => str_limit('Utilisateurs, Roles, Permissions', 24, '...'),
                'items' => [
                    [
                        'route' => route('permissions.index'),
                        'label' => 'Permissions',
                        'color' => 'green',
                    ],
                    [
                        'route' => route('users.index'),
                        'label' => 'Utilisateurs',
                        'color' => 'blue',
                    ],
                    [
                        'route' => route('roles.index'),
                        'label' => 'Roles',
                        'color' => 'yellow',
                    ],
                ],
            ]) --}}
            @include('layouts.partials.treeview', [
                'icon' => 'fa-cutlery',
                    'type' => 'multilevel',
                    'label' => 'Boutiques',
                    'items' => [
                        [
                            'route' => route('restaurants.index'),
                            'label' => __('Liste des boutiques'),
                            'color' => 'white',
                            'icon' => 'fa-list-ul'
                        ],
                        [
                            'route' => route('restaurants.create'),
                            'label' => __('Ajouter une boutique'),
                            'color' => 'white',
                            'icon' => 'fa-plus'
                        ],
                    ],
                ])
            @endhasrole
            @isset($_restaurant)
            @hasrole('shop-admin')
            @include('layouts.partials.treeview', [
                'icon' => 'fa fa-cutlery',
                'type' => 'multilevel',
                'label' => __('My '.($_restaurant->is_merchant ? 'commerce' : 'restaurant')),
                'items' => [
                    [
                        'route' => route("restaurants.show", $_restaurant),
                        'label' => $_restaurant->is_merchant ? __('Commerce profile') : __('Restaurant profile'),
                        'icon' => 'fa-list-ul',
                        'color' => 'white',
                    ],
                    [
                        'route' => route('restaurants.edit', $_restaurant),
                        'label' => $_restaurant->is_merchant ? __('Edit commerce') : __('Edit restaurant'),
                        'icon' => 'fa-edit',
                        'color' => 'white',
                    ],
                ],
            ])
            {{-- <li><a href="{{ route("restaurants.show", $_restaurant) }}"><i class="fa fa-cutlery"></i> <span></span></a> --}}
            </li>
            @if(!$_restaurant->is_merchant)
                @include('layouts.partials.treeview', [
                        'icon' => 'fa-file-text',
                        'type' => 'multilevel',
                        'label' => __('Menus'),
                        'items' => [
                        [
                            'route' => route('menus.index'),
                            'label' => __('Liste des menus'),
                            'icon' => 'fa-list-ul',
                            'color' => 'white',
                        ],
                        [
                            'route' => route('menus.create', isset($_restaurant) ? $_restaurant->id : ''),
                            'label' => __('Ajouter un menu'),
                            'icon' => 'fa-plus',
                            'color' => 'white',
                        ],
                    ],
                ])
            @endif
            @include('layouts.partials.treeview', [
                    'icon' => 'fa-file-text',
                    'type' => 'multilevel',
                    'label' => __('Categories'),
                    'items' => [
                    [
                        'route' => route('categories.index'),
                        'label' => __('Liste des categories'),
                        'icon' => 'fa-list-ul',
                        'color' => 'white',
                    ],
                    [
                        'route' => route('categories.create', isset($_restaurant) ? $_restaurant->id : ''),
                        'label' => __('Ajouter une categorie'),
                        'icon' => 'fa-plus',
                        'color' => 'white',
                    ],
                ],
            ])
            @include('layouts.partials.treeview', [
                    'icon' => 'fa-coffee',
                    'type' => 'multilevel',
                    'label' => 'Articles',
                    'items' => [
                    [
                        'route' => route('items.index'),
                        'label' => __('Liste des articles'),
                        'color' => 'white',
                        'icon' => 'fa-list-ul'
                    ],
                    [
                        'route' => route('items.create', isset($_restaurant) ? $_restaurant->id : ''),
                        'label' => __('Ajouter un article'),
                        'color' => 'white',
                        'icon' => 'fa-plus'
                    ],
                ],
            ])
            @if(!$_restaurant->is_merchant)
                @include('layouts.partials.treeview', [
                            'icon' => 'fa-arrow-circle-left',
                            'type' => 'multilevel',
                            'label' => 'Supplements',
                            'items' => [
                            [
                                'route' => route('supplements.index'),
                                'label' => __('Liste des supplements'),
                                'color' => 'white',
                                'icon' => 'fa-list-ul'
                            ],
                            [
                                'route' => route('supplements.create', isset($_restaurant) ? $_restaurant->id : ''),
                                'label' => __('Ajouter un supplement'),
                                'color' => 'white',
                                'icon' => 'fa-plus'
                            ],
                        ],
                    ])
            @endif
            <li>
                <a href="{{ route("customers.index") }}"><i class="fa fa-users"></i> <span>Clients</span></a></li>
            @endhasrole
            @endisset
            @if(Auth::user()->hasrole('super-admin') || isset($_restaurant))
                @include('layouts.partials.treeview', [
                        'icon' => 'fa-cubes',
                        'type' => 'multilevel',
                        'label' => 'Ventes',
                        'items' => [
                        [
                            'route' => route("orders.index"),
                            'label' => 'Commandes',
                            'color' => 'white',
                            'icon' => 'fa-shopping-cart'
                        ],
                        [
                            'route' => route("shippings.index"),
                            'label' => 'Livraisons',
                            'color' => 'white',
                            'icon' => 'fa-truck'
                        ],
                        [
                            'route' => route("invoices.index"),
                            'label' => 'Factures',
                            'color' => 'white',
                            'icon' => 'fa-file-text-o'
                        ],
                        [
                            'route' => route("payments.index"),
                            'label' => 'Paiements',
                            'color' => 'white',
                            'icon' => 'fa-money'
                        ]
                        ],
                    ])
                <li><a href="{{ route("promocodes.index") }}"><i class="fa fa-gift"></i> <span>Promotions</span></a>
                </li>
            @endif
            @hasrole('super-admin')
            <li><a href="{{ route('notations.index') }}"><i class="fa fa-comment"></i> <span>Notations</span></a></li>
            @include('layouts.partials.treeview', [
                    'icon' => 'fa-cubes',
                    'type' => 'multilevel',
                    'label' => __('Paiements'),
                    'items' => [
                    [
                        'route' => route("restaurants.payouts_index"),
                        'label' => str_limit(__('Shops payouts'), 25, '...'),
                        'color' => 'white'
                    ],
                    [
                        'route' => route("shippers.payouts_index"),
                        'label' => str_limit(__('Shippers payouts'), 25, '...'),
                        'color' => 'white'
                    ],
                    // [
                    //     'route' => route("payments.index"),
                    //     'label' => str_limit('Historique de paiements des restaurants', 24, '...'),
                    //     'title' => 'Historique de paiements des restaurants',
                    //     'color' => 'white'
                    // ],
                    // [
                    //     'route' => route("payments.index"),
                    //     'label' => str_limit('Historique de paiements des livreurs', 24, '...'),
                    //     'title' => 'Historique de paiements des livreurs',
                    //     'color' => 'white'
                    // ]
                    ],
                ])
            @endhasrole
            @if(isset($_restaurant) || Auth::user()->isSuperAdmin())
            <li><a href="{{ route('payouts.show', Auth::user()) }}"><i class="fa fa-line-chart"></i>
                <span>{{ __('Wallet') }}</span></a></li>
            @endif
            <li class="header">AUTRES</li>
            @hasrole('super-admin')
            @include('layouts.partials.treeview', [
                    'icon' => 'fa-gears',
                    'type' => 'multilevel',
                    'label' => 'Parametres',
                    'items' => [
                        [
                            'route' => route('settings.site'),
                            'label' => __('Site'),
                            'color' => 'white',
                        ],
                        [
                            'route' => route('settings.general'),
                            'label' => __('Generales'),
                            'color' => 'white',
                        ],
                        [
                            'route' => route('settings.edit_privacy'),
                            'label' => __('Privacy policy'),
                            'color' => 'white',
                        ],
                        [
                            'route' => route('settings.edit_terms'),
                            'label' => __('Terms of use'),
                            'color' => 'white',
                        ],
                    ],
            ])
            {{-- @include('layouts.partials.treeview', [
                    'icon' => 'fa-file-text',
                    'type' => 'multilevel',
                    'label' => __('Methode de paiement'),
                    'items' => [
                        [
                            'route' => route('payment_methods.index'),
                            'label' => __('Liste des methodes de paiements'),
                            'icon' => 'fa-list-ul',
                            'color' => 'white',
                        ],
                        [
                            'route' => route('payment_methods.create'),
                            'label' => __('Ajouter un methode de paiement'),
                            'icon' => 'fa-plus',
                            'color' => 'white',
                        ],
                    ],
            ]) --}}
            <li><a href="{{ route('payment_methods.index') }}"><i class="fa fa-credit-card"></i> <span>Methodes de paiement</span></a>
            </li>
            @endhasrole
            {{-- <li><a href="#" data-toggle="control-sidebar"><i class="fa fa-gear"></i> <span>Autres parametres</span></a></li> --}}
            <li><a href="{{ route("documentation") }}"><i class="fa fa-book"></i> <span>Manuel d'utilisation</span></a>
            </li>
            @hasrole('shop-admin')
            <li><a href="{{ route("contact") }}"><i class="fa fa-envelope"></i> <span>Contact | Aide</span></a></li>
            @endhasrole
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>