<?php

/**
 * 2x3 matrix functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/mat2d.js
 */

namespace rasteiner\glMatrix;

/**
 * 2x3 Matrix
 * 
 * A mat2d contains six elements defined as:
 * 
 * a, b,  
 * c, d,  
 * tx, ty  
 * 
 * This is a short form for the 3x3 matrix:
 * 
 * a, b, 0,  
 * c, d, 0,  
 * tx, ty, 1  
 * 
 * The last column is ignored so the array is shorter and operations are faster.
 */
class Mat2d
{
    /**
     * Creates a new identity mat2d
     *
     * @return array a new 2x3 matrix
     */
    static function create(): array
    {
        return [
            1, 0,
            0, 1,
            0, 0
        ];
    }

    /**
     * Creates a new mat2d initialized with values from an existing matrix
     *
     * @param array $a matrix to clone
     * @return array a new 2x3 matrix
     */
    static function clone(array $a): array
    {
        return [
            $a[0], $a[1],
            $a[2], $a[3],
            $a[4], $a[5]
        ];
    }

    /**
     * Copy the values from one mat2d to another
     *
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array out
     */
    static function copy(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[3];
        $out[4] = $a[4];
        $out[5] = $a[5];
        return $out;
    }

    /**
     * Set a mat2d to the identity matrix
     *
     * @param array $out the receiving matrix
     * @return array out
     */
    static function identity(array &$out): array
    {
        $out[0] = 1;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        $out[4] = 0;
        $out[5] = 0;
        return $out;
    }

    /**
     * Create a new mat2d with the given values
     *
     * @param float $a Component A (index 0)
     * @param float $b Component B (index 1)
     * @param float $c Component C (index 2)
     * @param float $d Component D (index 3)
     * @param float $tx Component TX (index 4)
     * @param float $ty Component TY (index 5)
     * @return array a new 2x3 matrix
     */
    static function fromValues(float $a, float $b, float $c, float $d, float $tx, float $ty): array
    {
        return [$a, $b, $c, $d, $tx, $ty];
    }

    /**
     * Set the components of a mat2d to the given values
     *
     * @param array $out the receiving matrix
     * @param float $a Component A (index 0)
     * @param float $b Component B (index 1)
     * @param float $c Component C (index 2)
     * @param float $d Component D (index 3)
     * @param float $tx Component TX (index 4)
     * @param float $ty Component TY (index 5)
     * @return array out
     */
    static function set(array &$out, float $a, float $b, float $c, float $d, float $tx, float $ty): array
    {
        $out[0] = $a;
        $out[1] = $b;
        $out[2] = $c;
        $out[3] = $d;
        $out[4] = $tx;
        $out[5] = $ty;
        return $out;
    }

    /**
     * Inverts a mat2d
     *
     * @param array $out the receiving matrix
     * @param array $a the source matrix
     * @return array out
     */
    static function invert(array &$out, array $a): array
    {
        $aa = $a[0];
        $ab = $a[1];
        $ac = $a[2];
        $ad = $a[3];
        $atx = $a[4];
        $aty = $a[5];

        $det = $aa * $ad - $ab * $ac;
        if ($det === 0) {
            return null;
        }
        $det = 1.0 / $det;

        $out[0] = $ad * $det;
        $out[1] = -$ab * $det;
        $out[2] = -$ac * $det;
        $out[3] = $aa * $det;
        $out[4] = ($ac * $aty - $ad * $atx) * $det;
        $out[5] = ($ab * $atx - $aa * $aty) * $det;
        return $out;
    }

    /**
     * Calculates the determinant of a mat2d
     *
     * @param array $a the source matrix
     * @return float determinant of a
     */
    static function determinant(array $a): float
    {
        return $a[0] * $a[3] - $a[1] * $a[2];
    }

