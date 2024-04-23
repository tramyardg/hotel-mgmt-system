# Hotel Management System
## Table of Contents
- [Setup](#setup)
- [Screenshots](#screenshots)
- [For developer](#for-developer)

## Setup
1. Make sure you have `MySQL` and a web server to run/interpret `PHP` in your system.
2. Clone or download the repo and put it to `xampp/htdocs/` if you're using windows, otherwise check tutorial(s) for your corresponding web server and OS. 
3. Install dependencies for JavaScript, `npm install` and PHP, `composer install`.
4. Create a database named `hotel` and run the script [`hotel.sql`](https://github.com/tramyardg/hotel-mgmt-system/blob/master/hotel.sql) to create tables and populate data. Make sure your configuration matches with [`app/DB.php`](https://github.com/tramyardg/hotel-mgmt-system/blob/master/app/DB.php#L14), otherwise make the desired changes.
5. Run the app.

## Create an account
1. Go to the registration page (register.php) i.e. http://hotel.local/register.php
2. Enter your info.
3. To make an admin account
   - 3.1 go to your hotel database
   - 3.2 select table customer
   - 3.3 select an account
   - 3.4 change the value of isadmin to 1
 

## Screenshots
**Customer**
- Room pricing
![room_pricing](https://user-images.githubusercontent.com/5623994/51089111-f0131a00-1735-11e9-8758-847091e9b68e.PNG)
- Reservation form
![reservation_form](https://user-images.githubusercontent.com/5623994/51089124-218be580-1736-11e9-9400-3cfd5454fe56.PNG)
- View reservation(s)
![view_booking](https://user-images.githubusercontent.com/5623994/51089133-38cad300-1736-11e9-857a-64f9956b9f17.PNG)
- About user
![about_user](https://user-images.githubusercontent.com/5623994/51089140-4f712a00-1736-11e9-850f-6bb67151711e.PNG)

**Admin**
- Manage reservations
![manage_booking](https://user-images.githubusercontent.com/5623994/51089150-6d3e8f00-1736-11e9-9af0-601ef58847b4.PNG)

## For developer
**Run PHP unit tests**
```
$ ./vendor/bin/phpunit tests
```
```
$ ./vendor/bin/phpunit tests/CustomerHandlerTest.php
```
```
$ ./vendor/bin/phpunit --filter testUpdateCustomer tests
```
**Run PHP code beautifier and fixer**
```
$ ./vendor/bin/phpcbf app/process_login.php --standard=ruleset.xml
```
```
$ ./vendor/bin/phpcbf app/*/*.php --standard=ruleset.xml
```
**Run ESLint to format/fix JavaScript code**
```
npm run eslint
```
```
npm run eslint -- --fix
```
