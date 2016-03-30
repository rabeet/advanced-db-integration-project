<?php

require __DIR__ . '/vendor/autoload.php';

// lib classes are included via the Composer autoloader files
use Basho\Riak;
use Basho\Riak\Node;
use Basho\Riak\Command;

// define the connection info to our Riak nodes
$port = getenv('PORT');
echo $port;
$nodes = (new Node\Builder)
    ->atHost('adv-db-riak.herokuapp.com')
    ->onPort(443)
    ->build();

// instantiate the Riak client
$riak = new Riak($nodes);

$user = new \StdClass();
$user->name = 'John Doe';
$user->email = 'jdoe@example.com';
// store a new value
$command = (new Command\Builder\StoreObject($riak))
    ->buildJsonObject($user)
    ->buildBucket('users')
    ->build();
$response = $command->execute();
$location = $response->getLocation();
$command = (new Command\Builder\FetchObject($riak))
    ->atLocation($location)
    ->build();
$response = $command->execute();
$object = $response->getObject();
$object->getData()->country = 'USA';
$command = (new Command\Builder\StoreObject($riak))
    ->withObject($object)
    ->atLocation($location)
    ->build();
$response = $command->execute();
echo $response->getStatusCode() . PHP_EOL;

?>