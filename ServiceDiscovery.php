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
		return $this->discover( $serviceName, null );
	}

	public function nginx( $serviceName = 'frontend-proxy' ) {
		return $this->discover( $serviceName, null );
	}

	public function redis( $serviceName = 'redis' ) {
		return $this->discover( $serviceName, '6379' );
	}

	private function discover( $service, $port ) {
		$ipAddresses = gethostbynamel( $this->prefix . $service );
		if ( $ipAddresses === false ) {
			return [];
		}

		return array_map( static function ( $server ) use ( $port ) {
			if ( $port !== null ) {
				 return $server . ':' . $port;
			}
			return $server;
		}, $ipAddresses );
	}
}
