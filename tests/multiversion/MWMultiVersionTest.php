<?php

require_once __DIR__ . '/../../multiversion/MWMultiVersion.php';

class MWMultiVersionTest extends PHPUnit\Framework\TestCase {

	private $backedUpArgv;

	protected function tearDown(): void {
		global $argv;

		MWMultiversion::destroySingleton();
		$argv = $this->backedUpArgv;
		parent::tearDown();
	}

	protected function setUp(): void {
		global $argv;

		parent::setUp();
		$this->backedUpArgv = $argv;
	}

	/**
	 * @dataProvider provideServerName
	 */
	public function testFactory( $expected, $serverName ) {
		$version = MWMultiversion::factory( $serverName );

		$this->assertEquals( $expected, $version->getDBName() );
	}

	public function provideServerName() {
		return [
			// (expected DB, server name [, message]]
			[ 'droidwikiwiki', 'www.droidwiki.org' ],
			[ 'endroidwikiwiki', 'en.droidwiki.org' ],
			[ 'datawiki', 'data.droidwiki.org' ],
			[ 'opswiki', 'ops.go2tech.de' ],
			[ 'armakothwiki', 'armakoth.wiki' ],
			[ 'armakothwiki', 'www.armakoth.wiki' ],
		];
	}

	/**
	 * @dataProvider provideWikiname
	 */
	public function testMaintenanceSeparateWikiname( $expected, $wikiName ) {
		global $argv;
		$argv[1] = '--wiki';
		$argv[2] = $wikiName;

		$version = MWMultiversion::getInstanceForMaintenance();

		$this->assertEquals( $expected, $version->getDBName() );
	}

	/**
	 * @dataProvider provideWikiname
	 */
	public function testMaintenanceCombinedWikiname( $expected, $wikiName ) {
		global $argv;
		$argv[1] = '--wiki=' . $wikiName;

		$version = MWMultiversion::getInstanceForMaintenance();

		$this->assertEquals( $expected, $version->getDBName() );
	}

	/**
	 * @dataProvider provideWikiname
	 */
	public function testMaintenanceWithoutParamNamee( $expected, $wikiName ) {
		global $argv;
		$argv[1] = $wikiName;

		$version = MWMultiversion::getInstanceForMaintenance();

		$this->assertEquals( $expected, $version->getDBName() );
	}

	public function provideWikiname() {
		return [
			// (expected DB, server name [, message]]
			[ 'droidwikiwiki', 'droidwikiwiki' ],
			[ 'endroidwikiwiki', 'endroidwikiwiki' ],
			[ 'datawiki', 'datawiki' ],
			[ 'opswiki', 'opswiki' ],
		];
	}
}
