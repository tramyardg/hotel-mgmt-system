<?php
/**
 * PHP Password Demo
 *
 * @link https://github.com/Antnee/phpPasswordLib
 */


require_once 'passwordLib.php';


/**
 * Demo Code
 */
$pass = FALSE;
$algo = FALSE;
$salt = FALSE;
$cost = 10;
$hash = FALSE;
$time = FALSE;
$rehash = FALSE;
$info = FALSE;

$selectedDefault    = FALSE;
$selectedBlowfish   = FALSE;
$selectedSha256     = FALSE;
$selectedSha512     = FALSE;

$verified = FALSE;

if (isset($_POST['password_hash'])){
    // We're hashing
    $pass = $_POST['password'];
    $algo = $_POST['algo'];
    $salt = $_POST['salt'];
    $cost = $_POST['cost'];
    
    switch ($algo){
        case PASSWORD_DEFAULT: $selectedDefault = 'selected'; break;
        case PASSWORD_BCRYPT: $selectedBlowfish = 'selected'; break;
        case PASSWORD_SHA256: $selectedSha256 = 'selected'; break;
        case PASSWORD_SHA512: $selectedSha512 = 'selected'; break;
    }
    
    $options = array();
    
    if (!empty($cost)) $options['cost'] = (int)$cost;
    if (!empty($salt)) $options['salt'] = $salt;
    
    $start  = microtime(TRUE);
    $hash   = password_hash($pass, $algo, $options);
    $end    = microtime(TRUE);
    $time   = round($end - $start, 5);
}



if (isset($_POST['password_verify'])){
    // We're verifying
    $pass = $_POST['password'];
    $hash = $_POST['hash'];
    $verified = password_verify($pass, $hash)
        ? 'The hash matches the entered password'
        : 'The hash does not match the entered password';
}



if (isset($_POST['password_needs_rehash'])){
    // We're checking for rehash requirement
    $hash = $_POST['hash'];
    $algo = $_POST['algo'];
    $cost = $_POST['cost'];
    
    switch ($algo){
        case PASSWORD_DEFAULT: $selectedDefault = 'selected'; break;
        case PASSWORD_BCRYPT: $selectedBlowfish = 'selected'; break;
        case PASSWORD_SHA256: $selectedSha256 = 'selected'; break;
        case PASSWORD_SHA512: $selectedSha512 = 'selected'; break;
    }
    
    $options = array();
    
    if (!empty($cost)) $options['cost'] = (int)$cost;
    
    $rehash = password_needs_rehash($hash, $algo, $options)
        ? 'DOES'
        : 'does NOT';
}

