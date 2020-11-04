<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(ucfirst(__('dashboard')), route('dashboard'));
});

// Home > Users
Breadcrumbs::for('users', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('users')), route('users.index'));
});

// Home > Users > Form
Breadcrumbs::for('users.form', function ($trail) {
    $trail->parent('users');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Profile
Breadcrumbs::for('users.profile', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('profile')), null);
});

// Home > Items
Breadcrumbs::for('items', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('articles')), route('items.index'));
});

// Home > Items > Form
Breadcrumbs::for('items.form', function ($trail) {
    $trail->parent('items');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Items
Breadcrumbs::for('supplements', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('supplements')), route('supplements.index'));
});

// Home > Items > Form
Breadcrumbs::for('supplements.form', function ($trail) {
    $trail->parent('supplements');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Orders
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('orders')), route('orders.index'));
});

// Home > Orders > Details
Breadcrumbs::for('orders.details', function ($trail) {
    $trail->parent('orders');
    $trail->push(ucfirst(__('details')), null);
});

// Home > Restaurants
Breadcrumbs::for('restaurants', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('restaurants')), route('restaurants.index'));
});

// Home > Restaurants > Items

Breadcrumbs::for('restaurants.items', function ($trail) {
    $trail->parent('restaurants');
    $trail->push(ucfirst(__('items')), null);
});

// Home > Restaurants > Form
Breadcrumbs::for('restaurants.form', function ($trail) {
    $trail->parent('restaurants');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('categories')), route('categories.index'));
});

// Home > Categories > Form
Breadcrumbs::for('categories.form', function ($trail) {
    $trail->parent('categories');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Cuisines
Breadcrumbs::for('cuisines', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('cuisines')), route('cuisines.index'));
});

// Home > Cuisines > Form
Breadcrumbs::for('cuisines.form', function ($trail) {
    $trail->parent('cuisines');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Customers
Breadcrumbs::for('customers', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('customers')), route('customers.index'));
});

// Home > Customers > Orders
Breadcrumbs::for('customers.orders', function ($trail) {
    $trail->parent('customers');
    $trail->push(ucfirst(__('orders')), null);
});

// Home > Invoices
Breadcrumbs::for('invoices', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('invoices')), route('invoices.index'));
});

// Home > Invoices > Details
Breadcrumbs::for('invoices.details', function ($trail) {
    $trail->parent('invoices');
    $trail->push(ucfirst(__('details')), null);
});

// Home > Menus
Breadcrumbs::for('menus', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('menus')), route('menus.index'));
});

// Home > Menus > Form
Breadcrumbs::for('menus.form', function ($trail) {
    $trail->parent('menus');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Notations
Breadcrumbs::for('notations', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('notations')), route('notations.index'));
});

// Home > Notations > Form
Breadcrumbs::for('notations.form', function ($trail) {
    $trail->parent('notations');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Payment_methods
Breadcrumbs::for('payment_methods', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('payment_methods')), route('payment_methods.index'));
});

// Home > Payment_methods > Form
Breadcrumbs::for('payment_methods.form', function ($trail) {
    $trail->parent('payment_methods');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Payments
Breadcrumbs::for('payments', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('payments')), route('payments.index'));
});

// Home > Shops_payouts
Breadcrumbs::for('wallet', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('wallet')), route('restaurants.payouts_index'));
});

// Home > Payouts
Breadcrumbs::for('payouts', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('payouts')), null);
});

// Home > Shops_payouts
Breadcrumbs::for('shops_payouts', function ($trail) {
    $trail->parent('payouts');
    $trail->push(ucfirst(__('shops')), route('restaurants.payouts_index'));
});

// Home > Shops_payouts > wallet
Breadcrumbs::for('shops_payouts.wallet', function ($trail) {
    $trail->parent('shops_payouts');
    $trail->push(ucfirst(__('wallet')), null);
});

// Home > Shippers_payouts
Breadcrumbs::for('shippers_payouts', function ($trail) {
    $trail->parent('payouts');
    $trail->push(ucfirst(__('shippers')), route('shippers.payouts_index'));
});

// Home > Shippers_payouts > wallet
Breadcrumbs::for('shippers_payouts.wallet', function ($trail) {
    $trail->parent('shippers_payouts');
    $trail->push(ucfirst(__('wallet')), null);
});

// Home > Promocodes
Breadcrumbs::for('promocodes', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('promocodes')), route('promocodes.index'));
});

// Home > Promocodes > Form
Breadcrumbs::for('promocodes.form', function ($trail) {
    $trail->parent('promocodes');
    $trail->push(ucfirst(__('form')), null);
});

// Home > Shippings
Breadcrumbs::for('shippings', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('shippings')), route('shippings.index'));
});

// Home > Shippers
Breadcrumbs::for('shippers', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('shippers')), route('shippers.index'));
});

// Home > Shippers > Shippings
Breadcrumbs::for('shippers.shippings', function ($trail) {
    $trail->parent('shippers');
    $trail->push(ucfirst(__('shippings')), null);
});

// Home > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('settings')), null);
});

// Home > Settings > Site
Breadcrumbs::for('settings.site', function ($trail) {
    $trail->parent('settings');
    $trail->push(ucfirst(__('site')), null);
});

// Home > Settings > Generale
Breadcrumbs::for('settings.general', function ($trail) {
    $trail->parent('settings');
    $trail->push(ucfirst(__('general')), null);
});

// Home > Settings > Privacy
Breadcrumbs::for('settings.privacy_policy', function ($trail) {
    $trail->parent('settings');
    $trail->push(ucfirst(__('Privacy policy')), null);
});

// Home > Settings > Term
Breadcrumbs::for('settings.terms_of_use', function ($trail) {
    $trail->parent('settings');
    $trail->push(ucfirst(__('Terms of use')), null);
});

// Home > Documentation
Breadcrumbs::for('documentation', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('documentation')), null);
});

// Home > Privacy
Breadcrumbs::for('privacy_policy', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('Privacy policy')), null);
});

// Home > Term
Breadcrumbs::for('terms_of_use', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('Terms of use')), null);
});

// Home > Contact
Breadcrumbs::for('contact', function ($trail) {
    $trail->parent('home');
    $trail->push(ucfirst(__('Contact')), null);
});