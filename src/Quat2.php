<?php

/**
 * Quaternion functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/quat2.js
 */

namespace rasteiner\glMatrix;

/**
 * Dual Quaternion  
 * Format: [real, dual]  
 * Quaternion format: XYZW  
 * Make sure to have normalized dual quaternions, otherwise the functions may not work as intended.
 */
class Quat2
{
    /**
     * Creates a new identity dual quat
     *
     * @return array {quat2} a new dual quaternion [real ->rotation, dual -> translation]
     */
    static function create() {
        return [0, 0, 0, 1, 0, 0, 0, 0];
    }

    /**
     * Creates a new quat initialized with values from an existing quaternion
     *
     * @param array {quat2} a quaternion to clone
     * @return array {quat2} a new quaternion
     */
    static function clone(array &$a): array
    {
        return [$a[0], $a[1], $a[2], $a[3], $a[4], $a[5], $a[6], $a[7]];
    }

    /**
     * Creates a new dual quat initialized with the given values
     *
     * @param float $x X component
     * @param float $y Y component
     * @param float $z Z component
     * @param float $w W component
     * @param float $x X component
     * @param float $y Y component
     * @param float $z Z component
     * @param float $w W component
     * @return array a new dual quaternion
     */
    static function fromValues(float $x, float $y, float $z, float $w, float $x2, float $y2, float $z2, float $w2): array {
        return [$x, $y, $z, $w, $x2, $y2, $z2, $w2];
    }

    /**
     * Creates a new dual quat from the given values (quat and translation)
     *
     * @param float $x1 X component
     * @param float $y1 Y component
     * @param float $z1 Z component
     * @param float $w1 W component
     * @param float $x2 X component of translation
     * @param float $y2 Y component of translation
     * @param float $z2 Z component of translation
     * @return array a new dual quaternion
     */
    static function fromRotationTranslationValues(float $x1, float $y1, float $z1, float $w1, float $x2, float $y2, float $z2): array 
    {
        $dq = [];
        $dq[0] = $x1;
        $dq[1] = $y1;
        $dq[2] = $z1;
        $dq[3] = $w1;
        $ax = $x2 * 0.5;
        $ay = $y2 * 0.5;
        $az = $z2 * 0.5;
        $dq[4] = $ax * $w1 + $ay * $z1 - $az * $y1;
        $dq[5] = $ay * $w1 + $az * $x1 - $ax * $z1;
        $dq[6] = $az * $w1 + $ax * $y1 - $ay * $x1;
        $dq[7] = -$ax * $x1 - $ay * $y1 - $az * $z1;
        return $dq;
    }

    /**
     * Creates a dual quat from a quaternion and a translation
     * 
     * @param array {quat} q Rotation quaternion
     * @param array {vec3} t Translation vector
     * @return array {quat2} Dual Quaternion
     */
    static function fromRotationTranslation(array $q, array $t): array
    {
        $ax = $t[0] * 0.5;
        $ay = $t[1] * 0.5;
        $az = $t[2] * 0.5;
        $bx = $q[0];
        $by = $q[1];
        $bz = $q[2];
        $bw = $q[3];
        $out[0] = $bx;
        $out[1] = $by;
        $out[2] = $bz;
        $out[3] = $bw;
        $out[4] = $ax * $bw + $ay * $bz - $az * $by;
        $out[5] = $ay * $bw + $az * $bx - $ax * $bz;
        $out[6] = $az * $bw + $ax * $by - $ay * $bx;
        $out[7] = -$ax * $bx - $ay * $by - $az * $bz;
        return $out;
    }

    /**
     * Creates a dual quat from a translation
     *
     * @param array {quat2} out Dual Quaternion
     * @param array {vec3} t Translation vector
     * @return array {quat2} Dual Quaternion
     */
    static function fromTranslation(array &$out, array $t): array
    {
        $out[0] = 0;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        $out[4] = $t[0] * 0.5;
        $out[5] = $t[1] * 0.5;
        $out[6] = $t[2] * 0.5;
        $out[7] = 0;
        return $out;
    }

    /**
     * Creates a dual quat from a quaternion
     *
     * @param array {quat2} out Dual Quaternion
     * @param array {quat} q Rotation quaternion
     * @return array {quat2} Dual Quaternion
     */
    static function fromRotation(array &$out, array $q): array
    {
        $out[0] = $q[0];
        $out[1] = $q[1];
        $out[2] = $q[2];
        $out[3] = $q[3];
        $out[4] = 0;
        $out[5] = 0;
        $out[6] = 0;
        $out[7] = 0;
        return $out;
    }

