<?php

class MWMultiVersion {
	private static $instance = null;

	public static function getInstance() {
		if ( !self::$instance ) {
			self::$instance = self::factory( @$_SERVER['SERVER_NAME'] );
		}
		return self::$instance;
	}

	private static function factory( $serverName ) {
		$mwmv = new self();
		$mwmv->setServerName( $serverName )
			->loadDBFromServerName();

		return $mwmv;
	}

	public function setServerName( $serverName ) {
		$this->serverName = $serverName;

		return $this;
	}

	public function loadDBFromServerName() {
		$wiki = 'emptywiki';
		if ( preg_match( '/^([a-zA-Z1-9]*)\./', $this->serverName, $matches ) ) {
			$wiki = $matches[1];
		}
		$this->wiki = $wiki;

		return $this;
	}

	public function getDBName() {
		if ( $this->wiki ) {
			return $this->wiki . 'wiki';
		}
		throw new Exception( 'Wiki not set :(' );
	}

	public function setWikiName( $wikiName ) {
		$this->wiki = $wikiName;
	}

	public function getWikiName() {
		if ( $this->wiki === 'droidwiki' ) {
			return $this->wiki;
		}
		return $this->getDBName();
	}
}

