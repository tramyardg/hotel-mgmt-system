# phpPasswordHashingLib

## PHP 5.5-like password functions for PHP 5.3 and 5.4

PHP 5.5.0 introduced the new password_hash(), password_verify(),
password_needs_rehash() and password_info() functions which simpify the creation
of password hashes that are suitable for storing passwords at rest.

I don't want to go into a discussion about why BCrypt is the way to go instead
of using MD5() or SHA1() here, but if you're interested then I recommend that
you read the defacto online guide here:

http://codahale.com/how-to-safely-store-a-password/

## About phpPasswordHashingLib

PHP 5.5.0 password_hash() supports two algorithm definitions:

**PASSWORD_DEFAULT** and **PASSWORD_BCRYPT**

PASSWORD_DEFAULT is currently assigned to PASSWORD_BCRYPT, but in future it may
switch to another that is considered more secure. It is recommended that you
leave this value as PASSWORD_DEFAULT so that your code automatically selects the
prefered algorithm. If you want to force Blowfish, simply use PASSWORD_BCRYPT

phpPasswordLib supports a further two algorithm definitions that are not part of
the official PHP 5.5 implementation:

**PASSWORD_SHA256** and **PASSWORD_SHA512**

I do not recommend that you use either of these, as it may result in problems
if/when you port your code to PHP >= 5.5. The exception would be if you were to
use the Antnee\PhpPasswordLib\PhpPasswordLib class directly, instead of using
the password_*() wrappers.

_Note:_ If you use this code on PHP < 5.5.0 and then port your code to PHP >=
5.5.0 you should automatically begin using the built in functions, instead of
this libraries functions. Your password verification will continue to work as it
did, but only if you used the PASSWORD_DEFAULT or PASSWORD_BCRYPT algorithms. I
cannot stress enough that **PASSWORD_SHA256 and PASSWORD_SHA512 are NOT
supported in the native PHP 5.5 password_hash() or password_verify() functions**

## Requirements

PHP 5.3 or 5.4 should be fine. I'm not aware of any other limitations, but if
you experience any problems please let me know your PHP version. The crypt()
function is critical, but this SHOULD be available in PHP versions with support
for all algorithms that we're supporting here by PHP 5.3.0 at the very least.

This code is not designed to work with pre-5.3 code due to the use of
namespaces. However, if you did want to try the code on PHP 5.0, 5.1 or 5.2 you
may have success by removing the namespace references. Give it a try :) Note
that you may find that Blowfish support is not necessarily available, however

## Usage

Simply include/require passwordLib.php

    require_once 'path\to\passwordLib.php';

You can now use the PHP 5.5-like functions as follows:

    $hash = password_hash('YourPassword');
    $hash = password_hash('YourPassword', PASSWORD_BCRYPT);
    $hash = password_hash('YourPassword', PASSWORD_BCRYPT, array('cost' => 11));
    
    $match = password_verify('YourPassword', '$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym');
    
    $check = password_needs_rehash('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym', PASSWORD_BCRYPT);
    $check = password_needs_rehash('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym', PASSWORD_BCRYPT, array('cost' => 11));
    
    $info = password_info('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym');

You can also use the phpPasswordLib class directly. The class exists in the
Antnee\PhpPasswordLib namespace so you can create new instance by:

    $ppl = NEW Antnee\PhpPasswordLib\PhpPasswordLib;

Methods will then be available directly and can be used as follows:

    // Use default hash (bcrypt)
    $hash = $ppl->generateCryptPassword('YourPassword');
    
    // Use SHA-512
    $hash = $ppl->setAlgorithm(PASSWORD_SHA512)->generateCryptPassword('YourPassword');
    
    // Set custom cost for bcrypt password and hash
    $hash = $ppl->generateCryptPassword('YourPassword', array('cost'=>12));
    
    // Verify that hash is encrypted to default spec
    $check = $ppl->verifyCryptSetting('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym', PASSWORD_BCRYPT);
    
    // Verify that hash is encrypted to custom spec
    $check = $ppl->verifyCryptSetting('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym', PASSWORD_BCRYPT, array('cost'=>15));
    
    // Get information on hash
    $info = $ppl->getInfo('$2y$10$ulCrKeR8paa8RmRrmyPhw.CqvHlI1ZNDATawIUcIzsMB9MNq5AXym');

Note that there is no function in the class to replace the password_verify()
function. This is because it's easily handled in PHP anyway using crypt(), so
if you don't want to use the password_verify() function as above, just do this:

    // $password is plain text password, $hash is stored hash value
    $match = (crypt($password, $hash) === $hash);

## Demo

I've created a very basic demo GUI for you to try it out. Simply open demo.php
in your browser and try setting some values yourself for the password,
algorithm, salt and rounds. You can also try the password_verify() method to
check that your passwords and hashes verify properly after being hashed.

Remember that if you set a cost value that is out of range, a default value will
be used rather than generating an error.

## Feedback

This is the very first iteration. There will be improvements, I'm sure. I'm more
than happy to receive feedback. I'm also happy to explain any questions you may
have about why BCrypt is the recommended algorith. I don't want to get into any
philosophical debates about the subject however.

Thanks
