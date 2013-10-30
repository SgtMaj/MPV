<?php
    /**
     * Session class
     *
     * Flash messages by Grafikart.fr
     *     http://www.grafikart.fr/tutoriels/php/flash-message-286
     */
    class Session {

        /**
         * Class contructor
         * @access public
         * @param void
         */
        public function __construct() {
            if (!isset($_SESSION)) {
                session_start();
            }
        }

        /**
         * Define the flash message and its type ans put it in a session variable
         * @access public
         * @param string $message The text to display
         * @param string $type The message type
         * @return void
         */
        public function setFlash($message, $type = 'error') {
            $_SESSION['flash'] = array(
                'message' => $message,
                'type' => $type,
            );
        }

        /**
         * Display the flash message
         * @access public
         * @param void
         * @return void
         */
        public function getFlash() {
            if (isset($_SESSION['flash'])) {
            ?>
                <div id="alert" class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
                    <span class="alert-close">x</span>
                    <?php echo $_SESSION['flash']['message']; ?>
                </div>
            <?php
                unset($_SESSION['flash']);
            }
        }

        /**
         * Check if the user is logged thanks the session
         * @access public
         * @param void
         * @return bool Is the user logged ?
         */
        public function isLogged() {
            if (!empty($_SESSION['auth'])) {
                return true;
            }

            return false;
        }

    }