if (isset($_POST['password_get_info'])){
    // We're getting password info
    $hash = $_POST['hash'];
    
    $info = password_get_info($hash);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PHP 5.5-like Password Demo</title>
    <style>
        html { font-family:helvetica, arial, sans-serif; }
        aside { background-color: #eee; border: 1px solid #555; padding: 0px 10px; max-width:800px; }
        dd { margin-left:10px; float:left;  }
        dt { clear:left; float:left; width:200px; }
        h1, h2{ clear: both; }
        input[type="text"],
        input[type="number"],
        select{ width: 300px; }
        .code { font-family:consolas, "Courier New", Courier, monospace; background-color:#eee; }
    </style>
</head>
<body>
        <h1>PHP 5.5-like Password Demo</h1>
        <form action="" method="POST">
            <h2>password_hash() example</h2>
            <aside>
                <p>Note: BCrypt (which is also default in PHP 5.5) has a cost minimum of 4, and maximum of 31,
                    defaulting to 10. SHA-256 and SHA-512 have a minimum of 1000 and maximum of 999,999,999,
                    defaulting to 5000. If you do not set a valid figure, the default values will be automatically
                    applied</p>
                <p>Ideally you should use a cost value that will take between 0.1 and 0.5 seconds on the
                    hardware that this library will be in use. A BCrypt figure of around 10 should be adequate for
                    most, and the SHA functions should be around 100,000</p>
            </aside>
            <dl>
                <dt>Enter password</dt>
                <dd><input type="text" id="password" name="password" placeholder="Enter Password" value="<?php echo $pass ?>"></dd>
                <dt>Select Algorithm</dt>
                <dd><select name="algo" id="algo">
                        <option value="<?php echo PASSWORD_DEFAULT ?>" <?php echo $selectedDefault ?>>Default</option>
                        <option value="<?php echo PASSWORD_BCRYPT ?>" <?php echo $selectedBlowfish ?>>Blowfish</option>
                        <option value="<?php echo PASSWORD_SHA256 ?>" <?php echo $selectedSha256 ?>>SHA-256</option>
                        <option value="<?php echo PASSWORD_SHA512 ?>" <?php echo $selectedSha512 ?>>SHA-512</option>
                    </select></dd>
                <dt>Set Salt</dt>
                <dd><input type="text" id="salt" name="salt" placeholder="Use automatic salt" value="<?php echo $salt ?>"></dd>
                <dt>Set Cost</dt>
                <dd><input type="number" name="cost" id="cost" min="4" max="999999999" placeholder="Set Cost" value="<?php echo $cost ?>"></dd>
                <dt>&nbsp;</dt>
                <dd><input type="submit" name="password_hash" value="password_hash($password, $algorithm, $options)">
            </dl>
            <?php if ($hash): ?>
                <p style="clear:both;">Your generated hash is: <span class="code"><?php echo $hash ?></span></p>
            <?php endif ?>
            <?php if ($time): ?>
                <p> Took <?php echo $time ?> seconds to generate this hash</p>
            <?php endif ?>
        </form>
        
        
        
        <form action="" method="POST">
            <h2>password_verify() example</h2>
            <dl>
                <dt>Enter password</dt>
                <dd><input type="text" id="password" name="password" placeholder="Enter Password" value="<?php echo $pass ?>"></dd>
                <dt>Enter hash</dt>
                <dd><input type="text" id="hash" name="hash" placeholder="Enter Hash" value="<?php echo $hash ?>"></dd>
                <dt>&nbsp;</dt>
                <dd><input type="submit" name="password_verify" value="password_verify($password, $hash)">
            </dl>
            <?php if ($verified): ?>
                <p style="clear:both;"><?php echo $verified ?></p>
            <?php endif ?>
        </form>
        
        
        
        <form action="" method="POST">
            <h2>password_needs_rehash() example</h2>
            <dl>
                <dt>Enter hash</dt>
                <dd><input type="text" id="password" name="hash" placeholder="Enter Password" value="<?php echo $hash ?>"></dd>
                <dt>Select Algorithm</dt>
                <dd><select name="algo" id="algo">
                        <option value="<?php echo PASSWORD_DEFAULT ?>" <?php echo $selectedDefault ?>>Default</option>
                        <option value="<?php echo PASSWORD_BCRYPT ?>" <?php echo $selectedBlowfish ?>>Blowfish</option>
                        <option value="<?php echo PASSWORD_SHA256 ?>" <?php echo $selectedSha256 ?>>SHA-256</option>
                        <option value="<?php echo PASSWORD_SHA512 ?>" <?php echo $selectedSha512 ?>>SHA-512</option>
                    </select></dd>
                <dt>Set Cost</dt>
                <dd><input type="number" name="cost" id="cost" min="4" max="999999999" placeholder="Set Cost" value="<?php echo $cost ?>"></dd>
                <dt>&nbsp;</dt>
                <dd><input type="submit" name="password_needs_rehash" value="password_hash($hash, $algorithm, $options)">
            </dl>
            <?php if ($rehash !== FALSE): ?>
                <p style="clear:both;">Your generated hash <?php echo $rehash ?> need to be rehashed</span></p>
            <?php endif ?>
        </form>
        
        
        
        <form action="" method="POST">
            <h2>password_get_info() example</h2>
            <dl>
                <dt>Enter hash</dt>
                <dd><input type="text" id="password" name="hash" placeholder="Enter Password" value="<?php echo $hash ?>"></dd>
                <dt>&nbsp;</dt>
                <dd><input type="submit" name="password_get_info" value="password_get_info($hash)">
            </dl>
            <?php if ($info !== FALSE): ?>
                <pre style="clear:both;"><?php var_dump($info) ?></pre>
            <?php endif ?>
        </form>
</body>
</html>