    /**
     * Multiplies two mat2d's
     *
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $a4 = $a[4];
        $a5 = $a[5];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        $b4 = $b[4];
        $b5 = $b[5];
        $out[0] = $a0 * $b0 + $a2 * $b1;
        $out[1] = $a1 * $b0 + $a3 * $b1;
        $out[2] = $a0 * $b2 + $a2 * $b3;
        $out[3] = $a1 * $b2 + $a3 * $b3;
        $out[4] = $a0 * $b4 + $a2 * $b5 + $a4;
        $out[5] = $a1 * $b4 + $a3 * $b5 + $a5;
        return $out;
    }

    /**
     * Rotates a mat2d by the given angle
     *
     * @param array $out the receiving matrix
     * @param array $a the matrix to rotate
     * @param float $rad the angle to rotate the matrix by
     * @return array out
     */
    static function rotate(array &$out, array $a, float $rad): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $a4 = $a[4];
        $a5 = $a[5];
        $s = sin($rad);
        $c = cos($rad);
        $out[0] = $a0 * $c + $a2 * $s;
        $out[1] = $a1 * $c + $a3 * $s;
        $out[2] = $a0 * -$s + $a2 * $c;
        $out[3] = $a1 * -$s + $a3 * $c;
        $out[4] = $a4;
        $out[5] = $a5;
        return $out;
    }

    /**
     * Scales the mat2d by the dimensions in the given vec2
     *
     * @param array $out the receiving matrix
     * @param array $a the matrix to translate
     * @param array $v the vec2 to scale the matrix by
     * @return array out
     **/
    static function scale(array &$out, array $a, array $v): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $a4 = $a[4];
        $a5 = $a[5];
        $v0 = $v[0];
        $v1 = $v[1];
        $out[0] = $a0 * $v0;
        $out[1] = $a1 * $v0;
        $out[2] = $a2 * $v1;
        $out[3] = $a3 * $v1;
        $out[4] = $a4;
        $out[5] = $a5;
        return $out;
    }

    /**
     * Translates the mat2d by the dimensions in the given vec2
     *
     * @param array $out the receiving matrix
     * @param array $a the matrix to translate
     * @param array $v the vec2 to translate the matrix by
     * @return array out
     **/
    static function translate(array &$out, array $a, array $v): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $a4 = $a[4];
        $a5 = $a[5];
        $v0 = $v[0];
        $v1 = $v[1];
        $out[0] = $a0;
        $out[1] = $a1;
        $out[2] = $a2;
        $out[3] = $a3;
        $out[4] = $a0 * $v0 + $a2 * $v1 + $a4;
        $out[5] = $a1 * $v0 + $a3 * $v1 + $a5;
        return $out;
    }

    /**
     * Creates a matrix from a given angle
     * This is equivalent to (but much faster than):
     *
     *     mat2d.identity(dest);
     *     mat2d.rotate(dest, dest, rad);
     *
     * @param array $out mat2d receiving operation result
     * @param float $rad the angle to rotate the matrix by
     * @return array out
     */
    static function fromRotation(array &$out, float $rad): array
    {
        $s = sin($rad);
        $c = cos($rad);
        $out[0] = $c;
        $out[1] = $s;
        $out[2] = -$s;
        $out[3] = $c;
        $out[4] = 0;
        $out[5] = 0;
        return $out;
    }

    /**
     * Creates a matrix from a vector scaling
     * This is equivalent to (but much faster than):
     *
     *     mat2d.identity(dest);
     *     mat2d.scale(dest, dest, vec);
     *
     * @param array $out mat2d receiving operation result
     * @param array $v Scaling vector
     * @return array out
     */
    static function fromScaling(array &$out, array $v): array
    {
        $out[0] = $v[0];
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = $v[1];
        $out[4] = 0;
        $out[5] = 0;
        return $out;
    }

    /**
     * Creates a matrix from a vector translation
     * This is equivalent to (but much faster than):
     *
     *     mat2d.identity(dest);
     *     mat2d.translate(dest, dest, vec);
     *
     * @param array $out mat2d receiving operation result
     * @param array $v Translation vector
     * @return array out
     */
    static function fromTranslation(array &$out, array $v): array
    {
        $out[0] = 1;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        $out[4] = $v[0];
        $out[5] = $v[1];
        return $out;
    }

    /**
     * Returns a string representation of a mat2d
     *
     * @param array $a matrix to represent as a string
     * @return string string representation of the matrix
     */
    static function str(array $a): string
    {
        return 'mat2d(' . $a[0] . ', ' . $a[1] . ', ' . $a[2] . ', ' . $a[3] . ', ' . $a[4] . ', ' . $a[5] . ')';
    }

    /**
     * Returns Frobenius norm of a mat2d
     *
     * @param array $a the matrix to calculate Frobenius norm of
     * @return float Frobenius norm
     */
    static function frob(array $a): float
    {
        return sqrt(
            pow($a[0], 2) +
            pow($a[1], 2) +
            pow($a[2], 2) +
            pow($a[3], 2) +
            pow($a[4], 2) +
            pow($a[5], 2) +
            1
        );
    }

    /**
     * Adds two mat2d's
     *
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array out
     */
    static function add(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] + $b[0];
        $out[1] = $a[1] + $b[1];
        $out[2] = $a[2] + $b[2];
        $out[3] = $a[3] + $b[3];
        $out[4] = $a[4] + $b[4];
        $out[5] = $a[5] + $b[5];
        return $out;
    }

    /**
     * Subtracts matrix b from matrix a
     *
     * @param array $out the receiving matrix
     * @param array $a the first operand
     * @param array $b the second operand
     * @return array out
     */
    static function subtract(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] - $b[0];
        $out[1] = $a[1] - $b[1];
        $out[2] = $a[2] - $b[2];
        $out[3] = $a[3] - $b[3];
        $out[4] = $a[4] - $b[4];
        $out[5] = $a[5] - $b[5];
        return $out;
    }

    /**
     * Multiply each element of the matrix by a scalar.
     *
     * @param array $out the receiving matrix
     * @param array $a the matrix to scale
     * @param float $b amount to scale the matrix's elements by
     * @return array out
     */
    static function multiplyScalar(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        $out[3] = $a[3] * $b;
        $out[4] = $a[4] * $b;
        $out[5] = $a[5] * $b;
        return $out;
    }

    /**
     * Adds two mat2d's after multiplying each element of the second operand by a scalar value.
     *
     * @param array $out the receiving vector
     * @param array $a the first operand
     * @param array $b the second operand
     * @param float $scale the amount to scale b's elements by before adding
     * @return array out
     */
    static function multiplyScalarAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        $out[2] = $a[2] + ($b[2] * $scale);
        $out[3] = $a[3] + ($b[3] * $scale);
        $out[4] = $a[4] + ($b[4] * $scale);
        $out[5] = $a[5] + ($b[5] * $scale);
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
        return $a[0] === $b[0] && 
            $a[1] === $b[1] && 
            $a[2] === $b[2] && 
            $a[3] === $b[3] && 
            $a[4] === $b[4] && 
            $a[5] === $b[5];
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
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        $b4 = $b[4];
        $b5 = $b[5];
        return abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) && 
            abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) && 
            abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2)) && 
            abs($a3 - $b3) <= glMatrix::EPSILON * max(1.0, abs($a3), abs($b3)) && 
            abs($a4 - $b4) <= glMatrix::EPSILON * max(1.0, abs($a4), abs($b4)) && 
            abs($a5 - $b5) <= glMatrix::EPSILON * max(1.0, abs($a5), abs($b5));
    }

    /**
     * Alias for {@see Mat2d::multiply}
     * @param array $out
     * @param array $a
     * @param array $b
     * @return array
     */
    static function mul(array &$out, array $a, array $b): array
    {
        return self::multiply($out, $a, $b);
    }

    /**
     * Alias for {@see Mat2d::subtract}
     * @param array $out
     * @param array $a
     * @param array $b
     * @return array
     */
    static function sub(array &$out, array $a, array $b): array
    {
        return self::subtract($out, $a, $b);
    }
}
