<?php

/**
 * Template name: Search index
 */

$search = new \App\Search();

$search->build_indexes();

$search->search( 'téles', 'product',10 );
