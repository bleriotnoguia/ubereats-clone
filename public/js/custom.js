
lazyload();

$(document).ready(function () {
    $('.preloader').addClass('complete');
});

/** add active class and stay opened when selected */
var url = window.location;

// for dollar we use en-US and USD
// app_currency_code and app_language_code are global variable define in the mainhaider they take thier value in the lavavel's .env file
const formatter = new Intl.NumberFormat(app_language_code, {
    style: 'currency',
    currency: app_currency_code,
    minimumFractionDigits: 2
});

var dict = {
    "Home": {
      pt: "Início",
      fr: "Accueil"
    },
    "Download plugin": {
       pt: "Descarregar plugin",
       en: "Download plugin",
       fr: "Télécharger le plugin"
    },
    "File is too big":{
        fr: "Le fichier est trop lourd"
    },
    "Max filesize":{
        fr: "Taille maximale acceptable"
    },
    "Blue":{
        fr: "Bleu"
    },
    "Blue Light":{
        fr: "Bleu claire"
    },
    "Purple":{
        fr: "Violet"
    },
    "Purple Light":{
        fr: "Violet claire"
    },
    "Black":{
        fr: "Noir"
    },
    "Black Light":{
        fr: "Noir claire"
    },
    "Green":{
        fr: "Vert"
    },
    "Green Light":{
        fr: "Vert claire"
    },
    "Red":{
        fr: "Rouge"
    },
    "Red Light":{
        fr: "Rouge claire"
    },
    "Yellow":{
        fr: "Jaune"
    },
    "Yellow Light":{
        fr: "Jaune claire"
    },
    "comment":{
        fr: "Commentaire",
    },
    "percent": {
        fr: "pourcentage"
    },
    "activated": {
        fr: "activé"
    },
    "blocked": {
        fr: "bloqué"
    },
    "not blocked": {
        fr: "pas bloqué"
    },
    "amount": {
        fr: "montant"
    },
    "pending": {
        fr: "en attente"
    },
    "in_shipment": {
        fr: "expédition en cours"
    },
    "ready": {
        fr: "prête"
    },
    "confirmed": {
        fr: "confirmée"
    },
    "Confirm": {
        fr: "Confirmer"
    },
    "all_user": {
        fr: "tous les utilisateurs"
    },
    "some_user": {
        fr: "certains clients"
    },
    "one_user": {
        fr: "un utilisateur"
    },
    "Cancel": {
        fr: "Annuler"
    },
    "Yes, confirm it": {
        fr: "Oui, confirmer"
    },
    "Yes":{
        fr: "Oui"
    },
    "No":{
        fr: "Non"
    },
    "Cancel upload": {
        fr: "Annuler le téléchargement"
    },
    "Upload canceled": {
        fr: "Téléchargement annulé"
    },
    "Remove file": {
        fr: "Retirer le fichier"
    },
    "Layout Options": {
        fr: "Options de mise en page"
    },
    "Skins": {
        fr: "Thèmes"
    },
    "You can not upload any more files": {
        fr: "Vous ne pouvez plus télécharger de fichiers"
    },
    "Are you sure you want to cancel this upload ?": {
        fr: "Êtes-vous sûr de vouloir annuler ce téléchargement ?"
    },
    "Activate the fixed layout.": {
        fr: "Activer la mise en page fixe."
    },
    "Fixed layout": {
        fr: "Mise en page fixe"
    },
    "Toggle the left sidebar's state (open or collapse)": {
        fr: "Basculer l’état de la barre latérale gauche (ouvert ou réduit)"
    },
    "Toggle Sidebar": {
        fr: "Basculer la barre latérale"
    },
    "Toggle Right Sidebar Slide": {
        fr: "Basculer la barre latérale droite"
    },
    "Toggle between slide over content and push content effects": {
        fr: "Basculer entre les effets de diapositive sur le contenu et de contenu push"
    },
    "Toggle Right Sidebar Skin": {
        fr: "Basculer le thème de la barre latérale droite"
    },
    "Toggle between dark and light skins for the right sidebar": {
        fr: "Basculer entre les thèmes sombres et claires pour la barre latérale droite"
    }
  }
