<?php 

/**
 * Common utilities
 * ported from https://github.com/toji/gl-matrix/blob/master/src/common.js
 */

namespace rasteiner\glMatrix;


class glMatrix {
    const DEGREE = M_PI / 180;
    const EPSILON = 0.000001;
    static $ANGLE_ORDER = 'zyx';

    static function toRadian(float $angle): float {
        return $angle * self::DEGREE;
    }

    static function equals(float $a, float $b): bool {
        return abs($a - $b) <= self::EPSILON * max(1.0, abs($a), abs($b));
    }

    static function random(): float {
        return rand(0, getrandmax() - 1) / getrandmax();
    }
}