    /**
     * Creates a dual quat from a matrix (4x4)
     * 
     * @param array {quat2} out Dual Quaternion
     * @param array {mat4} m Matrix
     * @return array {quat2} Dual Quaternion
     */
    static function fromMat4(array &$out, array $a): array
    {
        //TODO Optimize this
        $outer = quat::create();
        mat4::getRotation($outer, $a);
        $t = [0, 0, 0];
        mat4::getTranslation($t, $a);
        self::fromRotationTranslation($out, $outer, $t);
        return $out;
    }

    /**
     * Copy the values from one dual quat to another
     *
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the source dual quaternion
     * @return array {quat2} out
     */
    static function copy(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[3];
        $out[4] = $a[4];
        $out[5] = $a[5];
        $out[6] = $a[6];
        $out[7] = $a[7];
        return $out;
    }

    /**
     * Set a dual quat to the identity dual quaternion
     *
     * @param array {quat2} out the receiving dual quaternion
     * @return array {quat2} out
     */
    static function identity(array &$out): array
    {
        $out[0] = 0;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        $out[4] = 0;
        $out[5] = 0;
        $out[6] = 0;
        $out[7] = 0;
        return $out;
    }

    /**
     * Sets a dual quat with the given values
     *
     * @param array {quat2} out the receiving dual quaternion
     * @param float $x1 X component of rotation
     * @param float $y1 Y component of rotation
     * @param float $z1 Z component of rotation
     * @param float $w1 W component of rotation
     * @param float $x2 X component of translation
     * @param float $y2 Y component of translation
     * @param float $z2 Z component of translation
     * @param float $w2 W component of translation
     * @return array {quat2} out
     */
    static function set(array &$out, float $x1, float $y1, float $z1, float $w1, float $x2, float $y2, float $z2, float $w2): array
    {
        $out[0] = $x1;
        $out[1] = $y1;
        $out[2] = $z1;
        $out[3] = $w1;

        $out[4] = $x2;
        $out[5] = $y2;
        $out[6] = $z2;
        $out[7] = $w2;
        return $out;
    }

    /**
     * Gets the real part of a dual quat
     * @param array {quat} out the receiving quaternion
     * @param array {quat2} a Dual Quaternion
     * @return array {quat} out
     */
    static function getReal(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[3];
        return $out;
    }

    /**
     * Gets the dual part of a dual quat
     * @param array {quat} out the receiving quaternion
     * @param array {quat2} a Dual Quaternion
     * @return array {quat} out
     */
    static function getDual(array &$out, array $a): array
    {
        $out[0] = $a[4];
        $out[1] = $a[5];
        $out[2] = $a[6];
        $out[3] = $a[7];
        return $out;
    }

    /**
     * Sets the real component of a dual quat
     *
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat} q a quaternion representing the real part
     * @return array {quat2} out
     */
    static function setReal(array &$out, array $q): array
    {
        $out[0] = $q[0];
        $out[1] = $q[1];
        $out[2] = $q[2];
        $out[3] = $q[3];
        return $out;
    }

    /**
     * Sets the dual component of a dual quat
     *
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat} q a quaternion representing the dual part
     * @return array {quat2} out
     */
    static function setDual(array &$out, array $q): array
    {
        $out[4] = $q[0];
        $out[5] = $q[1];
        $out[6] = $q[2];
        $out[7] = $q[3];
        return $out;
    }

    /**
     * Get the translation of a dual quat
     * 
     * @param array {vec3} out Vector3 receiving translation
     * @param array {quat2} a Dual Quaternion
     * @return array {vec3} out
     */
    static function getTranslation(array &$out, array $a): array
    {
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];

        $bx = -$a[0];
        $by = -$a[1];
        $bz = -$a[2];
        $bw = $a[3];

