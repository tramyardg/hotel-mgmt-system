**Run PHP unit tests**
```
$ ./vendor/bin/phpunit tests
```
```
$ ./vendor/bin/phpunit tests/CustomerHandlerTest/php
```
**PHP Code Beautifier and Fixer**
```
$ ./vendor/bin/phpcbf app/process_login.php --standard=ruleset.xml
```
```
$ ./vendor/bin/phpcbf app/*/*.php --standard=ruleset.xml
```