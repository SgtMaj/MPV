<?php
    require 'db.class.php';
    require 'session.class.php';

    /**
     * Validation class
     *
     * Several validation methods to check form integrity
     */
    class Validation {

        /**
         * Database instance
         * @access private
         * @static
         * @var connection
         */
        private static $instance = NULL;

        /**
         * Database connexion variable
         * @access private
         * @static
         * @var PDO object
         */
        private static $pdo = NULL;

        /**
         * Validation class constructor
         *
         * Avoid external object creation with private access
         * @access private
         */
        private function __construct() {
        }

        /**
         * Avoid external object destruction
         * @access private
         */
        private function __destruct() {
        }

        /**
         * Avoid external object copy
         * @access private
         */
        private function __clone() {
        }

        /**
         * Sanitize database inputs
         *
         * When inserting data in your database,
         * you have to be really careful about SQL injections
         * and other attempts to insert malicious data into the db.
         * The function below is probably the most complete and efficient way
         * to sanitize a string before using it with your database.
         *
         * @link http://css-tricks.com/snippets/php/sanitize-database-inputs/
         *
         * @access public
         * @static
         * @param mixed $input The input to sanitize
         * @return mixed The sanitized input
         */
        public static function sanitize($input) {
            if (is_array($input)) {
                foreach ($input as $var => $val) {
                    $output[$var] = self::sanitize($val);
                }
            }
            else {
                if (get_magic_quotes_gpc()) {
                    $input = stripslashes($input);
                }

                $input  = self::cleanInput($input);
                $output = mysql_real_escape_string($input);
            }

            return $output;
        }

        /**
         * Strip tags ans multi-line comments
         * @access public
         * @static
         * @param string $input The input to clear
         * @return string The cleared input
         *
         * @see sanitize
         */
        public static function cleanInput($input) {
            $search = array(
                '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
                '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
                '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
                '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
            );

            $output = preg_replace($search, '', $input);

            return $output;
        }

        /**
         * Check if the login / password pair exists in the database
         * @access public
         * @static
         * @param array $arr Username and password pair
         * @return bool Is the pair exists ?
         *
         * @see config.php to define SALT# constants
         */
        public static function checkHash($arr) {
            $hash = md5(sha1(SALT1 . $arr['login'] . SALT2 . $arr['pwd'] . SALT3));
            $pwd = '';

            $instance = DataBase::getInstance();
            $pdo = $instance->getPDO();

            $result = $pdo->prepare('SELECT password FROM user WHERE pseudo = ?');
            $result->execute(array($arr['login']));

            while($record = $result->fetch()) {
                $pwd = $record['password'];
            }

            return ($hash == $pwd) ? TRUE : FALSE;
        }

        /**
         * Check if user is in the database
         * @access public
         * @static
         * @param array $arr Username and password pair ($_POST)
         * @return array The user datas
         */
        public static function checkUser($arr) {
            $Session = new Session();

            if (self::checkHash($arr)) {
                $instance = DataBase::getInstance();
                $pdo = $instance->getPDO();

                $result = $pdo->prepare('SELECT uid, nom, prenom, pseudo, role FROM user WHERE pseudo = ?');
                $result->execute(array($arr['login']));

                $datas = $result->fetch(PDO::FETCH_ASSOC);

                $_SESSION['auth'] = array(
                    'pseudo' => $arr['login'],
                    'token' => md5(uniqid(rand(), true)),
                );

                $Session->setFlash('Vous êtes connecté', 'success');

                header('Location: ' . ADMIN . 'index.php');
            }
            else {
                $Session->setFlash('Error : couple identifiant/mot de passe incorrect', 'error');
            }
        }

    }
