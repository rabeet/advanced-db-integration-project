<?php
require("superinclude.php");
/*
	^Put any Riak-specific code in the db.php include
	
	^Make functions for any Riak tasks that the app needs.
	
	In other words, the Riak client should not be used directly
	  in any PHP files that output HTML (such as to students).
*/
use Riak\Client\RiakClientBuilder;
$builder = new RiakClientBuilder();
$client = $builder
	->withNodeUri("http://192.168.56.102:8098")
	->build();
	
	/*
	Rabeet, you might have to add /riak to the URI for your Riak
	
	Also, make sure it's the same port as the HTTP interface to your Riak.
	
	*check and see if it works*
	
	*if it doesn't work...*
	Also, make sure that your CURL is working from the web host to Riak.
		^You might have to install package(s) to let CURL speak HTTPS.
		
	$client = $builder
		->withNodeUri("http://1.1.1.1:8098")
		->withNodeUri("http://2.2.2.2:8098")
		->withNodeUri("http://3.3.3.3:8098")
		->build();
	*/
	
use Riak\Client\Command\Kv\StoreValue;
use Riak\Client\Command\Kv\FetchValue;
use Riak\Client\Command\Kv\DeleteValue;
use Riak\Client\Core\Query\RiakObject;
use Riak\Client\Core\Query\RiakLocation;
use Riak\Client\Core\Query\RiakNamespace;

$object    = new RiakObject();
$namespace = new RiakNamespace('default', 'quotes');
$location  = new RiakLocation($namespace, 'icemand');

$object->setValue("You're dangerous, Maverick");
$object->setContentType('text/plain');

// store object
$store  = StoreValue::builder($location, $object)
    ->withPw(1)
    ->withW(2)
    ->build();

// Use our client object to execute the store operation
$client->execute($store);


$namespace = new RiakNamespace('default', 'quotes');
$location  = new RiakLocation($namespace, 'icemand');

// fetch object
$fetch  = FetchValue::builder($location)
    ->withNotFoundOk(true)
    ->withR(1)
    ->build();

/** @var $result \Riak\Client\Command\Kv\Response\FetchValueResponse */
/** @var $object \Riak\Client\Core\Query\RiakObject */
$result = $client->execute($fetch);
$object = $result->getValue();

echo $object->getValue();
// You're dangerous, Maverick


$namespace = new RiakNamespace('default', 'quotes');
$location  = new RiakLocation($namespace, 'icemand');

// delete object
$delete  = DeleteValue::builder($location)
    ->withPw(1)
    ->withW(2)
    ->build();

$client->execute($delete);
?>
