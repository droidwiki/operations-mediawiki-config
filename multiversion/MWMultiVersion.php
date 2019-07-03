<?php

require_once __DIR__ . '/../vendor/autoload.php';

class MWMultiVersion {
	private static $instance = null;

	private $db = null;
	private $serverName = null;

	/**
	 * Destroy the singleton instance to let a subsequent call create a new
	 * one. This should NEVER be used on non CLI interface, that will throw an
	 * internal error.
	 */
	public static function destroySingleton() {
		if ( PHP_SAPI !== 'cli' ) {
			self::error( 'Can not destroy singleton instance when used ' .
				'with non-CLI interface' );
		}
		self::$instance = null;
	}

	/**
	 * Error out and exit(1);
	 * @param string $msg Error to show to the client
	 * @param int $httpError HTTP header error code
	 * @return void
	 */
	private static function error( $msg, $httpError = 500 ) {
		$msg = (string)$msg;
		if ( PHP_SAPI !== 'cli' ) {
			$msg = htmlspecialchars( $msg );
			switch ( $httpError ) {
				case 400:
					$httpMsg = 'Bad Request';
					break;
				case 500:
				default:
					$httpMsg = 'Internal server error';
					break;
			}
			header( "HTTP/1.1 $httpError $httpMsg" );
		}
		echo $msg;
		if ( $httpError >= 500 ) {
			trigger_error( $msg, E_USER_ERROR );
		}
		exit( 1 );
	}

	public static function getInstance() {
		if ( !self::$instance ) {
			if ( !isset( $_SERVER['SERVER_NAME'] ) ) {
				throw new LogicException( 'Could not determine server name. If you run a' .
					' maintenance script, you should use getInstanceForMaintenance() instead of ' .
					__METHOD__ );
			}
			$wiki = isset( $_GET['wiki'] ) ? $_GET['wiki'] : null;
			self::$instance = self::factory( $_SERVER['SERVER_NAME'], $wiki );
		}

		return self::$instance;
	}

	public static function getInstanceForMaintenance() {
		global $argv;

		if ( !self::$instance ) {
			self::$instance = new self();
			self::$instance->setDBName( self::extractWikiName( $argv ) );
		}

		return self::$instance;
	}

	public static function factory( $serverName, $dbName = null ) {
		if ( $serverName === 'dstatic.dev' ) {
			if ( $dbName !== null ) {
				$mwmv = new self();
				$mwmv->setDBName( $dbName );
				return $mwmv;
			}
			throw new InvalidArgumentException( 'static.dev without wikiname.' );
		}
		$mwmv = new self();
		$mwmv->setServerName( $serverName )->loadDBFromServerName();

		return $mwmv;
	}

	private function setServerName( $serverName ) {
		$this->serverName = $serverName;

		return $this;
	}

	private function loadDBFromServerName() {
		$staticMapping = [
			'en' => 'endroidwikiwiki',
		];

		$serverName = $this->serverName;
		$serverName = preg_replace( '/(^www.)/', '', $serverName );
		if ( !preg_match( '/^([a-zA-Z1-9]*)\./', $serverName, $matches ) ) {
			throw new LogicException( 'Could not parse wiki-name: ' . $serverName );
		}
		if ( !isset( $matches[1] ) ) {
			throw new DomainException( 'Expected an array with at least two matches, but got one' .
				' with less values.' );
		}
		if ( isset( $staticMapping[$matches[1]] ) ) {
			$this->db = $staticMapping[$matches[1]];
		} else {
			$this->db = $matches[1] . 'wiki';
		}

		return $this;
	}

	private static function isSeparatedWikiArg( array $argv ) {
		return isset( $argv[1] ) && $argv[1] === '--wiki';
	}

	private static function isCombinedWikiArg( array $argv ) {
		return isset( $argv[1] ) && substr( $argv[1], 0, 7 ) === '--wiki=';
	}

	private static function isStandaloneWikiArg( array $argv ) {
		return isset( $argv[1] ) && substr( $argv[1], 0, 2 ) !== '--';
	}

	private static function extractWikiName( array $argv ) {
		if ( self::isSeparatedWikiArg( $argv ) ) {
			return isset( $argv[2] ) ? $argv[2] : ''; // "script.php --wiki dbname"
		}
		if ( self::isCombinedWikiArg( $argv ) ) {
			return substr( $argv[1], 7 ); // "script.php --wiki=dbname"
		}
		if ( self::isStandaloneWikiArg( $argv ) ) {
			return $argv[1]; // "script.php dbname"
		}

		trigger_error( "Usage: mwscript scriptName.php --wiki=dbname\n", E_USER_ERROR );
		exit;
	}

	public function getDBName() {
		return $this->db;
	}

	public function setDBName( $dbname ) {
		$this->db = $dbname;
	}
}
