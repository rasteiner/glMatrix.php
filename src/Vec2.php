<?php

/**
 * 2d vector functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/vec2.js
 */

namespace rasteiner\glMatrix;

/**
 * 2 dimensional vector
 */
class Vec2 {
    
    /**
     * Creates a new, empty vec2
     *
     * @return array {vec2} a new 3D vector
     */
    static function create(): array
    {
        return [0, 0];
    }

    /**
     * Creates a new vec2 initialized with values from an existing vector
     * 
     * @param array {vec2} a vector to clone
     * @return array {vec2} a new 3D vector
     */
    static function clone(array $a): array
    {
        return [$a[0], $a[1]];
    }

    /**
     * Calculates the length of a vec2
     * 
     * @param array {vec2} a vector to calculate length of
     * @return float length of a
     */
    static function length(array $a): float
    {
        $x = $a[0];
        $y = $a[1];
        return sqrt($x * $x + $y * $y);
    }

    /**
     * Creates a new vec2 initialized with the given values
     * 
     * @param float $x X component
     * @param float $y Y component
     * @return array {vec2} a new 2D vector
     */
    static function fromValues(float $x, float $y): array
    {
        return [$x, $y];
    }

    /**
     * Copy the values from one vec2 to another
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the source vector
     * @return array {vec2} out
     */

    static function copy(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        return $out;
    }

    /**
     * Set the components of a vec2 to the given values
     * 
     * @param array {vec2} out the receiving vector
     * @param float $x X component
     * @param float $y Y component
     * @return array {vec2} out
     */
    static function set(array &$out, float $x, float $y): array
    {
        $out[0] = $x;
        $out[1] = $y;
        return $out;
    }

    /**
     * Adds two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function add(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] + $b[0];
        $out[1] = $a[1] + $b[1];
        return $out;
    }

    /**
     * Subtracts vector b from vector a
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function subtract(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] - $b[0];
        $out[1] = $a[1] - $b[1];
        return $out;
    }

    /**
     * Multiplies two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] * $b[0];
        $out[1] = $a[1] * $b[1];
        return $out;
    }

    /**
     * Divides two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function divide(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] / $b[0];
        $out[1] = $a[1] / $b[1];
        return $out;
    }

    /**
     * ceil the components of a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to ceil
     * @return array {vec2} out
     */
    static function ceil(array &$out, array $a): array
    {
        $out[0] = ceil($a[0]);
        $out[1] = ceil($a[1]);
        return $out;
    }

    /**
     * floor the components of a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to floor
     * @return array {vec2} out
     */
    static function floor(array &$out, array $a): array
    {
        $out[0] = floor($a[0]);
        $out[1] = floor($a[1]);
        return $out;
    }

    /**
     * Returns the minimum of two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function min(array &$out, array $a, array $b): array
    {
        $out[0] = min($a[0], $b[0]);
        $out[1] = min($a[1], $b[1]);
        return $out;
    }

    /**
     * Returns the maximum of two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec2} out
     */
    static function max(array &$out, array $a, array $b): array
    {
        $out[0] = max($a[0], $b[0]);
        $out[1] = max($a[1], $b[1]);
        return $out;
    }

    /**
     * Round the components of a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to round
     * @return array {vec2} out
     */
    static function round(array &$out, array $a): array
    {
        $out[0] = round($a[0]);
        $out[1] = round($a[1]);
        return $out;
    }

    /**
     * Scales a vec2 by a scalar number
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to scale
     * @param float $b amount to scale the vector by
     * @return array {vec2} out
     */
    static function scale(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        return $out;
    }

