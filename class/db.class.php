<?php

    /**
     * DataBase class - design pattern singleton
     *
     * Usage :
     * <pre>
     *     private $cnx; // connection variable
     *     $db = DataBase::getInstance();
     *     $this->cnx = $db->getPDO();
     * </pre>
     *
     * @link http://php.net/manual/en/book.pdo.php PDO class
     *
     */
    class DataBase {
        /**
         * DataBase class instance
         * @access private
         * @static
         * @var connection
         * @see getInstance
         */
         private static $instance = NULL;

         /**
         * Database type
         * @access private
         * @var string
         * @see __construct
         */
         private $db_type = 'mysql';

         /**
         * Database host
         * @access private
         * @var string
         * @see __construct
         */
         private $db_host = 'localhost';

         /**
         * Database name
         * @access private
         * @var string
         * @see __construct
         */
         private $db_name = 'mpv';

         /**
         * Database username
         * @access private
         * @var string
         * @see __construct
         */
         private $db_user = 'root';

         /**
         * Database user password
         * @access private
         * @var string
         * @see __construct
         */
         private $db_pwd = '';

         /**
          * PDO object
          * @var PDO object
          * @see __construct
          */
         private $pdo;

         /**
         * DataBase class constructor
         *
         * Run database connection and stock it in the $pdo variable
         * @access private
         * @param void
         */
         private function __construct() {
            try {
                $this->pdo = new PDO(
                    $this->db_type . ':host=' . $this->db_host . '; dbname=' . $this->db_name,
                    $this->db_user,
                    $this->db_pwd,
                    array(PDO::ATTR_PERSISTENT => true)
                );

                $set = 'SET NAMES UTF8';
                $result = $this->pdo->prepare($set);
                $result->execute();
            }
            catch (PDOException $e) {
                echo '<div class="error">Erreur !: ' . $e->getMessage() . '</div>';
                die();
            }
        }

        /**
         * If an instance exists, return it ; else create a new one
         * @access public
         * @static
         * @param void
         * @return $instance
         */
        public static function getInstance() {
            if (is_null(self::$instance)) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Get the PDO object to manipulate the database
         * @access public
         * @param void
         * @return $pdo
         */
        public function getPDO() {
            return $this->pdo;
        }
    }