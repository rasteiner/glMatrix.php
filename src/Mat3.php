<?php

/**
 * 3x3 matrix functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/mat3.js
 */

namespace rasteiner\glMatrix;

/**
 * 3x3 Matrix
 */
class Mat3
{
    /**
     * Creates a new identity mat3
     * 
     * @return array
     */
    static function create(): array
    {
        return [
            1, 0, 0,
            0, 1, 0,
            0, 0, 1,
        ];
    }

    
    /**
     * Copies the upper-left 3x3 values into the given mat3.
     * 
     * @param array $out the receiving 3x3 matrix
     * @param array $a   the source 4x4 matrix
     * @return array
     */
    static function fromMat4(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[4];
        $out[4] = $a[5];
        $out[5] = $a[6];
        $out[6] = $a[8];
        $out[7] = $a[9];
        $out[8] = $a[10];
        return $out;
    }

    /**
     * Creates a new mat3 initialized with values from an existing matrix
     * 
     * @param array $a matrix to clone
     * @return array
     */
    static function clone(array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[3];
        $out[4] = $a[4];
        $out[5] = $a[5];
        $out[6] = $a[6];
        $out[7] = $a[7];
        $out[8] = $a[8];
        return $out;
    }

    /**
     * Copy the values from one mat3 to another
     * 
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array
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
        $out[8] = $a[8];
        return $out;
    }

    /**
     * Create a new mat3 with the given values
     *
     * @param float $m00 Component in column 0, row 0 position (index 0)
     * @param float $m01 Component in column 0, row 1 position (index 1)
     * @param float $m02 Component in column 0, row 2 position (index 2)
     * @param float $m10 Component in column 1, row 0 position (index 3)
     * @param float $m11 Component in column 1, row 1 position (index 4)
     * @param float $m12 Component in column 1, row 2 position (index 5)
     * @param float $m20 Component in column 2, row 0 position (index 6)
     * @param float $m21 Component in column 2, row 1 position (index 7)
     * @param float $m22 Component in column 2, row 2 position (index 8)
     * @return array
     */
    static function fromValues(
        float $m00, float $m01, float $m02,
        float $m10, float $m11, float $m12,
        float $m20, float $m21, float $m22
    ): array {
        return array(
            $m00, $m01, $m02,
            $m10, $m11, $m12,
            $m20, $m21, $m22
        );
    }
    
    /**
     * Set the components of a mat3 to the given values
     *
     * @param array $out the receiving matrix
     * @param float $m00 Component in column 0, row 0 position (index 0)
     * @param float $m01 Component in column 0, row 1 position (index 1)
     * @param float $m02 Component in column 0, row 2 position (index 2)
     * @param float $m10 Component in column 1, row 0 position (index 3)
     * @param float $m11 Component in column 1, row 1 position (index 4)
     * @param float $m12 Component in column 1, row 2 position (index 5)
     * @param float $m20 Component in column 2, row 0 position (index 6)
     * @param float $m21 Component in column 2, row 1 position (index 7)
     * @param float $m22 Component in column 2, row 2 position (index 8)
     * @return array
     */
    static function set(
        array &$out,
        float $m00, float $m01, float $m02,
        float $m10, float $m11, float $m12,
        float $m20, float $m21, float $m22
    ): array {
        $out[0] = $m00;
        $out[1] = $m01;
        $out[2] = $m02;
        $out[3] = $m10;
        $out[4] = $m11;
        $out[5] = $m12;
        $out[6] = $m20;
        $out[7] = $m21;
        $out[8] = $m22;
        return $out;
    }

    /**
     * Set a mat3 to the identity matrix
     * 
     * @param array $out the receiving matrix
     * @return array
     */
    static function identity(array &$out): array
    {
        $out[0] = 1;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 0;
        $out[4] = 1;
        $out[5] = 0;
        $out[6] = 0;
        $out[7] = 0;
        $out[8] = 1;
        return $out;
    }

    /**
     * Transpose the values of a mat3
     * 
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array
     */
    static function transpose(array &$out, array $a): array
    {
        // If we are transposing ourselves we can skip a few steps but have to cache some values
        if ($out === $a) {
            $a01 = $a[1];
            $a02 = $a[2];
            $a12 = $a[5];
            $out[1] = $a[3];
            $out[2] = $a[6];
            $out[3] = $a01;
            $out[5] = $a[7];
            $out[6] = $a02;
            $out[7] = $a12;
        } else {
            $out[0] = $a[0];
            $out[1] = $a[3];
            $out[2] = $a[6];
            $out[3] = $a[1];
            $out[4] = $a[4];
            $out[5] = $a[7];
            $out[6] = $a[2];
            $out[7] = $a[5];
            $out[8] = $a[8];
        }
        return $out;
    }

