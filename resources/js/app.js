
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// require('./components/Example');

var notifications = [];
var app_url = "https://ubereats.alc-digital.com";
$(document).ready(function(){
    if(window.laravel.userId){
        window.Echo.private(`App.Models.User.${window.laravel.userId}`).notification((notification) => {
            var notif_count = parseInt($('.notif-count').first().text());
            $('.notif-count').text(notif_count+1);
            if(notification.type == "App\\Notifications\\OrderCreated"){
                var newNotificationHtml = `
                <li>
                    <a href="${app_url}/orders/${notification.order.id}?read=${notification.id}">
                        <i class="fa fa-shopping-cart text-aqua"></i>Une nouvelle commande : ${notification.order.number}
                    </a>
                </li>
                `;
                $('.dropdown-menu .menu').prepend(newNotificationHtml);
                $.toast({
                    heading: 'Nouvelle commande',
                    text: 'Numéro de la commande : <a href="'+app_url+'/orders/'+notification.order.id+'?read='+notification.id+'">'+notification.order.number+'</a>',
                    hideAfter: 8000,
                    showHideTransition: 'plain',
                    position: "bottom-right",
                    icon: 'success'
                });
            }else if(notification.type == "App\\Notifications\\RestaurantCreated"){
                var newNotificationHtml = `
                <li class="messages-notif-style">
                    <a href="${app_url}/restaurants/${notification.restaurant.id}?read=${notification.id}">
                      <div class="pull-left">
                        <img src="${app_url}/${notification.restaurant.profile_img}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      ${notification.restaurant.name.substring(0,12)+"..."}
                        <small><i class="fa fa-clock-o"></i> ${moment(notification.restaurant.created_at).fromNow()}</small>
                      </h4>
                      <p>${notification.restaurant.location.substring(0,20)+"..."}</p>
                      <small class="label pull-right bg-green">new restaurant</small>
                    </a>
                  </li>
                `;
                $('.dropdown-menu .menu').prepend(newNotificationHtml);
                $.toast({
                    heading: "Nouveau restaurant crée",
                    text: "Vous avez les droits d'administration sur le restaurant : <a href='"+app_url+"/restaurants/"+notification.restaurant.id+'?read='+notification.id+'>'+notification.restaurant.name+"</a>",
                    hideAfter: 8000,
                    showHideTransition: 'plain',
                    position: "bottom-right",
                    icon: 'success'
                });
            }else if(notification.type == "App\\Notifications\\UserRegistered"){
                var newNotificationHtml = `
                <li class="messages-notif-style">
                    <a href="${app_url}/users/${notification.user.id}?read=${notification.id}">
                      <div class="pull-left">
                        <img src="${app_url}${notification.user.profile_img}" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      ${notification.user.full_name.substring(0,12)+"..."}
                        <small><i class="fa fa-clock-o"></i> ${moment(notification.user.created_at).fromNow()}</small>
                      </h4>
                      <p>${notification.user.location.substring(0,20)+"..."}</p>
                      <small class="label pull-right bg-green">new user</small>
                    </a>
                  </li>
                `;
                $('.dropdown-menu .menu').prepend(newNotificationHtml);
                $.toast({
                    heading: "Nouveau utilisateur",
                    text: "L'utilisateur ' <a href='"+app_url+"/users/"+notification.user.id+'?read='+notification.id+'>'+notification.user.full_name+"</a> ' vient juste de s'inscrire",
                    hideAfter: 8000,
                    showHideTransition: 'plain',
                    position: "bottom-right",
                    icon: 'success',
                });
            }else if(notification.type == "App\\Events\\sendUntakeShipmentNotification"){
              $.toast({
                  heading: 'Untaked shipment',
                  text: 'La livraison relative a la commande <a href="'+app_url+'/orders/'+notification.order.id+'">'+notification.order.number+'</a> n\'a pas été prise en charge',
                  hideAfter: 8000,
                  showHideTransition: 'plain',
                  position: "bottom-right",
                  icon: 'success'
              });
          }
        });
    }
});