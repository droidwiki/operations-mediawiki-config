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

	public function nginx( $serviceName = 'frontend-proxy' ) {
		return $this->discover( $serviceName, null );
	}

	private function discover( $service, $port ) {
		return array_map( function ( $server ) use ( $port ) {
			if ( $port !== null ) {
				 return $server . ':' . $port;
			}
			return $server;
		}, gethostbynamel( $this->prefix . $service ) );
	}
}
