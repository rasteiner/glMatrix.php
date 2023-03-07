<?php

/**
 * Quaternion functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/quat.js
 */

namespace rasteiner\glMatrix;

/**
 * Quaternion in the form of [x, y, z, w]
 */
class Quat {
    use Vec4OrQuat;

    /**
     * Creates a new, empty quat
     *
     * @return array {quat} a new quaternion
     */
    static function create(): array
    {
        return [0, 0, 0, 1];
    }

    /** 
     * Sets a quat to the identity quaternion
     * 
     * @param array {quat} out the receiving quaternion
     * @return array {quat} out
     */
    static function identity(array &$out): array
    {
        $out[0] = 0;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        return $out;
    }

    /**
     * Sets a quat from the given angle and rotation axis,
     * then returns it.
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {vec3} axis the axis around which to rotate
     * @param float rad the angle in radians
     * @return array {quat} out
     */
    static function setAxisAngle(array &$out, array $axis, float $rad): array
    {
        $rad = $rad * 0.5;
        $s = sin($rad);
        $out[0] = $s * $axis[0];
        $out[1] = $s * $axis[1];
        $out[2] = $s * $axis[2];
        $out[3] = cos($rad);
        return $out;
    }

    /**
     * Gets the rotation axis and angle for a given
     * quaternion. If a quaternion is created with
     * setAxisAngle, this method will return the same
     * values as providied in the original parameter list
     * OR functionally equivalent values.
     * Example: The quaternion formed by axis [0, 0, 1] and
     * angle -90 is the same as the quaternion formed by
     * [0, 0, 1] and 270. This method favors the latter.
     * 
     * @param array {vec3} out_axis the receiving vector3
     * @param array {quat} q the source quaternion
     * @return float {number} the angle in radians
     */
    static function getAxisAngle(array &$out_axis, array $q): float
    {
        $rad = acos($q[3]) * 2.0;
        $s = sin($rad / 2.0);
        if ($s > glMatrix::EPSILON) {
            $out_axis[0] = $q[0] / $s;
            $out_axis[1] = $q[1] / $s;
            $out_axis[2] = $q[2] / $s;
        } else {
            // If s is zero, return any axis (no rotation - axis does not matter)
            $out_axis[0] = 1;
            $out_axis[1] = 0;
            $out_axis[2] = 0;
        }
        return $rad;
    }

    /**
     * Gets the angular distance between two unit quaternions
     * 
     * @param array {quat} a the first operand
     * @param array {quat} b the second operand
     * @return float {number} the angular distance in radians
     */
    static function getAngle(array $a, array $b): float
    {
        $dotproduct = self::dot($a, $b);

        return acos(2 * $dotproduct * $dotproduct - 1);
    }


    /**
     * Multiplies two quaternions
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the first operand
     * @param array {quat} b the second operand
     * @return array {quat} out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $bx = $b[0];
        $by = $b[1];
        $bz = $b[2];
        $bw = $b[3];

        $out[0] = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $out[1] = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $out[2] = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $out[3] = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        return $out;
    }

    /**
     * Rotates a quaternion by the given angle about the X axis
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the quaternion to rotate
     * @param float rad the angle to rotate the quaternion by
     * @return array {quat} out
     */
    static function rotateX(array &$out, array $a, float $rad): array
    {
        $rad = $rad * 0.5;

        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $bx = sin($rad);
        $bw = cos($rad);

        $out[0] = $ax * $bw + $aw * $bx;
        $out[1] = $ay * $bw + $az * $bx;
        $out[2] = $az * $bw - $ay * $bx;
        $out[3] = $aw * $bw - $ax * $bx;
        return $out;
    }

    /**
     * Rotates a quaternion by the given angle about the Y axis
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the quaternion to rotate
     * @param float rad the angle to rotate the quaternion by
     * @return array {quat} out
     */
    static function rotateY(array &$out, array $a, float $rad): array
    {
        $rad = $rad * 0.5;

        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $by = sin($rad);
        $bw = cos($rad);

        $out[0] = $ax * $bw - $az * $by;
        $out[1] = $ay * $bw + $aw * $by;
        $out[2] = $az * $bw + $ax * $by;
        $out[3] = $aw * $bw - $ay * $by;
        return $out;
    }

