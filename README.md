

## Installation & usage
- For Install you have to clone this repo or you can fire this command as well.

```php
 clone the project
```
 
- After the installation you have to update the vendor folder you can update the vendor folder using this command.

```php
composer update
```

- After the updation you have to create the ```.env``` file via this command.
 
- Now you have to generate the product key.

```php
php artisan key:generate
```

- Now migrate the tables & seed the database.

```php
php artisan migrate --seed
```

- We are done here. Now you have to just serve your project.

```php
php artisan serve
```

- This is the updated code of admin.

To get the access of admin side there is credentials bellow

- Admin

email: ```admin@admin.com```
password: ```password```

- User

email: ```testuser@gmail.com```
password: ```password```



Postman documentation for API’a

```php
Logi api
End point :  http://127.0.0.1:8000/api/login
Request : 
{
Email : admin@admin.com
Password: password
}
Response:
{
    "status": "success",
    "message": "User is logged in successfully.",
    "access_token": "3|0MOI2OVWXl8Iyt0IoaZt6x8fHcLcY9FDvZLID4Y10edd1533",
    "token_type": "Bearer"
}
```



```php
Get usr information api

End point :  http://127.0.0.1:8000/api/login
Request : 
Add bearer token 
Response:
[
    {
        "id": 2,
        "first_name": "raju",
        "last_name": "vk",
        "email": "nikhil@yopmail.com",
        "company_id": 6,
        "phone": "8965636526",
        "created_at": "2024-02-01T19:03:38.000000Z",
        "updated_at": "2024-02-01T19:14:47.000000Z",
        "company": {
            "id": 6,
            "name": "nikcompany",
            "email": "nikcom@yopmail.com",
            "logo": "efefef.jpg",
            "website": "test",
            "created_at": "2024-02-01T15:24:45.000000Z",
            "updated_at": "2024-02-01T17:32:14.000000Z"
        }
    },
    {
        "id": 3,
        "first_name": "manu",
        "last_name": "varma",
        "email": "manu@yopmail.com",
        "company_id": 6,
        "phone": "8965636521",
        "created_at": "2024-02-02T04:15:17.000000Z",
        "updated_at": "2024-02-02T04:15:17.000000Z",
        "company": {
            "id": 6,
            "name": "nikcompany",
            "email": "nikcom@yopmail.com",
            "logo": "efefef.jpg",
            "website": "test",
            "created_at": "2024-02-01T15:24:45.000000Z",
            "updated_at": "2024-02-01T17:32:14.000000Z"
        }
    }
]
```



