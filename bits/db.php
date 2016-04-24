<?php
$GLOBALS['pg'] = pg_connect($POSTGRES["string"]);

// Create Riak (store)
use Riak\Client\RiakClientBuilder;
use Riak\Client\Command\Kv\StoreValue;
use Riak\Client\Core\Query\RiakObject;
use Riak\Client\Core\Query\RiakLocation;
use Riak\Client\Core\Query\RiakNamespace;
use Riak\Client\Command\Kv\DeleteValue;
use Riak\Client\Command\Kv\FetchValue; //removeme

function getRiakClient() {
	if(count($GLOBALS["riak"]) < 1) die("Must configure at least one Riak node");
	$builder = new RiakClientBuilder();
	foreach($GLOBALS["riak"] as $riakNodeURL) {
		$builder = $builder->withNodeUri($riakNodeURL);
	}
	return $builder->build();
}

function storeRiak($key, $file_contents) {

	$file_type = "application/json";
	$client = getRiakClient();
	
$object    = new RiakObject();
$namespace = new RiakNamespace('default', 'Submissions');
$location  = new RiakLocation($namespace, $key);

$object->setValue($file_contents);
$object->setContentType($file_type);

// Use our client object to execute the store operation
	$store  = StoreValue::builder($location, $object)
    ->withPw(2)
    ->withW(2)
    ->withDw(2)
    ->build();
$client->execute($store);

//echo $location;
}

// Read Riak
function fetchRiak($key) {
	
	$client = getRiakClient();

	$namespace = new RiakNamespace('default', 'Submissions');
	$location  = new RiakLocation($namespace, $key);

	// fetch object
	$fetch  = FetchValue::builder($location)
	    ->withNotFoundOk(false)
	    ->withPr(1)
	    ->withR(1)
	    ->build();

	/** @var $result \Riak\Client\Command\Kv\Response\FetchValueResponse */
	/** @var $object \Riak\Client\Core\Query\RiakObject */
	$result = $client->execute($fetch);
	$object = $result->getValue();

	echo $object->getValue();
}

// Update Riak not necesary

// Delete Riak
function deleteRiak() {

}

?>