    /**
     * Rotates a quaternion by the given angle about the Z axis
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the quaternion to rotate
     * @param float rad the angle to rotate the quaternion by
     * @return array {quat} out
     */
    static function rotateZ(array &$out, array $a, float $rad): array
    {
        $rad = $rad * 0.5;

        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $bz = sin($rad);
        $bw = cos($rad);

        $out[0] = $ax * $bw + $ay * $bz;
        $out[1] = $ay * $bw - $ax * $bz;
        $out[2] = $az * $bw + $aw * $bz;
        $out[3] = $aw * $bw - $az * $bz;
        return $out;
    }

    /**
     * Calculates the W component of a quaternion from the X, Y, and Z components.
     * Assumes that quaternion is 1 unit in length.
     * Any existing W component will be ignored.
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the source quaternion
     * @return array {quat} out
     */
    static function calculateW(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];

        $out[0] = $x;
        $out[1] = $y;
        $out[2] = $z;
        $out[3] = sqrt(abs(1.0 - $x * $x - $y * $y - $z * $z));
        return $out;
    }

    /**
     * Calculate the exponential of a unit quaternion
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the source quaternion
     * @return array {quat} out
     */
    static function exp(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];
        $r = sqrt($x * $x + $y * $y + $z * $z);
        $et = exp($w);
        $s = $r > 0 ? $et * sin($r) / $r : 0;

        $out[0] = $x * $s;
        $out[1] = $y * $s;
        $out[2] = $z * $s;
        $out[3] = $et * cos($r);
        return $out;
    }

    /**
     * Calculate the natural logarithm of a unit quaternion
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the source quaternion
     * @return array {quat} out
     */
    static function ln(array &$out, array $a): array
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];

        $r = sqrt($x * $x + $y * $y + $z * $z);
        $t = $r > 0 ? atan2($r, $w) / $r : 0;
        
        $out[0] = $x * $t;
        $out[1] = $y * $t;
        $out[2] = $z * $t;
        $out[3] = 0.5 * log($x * $x + $y * $y + $z * $z + $w * $w);
        return $out;
    }

    /**
     * Calculates the scalar power of a quaternion
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the source quaternion
     * @param float b the exponent, assumed to be a scalar
     * @return array {quat} out
     */
    static function pow(array &$out, array $a, float $b): array
    {
        self::ln($out, $a);
        self::scale($out, $out, $b);
        self::exp($out, $out);
        return $out;
    }

    /**
     * Performs a spherical linear interpolation between two quat
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a the first operand
     * @param array {quat} b the second operand
     * @param float t interpolation amount between the two inputs
     * @return array {quat} out
     */
    static function slerp(array &$out, array $a, array $b, float $t): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $bx = $b[0];
        $by = $b[1];
        $bz = $b[2];
        $bw = $b[3];

        // calc cosine
        $cosom = $ax * $bx + $ay * $by + $az * $bz + $aw * $bw;

        // adjust signs (if necessary)
        if ($cosom < 0.0) {
            $cosom = -$cosom;
            $bx = -$bx;
            $by = -$by;
            $bz = -$bz;
            $bw = -$bw;
        }

        // calculate coefficients
        if ((1.0 - $cosom) > glMatrix::EPSILON) {
            // standard case (slerp)
            $omega = acos($cosom);
            $sinom = sin($omega);
            $scale0 = sin((1.0 - $t) * $omega) / $sinom;
            $scale1 = sin($t * $omega) / $sinom;
        } else {
            // "from" and "to" quaternions are very close
            //  ... so we can do a linear interpolation
            $scale0 = 1.0 - $t;
            $scale1 = $t;
        }
        // calculate final values
        $out[0] = $scale0 * $ax + $scale1 * $bx;
        $out[1] = $scale0 * $ay + $scale1 * $by;
        $out[2] = $scale0 * $az + $scale1 * $bz;
        $out[3] = $scale0 * $aw + $scale1 * $bw;

        return $out;
    }

    /**
     * Generates a random unit quaternion
     * 
     * @param array {quat} out the receiving quaternion
     * @return array {quat} out
     */
    static function random(array &$out): array
    {
        $u1 = glMatrix::random();
        $u2 = glMatrix::random();
        $u3 = glMatrix::random();

        $sqrt1MinusU1 = sqrt(1 - $u1);
        $sqrtU1 = sqrt($u1);

        $out[0] = $sqrt1MinusU1 * sin(2.0 * M_PI * $u2);
        $out[1] = $sqrt1MinusU1 * cos(2.0 * M_PI * $u2);
        $out[2] = $sqrtU1 * sin(2.0 * M_PI * $u3);
        $out[3] = $sqrtU1 * cos(2.0 * M_PI * $u3);
        return $out;
    }

    /**
     * Calculates the inverse of a quat
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a quat to calculate inverse of
     * @return array {quat} out
     */
    static function invert(array &$out, array $a): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $dot = $a0 * $a0 + $a1 * $a1 + $a2 * $a2 + $a3 * $a3;
        $invDot = $dot ? 1.0 / $dot : 0;

        if($dot) {
            $out[0] = -$a0 * $invDot;
            $out[1] = -$a1 * $invDot;
            $out[2] = -$a2 * $invDot;
            $out[3] = $a3 * $invDot;
        } else {
            // return identity quaternion
            $out[0] = 0;
            $out[1] = 0;
            $out[2] = 0;
            $out[3] = 1;
        }
        return $out;
    }

    /**
     * Calculates the conjugate of a quat
     * If the quaternion is normalized, this function is faster than quat.inverse and produces the same result.
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {quat} a quat to calculate conjugate of
     * @return array {quat} out
     */
    static function conjugate(array &$out, array $a): array
    {
        $out[0] = -$a[0];
        $out[1] = -$a[1];
        $out[2] = -$a[2];
        $out[3] = $a[3];
        return $out;
    }

    /**
     * Creates a quaternion from the given 3x3 rotation matrix.
     * 
     * NOTE: The resultant quaternion is not normalized, so you should be sure
     * to renormalize the quaternion yourself where necessary.
     * 
     * @param array {quat} out the receiving quaternion
     * @param array {mat3} m rotation matrix
     * @return array {quat} out
     */
    static function fromMat3(array &$out, array $m): array
    {
        // Algorithm in Ken Shoemake's article in 1987 SIGGRAPH course notes
        // article "Quaternion Calculus and Fast Animation".
        $fTrace = $m[0] + $m[4] + $m[8];

        if ($fTrace > 0.0) {
            // |w| > 1/2, may as well choose w > 1/2
            $fRoot = sqrt($fTrace + 1.0);  // 2w
            $out[3] = 0.5 * $fRoot;
            $fRoot = 0.5 / $fRoot;  // 1/(4w)
            $out[0] = ($m[7] - $m[5]) * $fRoot;
            $out[1] = ($m[2] - $m[6]) * $fRoot;
            $out[2] = ($m[3] - $m[1]) * $fRoot;
        } else {
            // |w| <= 1/2
            $i = 0;
            if ($m[4] > $m[0]) {
                $i = 1;
            }
            if ($m[8] > $m[$i * 3 + $i]) {
                $i = 2;
            }
            $j = ($i + 1) % 3;
            $k = ($i + 2) % 3;

            $fRoot = sqrt($m[$i * 3 + $i] - $m[$j * 3 + $j] - $m[$k * 3 + $k] + 1.0);
            $out[$i] = 0.5 * $fRoot;
            $fRoot = 0.5 / $fRoot;
            $out[3] = ($m[$k * 3 + $j] - $m[$j * 3 + $k]) * $fRoot;
            $out[$j] = ($m[$j * 3 + $i] + $m[$i * 3 + $j]) * $fRoot;
            $out[$k] = ($m[$k * 3 + $i] + $m[$i * 3 + $k]) * $fRoot;
        }

        return $out;
    }

    /**
     * Creates a quaternion from the given euler angle x, y, z using the provided intrinsic order for the conversion.
     *
     * @param array {quat} out the receiving quaternion
     * @param float x Angle to rotate around X axis in degrees.
     * @param float y Angle to rotate around Y axis in degrees.
     * @param float z Angle to rotate around Z axis in degrees.
     * @param string {'zyx'|'yzx'|'zxy'|'xzy'|'yxz'|'xyz'} order Intrinsinc order for the conversion, default is 'zyx'.
     * @return array {quat} out
     */
    static function fromEuler(array &$out, float $x, float $y, float $z, string $order = glMatrix::$ANGLE_ORDER): array
    {
        $halfToRad = M_PI / 360.0;
        $x *= $halfToRad;
        $y *= $halfToRad;
        $z *= $halfToRad;

        $sx = sin($x);
        $cx = cos($x);
        $sy = sin($y);
        $cy = cos($y);
        $sz = sin($z);
        $cz = cos($z);

        switch ($order) {
            case "xyz":
                $out[0] = $sx * $cy * $cz + $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz - $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz + $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz - $sx * $sy * $sz;
                break;
          
              case "xzy":
                $out[0] = $sx * $cy * $cz - $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz - $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz + $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz + $sx * $sy * $sz;
                break;
          
              case "yxz":
                $out[0] = $sx * $cy * $cz + $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz - $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz - $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz + $sx * $sy * $sz;
                break;
          
              case "yzx":
                $out[0] = $sx * $cy * $cz + $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz + $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz - $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz - $sx * $sy * $sz;
                break;
          
              case "zxy":
                $out[0] = $sx * $cy * $cz - $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz + $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz + $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz - $sx * $sy * $sz;
                break;
          
              case "zyx":
                $out[0] = $sx * $cy * $cz - $cx * $sy * $sz;
                $out[1] = $cx * $sy * $cz + $sx * $cy * $sz;
                $out[2] = $cx * $cy * $sz - $sx * $sy * $cz;
                $out[3] = $cx * $cy * $cz + $sx * $sy * $sz;
                break;
            default:
                throw new \InvalidArgumentException('Invalid order: ' . $order);
        }

        return $out;
    }

    /**
     * Returns a string representation of a quaternion
     * 
     * @param array {quat} a vector to represent as a string
     * @return string string representation of the vector
     */
    static function str(array $a): string
    {
        return 'quat(' . $a[0] . ', ' . $a[1] . ', ' . $a[2] . ', ' . $a[3] . ')';
    }

    /**
     * Returns whether or not the quaternions point approximately in the same direction.
     * Both quaternions are assumed to be unit quaternions.
     * 
     * @param array {quat} a The first quaternion.
     * @param array {quat} b The second quaternion.
     * @return bool True if the quaternions point approximately in the same direction, false otherwise.
     */
    static function equals(array $a, array $b): bool
    {
        return abs(self::dot($a, $b)) >= 1 - glMatrix::EPSILON;
    }

    /**
     * Sets a quaternion to represent the shortest rotation from one
     * vector to another.
     *
     * Both vectors are assumed to be unit length.
     */
    static function rotationTo(array &$out, array $a, array $b): array
    {
        $tmpvec3 = [0,0,0];
        $xUnitVec3 = [1, 0, 0];
        $yUnitVec3 = [0, 1, 0];

        $dot = vec3::dot($a, $b);
        if ($dot < glMatrix::EPSILON - 1) {
            vec3::cross($tmpvec3, $xUnitVec3, $a);
            if (vec3::length($tmpvec3) < 0.000001) {
                vec3::cross($tmpvec3, $yUnitVec3, $a);
            }
            vec3::normalize($tmpvec3, $tmpvec3);
            self::setAxisAngle($out, $tmpvec3, M_PI);
            return $out;
        } else if ($dot > 0.999999) {
            $out[0] = 0;
            $out[1] = 0;
            $out[2] = 0;
            $out[3] = 1;
            return $out;
        } else {
            vec3::cross($tmpvec3, $a, $b);
            $out[0] = $tmpvec3[0];
            $out[1] = $tmpvec3[1];
            $out[2] = $tmpvec3[2];
            $out[3] = 1 + $dot;
            return self::normalize($out, $out);
        }
    }

    /**
     * Performs a spherical linear interpolation with two control points
     *
     * @param array {quat} out the receiving quaternion.
     * @param array {quat} a the first operand.
     * @param array {quat} b the second operand.
     * @param array {quat} c the third operand.
     * @param array {quat} d the fourth operand.
     * @param {Number} t interpolation amount between the two inputs
     * @return array {quat} out
     */
    static function sqlerp(array &$out, array $a, array $b, array $c, array $d, float $t): array
    {
        $temp1 = [0,0,0,0];
        $temp2 = [0,0,0,0];

        self::slerp($temp1, $a, $d, $t);
        self::slerp($temp2, $b, $c, $t);
        self::slerp($out, $temp1, $temp2, 2 * $t * (1 - $t));

        return $out;
    }

    /**
     * Sets the specified quaternion with values corresponding to the given
     * axes. Each axis is a vec3 and is expected to be unit length and
     * perpendicular to all other specified axes.
     * 
     * @param array {quat} out the receiving quaternion.
     * @param array {vec3} view  the vector representing the viewing direction
     * @param array {vec3} right the vector representing the local "right" direction
     * @param array {vec3} up    the vector representing the local "up" direction
     * @return array {quat} out
     */
    static function setAxes(array &$out, array $view, array $right, array $up): array
    {
        $matr = [0,0,0,0,0,0,0,0,0];
        $matr[0] = $right[0];
        $matr[3] = $right[1];
        $matr[6] = $right[2];

        $matr[1] = $up[0];
        $matr[4] = $up[1];
        $matr[7] = $up[2];

        $matr[2] = $view[0];
        $matr[5] = $view[1];
        $matr[8] = $view[2];

        return self::normalize($out, self::fromMat3($out, $matr));
    }

}