        $out[0] = ($ax * $bw + $aw * $bx + $ay * $bz - $az * $by) * 2;
        $out[1] = ($ay * $bw + $aw * $by + $az * $bx - $ax * $bz) * 2;
        $out[2] = ($az * $bw + $aw * $bz + $ax * $by - $ay * $bx) * 2;
        return $out;
    }

    /** 
     * Translate a dual quat by the given vector
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to translate
     * @param array {vec3} v vector to translate by
     * @return array {quat2} out
     */
    static function translate(array &$out, array $a, array $v): array
    {
        $ax1 = $a[0];
        $ay1 = $a[1];
        $az1 = $a[2];
        $aw1 = $a[3];
        $bx1 = $v[0] * 0.5;
        $by1 = $v[1] * 0.5;
        $bz1 = $v[2] * 0.5;
        $ax2 = $a[4];
        $ay2 = $a[5];
        $az2 = $a[6];
        $aw2 = $a[7];
        $out[0] = $ax1;
        $out[1] = $ay1;
        $out[2] = $az1;
        $out[3] = $aw1;
        $out[4] = $aw1 * $bx1 + $ay1 * $bz1 - $az1 * $by1 + $ax2;
        $out[5] = $aw1 * $by1 + $az1 * $bx1 - $ax1 * $bz1 + $ay2;
        $out[6] = $aw1 * $bz1 + $ax1 * $by1 - $ay1 * $bx1 + $az2;
        $out[7] = -$ax1 * $bx1 - $ay1 * $by1 - $az1 * $bz1 + $aw2;
        return $out;
    }

    /**
     * Rotates a dual quat around the X axis
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to rotate
     * @param float $rad the angle to rotate the dual quaternion by
     * @return array {quat2} out
     */
    static function rotateX(array &$out, array $a, float $rad): array
    {
        $bx = -$a[0];
        $by = -$a[1];
        $bz = -$a[2];
        $bw = $a[3];
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $ax1 = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $ay1 = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $az1 = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $aw1 = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        quat::rotateX($out, $a, $rad);
        $bx = $out[0];
        $by = $out[1];
        $bz = $out[2];
        $bw = $out[3];
        $out[4] = $ax1 * $bw + $aw1 * $bx + $ay1 * $bz - $az1 * $by;
        $out[5] = $ay1 * $bw + $aw1 * $by + $az1 * $bx - $ax1 * $bz;
        $out[6] = $az1 * $bw + $aw1 * $bz + $ax1 * $by - $ay1 * $bx;
        $out[7] = $aw1 * $bw - $ax1 * $bx - $ay1 * $by - $az1 * $bz;
        return $out;
    }
    
    
    /**
     * Rotates a dual quat around the Y axis
     *
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to rotate
     * @param float rad how far should the rotation be
     * @return array {quat2} out
     */
    static function rotateY(array &$out, array $a, float $rad): array
    {
        $bx = -$a[0];
        $by = -$a[1];
        $bz = -$a[2];
        $bw = $a[3];
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $ax1 = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $ay1 = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $az1 = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $aw1 = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        quat::rotateY($out, $a, $rad);
        $bx = $out[0];
        $by = $out[1];
        $bz = $out[2];
        $bw = $out[3];
        $out[4] = $ax1 * $bw + $aw1 * $bx + $ay1 * $bz - $az1 * $by;
        $out[5] = $ay1 * $bw + $aw1 * $by + $az1 * $bx - $ax1 * $bz;
        $out[6] = $az1 * $bw + $aw1 * $bz + $ax1 * $by - $ay1 * $bx;
        $out[7] = $aw1 * $bw - $ax1 * $bx - $ay1 * $by - $az1 * $bz;
        return $out;
    }

    /**
     * Rotates a dual quat around the Z axis
     *
     * @param {quat2} out the receiving dual quaternion
     * @param {ReadonlyQuat2} a the dual quaternion to rotate
     * @param {number} rad how far should the rotation be
     * @return {quat2} out
     */
    static function rotateZ(array &$out, array $a, float $rad)
    {
        $bx = -$a[0];
        $by = -$a[1];
        $bz = -$a[2];
        $bw = $a[3];
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $ax1 = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $ay1 = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $az1 = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $aw1 = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        quat::rotateZ($out, $a, $rad);
        $bx = $out[0];
        $by = $out[1];
        $bz = $out[2];
        $bw = $out[3];
        $out[4] = $ax1 * $bw + $aw1 * $bx + $ay1 * $bz - $az1 * $by;
        $out[5] = $ay1 * $bw + $aw1 * $by + $az1 * $bx - $ax1 * $bz;
        $out[6] = $az1 * $bw + $aw1 * $bz + $ax1 * $by - $ay1 * $bx;
        $out[7] = $aw1 * $bw - $ax1 * $bx - $ay1 * $by - $az1 * $bz;
        return $out;
    }

    /**
     * Rotates a dual quat by a given quaternion (a * q)
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to rotate
     * @param array {quat} q the quaternion to rotate by
     * @return array {quat2} out
     */
    static function rotateByQuatAppend(array &$out, array $a, array $q): array
    {
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $qx = $q[0];
        $qy = $q[1];
        $qz = $q[2];
        $qw = $q[3];
        $out[0] = $ax * $qw + $aw * $qx + $ay * $qz - $az * $qy;
        $out[1] = $ay * $qw + $aw * $qy + $az * $qx - $ax * $qz;
        $out[2] = $az * $qw + $aw * $qz + $ax * $qy - $ay * $qx;
        $out[3] = $aw * $qw - $ax * $qx - $ay * $qy - $az * $qz;
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $out[4] = $ax * $qw + $aw * $qx + $ay * $qz - $az * $qy;
        $out[5] = $ay * $qw + $aw * $qy + $az * $qx - $ax * $qz;
        $out[6] = $az * $qw + $aw * $qz + $ax * $qy - $ay * $qx;
        $out[7] = $aw * $qw - $ax * $qx - $ay * $qy - $az * $qz;
        return $out;
    }

    /**
     * Rotates a dual quat by a given quaternion (q * a)
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to rotate
     * @param array {quat} q the quaternion to rotate by
     * @return array {quat2} out
     */
    static function rotateByQuatPrepend(array &$out, array $a, array $q): array
    {
        $bx = $q[0];
        $by = $q[1];
        $bz = $q[2];
        $bw = $q[3];
        $ax = $a[0];
        $ay = $a[1];
        $az = $a[2];
        $aw = $a[3];
        $out[0] = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $out[1] = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $out[2] = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $out[3] = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $out[4] = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $out[5] = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $out[6] = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $out[7] = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;
        return $out;
    }

    /**
     * Rotates a dual quat around a given axis. Does the normalisation automatically.
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to rotate
     * @param array {vec3} axis the axis to rotate around
     * @param float rad the angle to rotate the dual quaternion by
     * @return array {quat2} out
     */
    static function rotateAroundAxis(array &$out, array $a, array $axis, float $rad): array
    {
        //Special case for rad = 0
        if (abs($rad) < glMatrix::EPSILON) {
            return self::copy($out, $a);
        }

        $axisLength = sqrt($axis[0] * $axis[0] + $axis[1] * $axis[1] + $axis[2] * $axis[2]);

        $rad = $rad * 0.5;
        $s = sin($rad);
        $bx = ($s * $axis[0]) / $axisLength;
        $by = ($s * $axis[1]) / $axisLength;
        $bz = ($s * $axis[2]) / $axisLength;
        $bw = cos($rad);

        $ax1 = $a[0];
        $ay1 = $a[1];
        $az1 = $a[2];
        $aw1 = $a[3];
        $out[0] = $ax1 * $bw + $aw1 * $bx + $ay1 * $bz - $az1 * $by;
        $out[1] = $ay1 * $bw + $aw1 * $by + $az1 * $bx - $ax1 * $bz;
        $out[2] = $az1 * $bw + $aw1 * $bz + $ax1 * $by - $ay1 * $bx;
        $out[3] = $aw1 * $bw - $ax1 * $bx - $ay1 * $by - $az1 * $bz;

        $ax = $a[4];
        $ay = $a[5];
        $az = $a[6];
        $aw = $a[7];
        $out[4] = $ax * $bw + $aw * $bx + $ay * $bz - $az * $by;
        $out[5] = $ay * $bw + $aw * $by + $az * $bx - $ax * $bz;
        $out[6] = $az * $bw + $aw * $bz + $ax * $by - $ay * $bx;
        $out[7] = $aw * $bw - $ax * $bx - $ay * $by - $az * $bz;

        return $out;
    }

    /**
     * Adds two dual quat's
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the first operand
     * @param array {quat2} b the second operand
     * @return array {quat2} out
     */
    static function add(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] + $b[0];
        $out[1] = $a[1] + $b[1];
        $out[2] = $a[2] + $b[2];
        $out[3] = $a[3] + $b[3];
        $out[4] = $a[4] + $b[4];
        $out[5] = $a[5] + $b[5];
        $out[6] = $a[6] + $b[6];
        $out[7] = $a[7] + $b[7];
        return $out;
    }

    /**
     * Multiplies two dual quat's
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the first operand
     * @param array {quat2} b the second operand
     * @return array {quat2} out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $ax0 = $a[0];
        $ay0 = $a[1];
        $az0 = $a[2];
        $aw0 = $a[3];
        $ax1 = $a[4];
        $ay1 = $a[5];
        $az1 = $a[6];
        $aw1 = $a[7];
        $bx0 = $b[0];
        $by0 = $b[1];
        $bz0 = $b[2];
        $bw0 = $b[3];
        $bx1 = $b[4];
        $by1 = $b[5];
        $bz1 = $b[6];
        $bw1 = $b[7];
        $out[0] = $ax0 * $bw0 + $aw0 * $bx0 + $ay0 * $bz0 - $az0 * $by0;
        $out[1] = $ay0 * $bw0 + $aw0 * $by0 + $az0 * $bx0 - $ax0 * $bz0;
        $out[2] = $az0 * $bw0 + $aw0 * $bz0 + $ax0 * $by0 - $ay0 * $bx0;
        $out[3] = $aw0 * $bw0 - $ax0 * $bx0 - $ay0 * $by0 - $az0 * $bz0;
        $out[4] = $ax0 * $bw1 + $aw0 * $bx1 + $ay0 * $bz1 - $az0 * $by1 + $ax1 * $bw0 + $aw1 * $bx0 + $ay1 * $bz0 - $az1 * $by0;
        $out[5] = $ay0 * $bw1 + $aw0 * $by1 + $az0 * $bx1 - $ax0 * $bz1 + $ay1 * $bw0 + $aw1 * $by0 + $az1 * $bx0 - $ax1 * $bz0;
        $out[6] = $az0 * $bw1 + $aw0 * $bz1 + $ax0 * $by1 - $ay0 * $bx1 + $az1 * $bw0 + $aw1 * $bz0 + $ax1 * $by0 - $ay1 * $bx0;
        $out[7] = $aw0 * $bw1 - $ax0 * $bx1 - $ay0 * $by1 - $az0 * $bz1 + $aw1 * $bw0 - $ax1 * $bx0 - $ay1 * $by0 - $az1 * $bz0;
        return $out;
    }

    /**
     * Scales a dual quat by a scalar number
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the dual quaternion to scale
     * @param float {Number} b amount to scale the dual quaternion by
     * @return array {quat2} out
     */
    static function scale(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        $out[3] = $a[3] * $b;
        $out[4] = $a[4] * $b;
        $out[5] = $a[5] * $b;
        $out[6] = $a[6] * $b;
        $out[7] = $a[7] * $b;
        return $out;
    }

    /**
     * Calculates the dot product of two dual quat's
     * 
     * @param array {quat2} a the first operand
     * @param array {quat2} b the second operand
     * @return float {Number} dot product of a and b
     */
    static function dot(array $a, array $b): float
    {
        return $a[0] * $b[0] + $a[1] * $b[1] + $a[2] * $b[2] + $a[3] * $b[3];
    }

    /**
     * Performs a linear interpolation between two dual quat's
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a the first operand
     * @param array {quat2} b the second operand
     * @param float {Number} t interpolation amount between the two inputs
     * @return array {quat2} out
     */
    static function lerp(array &$out, array $a, array $b, float $t): array
    {
        $mt = 1 - $t;
        if (self::dot($a, $b) < 0) $t = -$t;
      
        $out[0] = $a[0] * $mt + $b[0] * $t;
        $out[1] = $a[1] * $mt + $b[1] * $t;
        $out[2] = $a[2] * $mt + $b[2] * $t;
        $out[3] = $a[3] * $mt + $b[3] * $t;
        $out[4] = $a[4] * $mt + $b[4] * $t;
        $out[5] = $a[5] * $mt + $b[5] * $t;
        $out[6] = $a[6] * $mt + $b[6] * $t;
        $out[7] = $a[7] * $mt + $b[7] * $t;
      
        return $out;
    }

    /**
     * Calculates the inverse of a dual quat. If they are normalized, conjugate is cheaper.
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a dual quaternion to calculate inverse of
     * @return array {quat2} out
     */
    static function invert(array &$out, array $a): array
    {
        $sqlen = self::squaredLength($a);
        $out[0] = -$a[0] / $sqlen;
        $out[1] = -$a[1] / $sqlen;
        $out[2] = -$a[2] / $sqlen;
        $out[3] = $a[3] / $sqlen;
        $out[4] = -$a[4] / $sqlen;
        $out[5] = -$a[5] / $sqlen;
        $out[6] = -$a[6] / $sqlen;
        $out[7] = $a[7] / $sqlen;
        return $out;
    }

    /**
     * Calculates the conjugate of a dual quat
     * If the dual quaternion is normalized, this function is faster than quat2.inverse and produces the same result.
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a dual quaternion to calculate conjugate of
     * @return array {quat2} out
     */
    static function conjugate(array &$out, array $a): array
    {
        $out[0] = -$a[0];
        $out[1] = -$a[1];
        $out[2] = -$a[2];
        $out[3] = $a[3];
        $out[4] = -$a[4];
        $out[5] = -$a[5];
        $out[6] = -$a[6];
        $out[7] = $a[7];
        return $out;
    }

    /**
     * Calculates the length of a dual quat
     * 
     * @param array {quat2} a dual quaternion to calculate length of
     * @return float {Number} length of a
     */
    static function length(array $a): float
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];
        return sqrt($x * $x + $y * $y + $z * $z + $w * $w);
    }

    /**
     * Calculates the squared length of a dual quat
     * 
     * @param array {quat2} a dual quaternion to calculate squared length of
     * @return float {Number} squared length of a
     */
    static function squaredLength(array $a): float
    {
        $x = $a[0];
        $y = $a[1];
        $z = $a[2];
        $w = $a[3];
        return $x * $x + $y * $y + $z * $z + $w * $w;
    }

    /**
     * Normalize a dual quat
     * 
     * @param array {quat2} out the receiving dual quaternion
     * @param array {quat2} a dual quaternion to normalize
     * @return array {quat2} out
     */
    static function normalize(array &$out, array $a): array
    {
        $magnitude = self::squaredLength($a);
        if ($magnitude > 0) {
            $magnitude = sqrt($magnitude);

            $a0 = $a[0] / $magnitude;
            $a1 = $a[1] / $magnitude;
            $a2 = $a[2] / $magnitude;
            $a3 = $a[3] / $magnitude;

            $b0 = $a[4];
            $b1 = $a[5];
            $b2 = $a[6];
            $b3 = $a[7];

            $a_dot_b = $a0 * $b0 + $a1 * $b1 + $a2 * $b2 + $a3 * $b3;

            $out[0] = $a0;
            $out[1] = $a1;
            $out[2] = $a2;
            $out[3] = $a3;

            $out[4] = ($b0 - $a0 * $a_dot_b) / $magnitude;
            $out[5] = ($b1 - $a1 * $a_dot_b) / $magnitude;
            $out[6] = ($b2 - $a2 * $a_dot_b) / $magnitude;
            $out[7] = ($b3 - $a3 * $a_dot_b) / $magnitude;
        }
        return $out;
    }

    /**
     * Returns a string representation of a dual quat
     * 
     * @param array {quat2} a dual quaternion to represent as a string
     */
    static function str(array $a): string
    {
        return "quat2(" . $a[0] . ", " . $a[1] . ", " . $a[2] . ", " . $a[3] . ", " . $a[4] . ", " . $a[5] . ", " . $a[6] . ", " . $a[7] . ")";
    }

    /**
     * Returns whether or not the dual quaternions have exactly the same elements in the same position (when compared with ===)
     * 
     * @param array {quat2} a the first dual quaternion.
     * @param array {quat2} b the second dual quaternion.
     * @return bool {Boolean} true if the dual quaternions are equal, false otherwise.
     */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1] && $a[2] === $b[2] && $a[3] === $b[3] && $a[4] === $b[4] && $a[5] === $b[5] && $a[6] === $b[6] && $a[7] === $b[7];
    }

    /**
     * Returns whether or not the dual quaternions have approximately the same elements in the same position.
     * 
     * @param array {quat2} a the first dual quaternion.
     * @param array {quat2} b the second dual quaternion.
     * @return bool {Boolean} true if the dual quaternions are equal, false otherwise.
     */
    static function equals(array $a, array $b): bool
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $a4 = $a[4];
        $a5 = $a[5];
        $a6 = $a[6];
        $a7 = $a[7];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        $b4 = $b[4];
        $b5 = $b[5];
        $b6 = $b[6];
        $b7 = $b[7];
        return (abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
            abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) &&
            abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2)) &&
            abs($a3 - $b3) <= glMatrix::EPSILON * max(1.0, abs($a3), abs($b3)) &&
            abs($a4 - $b4) <= glMatrix::EPSILON * max(1.0, abs($a4), abs($b4)) &&
            abs($a5 - $b5) <= glMatrix::EPSILON * max(1.0, abs($a5), abs($b5)) &&
            abs($a6 - $b6) <= glMatrix::EPSILON * max(1.0, abs($a6), abs($b6)) &&
            abs($a7 - $b7) <= glMatrix::EPSILON * max(1.0, abs($a7), abs($b7)));
    }
}
