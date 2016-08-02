<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 01.08.16
 * Time: 14:13
 */
namespace Customer\Socket {

    use \Ratchet\ConnectionInterface;

    class Customer implements \Ratchet\MessageComponentInterface {
        protected $clients;
        protected $users = array();

        public function __construct() {
            $this->clients = new \SplObjectStorage;
        }

        public function onOpen(ConnectionInterface $conn) {
            // Store the new connection to send messages to later
            $this->clients->attach($conn);

            echo "New connection! ({$conn->resourceId})\n";
        }

        public function onMessage(ConnectionInterface $from, $msg) {
            
//            ini_set("session.use_cookies", 0);
//            ini_set("session.use_only_cookies", 0);
//            ini_set("session.cache_limiter", "");
//            session_id($msg);
//            session_start();
//            $message = \Core\Model\Mongo::simpleSelect('to_mail',$msg,'customer_message');
//            $this->users[$_SESSION['customer_id']] = $msg;
//            session_abort();
//            $numRecv = count($this->clients) - 1;

//            var_dump($msg,$message->toArray());
//            $messageRecive[$msg] = count($message->toArray());
//
//            echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
//                , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');
//
//
//            foreach ($this->clients as $client) {
//                var_dump($client);
//                if ($from !== $client) {
                    // The sender is not the receiver, send to each client connected
//                    $client->send($msg);
//                }
//            }
        }

        public function onClose(ConnectionInterface $conn) {
            // The connection is closed, remove it, as we can no longer send it messages
            $this->clients->detach($conn);

            echo "Connection {$conn->resourceId} has disconnected\n";
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            echo "An error has occurred: {$e->getMessage()}\n";

            $conn->close();
        }
    }
}