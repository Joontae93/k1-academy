<?php
/**
 * Describes the allowable Enqueue types
 *
 * @package KingdomOne
 * @since 2.0
 */

namespace KingdomOne;

/** Allowable Enqueue Types */
enum Enqueue_Type {
	case script;
	case style;
	case both;
}
