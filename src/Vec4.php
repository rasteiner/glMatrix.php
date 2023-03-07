<?php

/**
 * 4d vector functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/vec4.js
 */

namespace rasteiner\glMatrix;

/**
 * 4 dimensional vector
 */
class Vec4 {
    use Vec4OrQuat;

    /**
     * Creates a new, empty vec4
     *
     * @return array {vec4} a new 4D vector
     */
    static function create(): array
    {
        return [0, 0, 0, 0];
    }

    /**
     * Subtracts vector b from vector a
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function subtract(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] - $b[0];
        $out[1] = $a[1] - $b[1];
        $out[2] = $a[2] - $b[2];
        $out[3] = $a[3] - $b[3];
        return $out;
    }

    /**
     * Multiplies two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] * $b[0];
        $out[1] = $a[1] * $b[1];
        $out[2] = $a[2] * $b[2];
        $out[3] = $a[3] * $b[3];
        return $out;
    }

    /**
     * Divides two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function divide(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] / $b[0];
        $out[1] = $a[1] / $b[1];
        $out[2] = $a[2] / $b[2];
        $out[3] = $a[3] / $b[3];
        return $out;
    }

    /**
     * ceil the components of a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to ceil
     * @return array {vec4} out
     */
    static function ceil(array &$out, array $a): array
    {
        $out[0] = ceil($a[0]);
        $out[1] = ceil($a[1]);
        $out[2] = ceil($a[2]);
        $out[3] = ceil($a[3]);
        return $out;
    }

    /**
     * floor the components of a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to floor
     * @return array {vec4} out
     */
    static function floor(array &$out, array $a): array
    {
        $out[0] = floor($a[0]);
        $out[1] = floor($a[1]);
        $out[2] = floor($a[2]);
        $out[3] = floor($a[3]);
        return $out;
    }

    /**
     * Returns the minimum of two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function min(array &$out, array $a, array $b): array
    {
        $out[0] = min($a[0], $b[0]);
        $out[1] = min($a[1], $b[1]);
        $out[2] = min($a[2], $b[2]);
        $out[3] = min($a[3], $b[3]);
        return $out;
    }

    /**
     * Returns the maximum of two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function max(array &$out, array $a, array $b): array
    {
        $out[0] = max($a[0], $b[0]);
        $out[1] = max($a[1], $b[1]);
        $out[2] = max($a[2], $b[2]);
        $out[3] = max($a[3], $b[3]);
        return $out;
    }

    /**
     * Round the components of a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to round
     * @return array {vec4} out
     */
    static function round(array &$out, array $a): array
    {
        $out[0] = round($a[0]);
        $out[1] = round($a[1]);
        $out[2] = round($a[2]);
        $out[3] = round($a[3]);
        return $out;
    }

    /**
     * Scales a vec4 by a scalar number
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the vector to scale
     * @param float $b amount to scale the vector by
     * @return array {vec4} out
     */
    static function scale(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        $out[3] = $a[3] * $b;
        return $out;
    }