// current_lang is global variable define in the mainhaider
var translator = $('body').translate({lang: current_lang, t: dict});

function __(text){
    return translator.get(text);
}

function dd(data){
    console.log(data);
    debugger;
}

function allow(message, _this, dangerMode){
    swal({
        title: __("Confirm")+" ?",
        text: message,
        buttons: {
            cancel: {
                text: __("Cancel"),
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm: {
                text: __("Yes, confirm it")+" !",
                value: true,
                visible: true,
                className: "",
                closeModal: true
            }
        },
        dangerMode: dangerMode,
        icon: 'warning'
    }).then((value) => {
            if(value){
                _this.parentElement.submit();
            }
        });
}

function goTo(url){
    window.location.href = url;
}

$(function () {
    $('[data-toggle="popover"]').popover()
    $('[data-toggle="tooltip"]').tooltip()
    $('.btn').tooltip();
})

$(function (){
    'use strict'

    /**
     * Get access to plugins
     */
  
    $('[data-toggle="control-sidebar"]').controlSidebar()
    $('[data-toggle="push-menu"]').pushMenu()
    var $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
    var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
    var $layout = $('body').data('lte.layout')
    $(window).on('load', function() {
        // Reinitialize variables on load
        $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
        $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
        $layout = $('body').data('lte.layout')
    })
  
    /**
     * List of all the available skins
     *
     * @type Array
     */
    var mySkins = [
        'skin-blue',
        'skin-black',
        'skin-red',
        'skin-yellow',
        'skin-purple',
        'skin-green',
        'skin-blue-light',
        'skin-black-light',
        'skin-red-light',
        'skin-yellow-light',
        'skin-purple-light',
        'skin-green-light'
    ]
  
    /**
     * Get a prestored setting
     *
     * @param String name Name of of the setting
     * @returns String The value of the setting | null
     */
    function get(name) {
        if (typeof (Storage) !== 'undefined') {
            return localStorage.getItem(name)
        } else {
            window.alert('Please use a modern browser to properly view this web application !')
        }
    }
  
    /**
     * Store a new settings in the browser
     *
     * @param String name Name of the setting
     * @param String val Value of the setting
     * @returns void
     */
    function store(name, val) {
        if (typeof (Storage) !== 'undefined') {
            localStorage.setItem(name, val)
        } else {
            window.alert('Please use a modern browser to properly view this web application !')
        }
    }
  
    /**
     * Toggles layout classes
     *
     * @param String cls the layout class to toggle
     * @returns void
     */
    function changeLayout(cls) {
        $('body').toggleClass(cls)
        $layout.fixSidebar()
        if ($('body').hasClass('fixed') && cls == 'fixed') {
            $pushMenu.expandOnHover()
            $layout.activate()
        }
        $controlSidebar.fix()
    }
  
    /**
     * Replaces the old skin with the new skin
     * @param String cls the new skin class
     * @returns Boolean false to prevent link's default action
     */
    function changeSkin(cls) {
        $.each(mySkins, function (i) {
            $('body').removeClass(mySkins[i])
        })
  
        $('body').addClass(cls)
        store('skin', cls)
        return false
    }
  
    /**
     * Retrieve default settings and apply them to the template 
     *
     * @returns void
     */
    function setup() {
        var tmp = get('skin')
        if (tmp && $.inArray(tmp, mySkins))
            changeSkin(tmp)
  
        // Add the change skin listener
        $('[data-skin]').on('click', function (e) {
            if ($(this).hasClass('knob'))
                return
            e.preventDefault()
            changeSkin($(this).data('skin'))
        })
  
        // Add the layout manager
        $('[data-layout]').on('click', function () {
            changeLayout($(this).data('layout'))
        })
  
        $('[data-controlsidebar]').on('click', function () {
            changeLayout($(this).data('controlsidebar'))
            var slide = !$controlSidebar.options.slide
  
            $controlSidebar.options.slide = slide
            if (!slide)
                $('.control-sidebar').removeClass('control-sidebar-open')
        })
  
        $('[data-sidebarskin="toggle"]').on('click', function () {
            var $sidebar = $('.control-sidebar')
            if ($sidebar.hasClass('control-sidebar-dark')) {
                $sidebar.removeClass('control-sidebar-dark')
                $sidebar.addClass('control-sidebar-light')
            } else {
                $sidebar.removeClass('control-sidebar-light')
                $sidebar.addClass('control-sidebar-dark')
            }
        })
  
        $('[data-enable="expandOnHover"]').on('click', function () {
            $(this).attr('disabled', true)
            $pushMenu.expandOnHover()
            if (!$('body').hasClass('sidebar-collapse'))
                $('[data-layout="sidebar-collapse"]').click()
        })
  
        //  Reset options
        if ($('body').hasClass('fixed')) {
            $('[data-layout="fixed"]').attr('checked', 'checked')
        }
        if ($('body').hasClass('layout-boxed')) {
            $('[data-layout="layout-boxed"]').attr('checked', 'checked')
        }
        if ($('body').hasClass('sidebar-collapse')) {
            $('[data-layout="sidebar-collapse"]').attr('checked', 'checked')
        }
  
    }
    //----------------------------------------------------------

    
    // Create the new tab
    var $tabPane = $('<div />', {
        'id': 'control-sidebar-theme-demo-options-tab',
        'class': 'tab-pane active'
    })

    // Create the tab button
    var $tabButton = $('<li />', {'class': 'active'})
        .html('<a href=\'#control-sidebar-theme-demo-options-tab\' data-toggle=\'tab\'>'
            + '<i class="fa fa-wrench"></i>'
            + '</a>')

    // Add the tab button to the right sidebar tabs
    $('[href="#control-sidebar-home-tab"]')
        .parent()
        .before($tabButton)

    // Create the menu
    var $demoSettings = $('<div />')

    // Layout options
    $demoSettings.append(
        '<h4 class="control-sidebar-heading">'
        + __('Layout Options')
        + '</h4>'
        // Fixed layout
        + '<div class="form-group">'
        + '<label class="control-sidebar-subheading">'
        + '<input type="checkbox"data-layout="fixed"class="pull-right"/> '
        + __('Fixed layout')
        + '</label>'
        + '<p>'+__('Activate the fixed layout.')+'</p>'
        + '</div>'
        // Boxed layout
        // + '<div class="form-group">'
        // + '<label class="control-sidebar-subheading">'
        // + '<input type="checkbox"data-layout="layout-boxed" class="pull-right"/> '
        // + 'Boxed Layout'
        // + '</label>'
        // + '<p>Activate the boxed layout</p>'
        // + '</div>'
        // Sidebar Toggle
        + '<div class="form-group">'
        + '<label class="control-sidebar-subheading">'
        + '<input type="checkbox"data-layout="sidebar-collapse"class="pull-right"/> '
        + __('Toggle Sidebar')
        + '</label>'
        + '<p>'+__("Toggle the left sidebar's state (open or collapse)")+'</p>'
        + '</div>'
        // Sidebar mini expand on hover toggle
        // + '<div class="form-group">'
        // + '<label class="control-sidebar-subheading">'
        // + '<input type="checkbox"data-enable="expandOnHover"class="pull-right"/> '
        // + 'Sidebar Expand on Hover'
        // + '</label>'
        // + '<p>Let the sidebar mini expand on hover</p>'
        // + '</div>'
        // Control Sidebar Toggle
        + '<div class="form-group">'
        + '<label class="control-sidebar-subheading">'
        + '<input type="checkbox"data-controlsidebar="control-sidebar-open"class="pull-right"/> '
        + __('Toggle Right Sidebar Slide')
        + '</label>'
        + '<p>'+__('Toggle between slide over content and push content effects')+'</p>'
        + '</div>'
        // Control Sidebar Skin Toggle
        + '<div class="form-group">'
        + '<label class="control-sidebar-subheading">'
        + '<input type="checkbox"data-sidebarskin="toggle"class="pull-right"/> '
        + __('Toggle Right Sidebar Skin')
        + '</label>'
        + '<p>'+__('Toggle between dark and light skins for the right sidebar')+'</p>'
        + '</div>'
    )
    var $skinsList = $('<ul />', {'class': 'list-unstyled clearfix'})

    // Dark sidebar skins
    var $skinBlue =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-blue" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Blue')+'</p>')
    $skinsList.append($skinBlue)
    var $skinBlack =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-black" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Black')+'</p>')
    $skinsList.append($skinBlack)
    var $skinPurple =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-purple" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Purple')+'</p>')
    $skinsList.append($skinPurple)
    var $skinGreen =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-green" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Green')+'</p>')
    $skinsList.append($skinGreen)
    var $skinRed =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-red" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Red')+'</p>')
    $skinsList.append($skinRed)
    var $skinYellow =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-yellow" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #222d32"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin">'+__('Yellow')+'</p>')
    $skinsList.append($skinYellow)

    // Light sidebar skins
    var $skinBlueLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-blue-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px; background: #367fa9"></span><span class="bg-light-blue" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Blue Light')+'</p>')
    $skinsList.append($skinBlueLight)
    var $skinBlackLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-black-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div style="box-shadow: 0 0 2px rgba(0,0,0,0.1)" class="clearfix"><span style="display:block; width: 20%; float: left; height: 7px; background: #fefefe"></span><span style="display:block; width: 80%; float: left; height: 7px; background: #fefefe"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Black Light')+'</p>')
    $skinsList.append($skinBlackLight)
    var $skinPurpleLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-purple-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-purple-active"></span><span class="bg-purple" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Purple Light')+'</p>')
    $skinsList.append($skinPurpleLight)
    var $skinGreenLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-green-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-green-active"></span><span class="bg-green" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Green Light')+'</p>')
    $skinsList.append($skinGreenLight)
    var $skinRedLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-red-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-red-active"></span><span class="bg-red" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Red Light')+'</p>')
    $skinsList.append($skinRedLight)
    var $skinYellowLight =
        $('<li />', {style: 'float:left; width: 33.33333%; padding: 5px;'})
            .append('<a href="javascript:void(0)" data-skin="skin-yellow-light" style="display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)" class="clearfix full-opacity-hover">'
                + '<div><span style="display:block; width: 20%; float: left; height: 7px;" class="bg-yellow-active"></span><span class="bg-yellow" style="display:block; width: 80%; float: left; height: 7px;"></span></div>'
                + '<div><span style="display:block; width: 20%; float: left; height: 20px; background: #f9fafc"></span><span style="display:block; width: 80%; float: left; height: 20px; background: #f4f5f7"></span></div>'
                + '</a>'
                + '<p class="text-center no-margin" style="font-size: 12px">'+__('Yellow Light')+'</p>')
    $skinsList.append($skinYellowLight)

    $demoSettings.append('<h4 class="control-sidebar-heading">'+__('Skins')+'</h4>')
    $demoSettings.append($skinsList)

    $tabPane.append($demoSettings)
    $('#control-sidebar-home-tab').after($tabPane)

    $('[data-toggle="tooltip"]').tooltip()

    setup()

    //-----------------------------------------------------------

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
        if(url.href[url.href.length - 1] == '#'){
            return;
        }
        return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
        if(url.href[url.href.length - 1] == '#'){
            return this.href == url.href.slice(0, url.href.length - 1);
        }
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');


    $('.btn-permanently-hide').click(function(){
        swal({
                title: "Coming soon !",
                text: "Cette fonctionnalité est en cours de développement ... \n Elle vous permettra de masquer un enregistrement de maniere permanente.",
                icon: "warning"
            });
    });

    $('.in-dev-info').click(function(){
        swal({
            title: 'Coming soon !',
            text: 'Cette fonctionnalité n\'est pas encore disponible.',
            icon: 'warning'
        });
    });

    $('.btn-add-notation').click(function(){
        swal({
                title: "Coming soon !",
                text: "Cette fonctionnalité est en cours de développement ... \n Elle vous permettra d'ajouter une notation à une commande.",
                icon: "warning"
            });
    });
})