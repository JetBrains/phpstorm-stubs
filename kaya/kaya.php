<?php
/**
 * Stubs for Kaya
 * https://github.com/nerd4ever/kaya-for-php
 * @category   Marketplace
 * @package    php-kaya
 * @author     Sileno de Oliveira Brito <sobrito@nerd4ever.com.br>
 * @copyright  Copyright 2020-2021 Nerd4ever, Ltda.
 * @license    https://nerd4ever.s3.us-east-2.amazonaws.com/legal/Kaya+Universal+Endoint.pdf proprietary
 * @link       https://www.nerd4ever.com.br
 * @see        https://github.com/nerd4ever/kaya-for-php 
 * @version    2.0.4
 */
namespace Nerd4ever{
    /**
     * Create an instance of an Kaya object.
     */
    class Kaya{
        /**
         * Decrypts the text that was encrypted for that device
         * @param string $encoded
         * @return string|null Return null if error or the current decoded value to passphrase if success
         */
        public function passphrase(string $encoded) {}

        /**
         * Get the device identification tag
         * @return string | null Return null if error or the current tag machine value if success
         */
        public static function tag() {}

        /**
         * Get the totp code
         * @return string | null Return null if error (not licensed its is considered an error) or the totp of success
         */
        public static function totp() {}

        /**
         * Authenticates to the nerd4ever server in the kaya service and generates authorizations and access credentials for transferring information.
         * @param string $username The login name to use (email or username)
         * @param string $password The password name to use
         * @return bool Return false if error or true if authenticated success
         */
        public function login(string $username, string $password){}

        /**
         * Log out the nerd4ever server user in the kaya service and remove the user's authorizations and access credentials. Note: Does not remove authorizations and access credentials from the equipment.
         */
        public function logout(){}

        /**
         * Get the public ip address
         * @return string | null Return null if error or the public ip address if success
         */
        public function myIp(){}

        /**
         * Associate and license the device to the connected user, making him/her responsible for the equipment and acquire a service license.
         * @param string $product The product namespace in format (<product>@<vendor>) to buy
         * @param string | null $activation Activation code, used only to transfer subscriptions from one device to another.
         */
        public function active(string $product, $activation = null){}

        /**
         * Buy a license of a service for the equipment under the responsibility of the user who is logged in
         * @param string $product The product namespace in format (<product>@<vendor>) to buy
         * @return bool Return false if error or true if authenticated success
         */
        public function assign(string $product){}

    }
}