    /**
     * Adds two vec4's after scaling the second operand by a scalar value
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @param float $scale the amount to scale b by before adding
     * @return array {vec4} out
     */
    static function scaleAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        $out[2] = $a[2] + ($b[2] * $scale);
        $out[3] = $a[3] + ($b[3] * $scale);
        return $out;
    }

    /**
     * Calculates the euclidian distance between two vec4's
     * 
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return float distance between a and b
     */
    static function distance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        $z = $b[2] - $a[2];
        $w = $b[3] - $a[3];
        return sqrt($x * $x + $y * $y + $z * $z + $w * $w);
    }

    /**
     * Calculates the squared euclidian distance between two vec4's
     * 
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return float squared distance between a and b
     */
    static function squaredDistance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        $z = $b[2] - $a[2];
        $w = $b[3] - $a[3];
        return $x * $x + $y * $y + $z * $z + $w * $w;
    }

    /**
     * Negates the components of a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to negate
     * @return array {vec4} out
     */
    static function negate(array &$out, array $a): array
    {
        $out[0] = -$a[0];
        $out[1] = -$a[1];
        $out[2] = -$a[2];
        $out[3] = -$a[3];
        return $out;
    }

    /**
     * Returns the inverse of the components of a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to invert
     * @return array {vec4} out
     */
    static function inverse(array &$out, array $a): array
    {
        $out[0] = 1.0 / $a[0];
        $out[1] = 1.0 / $a[1];
        $out[2] = 1.0 / $a[2];
        $out[3] = 1.0 / $a[3];
        return $out;
    }

    /**
     * Normalize a vec4
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a vector to normalize
     * @return array {vec4} out
     */
    static function normalize(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];
        $len = $x * $x + $y * $y + $z * $z + $w * $w;
        if ($len > 0) {
            $len = 1 / sqrt($len);
        }
        $out[0] = $a[0] * $len;
        $out[1] = $a[1] * $len;
        $out[2] = $a[2] * $len;
        $out[3] = $a[3] * $len;
        return $out;
    }

    /**
     * Calculates the dot product of two vec4's
     * 
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return float dot product of a and b
     */
    static function dot(array $a, array $b): float
    {
        return $a[0] * $b[0] + $a[1] * $b[1] + $a[2] * $b[2] + $a[3] * $b[3];
    }

    /**
     * Computes the cross product of two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @return array {vec4} out
     */
    static function cross(array &$out, array $u, array $v, array $w): array
    {
        $A = $v[0] * $w[1] - $v[1] * $w[0];
        $B = $v[0] * $w[2] - $v[2] * $w[0];
        $C = $v[0] * $w[3] - $v[3] * $w[0];
        $D = $v[1] * $w[2] - $v[2] * $w[1];
        $E = $v[1] * $w[3] - $v[3] * $w[1];
        $F = $v[2] * $w[3] - $v[3] * $w[2];
        $G = $u[0];
        $H = $u[1];
        $I = $u[2];
        $J = $u[3];
        
        $out[0] = $H * $F - $I * $E + $J * $D;
        $out[1] = -($G * $F) + $I * $C - $J * $B;
        $out[2] = $G * $E - $H * $C + $J * $A;
        $out[3] = -($G * $D) + $H * $B - $I * $A;
        
        return $out;
    }

    /**
     * Performs a linear interpolation between two vec4's
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the first operand
     * @param array {vec4} b the second operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec4} out
     */
    static function lerp(array &$out, array $a, array $b, float $t): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $out[0] = $ax + $t * ($b[0] - $ax);
        $out[1] = $ay + $t * ($b[1] - $ay);
        $out[2] = $az + $t * ($b[2] - $az);
        $out[3] = $aw + $t * ($b[3] - $aw);
        return $out;
    }

    /**
     * Generates a random vector with the given scale
     * 
     * @param array {vec4} out the receiving vector
     * @param float $scale Length of the resulting vector. If ommitted, a unit vector will be returned
     * @return array {vec4} out
     */
    static function random(array &$out, float $scale = 1): array
    {
        // Marsaglia, George. Choosing a Point from the Surface of a
        // Sphere. Ann. Math. Statist. 43 (1972), no. 2, 645--646.
        // http://projecteuclid.org/euclid.aoms/1177692644;
        do {
          $v1 = glMatrix::random() * 2 - 1;
          $v2 = glMatrix::random() * 2 - 1;
          $s1 = $v1 * $v1 + $v2 * $v2;
        } while ($s1 >= 1);
        do {
          $v3 = glMatrix::random() * 2 - 1;
          $v4 = glMatrix::random() * 2 - 1;
          $s2 = $v3 * $v3 + $v4 * $v4;
        } while ($s2 >= 1);
      
        $d = sqrt((1 - $s1) / $s2);
        $out[0] = $scale * $v1;
        $out[1] = $scale * $v2;
        $out[2] = $scale * $v3 * $d;
        $out[3] = $scale * $v4 * $d;

        return $out;
    }

    /**
     * Transforms the vec4 with a mat4.
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the vector to transform
     * @param array {mat4} m matrix to transform with
     * @return array {vec4} out
     */
    static function transformMat4(array &$out, array $a, array $m): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];
        $out[0] = $m[0] * $x + $m[4] * $y + $m[8] * $z + $m[12] * $w;
        $out[1] = $m[1] * $x + $m[5] * $y + $m[9] * $z + $m[13] * $w;
        $out[2] = $m[2] * $x + $m[6] * $y + $m[10] * $z + $m[14] * $w;
        $out[3] = $m[3] * $x + $m[7] * $y + $m[11] * $z + $m[15] * $w;
        return $out;
    }

    /**
     * Transforms the vec4 with a quat
     * 
     * @param array {vec4} out the receiving vector
     * @param array {vec4} a the vector to transform
     * @param array {quat} q quaternion to transform with
     * @return array {vec4} out
     */
    static function transformQuat(array &$out, array $a, array $q): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $qx = $q[0];
        $qy = $q[1];
        $qz = $q[2];
        $qw = $q[3];
    
        // calculate quat * vec
        $ix = $qw * $x + $qy * $z - $qz * $y;
        $iy = $qw * $y + $qz * $x - $qx * $z;
        $iz = $qw * $z + $qx * $y - $qy * $x;
        $iw = -$qx * $x - $qy * $y - $qz * $z;
        
        // calculate result * inverse quat
        $out[0] = $ix * $qw + $iw * -$qx + $iy * -$qz - $iz * -$qy;
        $out[1] = $iy * $qw + $iw * -$qy + $iz * -$qx - $ix * -$qz;
        $out[2] = $iz * $qw + $iw * -$qz + $ix * -$qy - $iy * -$qx;
        $out[3] = $a[3];
        return $out;
    }

    /**
     * Set the components of a vec4 to zero
     *
     * @param array {vec4} out the receiving vector
     * @return array {vec4} out
     */
    static function zero(array &$out): array
    {
        $out[0] = 0.0;
        $out[1] = 0.0;
        $out[2] = 0.0;
        return $out;
    }

    /**
     * Returns a string representation of a vector
     *
     * @param array {vec4} a vector to represent as a string
     * @return string string representation of the vector
     */
    static function str(array $a): string
    {
        return 'vec4(' . $a[0] . ', ' . $a[1] . ', ' . $a[2] . ', ' . $a[3] . ')';
    }

    /**
     * Returns whether or not the vectors have approximately the same elements in the same position.
     *
     * @param array {vec4} a the first vector.
     * @param array {vec4} b the second vector.
     * @return bool true if the vectors are equal, false otherwise.
     */
    static function equals(array $a, array $b): bool
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        return abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
               abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) &&
               abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2)) &&
               abs($a3 - $b3) <= glMatrix::EPSILON * max(1.0, abs($a3), abs($b3));
    }
}