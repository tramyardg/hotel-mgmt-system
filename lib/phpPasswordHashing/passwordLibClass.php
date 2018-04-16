<?php
/**
 * PHP 5.5-like password hashing functions
 *
 * Provides a password_hash() and password_verify() function as appeared in PHP 5.5.0
 * 
 * See: http://php.net/password_hash and http://php.net/password_verify
 * 
 * @link https://github.com/Antnee/phpPasswordHashingLib
 */


namespace Antnee\PhpPasswordLib;

if (!defined('PASSWORD_BCRYPT')) define('PASSWORD_BCRYPT', 1);

// Note that SHA hashes are not implemented in password_hash() or password_verify() in PHP 5.5
// and are not recommended for use. Recommend only the default BCrypt option
if (!defined('PASSWORD_SHA256')) define('PASSWORD_SHA256', -1);
if (!defined('PASSWORD_SHA512')) define('PASSWORD_SHA512', -2);

if (!defined('PASSWORD_DEFAULT')) define('PASSWORD_DEFAULT', PASSWORD_BCRYPT);

class PhpPasswordLib{
    
    CONST BLOWFISH_CHAR_RANGE = './0123456789ABCDEFGHIJKLMONPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    CONST BLOWFISH_CRYPT_SETTING = '$2a$'; 
    CONST BLOWFISH_CRYPT_SETTING_ALT = '$2y$'; // Available from PHP 5.3.7
    CONST BLOWFISH_ROUNDS = 10;
    CONST BLOWFISH_NAME = 'bcrypt';
    
    // Note that SHA hashes are not implemented in password_hash() or password_verify() in PHP 5.5
    // and are not recommended for use. Recommend only the default BCrypt option
    CONST SHA256_CHAR_RANGE = './0123456789ABCDEFGHIJKLMONPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    CONST SHA256_CRYPT_SETTING = '$5$';
    CONST SHA256_ROUNDS = 5000;
    CONST SHA256_NAME = 'sha256';
    