    /**
     * Inverts a mat3
     * 
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array
     */
    static function invert(array &$out, array $a): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];

        $b01 = $a22 * $a11 - $a12 * $a21;
        $b11 = -$a22 * $a10 + $a12 * $a20;
        $b21 = $a21 * $a10 - $a11 * $a20;

        // Calculate the determinant
        $det = $a00 * $b01 + $a01 * $b11 + $a02 * $b21;

        if ($det === 0) {
            return null;
        }
        $det = 1.0 / $det;

        $out[0] = $b01 * $det;
        $out[1] = (-$a22 * $a01 + $a02 * $a21) * $det;
        $out[2] = ($a12 * $a01 - $a02 * $a11) * $det;
        $out[3] = $b11 * $det;
        $out[4] = ($a22 * $a00 - $a02 * $a20) * $det;
        $out[5] = (-$a12 * $a00 + $a02 * $a10) * $det;
        $out[6] = $b21 * $det;
        $out[7] = (-$a21 * $a00 + $a01 * $a20) * $det;
        $out[8] = ($a11 * $a00 - $a01 * $a10) * $det;
        return $out;
    }

    /**
     * Calculates the adjugate of a mat3
     * 
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array
     */
    static function adjoint(array &$out, array $a): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];

        $out[0] = ($a11 * $a22 - $a12 * $a21);
        $out[1] = ($a02 * $a21 - $a01 * $a22);
        $out[2] = ($a01 * $a12 - $a02 * $a11);
        $out[3] = ($a12 * $a20 - $a10 * $a22);
        $out[4] = ($a00 * $a22 - $a02 * $a20);
        $out[5] = ($a02 * $a10 - $a00 * $a12);
        $out[6] = ($a10 * $a21 - $a11 * $a20);
        $out[7] = ($a01 * $a20 - $a00 * $a21);
        $out[8] = ($a00 * $a11 - $a01 * $a10);
        return $out;
    }

    /**
     * Calculates the determinant of a mat3
     * 
     * @param array $a the source matrix
     * @return float
     */
    static function determinant(array $a): float
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];

        return ($a00 * ($a22 * $a11 - $a12 * $a21) +
            $a01 * (-$a22 * $a10 + $a12 * $a20) +
            $a02 * ($a21 * $a10 - $a11 * $a20));
    }

    /**
     * Multiplies two mat3's
     * 
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];
        $b00 = $b[0];
        $b01 = $b[1];
        $b02 = $b[2];
        $b10 = $b[3];
        $b11 = $b[4];
        $b12 = $b[5];
        $b20 = $b[6];
        $b21 = $b[7];
        $b22 = $b[8];
        $out[0] = $b00 * $a00 + $b01 * $a10 + $b02 * $a20;
        $out[1] = $b00 * $a01 + $b01 * $a11 + $b02 * $a21;
        $out[2] = $b00 * $a02 + $b01 * $a12 + $b02 * $a22;
        $out[3] = $b10 * $a00 + $b11 * $a10 + $b12 * $a20;
        $out[4] = $b10 * $a01 + $b11 * $a11 + $b12 * $a21;
        $out[5] = $b10 * $a02 + $b11 * $a12 + $b12 * $a22;
        $out[6] = $b20 * $a00 + $b21 * $a10 + $b22 * $a20;
        $out[7] = $b20 * $a01 + $b21 * $a11 + $b22 * $a21;
        $out[8] = $b20 * $a02 + $b21 * $a12 + $b22 * $a22;
        return $out;
    }

    /**
     * Translates the mat3 by the dimensions in the given vec2
     * 
     * @param array $out the receiving matrix
     * @param array $a the matrix to translate
     * @param array $v the vec2 to translate the matrix by
     * @return array
     **/
    static function translate(array &$out, array $a, array $v): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];
        $x = $v[0];
        $y = $v[1];

        $out[0] = $a00;
        $out[1] = $a01;
        $out[2] = $a02;

        $out[3] = $a10;
        $out[4] = $a11;
        $out[5] = $a12;

        $out[6] = $x * $a00 + $y * $a10 + $a20;
        $out[7] = $x * $a01 + $y * $a11 + $a21;
        $out[8] = $x * $a02 + $y * $a12 + $a22;
        return $out;
    }

    /**
     * Rotates a mat3 by the given angle
     * 
     * @param array $out the receiving matrix
     * @param array $a the matrix to rotate
     * @param float $rad the angle to rotate the matrix by
     * @return array
     */
    static function rotate(array &$out, array $a, float $rad): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a10 = $a[3];
        $a11 = $a[4];
        $a12 = $a[5];
        $a20 = $a[6];
        $a21 = $a[7];
        $a22 = $a[8];
        $s = sin($rad);
        $c = cos($rad);
        $out[0] = $c * $a00 + $s * $a10;
        $out[1] = $c * $a01 + $s * $a11;
        $out[2] = $c * $a02 + $s * $a12;
        $out[3] = $c * $a10 - $s * $a00;
        $out[4] = $c * $a11 - $s * $a01;
        $out[5] = $c * $a12 - $s * $a02;
        $out[6] = $a20;
        $out[7] = $a21;
        $out[8] = $a22;
        return $out;
    }

    /**
     * Scales the mat3 by the dimensions in the given vec2
     * 
     * @param array $out the receiving matrix
     * @param array $a the matrix to rotate
     * @param array $v the vec2 to scale the matrix by
     * @return array
     **/
    static function scale(array &$out, array $a, array $v): array
    {
        $x = $v[0];
        $y = $v[1];
        $out[0] = $x * $a[0];
        $out[1] = $x * $a[1];
        $out[2] = $x * $a[2];
        $out[3] = $y * $a[3];
        $out[4] = $y * $a[4];
        $out[5] = $y * $a[5];
        $out[6] = $a[6];
        $out[7] = $a[7];
        $out[8] = $a[8];
        return $out;
    }

    /**
     * Creates a matrix from a vector translation
     * 
     * @param array $out {mat3} receiving operation result
     * @param array $v {vec2} Translation vector
     * @return array
     */
    static function fromTranslation(array &$out, array $v): array
    {
        $out[0] = 1;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 0;
        $out[4] = 1;
        $out[5] = 0;
        $out[6] = $v[0];
        $out[7] = $v[1];
        $out[8] = 1;
        return $out;
    }

    /**
     * Creates a matrix from a given angle
     * This is equivalent to (but much faster than):
     * 
     *     mat3::identity(dest);
     *     mat3::rotate(dest, dest, rad);
     * 
     * @param array $out mat3 receiving operation result
     * @param float $rad the angle to rotate the matrix by
     * @return array
     */
    static function fromRotation(array &$out, float $rad): array
    {
        $s = sin($rad);
        $c = cos($rad);
        $out[0] = $c;
        $out[1] = $s;
        $out[2] = 0;
        $out[3] = -$s;
        $out[4] = $c;
        $out[5] = 0;
        $out[6] = 0;
        $out[7] = 0;
        $out[8] = 1;
        return $out;
    }

    /**
     * Creates a matrix from a vector scaling
     * This is equivalent to (but much faster than):
     * 
     *     mat3::identity(dest);
     *     mat3::scale(dest, dest, vec);
     * 
     * @param array $out mat3 receiving operation result
     * @param array $v Scaling vector
     * @return array
     */
    static function fromScaling(array &$out, array $v): array
    {
        $out[0] = $v[0];
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 0;
        $out[4] = $v[1];
        $out[5] = 0;
        $out[6] = 0;
        $out[7] = 0;
        $out[8] = 1;
        return $out;
    }

    /**
     * Copies the values from a mat2d into a mat3
     * 
     * @param array $out the receiving matrix
     * @param array $a the matrix to copy
     * @return array
     */
    static function fromMat2d(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = 0;
        $out[3] = $a[2];
        $out[4] = $a[3];
        $out[5] = 0;
        $out[6] = $a[4];
        $out[7] = $a[5];
        $out[8] = 1;
        return $out;
    }

    /**
     * Calculates a 3x3 matrix from the given quaternion
     * 
     * @param array $out mat3 receiving operation result
     * @param array $q Quaternion to create matrix from
     * @return array
     */
    static function fromQuat(array &$out, array $q): array
    {
        $x = $q[0];
        $y = $q[1];
        $z = $q[2];
        $w = $q[3];
        
        $x2 = $x + $x;
        $y2 = $y + $y;
        $z2 = $z + $z;
        
        $xx = $x * $x2;
        $xy = $x * $y2;
        $xz = $x * $z2;
        $yy = $y * $y2;
        $yz = $y * $z2;
        $zz = $z * $z2;
        $wx = $w * $x2;
        $wy = $w * $y2;
        $wz = $w * $z2;
        
        $out[0] = 1 - $yy - $zz;
        $out[3] = $xy + $wz;
        $out[6] = $xz - $wy;
        
        $out[1] = $xy - $wz;
        $out[4] = 1 - $xx - $zz;
        $out[7] = $yz + $wx;

        $out[2] = $xz + $wy;
        $out[5] = $yz - $wx;
        $out[8] = 1 - $xx - $yy;
        return $out;
    }

    /**
     * Calculates a 3x3 normal matrix (transpose inverse) from the 4x4 matrix
     * 
     * @param array $out mat3 receiving operation result
     * @param array $a Mat4 to derive the normal matrix from
     * @return array
     */
    static function normalFromMat4(array &$out, array $a): array
    {
        $a00 = $a[0];
        $a01 = $a[1];
        $a02 = $a[2];
        $a03 = $a[3];
        $a10 = $a[4];
        $a11 = $a[5];
        $a12 = $a[6];
        $a13 = $a[7];
        $a20 = $a[8];
        $a21 = $a[9];
        $a22 = $a[10];
        $a23 = $a[11];
        $a30 = $a[12];
        $a31 = $a[13];
        $a32 = $a[14];
        $a33 = $a[15];
        
        $b00 = $a00 * $a11 - $a01 * $a10;
        $b01 = $a00 * $a12 - $a02 * $a10;
        $b02 = $a00 * $a13 - $a03 * $a10;
        $b03 = $a01 * $a12 - $a02 * $a11;
        $b04 = $a01 * $a13 - $a03 * $a11;
        $b05 = $a02 * $a13 - $a03 * $a12;
        $b06 = $a20 * $a31 - $a21 * $a30;
        $b07 = $a20 * $a32 - $a22 * $a30;
        $b08 = $a20 * $a33 - $a23 * $a30;
        $b09 = $a21 * $a32 - $a22 * $a31;
        $b10 = $a21 * $a33 - $a23 * $a31;
        $b11 = $a22 * $a33 - $a23 * $a32;
        
        // Calculate the determinant
        $det = $b00 * $b11 - $b01 * $b10 + $b02 * $b09 + $b03 * $b08 - $b04 * $b07 + $b05 * $b06;
        
        if ($det === 0) {
            return null;
        }
        $det = 1.0 / $det;

        $out[0] = ($a11 * $b11 - $a12 * $b10 + $a13 * $b09) * $det;
        $out[1] = ($a12 * $b08 - $a10 * $b11 - $a13 * $b07) * $det;
        $out[2] = ($a10 * $b10 - $a11 * $b08 + $a13 * $b06) * $det;

        $out[3] = ($a02 * $b10 - $a01 * $b11 - $a03 * $b09) * $det;
        $out[4] = ($a00 * $b11 - $a02 * $b08 + $a03 * $b07) * $det;
        $out[5] = ($a01 * $b08 - $a00 * $b10 - $a03 * $b06) * $det;

        $out[6] = ($a31 * $b05 - $a32 * $b04 + $a33 * $b03) * $det;
        $out[7] = ($a32 * $b02 - $a30 * $b05 - $a33 * $b01) * $det;
        $out[8] = ($a30 * $b04 - $a31 * $b02 + $a33 * $b00) * $det;

        return $out;
    }

    /**
     * Generates a 2D projection matrix with the given bounds
     *
     * @param array $out mat3 frustum matrix will be written into
     * @param float $width Width of your gl context
     * @param float $height Height of gl context
     * @return array
     */
    static function projection(array &$out, float $width, float $height): array
    {
        $out[0] = 2 / $width;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 0;
        $out[4] = -2 / $height;
        $out[5] = 0;
        $out[6] = -1;
        $out[7] = 1;
        $out[8] = 1;
        return $out;
    }

    /**
     * Returns a string representation of a mat3
     *
     * @param array $a matrix to represent as a string
     * @return string
     */
    static function str(array $a): string
    {
        return 'mat3(' . $a[0] . ', ' . $a[1] . ', ' . $a[2] . ', '
            . $a[3] . ', ' . $a[4] . ', ' . $a[5] . ', '
            . $a[6] . ', ' . $a[7] . ', ' . $a[8] . ')';
    }

    /**
     * Returns Frobenius norm of a mat3
     *
     * @param array $a the matrix to calculate Frobenius norm of
     * @return float
     */
    static function frob(array $a): float
    {
        return sqrt(
            $a[0] * $a[0] + $a[1] * $a[1] + $a[2] * $a[2] +
            $a[3] * $a[3] + $a[4] * $a[4] + $a[5] * $a[5] +
            $a[6] * $a[6] + $a[7] * $a[7] + $a[8] * $a[8]
        );
    }

    /**
     * Adds two mat3's
     *
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array
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
        $out[8] = $a[8] + $b[8];
        return $out;
    }

    /**
     * Subtracts matrix b from matrix a
     *
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array
     */
    static function subtract(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] - $b[0];
        $out[1] = $a[1] - $b[1];
        $out[2] = $a[2] - $b[2];
        $out[3] = $a[3] - $b[3];
        $out[4] = $a[4] - $b[4];
        $out[5] = $a[5] - $b[5];
        $out[6] = $a[6] - $b[6];
        $out[7] = $a[7] - $b[7];
        $out[8] = $a[8] - $b[8];
        return $out;
    }

    /**
     * Multiply each element of the matrix by a scalar.
     *
     * @param array $out the receiving matrix
     * @param array $a the matrix to scale
     * @param float $b amount to scale the matrix's elements by
     * @return array
     */
    static function multiplyScalar(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        $out[3] = $a[3] * $b;
        $out[4] = $a[4] * $b;
        $out[5] = $a[5] * $b;
        $out[6] = $a[6] * $b;
        $out[7] = $a[7] * $b;
        $out[8] = $a[8] * $b;
        return $out;
    }

    /**
     * Adds two mat3's after multiplying each element of the second operand by a scalar value.
     *
     * @param array $out the receiving vector
     * @param array $a the first operand
     * @param array $b the second operand
     * @param float $scale the amount to scale b's elements by before adding
     * @return array
     */
    static function multiplyScalarAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        $out[2] = $a[2] + ($b[2] * $scale);
        $out[3] = $a[3] + ($b[3] * $scale);
        $out[4] = $a[4] + ($b[4] * $scale);
        $out[5] = $a[5] + ($b[5] * $scale);
        $out[6] = $a[6] + ($b[6] * $scale);
        $out[7] = $a[7] + ($b[7] * $scale);
        $out[8] = $a[8] + ($b[8] * $scale);
        return $out;
    }

    /**
     * Returns whether or not the matrices have exactly the same elements in the same position (when compared with ===)
     *
     * @param array $a The first matrix.
     * @param array $b The second matrix.
     * @return bool True if the matrices are equal, false otherwise.
     */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1] && $a[2] === $b[2] &&
            $a[3] === $b[3] && $a[4] === $b[4] && $a[5] === $b[5] &&
            $a[6] === $b[6] && $a[7] === $b[7] && $a[8] === $b[8];
    }

    /**
     * Returns whether or not the matrices have approximately the same elements in the same position.
     *
     * @param array $a The first matrix.
     * @param array $b The second matrix.
     * @return bool True if the matrices are equal, false otherwise.
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
        $a8 = $a[8];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        $b4 = $b[4];
        $b5 = $b[5];
        $b6 = $b[6];
        $b7 = $b[7];
        $b8 = $b[8];

        return (abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
            abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) &&
            abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2)) &&
            abs($a3 - $b3) <= glMatrix::EPSILON * max(1.0, abs($a3), abs($b3)) &&
            abs($a4 - $b4) <= glMatrix::EPSILON * max(1.0, abs($a4), abs($b4)) &&
            abs($a5 - $b5) <= glMatrix::EPSILON * max(1.0, abs($a5), abs($b5)) &&
            abs($a6 - $b6) <= glMatrix::EPSILON * max(1.0, abs($a6), abs($b6)) &&
            abs($a7 - $b7) <= glMatrix::EPSILON * max(1.0, abs($a7), abs($b7)) &&
            abs($a8 - $b8) <= glMatrix::EPSILON * max(1.0, abs($a8), abs($b8)));
    }

    /**
     * Alias for {@see Mat3::multiply}
     * @return array
     */
    static function mul(array &$out, array $a, array $b): array
    {
        return self::multiply($out, $a, $b);
    }

    /**
     * Alias for {@see Mat3::subtract}
     * @return array
     */
    static function sub(array &$out, array $a, array $b): array
    {
        return self::subtract($out, $a, $b);
    }
}