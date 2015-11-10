<?php

class MWMultiVersion {
	private static $instance = null;

	public static function getInstance() {
		if ( !self::$instance ) {
			self::$instance = self::factory( @$_SERVER['SERVER_NAME'] );
		}
		return self::$instance;
	}

	public static function getInstanceForMaintenance() {
		global $argv;

		if ( !self::$instance ) {
			self::$instance = new self();
			$wikiname = '';
			if ( isset( $argv[1] ) && $argv[1] === '--wiki' ) {
				$wikiname = isset( $argv[2] ) ? $argv[2] : ''; // "script.php --wiki dbname"
			} elseif ( isset( $argv[1] ) && substr( $argv[1], 0, 7 ) === '--wiki=' ) {
				$wikiname = substr( $argv[1], 7 ); // "script.php --wiki=dbname"
			} elseif ( isset( $argv[1] ) && substr( $argv[1], 0, 2 ) !== '--' ) {
				$wikiname = $argv[1]; // "script.php dbname"
				$argv[1] = '--wiki=' . $dbname;
			}

			if ( $wikiname === '' ) {
				trigger_error( "Usage: mwscript scriptName.php --wiki=dbname\n", E_USER_ERROR );			
				exit;
			}
			self::$instance->setWikiName( $wikiname );
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

