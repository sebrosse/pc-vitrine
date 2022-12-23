<?php

namespace App;

class PCVProduct {

	private \WP_Post $product;
	private array $websites;

	function __construct( \WP_Post $product ) {
		$this->product  = $product;
		$this->websites = get_field( 'websites', 'option' );
	}

	function get_offers() {
		$offers = get_field( 'offers', $this->product->ID );

		usort( $offers, function ( $item1, $item2 ) {
			return $item1['metas'][0]['value'] <=> $item2['metas'][0]['value'];
		} );

		return $offers;
	}

	function get_offer_price( array $offer, $format = true ) {
		$price = false;

		foreach ( $offer['metas'] as $meta ) {
			if ( $meta['slug'] === 'price' ) {
				if ( $format ) {
					$price = $this->format_price( $meta['value'] );
				} else {
					$price = $meta['value'];
				}
				break;
			}
		}

		return $price;
	}

	function get_best_price( $format = true ) {
		$prices = [];
		foreach ( $this->get_offers() as $offer ) {
			$prices[] = $this->get_offer_price( $offer, false );
		}

		if ( $format ) {
			return $this->format_price( min( $prices ) );
		}

		return min( $prices );

	}

	function get_alert_suggested_threshold( $alert ) {
		if ( $alert ) {
			return $alert['threshold'];
		}

		return round( $this->get_best_price( false ) * 0.9 );
	}

	private function format_price( $price ) {
		return number_format( $price, 2, ',', ' ' ) . ' €';
	}

	public function get_price_history_data_points() {
		$price_history = [];
		foreach ( $this->get_offers() as $offer ) {
			$price_history[ $offer['domain'] ] = $offer['price_history'];
		}

		$data = [];

		$date = ( new \DateTime( 'now', new \DateTimeZone( 'Europe/Paris' ) ) )->modify( '-60 days' );

		$now = new \DateTime( 'now', new \DateTimeZone( 'Europe/Paris' ) );

		$i = 0;
		while ( $date < $now ) {
			$i ++;
			$date->modify( '+1 day' );

			$data[] = [ 'x' => $date->format( 'd/m/Y' ), 'y' => $this->get_day_min_price( $price_history, $date ) ];
		}

		return $data;
	}

	private function get_product_price_history_min_date() {
		$values = [];
		foreach ( $this->get_offers() as $offer ) {
			$values[] = min( array_column( $offer['price_history'], 'date' ) );
		}

		return min( $values );
	}

	public function get_website( $domain ) {

		foreach ( $this->websites as $website ) {
			if ( $website['domain'] === $domain ) {
				return $website;
			}
		}

		return false;
	}

	private function get_day_min_price( $price_history, \DateTime $date ) {
		$values = [];

		foreach ( $price_history as $website ) {
			foreach ( $website as $item ) {
				$item_datetime = new \DateTime( $item['date'], new \DateTimeZone( 'Europe/Paris' ) );
				if ( $item_datetime < $date && strtolower( $item['currency'] ) == 'eur' ) {
					$values[] = $item['price'];
					break;
				}
			}
		}
		if ( ! empty( $values ) ) {
			return min( $values );
		} else {
			return 0;
		}
	}
}

