## How does the Ubereats Clone API Work ?

### Table of content

- [Users Authentication](#users-authentication)
    - [Registration](#registration)
    - [Login](#login)
    - [Upload and save the user profile](#upload-and-save-the-user-profile)
    - [Get user's Data](#get-users-data)
    - [Update user's Data](#update-users-data)
    - [Logout](#logout)
    - [Reset password](#reset-password)
    - [Onesignal](#onesignal)
    - [Delete user account](#delete-user-account)
- [Users metas](#users-metas)
    - [Get all user's Metas](#get-all-users-metas)
    - [Store user's Meta](#store-users-meta)
    - [Get a specific user's Meta](#get-a-specific-users-meta)
    - [Update a specific user's Meta](#update-a-specific-users-meta)
    - [Delete a specific user's Meta](#delete-a-specific-users-meta)

- [Users orders](#users-orders)
    - [Check Promocode](#check-promocode)
    - [Get all user's Orders](#get-all-users-orders)
    - [Get all user's Orders sorted by status](#get-all-users-orders-sorted-by-status)
    - [Proceed to checkout](#proceed-to-checkout)
    - [Create a new order](#create-a-new-order)
    - [Get a specific user's order](#get-a-specific-users-order)
    - [Get order status](#get-order-status)
    - [Update a specific user's order](#update-a-specific-users-order)
    - [Canceled a specific user's order](#canceled-a-specific-users-order)
    - [Delete a specific user's order](#delete-a-specific-users-order)
    - [About order status](#about-order-status)

- [Cuisines](#cuisines)
    - [Get all cuisines](#get-all-cuisines)

- [Restaurants and items](#restaurants-and-items)
    - [Get all restaurants](#get-all-restaurants)
    - [Get all data of a specific restaurant](#get-all-data-of-a-specific-restaurant)
    - [Get all menus of a specific restaurant](#get-all-menus-of-a-specific-restaurant)
    - [Get restaurants by distances](#get-restaurants-by-distances)
    - [Get all items](#get-all-items)
    - [Get all items sorted by restaurants and cuisines](#get-all-items-sorted-by-restaurants-and-cuisines)
    - [Get all data of a specific item](#get-all-data-of-a-specific-item)
    - [Get items by categories and restaurants](#get-items-by-categories-and-restaurants)
    - [Get items by menus and restaurants](#get-items-by-menus-and-restaurants)
    - [Another usefull links](#another-usefull-links)

- [Notations](#notations)
    - [Get all createria for order or shipping notation](#get-all-createria-for-order-or-shipping-notation)
    - [Create a rating for the order and shipping](#create-a-rating-for-the-order-and-shipping)
    - [Update a specific notation](#update-a-specific-notation)
    - [Get one of my notations](#get-one-of-my-notations)
    - [Get all my notations](#get-all-my-notations)
    - [Delete a specific notations](#delete-a-specific-notations)

- [Payment](#payment)
    - [Get all payment method](#get-all-payment-method)
    - [Stripe Payment](#stripe-payment)

- [Shippings](#shippings)
    - [Get all my shipping](#get-all-my-shipping)
    - [Get shipping by status](#get-shipping-by-status)
        - [First method](#first-method)
        - [Second method](#second-method)
    - [Request to take charge of an expedition](#request-to-take-charge-of-an-expedition)
    - [Get all data of a specific shipping](#get-all-data-of-a-specific-shipping)
    - [Set the status of shipping to "in_progress" or to "done"](#set-the-status-of-shipping-to-in_progress-or-to-done)
    - [About shipping status](#about-shipping-status)
    - [Set / Update Service Zone](#set--update-service-zone)
    - [Toggle shipper Availability](#toggle-shipper-availability)

- [Wallet](#wallet)
    - [Get wallet balance](#get-wallet-balance)
    - [Get wallet transactions](#get-wallet-transactions)

- [Tracking](#tracking)
    - [Set position](#set-position)
    - [Get position](#get-position)

- [Shop API](#shop-api)
    - [Get all shop's orders](#get-all-shops-orders)
    - [Get total orders by status](#get-total-orders-by-status)
    - [Get all data of a specific order](#get-all-data-of-a-specific-order)
    - [Update the status of a specific order](#update-the-status-of-a-specific-order)
    - [Delay an order](#delay-an-order)
    - [Get order position](#get-order-position)
    - [Download order details](#download-order-details)
    - [Get all shop's shippings](#get-all-shops-shippings)
    - [Open / Close shop](#open--close-shop)
    - [Assign the shipment to the shipper](#assign-the-shipment-to-the-shipper)
    - [Search shipper](#search-shipper)
------

### Users Authentication

### Registration

- Url : http://localhost:8000/api/v1/auth/register
- Method : POST

> Headers
```
Content-Type: application/json
X-Requested-With: XMLHttpRequest
```
> Body (example)

```
{
    "first_name" : "hello",
    "last_name" : "test",
    "phone_number": "674565453",
    "gmap_address": "", // Make sure to JSON.stringify(results[0]) before sending the data
    "address_description": "je suis situé en face de ...",
    "email" : "hello@example.com",
    "password" : 12345678
}
```
Note : 
- Une fois le compte crée l'access_token est retourné mais reste non utilisable tant que le compte n'a pas été activé via le lien qui seras envoyé par email.
- Ouvrir sa boite email et suivre le lien reçu. ce lien ouvrira une thankyou page indiquant que le compte a bien été activé. l'access_token retourné lors de l'inscription peut ainsi etre utiliser pour l'authentification.

> Response (example)

```
{
    "success": true,
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjEzZjk5MmZiZDg3NDUzNjBiYWQ1NzZlODBmYzQxMjkzOTBkMzAxZTZjMDZkNmI2NWZhMTdjMzdkMmNiM2YzOWY4NzJkODRlZGQ5ZWEzN2EzIn0.eyJhdWQiOiIxIiwianRpIjoiMTNmOTkyZmJkODc0NTM2MGJhZDU3NmU4MGZjNDEyOTM5MGQzMDFlNmMwNmQ2YjY1ZmExN2MzN2QyY2IzZjM5Zjg3MmQ4NGVkZDllYTM3YTMiLCJpYXQiOjE1NTQ5MDI3OTIsIm5iZiI6MTU1NDkwMjc5MiwiZXhwIjoxNTg2NTI1MTkxLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.d24fh9Z5MslrIM2x6uDtcS3p4txIsDfzyytKEoFURlgSciTgpAKsY42jTVHTp1nRvTurc4-j59HYsGNpgE3nd-G_lUVXsXV_P0bwOW3EbckxfrIHMQc99PQ6Fjhei1-V2xKf-ABHUHyffl8sRbvdsLupNvV3CQFf8YSkGrox1eLU2WXO0ylnroXHhy_4Y0NK50J6DgAdK0TtVw-EuekLq8Mc2RpbyWsvEW6YK2nF7tfHsJSPYaiii1Yn7k8Sqnh26YjlOUH4vh0AIb-1QSkQgutT7rD_s7s-vpYaUcVs7Aag3aB-olm6LdeE8G91zIyKx3hmcC9J1Zaz8XHmqfcFFwEgEvpHoAkzAhyxtu44Th8-s2lGNEpNU_NRBoeLXKSR5WJJIQvCbIGlPaq-bcNCrgOq-QZtFZNM0J2afZTL6xpolr1w99ZUYIzybm4m_bVoDS9aXyepem_P-aZ_IFMB7DMOm5_aIPUMHnZNibplZT0d_pnIIngZkCAz9GlLJoIo7ryxM2pG_cbeD8AvW6TqQtPhyviRYk3dFD4uN6q2haPbNJlyYHaWHux4-m_wFGJnD6J1pD5K-lS-fGDBRBYkQAJS_2CZ9bM784iveFiQgXxSCP3y50rzpirOrxY-Un1gyvUbjqwdv8VTq6e6SZq5A7o8-H5pJkjE5RGv3Cza_J4",
        "name": "hello  test"
    },
    "message": "Your account was successfully created ! But you must connect to your email account and follow the link to confirm this account."
}
```

### Login

- Url: http://localhost:8000/api/v1/auth/login
- Method : POST

> Headers

```
Content-Type: application/json
X-Requested-With: XMLHttpRequest
```
> Body (example)

```
{
    "email" : "guest@example.com",
    "password" : 12345678
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMxMzM4YWVlNmVmNTU1YzAxMjVjNDFjNDJiNTYzNzNkOTEzYWZhMTljZTMwZGU3NGEyNGUwMTc0Mzk3YmJhMTZhNjQ4MmVjZDU4MTFmODYwIn0.eyJhdWQiOiIxIiwianRpIjoiMzEzMzhhZWU2ZWY1NTVjMDEyNWM0MWM0MmI1NjM3M2Q5MTNhZmExOWNlMzBkZTc0YTI0ZTAxNzQzOTdiYmExNmE2NDgyZWNkNTgxMWY4NjAiLCJpYXQiOjE1NTQ5NzYzODYsIm5iZiI6MTU1NDk3NjM4NiwiZXhwIjoxNTg2NTk4Nzg2LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.TIMU5-F7_83UAhYBG0HuZTM8Xj7vxIkPIYH09TcMVUwAzx0oovoHfpXKYWWfKu89rqzMSEYC2SpUZfXljHXN5X8BmIx0mp176nRTMvYnopb3vj1UI6HI30BTgiKml7AtDNjoyacVGBgB8iJHusmT3odqfq5ENnEf75W08l0mst3SMTzoATeLj3-k21Hq3Pnt3FKmrVCGNKL8x5A1ZaMcOwlh3GupMhjGJoM8jwhjz2REDJffhq35OaoM-4ClM7fKIbYuW1ty1ICSEdUpSdDKvfMqzAQ4cE5L1-EpFHoGvQhyGllsu0Mgje3dEIwzmqWL1hoCb4nQS7mwSfFa9KuJ1EqL73r5tWyjmfVS-0K72L0PBq1oMWWc4101tX1K-3rxMJeR8kMwvkgtKTvRrNuhZ3Rr6KaZRI4ubqwqEcyMs1AGPejrkzBTPnNKhlrrrLBddQ6QzBO8uPWfOnmWeli0UwRbLShUKpVs2PAtMjFcRQL44-2xxOAZR5DhdFpVxbdpgpRitInqAxoMLilDCFVNw2-AvQkyohPrRiINQrKczUv7xBtOrlnxU1MpcHNMIf8rtqeNeIZIVxAPgjegJyZSZHG9jF-HUKraYS3SD3dd83LJDO4A6Sm935pzyKDAE_jprvyvIpU3Qoszfmx-Y3N_QtFEvewgK_BqDPkIKRcZ2RM",
        "token_type": "Bearer",
        "expires_at": "2020-04-11 09:53:06"
    },
    "message": "User successfully logged in !"
}
```
### Upload and save the user profile

- Url : http://localhost:8000/api/v1/file/upload
- Method: POST
  
> Headers
```
    "Authorization" : "Bearer [follow by the value of access_token]"
```

Note: Image must be converted in base64
> Body
```
{
    "profile_img": xxxxxxxxxxxxxxxxxxx_img_in_base64_xxxxxxxxxxxxxxxxxxxxxxxx"
}
```

> Response
```
{
    "success": true,
    "data": {
        "id": 3,
        "first_name": "guest",
        "last_name": "simple",
        "email": "guest@example.com",
        "address": null,
        "phone_number": 12345679,
        "created_at": "2019-03-22 12:32:01",
        "updated_at": "2019-03-26 12:07:58",
        "email_verified_at": null,
        "is_enable": 1,
        "profile_img": "/storage/users/3/10/5c9a1616f312a_yemi-alade-forbes.jpg",
        "avatar": "/storage/users/4/avatar.png"
    },
    "message": "Your profile was successfull saved"
}
```

### Get user's Data

- Url : http://localhost:8000/api/v1/auth/user
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response (example) 
```
{
    "success": true,
    "data": {
        "id": 3,
        "first_name": "guest",
        "last_name": "simple",
        "email": "guest@example.com",
        "address": null,
        "phone_number": 12345679,
        "created_at": "2019-03-22 12:32:01",
        "updated_at": "2019-03-26 12:07:58",
        "email_verified_at": null,
        "is_enable": 1,
        "profile_img": "/storage/users/3/10/5c9a1616f312a_yemi-alade-forbes.jpg",
        "avatar": "/storage/users/4/avatar.png"
    },
    "message": "All details of the authenticated User"
}
```

### Update user's Data

- Url : http://localhost:8000/api/v1/auth/update
- Method : PUT

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```
> Body (example)

```
{
    "first_name" : "hello2",
    "last_name" : "test2",
    "phone_number": "674565453",
    "gmap_address": "", // Make sure to JSON.stringify(results[0]) before sending the data,
    "address_description": " ",
    "email" : "hello@example.com",
    "new_password": "11122233", // This is require if you want to update the password
    "password": "12345678" // This is require to update the profile
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 4,
        "first_name": "hello2",
        "last_name": "test2",
        "email": "hello@example.com",
        "address": "Bonamoussadi, bloc 12",
        "phone_number": "674565453",
        "created_at": "2019-04-10 13:26:27",
        "updated_at": "2019-04-30 09:49:30",
        "email_verified_at": null,
        "is_enable": 1,
        "active": 1,
        "deleted_at": null,
        "profile_img": "/storage/users/4/avatar.png",
        "media_links": [],
        "avatar": "/storage/users/4/avatar.png"
    },
    "message": "Your account was successfully updated !"
}
```

### Logout

- Url : http://localhost:8000/api/v1/auth/logout
- Method : GET

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response (example) 
```
"message" : "Successfully logged out !"
```

### Reset password

---> First step

- Url : http://localhost:8000/api/v1/auth/password/create
- Method : POST

> Headers
```
Content-Type : application/json
X-Requested-With: XMLHttpRequest
```

> Body
```
{
	"email": "hello@example.com"
}
```

> Response
```
{
    "message": "We have e-mailed your password reset link!"
}
```

---> Second step \

Lorsque l'utilisateur ouvre sa boite mail, il verra le lien ci dessous. Il faudra alors qu'il clique dessus et l'ouvre avec l'application Ubereats clone et non avec le navigateur. L'ouverture du lien à partir de cet e-mail mènera à un formulaire de réinitialisation du mot de passe sur l'application qui utilise le jeton de réinitialisation du mot de passe du lien comme entrée pour un champ de saisie masqué (le jeton fait partie du lien en tant que chaîne de requête). Un autre champ de saisie permet à l'utilisateur de définir un nouveau mot de passe. Une deuxième entrée pour confirmer le nouveau mot de passe sera utilisée pour la validation en amont (pour éviter les fautes de frappe).

- Url : http://localhost:8000/api/v1/auth/password/find/McNy9KCeIJsahMKk0isNoFp9lYaIngEANPBdWQoOqu6O27BukuoC7ED4NF74
- Method : GET

> Response
```
{
    "success": true,
    "data": {
        "id": 1,
        "email": "hello@example.com",
        "token": "McNy9KCeIJsahMKk0isNoFp9lYaIngEANPBdWQoOqu6O27BukuoC7ED4NF74",
        "created_at": "2019-04-24 10:37:34",
        "updated_at": "2019-04-24 10:37:34"
    },
    "message": "Password reset data"
}
```

---> Third step \

- Url : http://localhost:8000/api/v1/auth/password/reset
- Method : POST

> Headers
```
Content-Type : application/json
X-Requested-With: XMLHttpRequest
```

Une fois le nouveau mot de passe valider, l'user recevra un mail de confirmation. ["... You are changed your password succeful. ! ..."]
> Body
```
{
	"token": "McNy9KCeIJsahMKk0isNoFp9lYaIngEANPBdWQoOqu6O27BukuoC7ED4NF74",
	"email": "hello@example.com",
	"password": "12345678"
}
```

> Response
```
{
    "success": true,
    "data": {
        "id": 4,
        "first_name": "hello",
        "last_name": "test",
        "email": "hello@example.com",
        "address": null,
        "phone_number": 78787878,
        "created_at": "2019-04-10 13:26:27",
        "updated_at": "2019-04-24 14:36:49",
        "email_verified_at": null,
        "is_enable": 1,
        "active": 1,
        "deleted_at": null,
        "profile_img": "/storage/users/4/avatar.png",
        "media_links": [],
        "avatar": "/storage/users/4/avatar.png"
    },
    "message": "All user data"
}
```

### Onesignal

- Url : http://localhost:8000/api/v1/auth/onesignal
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```

> Body (example)

```
{
	"player_id": "ec3af189-5257-4f1c-8d27-f238d078dcca"
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "player_id": "ec3af189-5257-4f1c-8d27-f238d078dcca"
    },
    "message": "Your player_id was saved"
}
```

### Delete user account

- Url : http://localhost:8000/api/v1/auth/delete
- Method : Delete

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```
> Body (example)

```
{
    "password" : 12345678, // This line is require
}
```

> Response (example)

```


```

### Users metas

### Get all user's Metas

- Url : http://localhost:8000/api/v1/metas
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
Notes : 
- Retourne tous les "metas" de l'utilisateur
- Il doit d'abord etre connecté

> Response (example)

```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "key": "theme",
            "value": "blue",
            "updated_at": "2019-04-11 14:22:43",
            "created_at": "2019-04-11 14:22:43"
        }
    ],
    "message": "Metas retrieved successfully."
}
```

### Store user's Meta

- Url : http://localhost:8000/api/v1/metas
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```

> Body (example)

```
{
    "key": "theme",
    "value": "blue"
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "key": "theme",
        "value": "blue",
        "updated_at": "2019-04-11 14:22:43",
        "created_at": "2019-04-11 14:22:43",
        "id": 2
    },
    "message": "Meta created successfully."
}
```

### Get a specific user's Meta

- Url : http://localhost:8000/api/v1/metas/{key}
- Method : GET
- Url (example) : http://localhost:8000/api/v1/metas/theme

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 2,
        "key": "theme",
        "value": "blue",
        "created_at": "2019-04-11 14:22:43",
        "updated_at": "2019-04-11 15:03:45"
    },
    "message": "Meta retrieved successfully."
}
```

### Update a specific user's Meta

- Url : http://localhost:8000/api/v1/metas/{key}
- Method : PUT

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

- Url (example) : http://localhost:8000/api/v1/metas/theme

> Body (example)

```
{
    "value": "red"
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 2,
        "key": "theme",
        "value": "red",
        "created_at": "2019-04-11 14:22:43",
        "updated_at": "2019-04-11 15:03:45"
    },
    "message": "Meta updated successfully."
}
```

### Delete a specific user's Meta

- Url : http://localhost:8000/api/v1/metas/{key}
- Method : DELETE

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
- Url (example) : http://localhost:8000/api/v1/metas/theme

> Response (example)

```
{
    "success": true,
    "message": "Meta deleted successfully."
}
```

### Users orders

### Check Promocode

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
- Url (example) : http://localhost:8000/api/v1/promocodes/TRHV-FNBU/check
- Method : GET

Note : Ceci ne s'applique pas à la commande. Elle sert juste à verifier la validité du code coupon

> Response (example) : Success case 1
```
{
    "success": true,
    "data": {
        "code": "TRHV-FNBU",
        "discount_type": "percent",
        "discount_percent": "20%",
        "restaurant_id": 18,
        "response_code": 4
    },
    "message": "This coupon code is valid !"
}
```
> URL (example) : http://localhost:8000/api/v1/promocodes/HPMH-HYDA/check

> Response (example) : Success case 2
```
{
    "success": true,
    "data": {
        "code": "HPMH-HYDA",
        "discount_type": "amount",
        "discount_amount": "500",
        "currency": "fcfa",
        "restaurant_id": 18,
        "response_code": 4
    },
    "message": "This coupon code is valid !"
}
```

> Response (example) : Error case 1
```
{
    "success": false,
    "message": "Invalid promotion code : This promode code is expired or the offer is no longer valid",
    "data": {
        "response_code": 2
    }
}
```

> Response (example) : Error case 2
```
{
    "success": false,
    "message": "Invalid promotion code. This promode code does not exit",
    "data": {
        "response_code": 1
    }
}
```
> Response (example) : Error case 3
```
{
    "success": false,
    "message": "Promotion code is already used by current user.",
    "data": {
        "response_code": 3
    }
}
```
> Response (example) : Error case 4
```
{
    "success": false
    "message": "limit user reached"
    "data": {
        "limited_user": "0"
        "response_code": 5
    }
}
```
### Get all user's Orders

- Url : http://localhost:8000/api/v1/orders
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body
```
{
	"is_merchant": 0
}
```

> Response (example when we define pagination to 2)

```
{
    "current_page": 1,
    "data": [
        {
            "id": 18,
            "number": "#00018b",
            "created_at": "2019-04-29 12:57:01",
            "updated_at": "2019-04-29 12:57:01",
            "comment": "Test du number - un commentaire, lorem ipsum dolar",
            "restaurant_id": 2,
            "restaurant": {
                "id": 2,
                "name": "tchopetyamo2",
                "description" : "lorem ipsum dolar ...",
                "address": "dokoti, bloc 7",
                "is_merchant": false,
                "longitude": 1259.04,
                "latitude": 1399.05,
                "created_at": "2019-03-22 12:32:01",
                "updated_at": "2019-04-01 13:40:05",
                "deleted_at": null,
                "deliveries_time": "10mm - 15mm",
                "address_description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                "profile_img": "/storage//restaurants/2/14/5c9e1aaeaa2b3_restaurant-5.jpg",
                "media_links": [
                    "storage/restaurants/2/14/5c9e1aaeaa2b3_restaurant-5.jpg",
                    "storage/restaurants/2/15/5c9e1ab372ee7_restaurant-4.jpg",
                    "storage/restaurants/2/16/5c9e1adef2198_restaurant-1.jpg"
                ]
            },
            "status": "pending",
            "deleted_at": null,
            "restaurant_name": "tchopetyamo2",
            "total": 1900,
            "order_lines": [
                {
                    "id": 20,
                    "quantity": 1,
                    "order_id": 18,
                    "item_id": 4,
                    "subtotal": 700,
                    "item": {
                        "id": 4,
                        "name": "taro",
                        "price": 700,
                        "old_price": null,
                        "description": "lorem",
                        "preparation_time": 78,
                        "created_at": "2019-04-05 14:37:39",
                        "updated_at": "2019-04-05 14:37:39",
                        "available": null,
                        "display": 1,
                        "cuisine_id": 1,
                        "restaurant_id": 2,
                        "category_id": 2,
                        "media_links": [
                            "storage/items/4/18/5cb827809b65e_taro.jpg"
                        ]
                    }
                },...
                .
                .
                .
    ],
    "first_page_url": "http://localhost:8000/api/v1/orders?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/orders?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/orders",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 2,
    "success": true,
    "message": "Orders retrieved successfully."
}
```

### Get all user's Orders sorted by status

- Url : http://localhost:8000/api/v1/status/orders
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url (exemple) : 
- http://localhost:8000/api/v1/status/orders

> Note :
- Please to see all status you can use, click [here](#about-order-status)
- If you want to filter result by "type" you must add "is_merchant" param .set the value of "is_merchant" to "0" if it's restaurant and to "1" if it's "merchant"

> Body (example)

```
{
    "status" : ["confirmed","canceled"],
    "is_merchant": 1
}
```

> Response (example)

```
{
    "current_page": 1,
    "data": [
        {
            "id": 25,
            "number": "#00025n",
            "comment": "un commentaire, lorem ipsum dolar",
            "coupon_data": null,
            "restaurant_id": 1,
            "status": "canceled",
            "ready_at": null,
            "created_at": "2019-06-18 09:02:56",
            "updated_at": "2019-07-12 10:26:58",
            "deleted_at": null,
            "total": 850,
            "total_to_pay": 1350,
            "reduction": 0,
            "restaurant": {
                "id": 1,
                "name": "Rosty",
                "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                "is_merchant": false,
                "created_at": "2019-03-22 12:32:01",
                "updated_at": "2019-07-11 10:15:54",
                "deleted_at": null,
                "deliveries_time": "01:05",
                "profile_img": "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                "media_links": [
                    "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                    "storage/restaurants/1/27/5ccfe963e270a_restaurant_le_prom.jpg",
                    "storage/restaurants/1/28/5cd04f893703c_ppr-oiseau-blanc-interior-evening-1074.jpg"
                ],
                "location": "Boulevard de la Liberté, Douala, Cameroun",
                "country_name": "Cameroun",
                "city_name": "Douala",
                "address": {
                    "id": 6,
                    "description": "une desc",
                    "model_id": 1,
                    "model_type": "App\\Models\\Restaurant",
                    "gmap_address": {
                        "address_components": [
                            {
                                "long_name": "Boulevard de la Liberté",
                                "short_name": "Boulevard de la Liberté",
                                "types": [
                                    "route"
                                    ....
                                    .
                                    .
                                    .
```

### Proceed to checkout

- Url : http://localhost:8000/api/v1/checkout
- Method : POST

> Headers

```
Content-Type: application/json
```

> Body
```
{
    "restaurant" : {
        "restaurant_id" : 2,
        "data" : [
            {
                "items" : {
                    "id": 41
                },
                "quantity" : 2,
                "comment": "un commentaire, lorem ipsum dolar"
            }
        ]
    }
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "restaurant_id": 2,
        "order_lines": [
            {
                "item_id": 41,
                "item_price": 4500,
                "quantity": 2,
                "comment": "un commentaire, lorem ipsum dolar",
                "is_available": true,
                "item_name": "Ndole"
            }
        ]
    },
    "message": "Checkout : Response !"
}
```

### Create a new order

- Url : http://localhost:8000/api/v1/orders
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```
> Note :

- Si l'une des propriétés "phone_number", "email" et "gmap_address" du "shipping_data" est absente, la propriété "recipient" de l'objet "order" retourné sera null et on considèrera dans ce cas que le recepteur est l'user ayant passer la commande

> Body (example)

```
{
    "restaurant" : {
        "restaurant_id" : 18, // required
        "data" : [ // required
            {
                "items" : {
                    "id": 9 // required
                },
                "quantity" : 2, // required
                "comment": "un commentaire, lorem ipsum dolar"
            },
            {
                "items" : {
                    "id": 8
                },
                "quantity" : 2,
                "comment": "un commentaire, lorem ipsum dolar"
            }
        ]
    },
    "shipping_data" : {
        "phone_number": "12345678", // optional
        "email": "paul@gmail.com", // optional
        "name": "jean paul", // optional
        "gmap_address": {
            "foo": "bar"
        }, // required
        "address_description" : "une description",
        "planned_at" : "" // format : 'd/m/Y H:i:s'
    },
    "coupon_code" : [ // optional
        "TRHV-FNBU"
        ],
    "payment_data": {
        "amount_paid" : 3000
        "payment_method_id" : "1",
        "payment_id": "tnhd-sdnf-dskjn-iuop-kcdd",
        "meta" : {
        	"foo": "bar"
        }
    }
}
```
Note : Get all payment methods [here](#get-all-payment-method)

> Response (example)

```
{
    "success": true,
    "message": "Orders created successfully."
}
```

### Get a specific user's order

- Url : http://localhost:8000/api/v1/orders/{id}
- Method : GET

- Url (example) : http://localhost:8000/api/v1/orders/15

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 15,
        "number": null,
        "shipping_id": null,
        "created_at": "2019-04-12 09:50:50",
        "updated_at": "2019-04-12 09:50:50",
        "comment": "un commentaire, lorem ipsum dolar",
        "restaurant_id": 1,
        "restaurant": {
            "id": 1,
            "name": "rosty2",
            "address": "bonamoussadi, bloc 11",
            "is_merchant": false,
            "longitude": 1599.05,
            "latitude": 1500.6,
            "created_at": "2019-03-22 12:32:01",
            "updated_at": "2019-05-06 07:09:01",
            "deleted_at": null,
            "deliveries_time": "10mm - 20mm",
            "address_description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae !",
            "profile_img": "/storage//restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
            "media_links": [
                "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                "storage/restaurants/1/27/5ccfe963e270a_restaurant_le_prom.jpg",
                "storage/restaurants/1/28/5cd04f893703c_ppr-oiseau-blanc-interior-evening-1074.jpg"
            ]
        },
        "status": "pending",
        "order_lines": [
            {
                "order_id": 15,
                "id": 5,
                "quantity": 1,
                "item_id": 4,
                "subtotal": 700,
                "item": {
                        "id": 4,
                        "name": "taro",
                        "price": 700,
                        "old_price": null,
                        "description": "lorem",
                        "preparation_time": 78,
                        "created_at": "2019-04-05 14:37:39",
                        "updated_at": "2019-04-05 14:37:39",
                        "available": null,
                        "display": 1,
                        "cuisine_id": 1,
                        "restaurant_id": 2,
                        "category_id": 2,
                        "media_links": [
                            "storage/items/4/18/5cb827809b65e_taro.jpg"
                        ]
                    }
            },
            {
                "order_id": 15,
                "id": 6,
                "quantity": 1,
                "item_id": 5,
                "subtotal": 500,
                "item": {
                        "id": 5,
                        "name": "glasse",
                        "price": 500,
                        "old_price": null,
                        "description": "lorem lorem",
                        "preparation_time": 10,
                        "created_at": "2019-04-06 12:09:16",
                        "updated_at": "2019-04-06 12:09:16",
                        "available": 1,
                        "display": 1,
                        "cuisine_id": 2,
                        "restaurant_id": 1,
                        "category_id": 1,
                        "media_links": []
                    }
            }
        ],
        "total": 1200
    },
    "message": "Order retrieved successfully."
}
```
### Get order status

- Url : http://localhost:8000/api/v1/status/order/{order_id}
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```
- See all order status [here](#about-order-status)

- Url (example) : http://localhost:8000/api/v1/status/order/2

> Response

```
{
    "success": true,
    "order_status": "ready",
    "message": "Order status successfully retrieved"
}
```

### Update a specific user's order

- Url : http://localhost:8000/api/v1/orders/{id}
- Method : PUT

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```

- Url (example) : http://localhost:8000/api/v1/orders/15

> Body (example)

```
{
    "comment": "Modifions ce commentaire, lorem ipsum dolar",
    "order_lines": [
        {
            "id": 8,
            "item_id": 4,
            "quantity": 2
        },
        {
            "id": 9,
            "item_id": 5,
            "quantity": 3
        }
    ]
}
```

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 15,
        "number": null,
        "created_at": "2019-04-12 09:50:50",
        "updated_at": "2019-04-12 09:50:50",
        "comment": "Modifions ce commentaire, lorem ipsum dolar",
        "restaurant_id": 1,
        "status": "pending",
        "order_lines": [
            {
                "order_id": 15,
                "id": 8,
                "quantity": 2,
                "item_id": 4,
                "subtotal": 1400,
                "item": {
                        "id": 4,
                        "name": "taro",
                        "price": 700,
                        "old_price": null,
                        "description": "lorem",
                        "preparation_time": 78,
                        "created_at": "2019-04-05 14:37:39",
                        "updated_at": "2019-04-05 14:37:39",
                        "available": null,
                        "display": 1,
                        "cuisine_id": 1,
                        "restaurant_id": 2,
                        "category_id": 2,
                        "media_links": [
                            "storage/items/4/18/5cb827809b65e_taro.jpg"
                        ]
                    }
            },
            {
                "order_id": 15,
                "id": 9,
                "quantity": 3,
                "item_id": 5,
                "subtotal": 1500,
                "item": {
                        "id": 5,
                        "name": "glasse",
                        "price": 500,
                        "old_price": null,
                        "description": "lorem lorem",
                        "preparation_time": 10,
                        "created_at": "2019-04-06 12:09:16",
                        "updated_at": "2019-04-06 12:09:16",
                        "available": 1,
                        "display": 1,
                        "cuisine_id": 2,
                        "restaurant_id": 1,
                        "category_id": 1,
                        "media_links": []
                    }
            }
        ],
        "total": 2900
    },
    "message": "Order created successfully."
}
```

### Canceled a specific user's order

- Url : http://localhost:8000/api/v1/orders/{id}
- Method : PUT

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
- Url (example) : http://localhost:8000/api/v1/orders/15
- Note : Un utilisateur ne peut annuler la commande que lorsqu'il a le status "pending"

> Body

```
{
    "status": "canceled"
}
```

> Response (example)

```
{
    "success": true,
    "message": "Order canceled successfully."
}
```

### Delete a specific user's order

- Url : http://localhost:8000/api/v1/orders/{id}
- Method : DELETE

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
- Url (example) : http://localhost:8000/api/v1/orders/15

> Response (example)

```
{
    "success": true,
    "message": "Oreder deleted successfully."
}
```

### About order status

- Order status : 
    - pending,
    - canceled, (Losrque la commande est rejetée par le shop-admin ou Lorsque l'user annule sa commande)
    - confirmed (Lorsque le shop-admin approuve la commande - autremant dit il est d'accord de la prendre en charge)
    - ready (Lorsque la commande est prete et n'attends qu'a etre prise par livreur)
    - in_shipment
    - shipped (when the shipper say "done" with  shipper-app)

### Cuisines

### Get all cuisines

- Url : http://localhost:8000/api/v1/cuisines
- Method : GET

> Response (example)

```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "camerounaise"
        },
        {
            "id": 2,
            "name": "americaine"
        }
    ],
    "message": "All Cuisines retrieved successfully."
}
```

### Restaurants and items

### Get all restaurants

- Url : http://localhost:8000/api/v1/restaurants
- Method : GET

> Response (example when we define pagination to 2)

```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "rosty2",
            "description" : "lorem ipsum dolar ...",
            "address": "bonamoussadi, bloc 11",
            "is_merchant": false,
            "longitude": 1599.05,
            "latitude": 1500.6,
            "created_at": "2019-03-22 12:32:01",
            "updated_at": "2019-05-06 07:09:01",
            "deliveries_time": "10mm - 20mm",
            "location": "Cameroon, Ngaoundere",
            "country_name": "Cameroon",
            "city_name": "Ngaoundere",
            "address": {
                "id": 6,
                "country_id": 37,
                "status_id": 653,
                "city_id": 10015,
                "district": "rue",
                "description": "la montée allant vers l'école...",
                "postal_code": null,
                "longitude": null,
                "latitude": null,
                "model_id": 1,
                "model_type": "App\\Models\\Restaurant",
                "created_at": "2019-07-03 14:46:37",
                "updated_at": "2019-07-03 14:46:37",
                "country": {
                    "id": 37,
                    "code": "CM",
                    "name": "Cameroon",
                    "phonecode": 237
                },
                "city": {
                    "id": 10015,
                    "name": "Ngaoundere",
                    "status_id": 653
                }
            }
            "profile_img": "/storage//restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
            "media_links": [
                "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                "storage/restaurants/1/27/5ccfe963e270a_restaurant_le_prom.jpg"
            ],
            "cuisines": [
                {
                    "id": 1,
                    "name": "camerounaise",
                    "pivot": {
                        "restaurant_id": 1,
                        "cuisine_id": 1
                    }
                },
                {
                    "id": 2,
                    "name": "americaine",
                    "pivot": {
                        "restaurant_id": 1,
                        "cuisine_id": 2
                    }
                }
            ],
            "programmes": [
                {
                    "id": 3,
                    "day_id": 1,
                    "open_time": "06:00:00",
                    "close_time": "16:00:00",
                    "restaurant_id": 1
                },
                {
                    "id": 4,
                    "day_id": 2,
                    "open_time": "07:15:00",
                    "close_time": "17:00:00",
                    "restaurant_id": 1
                },
                {
                    "id": 9,
                    "day_id": 3,
                    "open_time": "06:30:00",
                    "close_time": "15:30:00",
                    "restaurant_id": 1
                }
            ]
        },
        ...
        .
        .
    ],
    "first_page_url": "http://localhost:8000/api/v1/restaurants?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://localhost:8000/api/v1/restaurants?page=2",
    "next_page_url": "http://localhost:8000/api/v1/restaurants?page=2",
    "path": "http://localhost:8000/api/v1/restaurants",
    "per_page": 2,
    "prev_page_url": null,
    "to": 2,
    "total": 4,
    "success": true,
    "message": "Restaurants retrieved successfully"
}
```

### Get all data of a specific restaurant

- Url : http://localhost:8000/api/v1/restaurants/{id}
- Method : GET
- Url(example) : http://localhost:8000/api/v1/restaurants/2

> Response (example)

```
{
    "success": true,
    "data": {
                "id": 2,
                "name": "tchopetyamo",
                "description" : "lorem ipsum dolar ...",
                "address": "dokoti, bloc 7",
                "is_merchant": false,
                "longitude": 1259.04,
                "latitude": 1399.05,
                "created_at": "2019-03-22 12:32:01",
                "updated_at": "2019-04-01 13:40:05",
                "deliveries_time": "10mm - 15mm",
                "address_description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                "profile_img": "/storage/restaurants/2/14/5c9e1aaeaa2b3_restaurant-5.jpg",
                "media_links": [
                    "storage/restaurants/2/14/5c9e1aaeaa2b3_restaurant-5.jpg",
                    "storage/restaurants/2/15/5c9e1ab372ee7_restaurant-4.jpg",
                    "storage/restaurants/2/16/5c9e1adef2198_restaurant-1.jpg"
                ],
                "cuisines": [
                    {
                        "id": 2,
                        "name": "americaine",
                        "pivot": {
                            "restaurant_id": 2,
                            "cuisine_id": 2
                        }
                    }
                ],
              "programmes": [
                {
                    "id": 6,
                    "day_id": 1,
                    "open_time": "06:00:00",
                    "close_time": "16:00:00",
                    "restaurant_id": 2
                },
                {
                    "id": 7,
                    "day_id": 2,
                    "open_time": "07:15:00",
                    "close_time": "17:00:00",
                    "restaurant_id": 2
                },
                {
                    "id": 8,
                    "day_id": 3,
                    "open_time": "06:30:00",
                    "close_time": "15:30:00",
                    "restaurant_id": 2
                }
            ]
            },
    "message": "Restaurant retrieved successfuly"
}
```
### Get all menus of a specific restaurant

- Url : http://localhost:8000/api/v1/restaurants/{restaurant}/menus
- Method : GET

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 3,
            "name": "dinner",
            "restaurant_id": 2
        },
        {
            "id": 4,
            "name": "lunch",
            "restaurant_id": 2
        },
        ...
        .
        .

```

### Get all categories of a specific restaurant

- Url : http://localhost:8000/api/v1/restaurants/{restaurant}/categories
- Method : GET

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 3,
            "name": "desserts",
            "restaurant_id": 2
        },
        {
            "id": 4,
            "name": "entrees",
            "restaurant_id": 2
        },
        ...
        .
        .

```

### Get restaurants by distances

- Url : http://localhost:8000/api/v1/distances/restaurants
- Method : POST

- Notes : La pagination n'est pas encore disponible dans ce cas.

> Body [ example ]

> Note: If you want to filter result by "type" you must add "is_merchant" param .set the value of "is_merchant" to "0" if it's restaurant and to "1" if it's "merchant"

```
{
    "user_latitude" : 48.86417880,
    "user_longitude" : 2.34250440
}
```

> Response [ example ]

```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Rosty",
            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
            "is_merchant": false,
            "created_at": "2019-03-22 12:32:01",
            "updated_at": "2019-07-11 10:15:54",
            "deleted_at": null,
            "deliveries_time": "01:05",
            "located_at": 0,
            "profile_img": "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
            "media_links": [
                "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                "storage/restaurants/1/27/5ccfe963e270a_restaurant_le_prom.jpg",
                "storage/restaurants/1/28/5cd04f893703c_ppr-oiseau-blanc-interior-evening-1074.jpg"
            ],
            "location": "Boulevard de la Liberté, Douala, Cameroun",
            "country_name": "Cameroun",
            "city_name": "Douala",
            "cuisines": [
                {
                    "id": 1,
                    "name": "Camerounaise",
                    "pivot": {
                        "restaurant_id": 1,
                        "cuisine_id": 1
                    }
                },
                {
                    "id": 2,
                    "name": "Americaine",
                    "pivot": {
                        "restaurant_id": 1,
                        "cuisine_id": 2
                    }
                }
            ],
            "programmes": [
                {
                    "id": 3,
                    "day_id": 1,
                    "open_time": "06:00:00",
                    "close_time": "16:00:00",
                    "restaurant_id": 1
                },
                {
                    "id": 4,
                    "day_id": 2,
                    "open_time": "07:15:00",
                    "close_time": "17:00:00",
                    "restaurant_id": 1
                },
                {
                    "id": 9,
                    "day_id": 3,
                    "open_time": "06:30:00",
                    "close_time": "15:30:00",
                    "restaurant_id": 1
                }
            ],
            "notations": [],
            "address": {
                "id": 6,
                "description": "une desc",
                "model_id": 1,
                "model_type": "App\\Models\\Restaurant",
                "gmap_address": {
                    "address_components": [
                        {
                            "long_name": "Boulevard de la Liberté",
                            "short_name": "Boulevard de la Liberté",
                            "types": [
                                "route"
                            ]
                        },
                        {
                            "long_name": "Akwa I",
                            "short_name": "Akwa I",
                            "types": [
                                "political",
                                "sublocality",
                                "sublocality_level_1"
                            ]
                        },
                        {
                            "long_name": "Douala",
                            "short_name": "Douala",
                            "types": [
                                "locality",
                                "political"
                            ]
                        },
                        {
                            "long_name": "Wouri",
                            "short_name": "Wouri",
                            "types": [
                                "administrative_area_level_2",
                                "political"
                            ]
                        },
                        {
                            "long_name": "Région du Littoral",
                            "short_name": "Région du Littoral",
                            "types": [
                                "administrative_area_level_1",
                                "political"
                            ]
                        },
                        {
                            "long_name": "Cameroun",
                            "short_name": "CM",
                            "types": [
                                "country",
                                "political"
                            ]
                        }
                    ],
                    "formatted_address": "Boulevard de la Liberté, Douala, Cameroun",
                    "geometry": {
                        "bounds": {
                            "south": 4.0480607,
                            "west": 9.694293000000016,
                            "north": 4.0486447,
                            "east": 9.694518700000003
                        },
                        "location": {
                            "lat": 4.0483515,
                            "lng": 9.69440910000003
                        },
                        "location_type": "GEOMETRIC_CENTER",
                        "viewport": {
                            "south": 4.047003719708497,
                            "west": 9.693056869708471,
                            "north": 4.049701680291502,
                            "east": 9.695754830291435
                        }
                    },
                    "place_id": "ChIJwUx8lvYSYRARomqM6GNiprI",
                    "types": [
                        "route"
                    ]
                },
                "created_at": "2019-07-03 14:46:37",
                "updated_at": "2019-07-11 10:15:54"
            }
        },
        ...
        .
        .
    ],
    "message": "Liste des restaurants se trouvant a une distance inférieur ou égale à 597.833 km"
}
```

### Get all items

- Url : http://localhost:8000/api/v1/items
- Method : GET

> Response (example when we define pagination to 2)

```
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Koki",
            "price": 500,
            "old_price": null,
            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
            "preparation_time": "00:00",
            "created_at": "22-03-2019 à 12:39",
            "updated_at": "14-05-2019 à 13:51",
            "is_available": true,
            "cuisine_id": 1,
            "restaurant_id": 1,
            "category_id": 2,
            "menu_id": 1,
            "profile_img": "storage/items/1/33/5cdbef81adf15_koki.jpg",
            "media_links": [
                "storage/items/1/33/5cdbef81adf15_koki.jpg"
            ],
            "supplements_details": [
                {
                    "category": {
                        "id": 4,
                        "name": "Boissons"
                    },
                    "required": true,
                    "items": [
                        {
                            "id": 2,
                            "name": "Café",
                            "price": 150,
                            "old_price": null,
                            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                            "preparation_time": "00:00",
                            "created_at": "22-03-2019 à 12:39",
                            "updated_at": "03-05-2019 à 11:14",
                            "is_available": false,
                            "cuisine_id": 2,
                            "restaurant_id": 1,
                            "category_id": 4,
                            "menu_id": null,
                            "profile_img": "storage/items/2/19/5cb827b654b0f_cafe_du_jeudi.jpg",
                            "media_links": [
                                "storage/items/2/19/5cb827b654b0f_cafe_du_jeudi.jpg"
                            ],
                            "supplements_details": [],
                            "pivot": {
                                "item_id": 1,
                                "supplement_id": 2
                            },
                            "category": {
                                "id": 4,
                                "name": "Boissons"
                            }
                        }
                    ]
                },
                {
                    "category": {
                        "id": 1,
                        "name": "Desserts"
                    },
                    "required": false,
                    "items": [
                        {
                            "id": 5,
                            "name": "Glasse",
                            "price": 500,
                            "old_price": null,
                            "description": "lorem lorem",
                            "preparation_time": "00:00",
                            "created_at": "06-04-2019 à 12:09",
                            "updated_at": "06-04-2019 à 12:09",
                            "is_available": true,
                            "cuisine_id": 2,
                            "restaurant_id": 1,
                            "category_id": 1,
                            "menu_id": null,
                            "profile_img": "/storage/items/default.png",
                            "media_links": [],
                            "supplements_details": [],
                            "pivot": {
                                "item_id": 1,
                                "supplement_id": 5
                            },
                            "category": {
                                "id": 1,
                                "name": "Desserts"
                            }
                        }
                    ]
                }
            ],
            "obligatory_supplement_category": [
                {
                    "id": 4,
                    "name": "Boissons",
                    "pivot": {
                        "item_id": 1,
                        "category_id": 4
                    }
                }
            ]
        },...
        .
        .
        .
}
```

### Get all items sorted by restaurants and cuisines

- Url : http://localhost:8000/api/v1/filter/items
- Method : POST

> Body ( example )

```
{
    "restaurants" : [1,2],
    "cuisines": [2]
}
```

> Response (example when we define pagination to 10)

```
{
    "current_page": 1,
    "data": [
        {
            "id": 2,
            "name": "café",
            "price": 150,
            "old_price": null,
            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
            "preparation_time": 5,
            "created_at": "2019-03-22 12:39:35",
            "updated_at": "2019-05-03 11:14:01",
            "is_available": false,
            "display": 1,
            "cuisine_id": 2,
            "restaurant_id": 1,
            "category_id": 4,
            "media_links": [
                "storage/items/2/19/5cb827b654b0f_cafe_du_jeudi.jpg"
            ]
        },
        {
            "id": 5,
            "name": "glasse",
            "price": 500,
            "old_price": null,
            "description": "lorem lorem",
            "preparation_time": 10,
            "created_at": "2019-04-06 12:09:16",
            "updated_at": "2019-04-06 12:09:16",
            "is_available": true,
            "display": 1,
            "cuisine_id": 2,
            "restaurant_id": 1,
            "category_id": 1,
            "media_links": []
        }
    ],
    "first_page_url": "http://localhost:8000/api/v1/filter/items?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/filter/items?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/filter/items",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2,
    "total": 2,
    "success": true,
    "message": "Specific restaurants & cuisines items recovered successfully"
}
```

### Get all data of a specific item

- Url : http://localhost:8000/api/v1/items/{id}
- Method : GET
- Url(example) : http://localhost:8000/api/v1/items/1

> Response (example)

```
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Koki",
        "price": 500,
        "old_price": null,
        "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
        "preparation_time": "00:00",
        "created_at": "22-03-2019 à 12:39",
        "updated_at": "14-05-2019 à 13:51",
        "is_available": true,
        "cuisine_id": 1,
        "restaurant_id": 1,
        "category_id": 2,
        "menu_id": 1,
        "profile_img": "storage/items/1/33/5cdbef81adf15_koki.jpg",
        "media_links": [
            "storage/items/1/33/5cdbef81adf15_koki.jpg"
        ],
        "supplements_details": [
            {
                "category": {
                    "id": 4,
                    "name": "Boissons"
                },
                "required": true,
                "items": [
                    {
                        "id": 2,
                        "name": "Café",
                        "price": 150,
                        "old_price": null,
                        "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                        "preparation_time": "00:00",
                        "created_at": "22-03-2019 à 12:39",
                        "updated_at": "03-05-2019 à 11:14",
                        "is_available": false,
                        "cuisine_id": 2,
                        "restaurant_id": 1,
                        "category_id": 4,
                        "menu_id": null,
                        "profile_img": "storage/items/2/19/5cb827b654b0f_cafe_du_jeudi.jpg",
                        "media_links": [
                            "storage/items/2/19/5cb827b654b0f_cafe_du_jeudi.jpg"
                        ],
                        "supplements_details": [],
                        "pivot": {
                            "item_id": 1,
                            "supplement_id": 2
                        },
                        "category": {
                            "id": 4,
                            "name": "Boissons"
                        }
                    }
                ]
            },
            {
                "category": {
                    "id": 1,
                    "name": "Desserts"
                },
                "required": false,
                "items": [
                    {
                        "id": 5,
                        "name": "Glasse",
                        "price": 500,
                        "old_price": null,
                        "description": "lorem lorem",
                        "preparation_time": "00:00",
                        "created_at": "06-04-2019 à 12:09",
                        "updated_at": "06-04-2019 à 12:09",
                        "is_available": true,
                        "cuisine_id": 2,
                        "restaurant_id": 1,
                        "category_id": 1,
                        "menu_id": null,
                        "profile_img": "/storage/items/default.png",
                        "media_links": [],
                        "supplements_details": [],
                        "pivot": {
                            "item_id": 1,
                            "supplement_id": 5
                        },
                        "category": {
                            "id": 1,
                            "name": "Desserts"
                        }
                    }
                ]
            }
        ],
        "cuisine": {
            "id": 1,
            "name": "Camerounaise"
        },
        "restaurant": {
            "id": 1,
            "name": "Rosty2",
            "description" : "lorem ipsum dolar ...",
            "address": "bonamoussadi, bloc 11",
            "is_merchant": false,
            "longitude": 159.05,
            "latitude": 1500.6,
            "created_at": "2019-03-22 12:32:01",
            "updated_at": "2019-05-22 11:02:19",
            "deleted_at": null,
            "deliveries_time": "01:05",
            "address_description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae !",
            "profile_img": "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
            "media_links": [
                "storage/restaurants/1/25/5ccfe7a4afe54_restaurant-2.jpg",
                "storage/restaurants/1/27/5ccfe963e270a_restaurant_le_prom.jpg",
                "storage/restaurants/1/28/5cd04f893703c_ppr-oiseau-blanc-interior-evening-1074.jpg"
            ]
        },
        "category": {
            "id": 2,
            "name": "Plats principaux"
        },
        "obligatory_supplement_category": [
            {
                "id": 4,
                "name": "Boissons",
                "pivot": {
                    "item_id": 1,
                    "category_id": 4
                }
            }
        ]
    },
    "message": "Item retrieved successfully"
}
```

### Get items by categories and restaurants

- Url : http://localhost:8000/api/v1/categories/{category_id}/items
- Method : GET
- Url ( example ) :  http://localhost:8000/api/v1/categories/4/items
- Note : You have to add this body only if you want to filter result by restaurant
> Body
```
{
    "restaurant_id" : 2
}
```
> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 7,
            "name": "Patates douces",
            "price": 500,
            "old_price": 0,
            "description": "lorem ipsum",
            ....
            .
            .
```
### Get items by menus and restaurants

- Url : http://localhost:8000/api/v1/menus/{menu_id}/items
- Method : GET
- Url ( example ) :  http://localhost:8000/api/v1/menus/4/items
- Note : You have to add this body only if you want to filter result by restaurant
> Body
```
{
    "restaurant_id" : 2
}
```
> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 7,
            "name": "Patates douces",
            "price": 500,
            "old_price": 0,
            "description": "lorem ipsum",
            ....
            .
            .
```

### Another usefull links


> Method : GET

```
- Url : http://localhost:8000/api/v1/restaurants/{restaurant_id}/items
- Url : http://localhost:8000/api/v1/cuisines/{cuisine_id}/items
- Url : http://localhost:8000/api/v1/cuisines/{cuisine_id}/restaurants
```

> Url [ example ]
```
- Url : http://localhost:8000/api/v1/restaurants/2/items
- Url : http://localhost:8000/api/v1/categories/3/items
```

### Notations

### Get all createria for order or shipping notation

- Url : http://localhost:8000/api/v1/notations/{type}/criteria
- Method: GET
- Notes : "type" variable can take 2 values [ 'order' or 'shipping' ]

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url (exemple)
- http://localhost:8000/api/v1/notations/order/criteria

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "température",
            "type": "order"
        },
        {
            "id": 2,
            "name": "portion size",
            "type": "order"
        },
        {
            "id": 3,
            "name": "goût",
            "type": "order"
        },
        {
            "id": 4,
            "name": "présentation",
            "type": "order"
        },
        {
            "id": 5,
            "name": "autre",
            "type": "order"
        }
    ],
    "message": "Criteria retrieved successfully !"
}
```

### Create a rating for the order and shipping

- Url : http://localhost:8000/api/v1/notations
- Method: POST
  
> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```
Note : model_name can take 2 values : shipping and order

> Body
```
{
	"model_name" : "order",
    "model_id" : 13,
    "star" : 4,
    "like" : false,
    "criteria" : [ 1, 2, 3 ],
    "comment" : "commentaire sur la commande d'1 restaurant"
}
```
> Response
```
{
    "success": true,
    "message": "Notation successfully saved !"
}
```

### Update a specific notation

> Headers

- url : http://localhost:8000/api/v1/notations/{id}
- method: PUT

```
"Authorization" : "Bearer [follow by the value of access_token]"
Content-Type: application/json
```

- url (example) : http://localhost:8000/api/v1/notations/8

> Body
```
{
    "id" : 8,
    "star" : 5,
    "like" : true,
    "criteria" : [ 1, 2 ],
    "comment" : "update commentaire sur la commande d'1 restaurant"
}
```
> Response
```
{
    "success": true,
    "data": {
        "id": 8,
        "user_id": 3,
        "model_type": "App\\Models\\Order",
        "model_id": 13,
        "comment": "update commentaire sur la commande d'1 restaurant",
        "star": 5,
        "like": true,
        "created_at": "2019-05-23 08:37:59",
        "updated_at": "2019-05-23 09:44:00"
    },
    "message": "Notation successfully updated"
}
```
### Get one of my notations

- Url : http://localhost:8000/api/v1/notations/{id}
- Method: GET
  
> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url (example)
- http://localhost:8000/api/v1/notations/8

> Response

```
{
    "success": true,
    "data": {
        "id": 8,
        "user_id": 3,
        "model_type": "App\\Models\\Order",
        "model_id": 13,
        "comment": "commentaire sur la commande d'1 restaurant",
        "star": 4,
        "like": false,
        "created_at": "2019-05-23 08:37:59",
        "updated_at": "2019-05-23 08:37:59",
        "criteria": [
            {
                "id": 1,
                "name": "température",
                "type": "restaurant",
                "pivot": {
                    "notation_id": 8,
                    "criteria_id": 1
                }
            },
            {
                "id": 2,
                "name": "portion size",
                "type": "restaurant",
                "pivot": {
                    "notation_id": 8,
                    "criteria_id": 2
                }
            },
            {
                "id": 3,
                "name": "goût",
                "type": "restaurant",
                "pivot": {
                    "notation_id": 8,
                    "criteria_id": 3
                }
            }
        ]
    },
    "message": "Notation retrieved successfully !"
}
```

### Get all my notations

- Url : http://localhost:8000/api/v1/notations
- Method: GET
  
> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 6,
            "user_id": 3,
            "model_type": "App\\Models\\Order",
            "model_id": 2,
            "comment": "commentaire sur le commerce",
            "star": 3,
            "like": true,
            "created_at": "2019-05-17 14:46:58",
            "updated_at": "2019-05-17 13:46:58",
            "criteria": []
        },
        {
            "id": 7,
            "user_id": 3,
            "model_type": "App\\Models\\Shipping",
            "model_id": 0,
            "comment": "commentaire sur la livraison",
            "star": 4,
            "like": false,
            "created_at": "2019-05-17 13:46:58",
            "updated_at": "2019-05-17 13:46:58",
            "criteria": [
                {
                    "id": 6,
                    "name": "température",
                    "type": "shipping",
                    "pivot": {
                        "notation_id": 7,
                        "criteria_id": 6
                    }
                },
                {
                    "id": 7,
                    "name": "manque de professionnalisme",
                    "type": "shipping",
                    "pivot": {
                        "notation_id": 7,
                        "criteria_id": 7
                    }
                }
            ]
        }
    ],
    "message": "Notations successfully retrieved !"
}
```

### Delete a specific notations

- url : http://localhost:8000/api/v1/notations/{id}
- method: DELETE

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response
```
{
    "success": true,
    "message": "Notation deleted successfully."
}
```

### Gestion des droits d'acces.

Lorsqu'un utilisateur essaye d'accéder au ressources sur lequel il n'a aucun droit, le message suivant lui est retourné

> Response
```
{
    "success": false,
    "message": "Unauthorized"
}
```

### Payment

### Get all payment method

- Url : http://localhost:8000/api/v1/payment-methods
- Method : GET

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "paiement a la livraison"
        },
        {
            "id": 2,
            "name": "orange money"
        },
        {
            "id": 3,
            "name": "mtn money"
        },
        {
            "id": 4,
            "name": "stripe"
        }
    ],
    "message": "Payment methods successfully retrieved !"
}
```

### Stripe Payment

- Url : http://localhost:8000/api/v1/stripe
- Method: POST

> Headers
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body
```
"stripeToken": "xxxxxxxxxxxxxxxxxx"
```

> Response
```
{
  "success": true,
  "data": {
    "id": "ch_1EtwszBtvNfyZFZR799SW6cI",
    "object": "charge",
    "amount": 10000,
    ...
    .
    .
    "transfer_group": null
  },
  "message": "Payment Success !"
}
```

### Shippings

### Get all my shipping

- Url : http://localhost:8000/api/v1/shippings
- Method: GET

- Note : Il s'agit uniquement des livraisons associées au livreur ( les livraison qu'il a effectué ou qu'il va effectué )

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

```
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "date": null,
            "fee": 500,
            "user_id": 4,
            "order_id": 25,
            "status": "planned",
            "created_at": "18.06.2019 09:02",
            "updated_at": "18.06.2019 09:02",
            "deleted_at": "12.07.2019 07:56",
            "location": "Rue Bertaut, Douala, Cameroun",
            "country_name": "Cameroun",
            "city_name": "Douala",
            "order": {
                "id": 25,
                "number": "#00025n",
                "comment": "un commentaire, lorem ipsum dolar",
                "coupon_data": null,
                "restaurant_id": 1,
                "status": "confirmed",
                "ready_at": null,
                "created_at": "2019-06-18 09:02:56",
                "updated_at": "2019-06-18 09:02:56",
                "deleted_at": null,
                "total": 850,
                "total_to_pay": 1350,
                "reduction": 0,
                "order_lines": [
                    {
                        "id": 27,
                        "quantity": 1,
                        "order_id": 25,
                        "item_id": 3,
                        "item_price": 700,
                        "comment": null,
                        "subtotal": 700,
                        "item": {
                            "id": 3,
                            "name": "Coucous ndole",
                            "price": 700,
                            "old_price": 0,
                            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                            "is_available": true,
                            "preparation_time": "00:00",
                            "cuisine_id": 1,
                            "restaurant_id": 1,
                            "category_id": 2,
                            "menu_id": 1,
                            "created_at": "22-03-2019 à 12:39",
                            "updated_at": "21-06-2019 à 07:37",
                            "deleted_at": null,
                            "profile_img": "storage/items/3/44/5d0c892ceeef4_couscous-ndole.jpg",
                            "media_links": [
                                "storage/items/3/44/5d0c892ceeef4_couscous-ndole.jpg"
                            ],
                            "supplements_details": []
                        }
                    },
                    ...
                    .
                    .
                ]
            },
            "address": {
                "id": 15,
                "description": "une description",
                "model_id": 4,
                "model_type": "App\\Models\\Shipping",
                "gmap_address": {
                    "address_components": [
                        {
                            "long_name": "Rue Bertaut",
                            "short_name": "Rue Bertaut",
                            "types": [
                                "route"
                            ]
                        },
                        ...
                        .
                        .
                        {
                            "long_name": "Cameroun",
                            "short_name": "CM",
                            "types": [
                                "country",
                                "political"
                            ]
                        }
                    ],
                    "formatted_address": "Rue Bertaut, Douala, Cameroun",
                    "geometry": {
                        "bounds": {
                            "south": 4.0378642,
                            "west": 9.693729399999938,
                            "north": 4.0378832,
                            "east": 9.694779899999958
                        },
                        "location": {
                            "lat": 4.0378737,
                            "lng": 9.694254600000022
                        },
                        "location_type": "GEOMETRIC_CENTER",
                        "viewport": {
                            "south": 4.036524719708498,
                            "west": 9.692905669708466,
                            "north": 4.039222680291502,
                            "east": 9.695603630291544
                        }
                    },
                    "place_id": "ChIJK_Jlvu4SYRARJEZbgsHeSos",
                    "types": [
                        "route"
                    ]
                },
                "created_at": "2019-07-04 09:25:23",
                "updated_at": "2019-07-04 09:25:23"
            }
        },
        ...
        .
        .

    ],
    "first_page_url": "http://localhost:8000/api/v1/shippings?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/v1/shippings?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/v1/shippings",
    "per_page": 10,
    "prev_page_url": null,
    "to": 3,
    "total": 3,
    "success": true,
    "message": "Shippings retrieved successfully."
}
```

### Get shipping by status

### First method

- Url : http://localhost:8000/api/v1/status/shippings
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url (exemple) : 
- http://localhost:8000/api/v1/status/shippings

> Note :
Please to see all status you can use, click [here](#about-shipping-status)

> Body (example)

```
{
    "status" : ['planned', 'in_progress']
}
```
> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "date": null,
            "fee": 500,
            "user_id": 4,
            .
            .
            .
```

### Second method 

- Url : http://localhost:8000/api/v1/status/{status}/shippings
- Method: GET

> Note : 
Please to see all status you can use, click [here](#about-shipping-status)

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url ( example ) : http://localhost:8000/api/v1/status/planned/shippings

> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "date": null,
            "fee": 500,
            "user_id": 4,
            "order_id": 25,
            "status": "planned",
            "created_at": "18.06.2019 09:02",
            "updated_at": "18.06.2019 09:02",
            "deleted_at": "12.07.2019 07:53",
            "location": "Rue Bertaut, Douala, Cameroun",
            "country_name": "Cameroun",
            "city_name": "Douala",
            "order": {
                "id": 25,
                "number": "#00025n",
                "comment": "un commentaire, lorem ipsum dolar",
                "coupon_data": null,
                "restaurant_id": 1,
                "status": "pending",
                "ready_at": null,
                "created_at": "2019-06-18 09:02:56",
                "updated_at": "2019-06-18 09:02:56",
                "deleted_at": null,
                "total": 850,
                "total_to_pay": 1350,
                "reduction": 0,
                "order_lines": [
                    {
                        "id": 27,
                        "quantity": 1,
                        "order_id": 25,
                        "item_id": 3,
                        "item_price": 700,
                        "comment": null,
                        "subtotal": 700,
                        "item": {
                            "id": 3,
                            "name": "Coucous ndole",
                            "price": 700,
                            "old_price": 0,
                            "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
                            "is_available": true,
                            "preparation_time": "00:00",
                            "cuisine_id": 1,
                            "restaurant_id": 1,
                            "category_id": 2,
                            "menu_id": 1,
                            "created_at": "22-03-2019 à 12:39",
                            "updated_at": "21-06-2019 à 07:37",
                            "deleted_at": null,
                            "profile_img": "storage/items/3/44/5d0c892ceeef4_couscous-ndole.jpg",
                            "media_links": [
                                "storage/items/3/44/5d0c892ceeef4_couscous-ndole.jpg"
                            ],
                            "supplements_details": []
                        }
                    },
                    ...
                    .
                    .
                ]
            },
            "address": {
                "id": 15,
                "description": "une description",
                "model_id": 4,
                "model_type": "App\\Models\\Shipping",
                "gmap_address": {
                    "address_components": [
                        {
                            "long_name": "Rue Bertaut",
                            "short_name": "Rue Bertaut",
                            "types": [
                                "route"
                            ]
                        },
                        ...
                        .
                        .
                        {
                            "long_name": "Cameroun",
                            "short_name": "CM",
                            "types": [
                                "country",
                                "political"
                            ]
                        }
                    ],
                    "formatted_address": "Rue Bertaut, Douala, Cameroun",
                    "geometry": {
                        "bounds": {
                            "south": 4.0378642,
                            "west": 9.693729399999938,
                            "north": 4.0378832,
                            "east": 9.694779899999958
                        },
                        "location": {
                            "lat": 4.0378737,
                            "lng": 9.694254600000022
                        },
                        "location_type": "GEOMETRIC_CENTER",
                        "viewport": {
                            "south": 4.036524719708498,
                            "west": 9.692905669708466,
                            "north": 4.039222680291502,
                            "east": 9.695603630291544
                        }
                    },
                    "place_id": "ChIJK_Jlvu4SYRARJEZbgsHeSos",
                    "types": [
                        "route"
                    ]
                },
                "created_at": "2019-07-04 09:25:23",
                "updated_at": "2019-07-04 09:25:23"
            }
        },
        ...
        .
        .
        ],
    "first_page_url": "http://192.168.3.220:8000/api/v1/status/planned/shippings?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://192.168.3.220:8000/api/v1/status/planned/shippings?page=1",
    "next_page_url": null,
    "path": "http://192.168.3.220:8000/api/v1/status/planned/shippings",
    "per_page": 10,
    "prev_page_url": null,
    "to": 2,
    "total": 2,
    "success": true,
    "message": "Shippings retrieved successfully."
}
```

### Request to take charge of an expedition

- Url : http://localhost:8000/api/v1/take/shipping/{shipping_id}
- Method: POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url ( example ) : http://localhost:8000/api/v1/take/shipping/7

> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 4,
            "date": null,
            "fee": 500,
            "user_id": 4,
            "order_id": 25,
            "status": "planned",
            "created_at": "18.06.2019 09:02",
            "updated_at": "18.06.2019 09:02",
            .
            .
            .
    "success": true,
    "message": "This shipping was successfully assigned to you !"
}
```
### Get all data of a specific shipping

- Url : http://localhost:8000/api/v1/shippings/{shipping_id}
- Method: GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Url : http://localhost:8000/api/v1/shippings/1

> Response

```

```

### Set the status of shipping to "in_progress" or to "done"

- Url : http://localhost:8000/api/v1/shippings/{shipping_id}
- Method : PUT

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```
> Url (example) :  http://localhost:8000/api/v1/shippings/6

> Body:
```
{
    "status" : "done" or "in_progress"
}
```

> Response
```
{
    "success": true,
    "data": {
        "id": 6,
        "date": null,
        "fee": 500,
        "user_id": 4,
        "order_id": 27,
        "status": "done",
        ...
        .
        .

```

### About shipping status

- Shipping status : 
    - pending (Lorsque la commande vient juste d'etre faite par le client ou que celle-ci à été prise en charge par le restaurant),
    - canceled (Losrque la commande est rejetée par le shop-admin ou annuler par le client)
    - planned (resto admin corfirm shipper request or admin planification), 
    - in_progress (when the shop-admin define that the shipper have take the order) ( order_status = in_shipment ) , 
    - done (when the shipper say "done" with  shipper-app)

### Set / Update Service Zone

- Url : http://192.168.3.220:8000/api/v1/service/zone
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body
```
{
	"gmap_address": "" // gmap_address must be a javascript object
}
```

> Response
```
{
    "success": true,
    "data": {
        "id": 4,
        "first_name": "Jean",
        "available": 1,
        .
        .
        .
    },
    "message": "Your service zone was succefully updated !"
}
```

### Toggle shipper Availability

- Url : http://192.168.3.220:8000/api/v1/toggle/availability
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body
- Note : available attribute can take 2 values : 1 and 0
```
{
	"available" : 1
}
```

> Response
```
{
    "success": true,
    "data": {
        "id": 4,
        "first_name": "Jean",
        "available": 1,
        .
        .
        .
    },
    "message": "You are now available to take a new order"
}
```

### Wallet

### Get wallet balance

- Url : http://localhost:8000/api/v1/wallet
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response

```
{
    "success": true,
    "data": {
        "balance": 0,
        "last_update": "10-09-2019 14:42:03"
    },
    "message": "wallet retrieved successfully."
}

```

### Get wallet transactions

- Url : http://localhost:8000/api/v1/payouts
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body

- Note : If you don't pass "type" parameter you will get all transaction ("deposit" and "withdraw") 

```
{
	"type": "withdraw" ou "deposit"
}
```

> Response

```
{
    "success": true,
    "data": [
        {
            "id": 21,
            "wallet_id": 5,
            "amount": 0,
            "hash": "trans_5d7cbc3150a474.12691887",
            "type": "withdraw",
            "accepted": 1,
            "meta": {
                "note": null
            },
            "created_at": "2019-09-14 10:08:49",
            "updated_at": "2019-09-14 10:08:49"
        },
        {
            "id": 20,
            "wallet_id": 5,
            .
            .
            .
```

### Tracking

### Set position

- Url : http://localhost:8000/api/v1/trackings/position
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body:
```
{
    "latitude": 3.3,
    "longitude": 1.2
}
```

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 4,
            "order_id": 2,
            "latitude": 3.3,
            "longitude": 1.2
        }
    ],
    "message": "Positions updated successfully."
}
```

### Get position

- Url : http://localhost:8000/api/v1/trackings/position
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body:
```
{
    "order_id" : 2
}
```

> Response
```
{
    "success": true,
    "data": [
        {
            "id": 1,
            "user_id": 4,
            "order_id": 2,
            "latitude": 3.3,
            "longitude": 1.2
        }
    ],
    "message": "Positions retrieved successfully."
}
```

- Note : If the order is still at the restaurant. Your answer will look like this

> Response
```
{
    "success": true,
    "data": {
        "restaurant_id": 2,
        "order_id": 83,
        "latitude": 4.0378737,
        "longitude": 9.694254600000022
    },
    "message": "Positions retrieved successfully."
}
```
### Shop API

### Get all shop's orders

- Url : http://localhost:8000/api/v1/shop/orders
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

Note: 
- All this parameters are optionals
- Please to see all status you can use, click [here](#about-order-status)

> Body

```
{
    "from" : "2019-09-20", // Y-m-d 
    "to" : "2019-09-30", // Y-m-d
    "status" : ["confirmed", "canceled"]
}
```
> Response

```
{
    "current_page": 1,
    "data": [
        {
            "id": 85,
            "number": "#00085a",
            "comment": null,
            "coupon_data": null,
            "restaurant_id": 1,
        .
        .
        .
    "to": 10,
    "total": 16,
    "success": true,
    "message": "Orders successfully retrieved !"
}
```

### Get total orders by status

- Url : http://localhost:8000/api/v1/shop/total/status/orders
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Response

```
{
    "success": true,
    "data": {
        "canceled": 1,
        "shipped": 1,
        "pending": 2,
        "in_shipment": 1,
        "confirmed": 7,
        "ready": 6
    },
    "message": "Total orders by status successfull retrieved !"
}
```

### Update the status of a specific order

- Url : Http://localhost:8000/api/v1/shop/orders/{order_id}
- Method : PUT

> Hearders
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

Note : The status here can take 3 values ('confirmed', 'ready', 'in_shipment')

> Body

```
{
    "status": "confirmed"
}
```

### Delay an order

- Url : Http://localhost:8000/api/v1/shop/orders/{order_id}
- Method : PUT

> Hearders
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

Note : "delay_added" parameter can take 4 values ('00:05:00', '00:10:00', '00:15:00', '00:20:00')

> Body
```
{
    "delay_added": '00:10:00' // minute
}
```

### Get order position

Note : Same as [Tracking](#get-position)

### Download order details

- Url : Http://localhost:8000/api/v1/shop/orders/export/{order_id}
- Method : GET

> Hearders
```
"Authorization" : "Bearer [follow by the value of access_token]"
```

### Get all data of a specific order

- Url : http://localhost:8000/api/v1/shop/orders/{order_id}
- Method : GET 

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

### Get all shop's shippings

- Url : http://localhost:8000/api/v1/shop/shipping
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

### Open / Close shop

- Url : http://localhost:8000/api/v1/shop/toggle/availability
- Method : POST

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body

```
{
    "is_open": "off" // "is_open" can take 4 values ( 1, "on", 0, "off" )
}
```

> Response

```
{
    "success": true,
    "message": "La disponibilité de votre boutique a été mis à jour !",
    "data": {
        "id": 1,
        "name": "Rosty",
        "description": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, repudiandae!",
        "is_merchant": false,
        "user_id": 3,
        "active": 1,
        "is_open": false,
        .
        .
        .
```

### Assign the shipment to the shipper

- Url : http://localhost:8000/api/v1/shop/shippings/{shipping_id}
- Method : PUT

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body

```
{
    "shipper_id": null // We can set the value to "null" in order to remove the shipping to the current shipper
}
```

> Response

```
{
    "success": true,
    "data": {
        "id": 33,
        "fee": 500,
        "user_id": null,
        .
        .
        .
}
```
### Search shipper

- Url : http://localhost:8000/api/v1/search/shippers
- Method : GET

> Headers

```
"Authorization" : "Bearer [follow by the value of access_token]"
```

> Body

```
{
	"term": "sa"
}
```

> Response

```
{
    "total_count": 1,
    "success": true,
    "shippers": [
        {
            "id": 11,
            "first_name": "Salvardord",
            .
            .
            .
```