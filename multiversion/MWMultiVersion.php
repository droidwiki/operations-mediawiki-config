<?php

class MWMultiVersion {
	private static $instance = null;

	private $db = null;
	private $wiki = null;

	public static function getInstance() {
		if ( !self::$instance ) {
			if ( !isset( $_SERVER['SERVER_NAME'] ) ) {
				throw new LogicException( 'Could not determine server name. If you run a' .
					' maintenance script, you should use getInstanceForMaintenance() instead of ' .
					__METHOD__ );
			}
			self::$instance = self::factory( $_SERVER['SERVER_NAME'] );
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
			self::$instance->setDBName( $wikiname );
		}
		return self::$instance;
	}

	private static function factory( $serverName ) {
		$mwmv = new self();
		$mwmv
			->setServerName( $serverName )
			->loadDBFromServerName();

		return $mwmv;
	}

	public function setServerName( $serverName ) {
		$this->serverName = $serverName;

		return $this;
	}

	public function loadDBFromServerName() {
		$wiki = 'emptywiki';
		$serverName = $this->serverName;
		$serverName = preg_replace( '/(^www.)/', '', $serverName );
		if ( !preg_match( '/^([a-zA-Z1-9]*)\./', $serverName, $matches ) ) {
			throw new LogicException( 'Could not parse wiki-name: ' . $serverName );
		}
		if ( !isset( $matches[1] ) ) {
			throw new DomainException( 'Expected an array with at least two matches, but got one' .
				' with less values.' );
		}
		$this->wiki = $matches[1];

		return $this;
	}

	public function getDBName() {
		if ( $this->db ) {
			return $this->db;
		}
		if ( $this->wiki ) {
			return $this->wiki . 'wiki';
		}
		throw new Exception( 'Wiki not set :(' );
	}

	public function setWikiName( $wikiName ) {
		$this->wiki = $wikiName;
	}

	public function setDBName( $dbname ) {
		$this->db = $dbname;
	}

	public function getWikiName() {
		if ( $this->wiki === 'droidwiki' ) {
			return $this->wiki;
		}
		return $this->getDBName();
	}
}

