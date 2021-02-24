## Ticketing Module

How the ticketing module works is described below:
1- Guest users can send a support ticket, receive a tracking code and register.

http://test.com/api/v1/tickets

method => POST
| Parameters | Descriptions |
| ------ | ------ |
| email | email type | 
| type | enum('immediate', 'normal', 'nonsignificant') |
| title | title ticket |
| description | description ticket |

2- Users can log in and track their tickets.

http://test.com/api/v1/tickets

method => GET

3- Guest users can see the status of their ticket by sending a ref_number.

http://test.com/api/v1/tickets/{ref_number}

method => GET

4- Login and receive jwt token

http://test.com/api/v1/auth/login

method => POST
| Parameters | Descriptions |
| ------ | ------ |
| email | user email | 
| password | user password |

5- Admins who are permission to give ticket answers:
- They can see a list of available tickets with pending status.
http://test.com/api/v1/admin/tickets
method => Get
- They can change the type of ticket.
http://test.com/api/v1/admin/ticket/change/type

method => Put

| Parameters | Descriptions |
| ------ | ------ |
| ref_number | ticket ref_number | 
| type | enum('immediate', 'normal', 'nonsignificant') |
- They can record their follow-up on any ticket.
http://test.com/api/v1/admin/tickets/{ref_number}/reply
method => Post

| Parameters | Descriptions |
| ------ | ------ |
| title | reply title | 
| description | description |
- In addition, a notification email will be sent to these admins when they submit a new ticket

6- Admins permissioned to close tickets:
- They can close one of the tickets
http://test.com/api/v1/admin/tickets/{ref_number}/close
method => Post

| Parameter | Description |
| ------ | ------ |
| status | ticket status | 

- They can see a list of available tickets with pending status.
http://test.com/api/v1/admin/tickets
method => Get

## Features
- Artisan command to create the desired number of dummy tickets with random and different statuses for the software demo
```sh
php artisan ticket:create {number}
```
- Artisan command for unanswered tickets from the user for one day.
```sh
php artisan ticket:finish
```
- Automatic closing of tickets left unanswered by the user. (Daily)
```sh
php artisan schedule:work
```

## User Module
1- Admin who are able to view the list of users.

http://test.com/api/v1/users.json

method => Get

2- assign role to user

http://test.com/api/v1/admin/add/role

method => Post
| Parameters | Descriptions |
| ------ | ------ |
| email | user email | 
| role | user role |

3- assign permission to role

http://test.com/api/v1/admin/add/permission

method => Post
| Parameters | Descriptions |
| ------ | ------ |
| role | user role | 
| permission | role permission |

4- Logout user

http://test.com/api/v1/auth/logout

method => POST

## Features

- Add a super admin with all permissions by seeder

```sh
php artisan module:seed
```
