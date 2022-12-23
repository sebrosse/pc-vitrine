<?php

namespace App;

use TeamTNT\TNTSearch\TNTSearch;

class Search {

	private TNTSearch $tnt;

	public function __construct() {
		$this->tnt = new \TeamTNT\TNTSearch\TNTSearch();

		$this->tnt->loadConfig( [
			'driver'   => 'mysql',
			'host'     => DB_HOST,
			'database' => DB_NAME,
			'username' => DB_USER,
			'password' => DB_PASSWORD,
			'storage'  => THEME_ROOT_PATH . '/search',
			'stemmer'  => \TeamTNT\TNTSearch\Stemmer\PorterStemmer::class//optional
		] );
	}

	public function build_indexes() {
		$indexer = $this->tnt->createIndex( 'product.index' );

		$query =
			'SELECT p.ID as id,p.post_title 
				FROM wp_posts p
				WHERE post_type="pc-product"
				AND post_status="publish"';
		$indexer->query( $query );
		$indexer->setLanguage( 'french' );
		$indexer->run();
	}

	public function search( $term, $index, $limit ) {
		$this->tnt->selectIndex( $index . ".index" );

		$this->tnt->asYouType = true;
		$this->tnt->fuzziness = true;

		return $this->tnt->searchBoolean( trim( $term ), $limit );
	}

}