    CONST SHA512_CHAR_RANGE = './0123456789ABCDEFGHIJKLMONPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    CONST SHA512_CRYPT_SETTING = '$6$';
    CONST SHA512_ROUNDS = 5000;
    CONST SHA512_NAME = 'sha512';
    
    
    /**
     * Default Crypt Algorithm
     * 
     * @var INT
     */
    private $algorithm = PASSWORD_BCRYPT;
    
    
    /**
     * Name of the current algorithm
     *
     * @var STRING
     */
    private $algoName;
    
    
    /**
     * Setting for PHP Crypt function, defines algorithm
     * 
     * Default setting is '$2a$' : BCrypt
     * 
     * @var STRING
     */
    protected $cryptSetting;
    
    
    /**
     * Setting for PHP Crypt function, defines processing cost
     * 
     * Default setting is '08$' for BCrypt rounds
     * 
     * @var INT
     */
    protected $rounds;
    
    
    /**
     * Salt Character Count for Crypt Functions
     * 
     * @var INT
     */
    protected $addSaltChars;
    
    
    /**
     * Salt Character Range for Crypt Functions
     * 
     * @var STRING 
     */
    protected $saltCharRange;
    
    
    /**
     * Class Constructor
     */
    public function __construct(){
        // Initialise default algorithm
        $this->setAlgorithm($this->algorithm);
    }
    
    
    /**
     * Generate Crypt Password
     * 
     * @param STRING $password The password to encode
     * @param ARRAY $options Cost value, and Salt if required
     * @param BOOL $debug If true will return time to calculate hash
     * @return STRING The encoded password
     */
    public function generateCryptPassword($password, $options = array(), $debug = FALSE){
        $startTime  = microtime(TRUE);
        if (isset($options['cost'])) $this->setCost($options['cost']);
        $salt       = $this->cryptSalt(@$options['salt']);
        $crypt      = crypt($password, $salt);
        $endTime    = microtime(TRUE);
        if ($debug){
            $calcTime = $endTime - $startTime;
            return $calcTime;
        }
        return $crypt;
    }
    
    
    /**
     * Generate Crypt Salt
     * 
     * Generates a salt suitable for Crypt using the defined crypt settings
     * 
     * @param STRING $salt Override random salt with predefined value
     * @return STRING
     */
    public function cryptSalt($salt=NULL){
        if (empty($salt)){
            for ($i = 0; $i<$this->addSaltChars; $i++){
                $salt .= $this->saltCharRange[rand(0,(strlen($this->saltCharRange)-1))];
            }
        }
        $salt = $this->cryptSetting.$this->rounds.$salt.'$';
        return $salt;
    }
    
    
    /**
     * Set Crypt Setting
     * 
     * @param type $setting
     * @return \Antnee\PhpPasswordLib\PhpPasswordLib
     */
    public function cryptSetting($setting){
        $this->cryptSetting = $setting;
        return $this;
    }
    
    
    /**
     * Salt Character Count
     * 
     * @param INT $count Number of characters to set
     * @return \Antnee\PhpPasswordLib\PhpPasswordLib|boolean
     */
    public function addSaltChars($count){
        if (is_int($count)){
            $this->addSaltChars = $count;
            return $this;
        } else {
            return FALSE;
        }
    }
    
    
    /**
     * Salt Character Range
     * 
     * @param STRING $chars
     * @return \Antnee\PhpPasswordLib\PhpPasswordLib|boolean
     */
    public function saltCharRange($chars){
        if (is_string($chars)){
            $this->saltCharRange = $chars;
            return $this;
        } else {
            return FALSE;
        }
    }
    
    
    /**
     * Set Crypt Algorithm
     * 
     * @param INT $algo
     * @return \Antnee\PhpPasswordLib\PhpPasswordLib
     */
    public function setAlgorithm($algo=NULL){
        switch ($algo){
            case PASSWORD_SHA256:
                $this->algorithm = PASSWORD_SHA256;
                $this->cryptSetting(self::SHA256_CRYPT_SETTING);
                $this->setCost(self::SHA256_ROUNDS);
                $this->addSaltChars(16);
                $this->saltCharRange(self::SHA256_CHAR_RANGE);
                $this->algoName = self::SHA256_NAME;
                break;
            case PASSWORD_SHA512:
                $this->algorithm = PASSWORD_SHA512;
                $this->cryptSetting(self::SHA512_CRYPT_SETTING);
                $this->setCost(self::SHA512_ROUNDS);
                $this->addSaltChars(16);
                $this->saltCharRange(self::SHA512_CHAR_RANGE);
                $this->algoName = self::SHA512_NAME;
                break;
            case PASSWORD_BCRYPT:
            default:
                $this->algorithm = PASSWORD_BCRYPT;
                if (version_compare(PHP_VERSION, '5.3.7') >= 1){
                    // Use improved Blowfish algorithm if supported
                    $this->cryptSetting(self::BLOWFISH_CRYPT_SETTING_ALT);
                } else {
                    $this->cryptSetting(self::BLOWFISH_CRYPT_SETTING);
                }
                $this->setCost(self::BLOWFISH_ROUNDS);
                $this->addSaltChars(22);
                $this->saltCharRange(self::BLOWFISH_CHAR_RANGE);
                $this->algoName = self::BLOWFISH_NAME;
                break;
        }
        return $this;
    }
    
    
    /**
     * Set Cost
     * 
     * @todo implement
     * 
     * @return \Antnee\PhpPasswordLib\PhpPasswordLib
     */
    public function setCost($rounds){
        switch ($this->algorithm){
            case PASSWORD_BCRYPT:
                $this->rounds = $this->setBlowfishCost($rounds);
                break;
            case PASSWORD_SHA256:
            case PASSWORD_SHA512:
                $this->rounds = $this->setShaCost($rounds);
                break;
        }
        return $this;
    }
    
    
    /**
     * Set Blowfish hash cost
     * 
     * Minimum 4, maximum 31. Value is base-2 log of actual number of rounds, so
     * 4 = 16, 8 = 256, 16 = 65,536 and 31 = 2,147,483,648
     * Defaults to 8 if value is out of range or incorrect type
     * 
     * @param int $rounds
     * @return STRING
     */
    private function setBlowfishCost($rounds){
        if (!is_int($rounds) || $rounds < 4 || $rounds > 31){
            $rounds = $rounds = self::BLOWFISH_ROUNDS;
        }
        return sprintf("%02d", $rounds)."$";
    }
    
    
    /**
     * Set SHA hash cost
     * 
     * Minimum 1000, maximum 999,999,999
     * Defaults to 5000 if value is out of range or incorrect type
     * 
     * @param INT $rounds
     * @return STRING
     */
    private function setShaCost($rounds){
        if (!is_int($rounds) || $rounds < 1000 || $rounds > 999999999){
            switch ($this->algorithm){
                case PASSWORD_SHA256:
                    $rounds = self::SHA256_ROUNDS;
                case PASSWORD_SHA512:
                default:
                    $rounds = self::SHA512_ROUNDS;
            }
        }
        return "rounds=" . $rounds ."$";
    }
    
    
    /**
     * Get hash info
     *
     * @param STRING $hash
     * @return ARRAY
     */
    public function getInfo($hash){
        $params = explode("$", $hash);
        if (count($params) < 4) return FALSE;
        
        switch ($params['1']){
            case '2a':
            case '2y':
            case '2x':
                $algo = PASSWORD_BCRYPT;
                $algoName = self::BLOWFISH_NAME;
                break;
            case '5':
                $algo = PASSWORD_SHA256;
                $algoName = self::SHA256_NAME;
                break;
            case '6':
                $algo = PASSWORD_SHA512;
                $algoName = self::SHA512_NAME;
                break;
            default:
                return FALSE;
        }
        
        $cost = preg_replace("/[^0-9,.]/", "", $params['2']);
        
        return array(
            'algo' => $algo,
            'algoName' => $algoName,
            'options' => array(
                'cost' => $cost
            ),
        );
    }
    
    
    /**
     * Verify Crypt Setting
     * 
     * Checks that the hash provided is encrypted at the current settings or not,
     * returning BOOL accordingly
     * 
     * @param STRING $hash
     * @return BOOL
     */
    public function verifyCryptSetting($hash, $algo, $options=array()){
        $this->setAlgorithm($algo);
        if (isset($options['cost'])) $this->setCost($options['cost']);
        
        $setting = $this->cryptSetting.$this->rounds;
        
        return (substr($hash, 0, strlen($setting)) === $setting);
    }
}