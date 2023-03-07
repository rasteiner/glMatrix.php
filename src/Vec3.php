<?php

/**
 * 3d vector functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/vec3.js
 */

namespace rasteiner\glMatrix;

/**
 * 3 dimensional vector
 */
class Vec3 {
    
    /**
     * Creates a new, empty vec3
     *
     * @return array {vec3} a new 3D vector
     */
    static function create(): array
    {
        return [0, 0, 0];
    }

    /**
     * Creates a new vec3 initialized with values from an existing vector
     * 
     * @param array {vec3} a vector to clone
     * @return array {vec3} a new 3D vector
     */
    static function clone(array $a): array
    {
        return [$a[0], $a[1], $a[2]];
    }

    /**
     * Calculates the length of a vec3
     * 
     * @param array {vec3} a vector to calculate length of
     * @return float length of a
     */
    static function length(array $a): float
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        return sqrt($x * $x + $y * $y + $z * $z);
    }

    /**
     * Creates a new vec3 initialized with the given values
     * 
     * @param float $x X component
     * @param float $y Y component
     * @param float $z Z component
     * @return array {vec3} a new 3D vector
     */
    static function fromValues(float $x, float $y, float $z): array
    {
        return [$x, $y, $z];
    }

    /**
     * Copy the values from one vec3 to another
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the source vector
     * @return array {vec3} out
     */

    static function copy(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        return $out;
    }

    /**
     * Set the components of a vec3 to the given values
     * 
     * @param array {vec3} out the receiving vector
     * @param float $x X component
     * @param float $y Y component
     * @param float $z Z component
     * @return array {vec3} out
     */
    static function set(array &$out, float $x, float $y, float $z): array
    {
        $out[0] = $x;
        $out[1] = $y;
        $out[2] = $z;
        return $out;
    }

    /**
     * Adds two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function add(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] + $b[0];
        $out[1] = $a[1] + $b[1];
        $out[2] = $a[2] + $b[2];
        return $out;
    }

    /**
     * Subtracts vector b from vector a
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function subtract(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] - $b[0];
        $out[1] = $a[1] - $b[1];
        $out[2] = $a[2] - $b[2];
        return $out;
    }

    /**
     * Multiplies two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] * $b[0];
        $out[1] = $a[1] * $b[1];
        $out[2] = $a[2] * $b[2];
        return $out;
    }

    /**
     * Divides two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function divide(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] / $b[0];
        $out[1] = $a[1] / $b[1];
        $out[2] = $a[2] / $b[2];
        return $out;
    }

    /**
     * ceil the components of a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to ceil
     * @return array {vec3} out
     */
    static function ceil(array &$out, array $a): array
    {
        $out[0] = ceil($a[0]);
        $out[1] = ceil($a[1]);
        $out[2] = ceil($a[2]);
        return $out;
    }

    /**
     * floor the components of a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to floor
     * @return array {vec3} out
     */
    static function floor(array &$out, array $a): array
    {
        $out[0] = floor($a[0]);
        $out[1] = floor($a[1]);
        $out[2] = floor($a[2]);
        return $out;
    }

    /**
     * Returns the minimum of two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function min(array &$out, array $a, array $b): array
    {
        $out[0] = min($a[0], $b[0]);
        $out[1] = min($a[1], $b[1]);
        $out[2] = min($a[2], $b[2]);
        return $out;
    }

    /**
     * Returns the maximum of two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function max(array &$out, array $a, array $b): array
    {
        $out[0] = max($a[0], $b[0]);
        $out[1] = max($a[1], $b[1]);
        $out[2] = max($a[2], $b[2]);
        return $out;
    }

    /**
     * Round the components of a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to round
     * @return array {vec3} out
     */
    static function round(array &$out, array $a): array
    {
        $out[0] = round($a[0]);
        $out[1] = round($a[1]);
        $out[2] = round($a[2]);
        return $out;
    }

    /**
     * Scales a vec3 by a scalar number
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to scale
     * @param float $b amount to scale the vector by
     * @return array {vec3} out
     */
    static function scale(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        return $out;
    }

    /**
     * Adds two vec3's after scaling the second operand by a scalar value
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @param float $scale the amount to scale b by before adding
     * @return array {vec3} out
     */
    static function scaleAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        $out[2] = $a[2] + ($b[2] * $scale);
        return $out;
    }

    /**
     * Calculates the euclidian distance between two vec3's
     * 
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return float distance between a and b
     */
    static function distance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        $z = $b[2] - $a[2];
        return sqrt($x * $x + $y * $y + $z * $z);
    }

    /**
     * Calculates the squared euclidian distance between two vec3's
     * 
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return float squared distance between a and b
     */
    static function squaredDistance(array $a, array $b): float
    {
        $x = $b[0] - $a[0];
        $y = $b[1] - $a[1];
        $z = $b[2] - $a[2];
        return $x * $x + $y * $y + $z * $z;
    }

    /**
     * Negates the components of a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to negate
     * @return array {vec3} out
     */
    static function negate(array &$out, array $a): array
    {
        $out[0] = -$a[0];
        $out[1] = -$a[1];
        $out[2] = -$a[2];
        return $out;
    }

    /**
     * Returns the inverse of the components of a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to invert
     * @return array {vec3} out
     */
    static function inverse(array &$out, array $a): array
    {
        $out[0] = 1.0 / $a[0];
        $out[1] = 1.0 / $a[1];
        $out[2] = 1.0 / $a[2];
        return $out;
    }

    /**
     * Normalize a vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a vector to normalize
     * @return array {vec3} out
     */
    static function normalize(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $len = $x * $x + $y * $y + $z * $z;
        if ($len > 0) {
            $len = 1 / sqrt($len);
        }
        $out[0] = $a[0] * $len;
        $out[1] = $a[1] * $len;
        $out[2] = $a[2] * $len;
        return $out;
    }

    /**
     * Calculates the dot product of two vec3's
     * 
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return float dot product of a and b
     */
    static function dot(array $a, array $b): float
    {
        return $a[0] * $b[0] + $a[1] * $b[1] + $a[2] * $b[2];
    }

    /**
     * Computes the cross product of two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return array {vec3} out
     */
    static function cross(array &$out, array $a, array $b): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $bx = $b[0];
        $by = $b[1];
        $bz = $b[2];
        $out[0] = $ay * $bz - $az * $by;
        $out[1] = $az * $bx - $ax * $bz;
        $out[2] = $ax * $by - $ay * $bx;
        return $out;
    }

    /**
     * Performs a linear interpolation between two vec3's
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec3} out
     */
    static function lerp(array &$out, array $a, array $b, float $t): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $out[0] = $ax + $t * ($b[0] - $ax);
        $out[1] = $ay + $t * ($b[1] - $ay);
        $out[2] = $az + $t * ($b[2] - $az);
        return $out;
    }

    /**
     * Performs a spherical linear interpolation between two vec3
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec3} out
     */
    static function slerp(array &$out, array $a, array $b, float $t): array
    {
        $angle = acos(min(max(self::dot($a, $b), -1), 1));
        $sinTotal = sin($angle);
      
        $ratioA = sin((1 - $t) * $angle) / $sinTotal;
        $ratioB = sin($t * $angle) / $sinTotal;
        $out[0] = $ratioA * $a[0] + $ratioB * $b[0];
        $out[1] = $ratioA * $a[1] + $ratioB * $b[1];
        $out[2] = $ratioA * $a[2] + $ratioB * $b[2];
      
        return $out;
    }

    /**
     * Performs a hermite interpolation with two control points
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @param array {vec3} c the third operand
     * @param array {vec3} d the fourth operand
     * @param float $t interpolation amount, between 0 and 1, between the two inputs
     * @return array {vec3} out
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
        $out[2] = $a[2] * $factor1 + $b[2] * $factor2 + $c[2] * $factor3 + $d[2] * $factor4;
        return $out;
    }

    /**
     * Performs a bezier interpolation with two control points
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @param array {vec3} c the third operand
     * @param array {vec3} d the fourth operand
     * @param float $t interpolation amount between the two inputs
     * @return array {vec3} out
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
        $out[2] = $a[2] * $factor1 + $b[2] * $factor2 + $c[2] * $factor3 + $d[2] * $factor4;
        return $out;
    }

    /**
     * Generates a random vector with the given scale
     * 
     * @param array {vec3} out the receiving vector
     * @param float $scale Length of the resulting vector. If ommitted, a unit vector will be returned
     * @return array {vec3} out
     */
    static function random(array &$out, float $scale = 1): array
    {
        $r = glMatrix::random() * 2.0 * M_PI;
        $z = (glMatrix::random() * 2.0) - 1.0;
        $zScale = sqrt(1.0 - $z * $z) * $scale;
        $out[0] = cos($r) * $zScale;
        $out[1] = sin($r) * $zScale;
        $out[2] = $z * $scale;
        return $out;
    }

    /**
     * Transforms the vec3 with a mat4.
     * 4th vector component is implicitly '1'
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to transform
     * @param array {mat4} m matrix to transform with
     * @return array {vec3} out
     */
    static function transformMat4(array &$out, array $a, array $m): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $m[3] * $x + $m[7] * $y + $m[11] * $z + $m[15];
        $w = $w || 1.0;
        $out[0] = ($m[0] * $x + $m[4] * $y + $m[8] * $z + $m[12]) / $w;
        $out[1] = ($m[1] * $x + $m[5] * $y + $m[9] * $z + $m[13]) / $w;
        $out[2] = ($m[2] * $x + $m[6] * $y + $m[10] * $z + $m[14]) / $w;
        return $out;
    }

    /**
     * Transforms the vec3 with a mat3.
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to transform
     * @param array {mat3} m the 3x3 matrix to transform with
     * @return array {vec3} out
     */
    static function transformMat3(array &$out, array $a, array $m): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $out[0] = $x * $m[0] + $y * $m[3] + $z * $m[6];
        $out[1] = $x * $m[1] + $y * $m[4] + $z * $m[7];
        $out[2] = $x * $m[2] + $y * $m[5] + $z * $m[8];
        return $out;
    }

    /**
     * Transforms the vec3 with a quat
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to transform
     * @param array {quat} q quaternion to transform with
     * @return array {vec3} out
     */
    static function transformQuat(array &$out, array $a, array $q): array
    {
        $qx = $q[0];
        $qy = $q[1];
        $qz = $q[2];
        $qw = $q[3];
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $uvx = $qy * $z - $qz * $y;
        $uvy = $qz * $x - $qx * $z;
        $uvz = $qx * $y - $qy * $x;
        $uuvx = $qy * $uvz - $qz * $uvy;
        $uuvy = $qz * $uvx - $qx * $uvz;
        $uuvz = $qx * $uvy - $qy * $uvx;
        $w2 = $qw * 2;
        $uvx *= $w2;
        $uvy *= $w2;
        $uvz *= $w2;
        $uuvx *= 2;
        $uuvy *= 2;
        $uuvz *= 2;
        $out[0] = $x + $uvx + $uuvx;
        $out[1] = $y + $uvy + $uuvy;
        $out[2] = $z + $uvz + $uuvz;
        return $out;
    }

    /**
     * Rotate a 3D vector around the x-axis
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to rotate
     * @param array {vec3} b the origin of the rotation
     * @param float $c the angle of rotation
     * @return array {vec3} out
     */
    static function rotateX(array &$out, array $a, array $b, float $c): array
    {
        $p = [];
        $r = [];

        //Translate point to the origin
        $p[0] = $a[0] - $b[0];
        $p[1] = $a[1] - $b[1];
        $p[2] = $a[2] - $b[2];
        //perform rotation
        $r[0] = $p[0];
        $r[1] = $p[1] * cos($c) - $p[2] * sin($c);
        $r[2] = $p[1] * sin($c) + $p[2] * cos($c);
        //translate to correct position
        $out[0] = $r[0] + $b[0];
        $out[1] = $r[1] + $b[1];
        $out[2] = $r[2] + $b[2];
        return $out;
    }

    /**
     * Rotate a 3D vector around the y-axis
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to rotate
     * @param array {vec3} b the origin of the rotation
     * @param float $c the angle of rotation
     * @return array {vec3} out
     */
    static function rotateY(array &$out, array $a, array $b, float $c): array
    {
        $p = [];
        $r = [];

        //Translate point to the origin
        $p[0] = $a[0] - $b[0];
        $p[1] = $a[1] - $b[1];
        $p[2] = $a[2] - $b[2];
        //perform rotation
        $r[0] = $p[2] * sin($c) + $p[0] * cos($c);
        $r[1] = $p[1];
        $r[2] = $p[2] * cos($c) - $p[0] * sin($c);
        //translate to correct position
        $out[0] = $r[0] + $b[0];
        $out[1] = $r[1] + $b[1];
        $out[2] = $r[2] + $b[2];
        return $out;
    }

    /**
     * Rotate a 3D vector around the z-axis
     * 
     * @param array {vec3} out the receiving vector
     * @param array {vec3} a the vector to rotate
     * @param array {vec3} b the origin of the rotation
     * @param float $c the angle of rotation
     * @return array {vec3} out
     */
    static function rotateZ(array &$out, array $a, array $b, float $c): array
    {
        $p = [];
        $r = [];

        //Translate point to the origin
        $p[0] = $a[0] - $b[0];
        $p[1] = $a[1] - $b[1];
        $p[2] = $a[2] - $b[2];
        //perform rotation
        $r[0] = $p[0] * cos($c) - $p[1] * sin($c);
        $r[1] = $p[0] * sin($c) + $p[1] * cos($c);
        $r[2] = $p[2];
        //translate to correct position
        $out[0] = $r[0] + $b[0];
        $out[1] = $r[1] + $b[1];
        $out[2] = $r[2] + $b[2];
        return $out;
    }

    /**
     * Get the angle between two 3D vectors
     * 
     * @param array {vec3} a the first operand
     * @param array {vec3} b the second operand
     * @return float the angle in radians
     */
    static function angle(array $a, array $b): float
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $bx = $b[0];
        $by = $b[1];
        $bz = $b[2];
        $mag = sqrt(($ax * $ax + $ay * $ay + $az * $az) * ($bx * $bx + $by * $by + $bz * $bz));
        $cosine = $mag && self::dot($a, $b) / $mag;

        return acos(min(max($cosine, -1), 1));    
    }

    /**
     * Set the components of a vec3 to zero
     *
     * @param array {vec3} out the receiving vector
     * @return array {vec3} out
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
     * @param array {vec3} a vector to represent as a string
     * @return string string representation of the vector
     */
    static function str(array $a): string
    {
        return 'vec3(' . $a[0] . ', ' . $a[1] . ', ' . $a[2] . ')';
    }

    /**
     * Returns whether or not the vectors have exactly the same elements in the same position (when compared with ===)
     *
     * @param array {vec3} a the first vector.
     * @param array {vec3} b the second vector.
     * @return bool true if the vectors are equal, false otherwise.
     */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1] && $a[2] === $b[2];
    }

    /**
     * Returns whether or not the vectors have approximately the same elements in the same position.
     *
     * @param array {vec3} a the first vector.
     * @param array {vec3} b the second vector.
     * @return bool true if the vectors are equal, false otherwise.
     */
    static function equals(array $a, array $b): bool
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        return abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
               abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) &&
               abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2));
    }
}