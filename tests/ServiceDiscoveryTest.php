<?php

require_once __DIR__ . '/../ServiceDiscovery.php';

class ServiceDiscoveryTest extends PHPUnit\Framework\TestCase {
	public function testDiscoversMemcached() {
		$services = new ServiceDiscovery( '' );

		$result = $services->memcached( 'localhost' );

		$this->assertEquals( [ '127.0.0.1:11211' ], $result );
	}

	public function testDiscoversVarnish() {
		$services = new ServiceDiscovery( '' );

		$result = $services->varnish( 'localhost' );

		$this->assertEquals( [ '127.0.0.1' ], $result );
	}

	public function testDiscoversNginx() {
		$services = new ServiceDiscovery( '' );

		$result = $services->nginx( 'localhost' );

		$this->assertEquals( [ '127.0.0.1' ], $result );
	}

	public function testDiscoversRedis() {
		$services = new ServiceDiscovery( '' );

		$result = $services->redis( 'localhost' );

		$this->assertEquals( [ '127.0.0.1:6379' ], $result );
	}
}
