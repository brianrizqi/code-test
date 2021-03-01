## How To Installation

- Clone this repository

```sh
$ git clone https://github.com/brianrizqi/code-test.git
```

- go to folder
- install dependency composer

```sh
$ composer install
```

- database migration

```sh
$ php artisan migrate
```

## How To Use

## Website

- Register Page Url : http://localhost:8000/register
- Login Page Url : http://localhost:8000/login
- Dashboard Page Url : http://localhost:8000/dashboard

## API

### v1

|No |Path                                                |Method|Parameter                                                                                                                                                                                                |Deskripsi                                                                  |
|---|----------------------------------------------------|------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------|
|1  |/api/v1/user                                           |GET  |N/A| Get All Users
|2  |/api/v1/user                                           |POST  |name = 'string'; email = 'string'; password = 'string';   | Create User
|3  |/api/v1/user/{id}                                           |GET  |id = 'integer'   | Show User by user id
|4  |/api/v1/user/{id}/edit                                           |PUT  |id = 'integer'; name = 'string'; email = 'string'; password = 'string'; status = 'active or inactive'; position = 'User or Super User'  | Update User by id
|5  |/api/v1/user/{id}                                           |GET  |id = 'integer'   | Delete user by user id
