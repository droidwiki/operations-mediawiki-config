<?php

class ServiceDiscovery {
	private $prefix;

	public function __construct( $servicesPrefix = 'tasks.' ) {
		$this->prefix = $servicesPrefix;
	}

	public function memcached( $serviceName = 'memcached' ) {
		return $this->discover( $serviceName, '11211' );
	}

	public function varnish( $serviceName = 'cache' ) {
		return $this->discover( $serviceName, '80' );
	}

	private function discover( $service, $port ) {
		return array_map( function ( $server ) use ( $port ) {
			return $server . ':' . $port;
		}, gethostbynamel( $this->prefix . $service ) );
	}
}
