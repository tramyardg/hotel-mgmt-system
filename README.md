### Customer
#### Room pricing
![Room pricing](https://github.com/tramyardg/hotel-mgmt-system/blob/master/image/screenshot/room_pricing.PNG)
#### Reservation form
![Reservation form](https://github.com/tramyardg/hotel-mgmt-system/blob/master/image/screenshot/reservation_form.PNG)
#### View reservation(s)
![View booking form](https://github.com/tramyardg/hotel-mgmt-system/blob/master/image/screenshot/view_booking.PNG)
#### About user
![About user](https://github.com/tramyardg/hotel-mgmt-system/blob/master/image/screenshot/about_user.PNG)
### Admin
### Manage reservation
![Manage booking](https://github.com/tramyardg/hotel-mgmt-system/blob/master/image/manage_booking.PNG)

---

**Install dependencies**
- JavaScript
```
npm install
```
- PHP
```
composer install
```
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