    /**
     * Adds two vec2's after scaling the second operand by a scalar value
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @param float $scale the amount to scale b by before adding
     * @return array {vec2} out
     */
    static function scaleAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        return $out;
    }

    /**
     * Calculates the euclidian distance between two vec2's
     * 
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return float distance between a and b
     */
    static function distance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        return sqrt($x * $x + $y * $y);
    }

    /**
     * Calculates the squared euclidian distance between two vec2's
     * 
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return float squared distance between a and b
     */
    static function squaredDistance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        return $x * $x + $y * $y;
    }

    /**
     * Negates the components of a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to negate
     * @return array {vec2} out
     */
    static function negate(array &$out, array $a): array
    {
        $out[0] = -$a[0];
        $out[1] = -$a[1];
        return $out;
    }

    /**
     * Returns the inverse of the components of a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to invert
     * @return array {vec2} out
     */
    static function inverse(array &$out, array $a): array
    {
        $out[0] = 1.0 / $a[0];
        $out[1] = 1.0 / $a[1];
        return $out;
    }

    /**
     * Normalize a vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a vector to normalize
     * @return array {vec2} out
     */
    static function normalize(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $len = $x * $x + $y * $y;
        if ($len > 0) {
            $len = 1 / sqrt($len);
        }
        $out[0] = $a[0] * $len;
        $out[1] = $a[1] * $len;
        return $out;
    }

    /**
     * Calculates the dot product of two vec2's
     * 
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return float dot product of a and b
     */
    static function dot(array $a, array $b): float
    {
        return $a[0] * $b[0] + $a[1] * $b[1];
    }

    /**
     * Computes the cross product of two vec2's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return array {vec3} out
     */
    static function cross(array &$out, array $a, array $b): array
    {
        $z = $a[0] * $b[1] - $a[1] * $b[0];
        $out[0] = $out[1] = 0;
        $out[2] = $z;
        return $out;
    }

    /**
     * Performs a linear interpolation between two vec2's
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec2} out
     */
    static function lerp(array &$out, array $a, array $b, float $t): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $out[0] = $ax + $t * ($b[0] - $ax);
        $out[1] = $ay + $t * ($b[1] - $ay);
        return $out;
    }

    /**
     * Performs a spherical linear interpolation between two vec2
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec2} out
     */
    static function slerp(array &$out, array $a, array $b, float $t): array
    {
        $angle = acos(min(max(self::dot($a, $b), -1), 1));
        $sinTotal = sin($angle);
      
        $ratioA = sin((1 - $t) * $angle) / $sinTotal;
        $ratioB = sin($t * $angle) / $sinTotal;
        $out[0] = $ratioA * $a[0] + $ratioB * $b[0];
        $out[1] = $ratioA * $a[1] + $ratioB * $b[1];

        return $out;
    }

    /**
     * Performs a hermite interpolation with two control points
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @param array {vec2} c the third operand
     * @param array {vec2} d the fourth operand
     * @param float $t interpolation amount, between 0 and 1, between the two inputs
     * @return array {vec2} out
     */
    static function hermite(array &$out, array $a, array $b, array $c, array $d, float $t): array
    {
        $factorTimes2 = $t * $t;
        $factor1 = $factorTimes2 * (2 * $t - 3) + 1;
        $factor2 = $factorTimes2 * ($t - 2) + $t;
        $factor3 = $factorTimes2 * ($t - 1);
        $factor4 = $factorTimes2 * (3 - 2 * $t);
        $out[0] = $a[0] * $factor1 + $b[0] * $factor2 + $c[0] * $factor3 + $d[0] * $factor4;
        $out[1] = $a[1] * $factor1 + $b[1] * $factor2 + $c[1] * $factor3 + $d[1] * $factor4;
        return $out;
    }

    /**
     * Performs a bezier interpolation with two control points
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @param array {vec2} c the third operand
     * @param array {vec2} d the fourth operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec2} out
     */
    static function bezier(array &$out, array $a, array $b, array $c, array $d, float $t): array
    {
        $inverseFactor = 1 - $t;
        $inverseFactorTimesTwo = $inverseFactor * $inverseFactor;
        $factorTimes2 = $t * $t;
        $factor1 = $inverseFactorTimesTwo * $inverseFactor;
        $factor2 = 3 * $t * $inverseFactorTimesTwo;
        $factor3 = 3 * $factorTimes2 * $inverseFactor;
        $factor4 = $factorTimes2 * $t;
        $out[0] = $a[0] * $factor1 + $b[0] * $factor2 + $c[0] * $factor3 + $d[0] * $factor4;
        $out[1] = $a[1] * $factor1 + $b[1] * $factor2 + $c[1] * $factor3 + $d[1] * $factor4;
        return $out;
    }

    /**
     * Generates a random vector with the given scale
     * 
     * @param array {vec2} out the receiving vector
     * @param float $scale Length of the resulting vector. If ommitted, a unit vector will be returned
     * @return array {vec2} out
     */
    static function random(array &$out, float $scale = 1): array
    {
        $r = glMatrix::RANDOM() * 2.0 * M_PI;
        $out[0] = cos($r) * $scale;
        $out[1] = sin($r) * $scale;
        return $out;
    }

    /**
     * Transforms the vec2 with a mat2
     *
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to transform
     * @param array {mat2} m matrix to transform with
     * @return array {vec2} out
     */
    static function transformMat2(array &$out, array $a, array $m): array {
        $x = $a[0];
        $y = $a[1];
        $out[0] = $m[0] * $x + $m[2] * $y;
        $out[1] = $m[1] * $x + $m[3] * $y;
        return $out;
    }

    /**
     * Transforms the vec2 with a mat2d
     *
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to transform
     * @param array {mat2d} m matrix to transform with
     * @return array {vec2} out
     */
    static function transformMat2d(array &$out, array $a, array $m): array {
        $x = $a[0];
        $y = $a[1];
        $out[0] = $m[0] * $x + $m[2] * $y + $m[4];
        $out[1] = $m[1] * $x + $m[3] * $y + $m[5];
        return $out;
    }
    
    /**
     * Transforms the vec2 with a mat3.
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to transform
     * @param array {mat3} m the 3x3 matrix to transform with
     * @return array {vec2} out
     */
    static function transformMat3(array &$out, array $a, array $m): array
    {
        $x = $a[0];
        $y = $a[1];
        $out[0] = $x * $m[0] + $y * $m[3] + $m[6];
        $out[1] = $x * $m[1] + $y * $m[4] + $m[7];
        return $out;
    }

    /**
     * Transforms the vec2 with a mat4.
     * 4th vector component is implicitly '1'
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to transform
     * @param array {mat4} m matrix to transform with
     * @return array {vec2} out
     */
    static function transformMat4(array &$out, array $a, array $m): array
    {
        $x = $a[0];
        $y = $a[1];
        
        $out[0] = $m[0] * $x + $m[4] * $y + $m[12];
        $out[1] = $m[1] * $x + $m[5] * $y + $m[13];
        return $out;
    }


    /**
     * Rotate a 2D vector
     * 
     * @param array {vec2} out the receiving vector
     * @param array {vec2} a the vector to rotate
     * @param array {vec2} b the origin of the rotation
     * @param float $rad the angle of rotation
     * @return array {vec2} out
     */
    static function rotate(array &$out, array $a, array $b, float $rad): array
    {
        //Translate point to the origin
        $p0 = $a[0] - $b[0];
        $p1 = $a[1] - $b[1];
        $sinC = sin($rad);
        $cosC = cos($rad);

        //perform rotation and translate to correct position
        $out[0] = $p0 * $cosC - $p1 * $sinC + $b[0];
        $out[1] = $p0 * $sinC + $p1 * $cosC + $b[1];

        return $out;
    }

    /**
     * Get the angle between two 2D vectors
     * 
     * @param array {vec2} a the first operand
     * @param array {vec2} b the second operand
     * @return float the angle in radians
     */
    static function angle(array $a, array $b): float
    {
        $x1 = $a[0];
        $y1 = $a[1];
        $x2 = $b[0];
        $y2 = $b[1];

        // mag is the product of the magnitudes of a and b
        $mag = sqrt(($x1 * $x1 + $y1 * $y1) * ($x2 * $x2 + $y2 * $y2));

        // mag &&.. short circuits if mag == 0
        $cosine = $mag && ($x1 * $x2 + $y1 * $y2) / $mag;
        return acos(min(max($cosine, -1), 1));
    
    }

    /**
     * Set the components of a vec2 to zero
     *
     * @param array {vec2} out the receiving vector
     * @return array {vec2} out
     */
    static function zero(array &$out): array
    {
        $out[0] = 0.0;
        $out[1] = 0.0;
        return $out;
    }

    /**
     * Returns a string representation of a vector
     *
     * @param array {vec2} a vector to represent as a string
     * @return string string representation of the vector
     */
    static function str(array $a): string
    {
        return 'vec2(' . $a[0] . ', ' . $a[1] . ')';
    }

    /**
     * Returns whether or not the vectors have exactly the same elements in the same position (when compared with ===)
     *
     * @param array {vec2} a the first vector.
     * @param array {vec2} b the second vector.
     * @return bool true if the vectors are equal, false otherwise.
     */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1];
    }

    /**
     * Returns whether or not the vectors have approximately the same elements in the same position.
     *
     * @param array {vec2} a the first vector.
     * @param array {vec2} b the second vector.
     * @return bool true if the vectors are equal, false otherwise.
     */
    static function equals(array $a, array $b): bool
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $b0 = $b[0];
        $b1 = $b[1];
        return abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
               abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1));
    }
}