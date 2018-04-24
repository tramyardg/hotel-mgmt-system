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
