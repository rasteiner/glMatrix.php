<?php

/**
 * 2x2 matrix functions
 * ported from https://github.com/toji/gl-matrix/blob/master/src/mat2.js
 */

namespace rasteiner\glMatrix;

/**
 * 2x2 Matrix
 */
class Mat2
{
    /**
     * Creates a new identity mat2
     *
     * @return array a new 2x2 matrix
     */
    static function create(): array
    {
        return [
            1, 0,
            0, 1
        ];
    }

    /**
     * Creates a new mat2 initialized with values from an existing matrix
     *
     * @param array a matrix to clone
     * @return array a new 2x2 matrix
     */
    static function clone(array $a): array
    {
        return [
            $a[0], $a[1],
            $a[2], $a[3]
        ];
    }

    /**
     * Copy the values from one mat2 to another
     *
     * @param array out the receiving matrix
     * @param array a the source matrix
     * @return array out
     */
    static function copy(array &$out, array $a): array
    {
        $out[0] = $a[0];
        $out[1] = $a[1];
        $out[2] = $a[2];
        $out[3] = $a[3];
        return $out;
    }

    /**
     * Set a mat2 to the identity matrix
     *
     * @param array out the receiving matrix
     * @return array out
     */
    static function identity(array &$out): array
    {
        $out[0] = 1;
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = 1;
        return $out;
    }

    /**
     * Create a new mat2 with the given values
     *
     * @param float m00 Component in column 0, row 0 position (index 0)
     * @param float m01 Component in column 0, row 1 position (index 1)
     * @param float m10 Component in column 1, row 0 position (index 2)
     * @param float m11 Component in column 1, row 1 position (index 3)
     * @return array out A new 2x2 matrix
     */
    static function fromValues(float $m00, float $m01, float $m10, float $m11): array
    {
        return [
            $m00, $m01,
            $m10, $m11
        ];
    }

    /**
     * Set the components of a mat2 to the given values
     *
     * @param array out the receiving matrix
     * @param float m00 Component in column 0, row 0 position (index 0)
     * @param float m01 Component in column 0, row 1 position (index 1)
     * @param float m10 Component in column 1, row 0 position (index 2)
     * @param float m11 Component in column 1, row 1 position (index 3)
     * @return array out
     */
    static function set(array &$out, float $m00, float $m01, float $m10, float $m11): array
    {
        $out[0] = $m00;
        $out[1] = $m01;
        $out[2] = $m10;
        $out[3] = $m11;
        return $out;
    }

    /**
     * Transpose the values of a mat2
     *
     * @param array out the receiving matrix
     * @param array a the source matrix
     * @return array out
     */
    static function transpose(array &$out, array $a): array
    {
        // If we are transposing ourselves we can skip a few steps but have to cache some values
        if ($out === $a) {
            $a1 = $a[1];
            $out[1] = $a[2];
            $out[2] = $a1;
        } else {
            $out[0] = $a[0];
            $out[1] = $a[2];
            $out[2] = $a[1];
            $out[3] = $a[3];
        }

        return $out;
    }

    /**
     * Inverts a mat2
     *
     * @param array out the receiving matrix
     * @param array a the source matrix
     * @return array out
     */
    static function invert(array &$out, array $a): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];

        // Calculate the determinant
        $det = $a0 * $a3 - $a2 * $a1;

        if ($det === 0) {
            return null;
        }
        $det = 1.0 / $det;

        $out[0] = $a3 * $det;
        $out[1] = -$a1 * $det;
        $out[2] = -$a2 * $det;
        $out[3] = $a0 * $det;

        return $out;
    }

    /**
     * Calculates the adjugate of a mat2
     *
     * @param array out the receiving matrix
     * @param array a the source matrix
     * @return array out
     */
    static function adjoint(array &$out, array $a): array
    {
        // Caching this value is necessary if out == a
        $a0 = $a[0];
        $out[0] = $a[3];
        $out[1] = -$a[1];
        $out[2] = -$a[2];
        $out[3] = $a0;

        return $out;
    }

    /**
     * Calculates the determinant of a mat2
     *
     * @param array a the source matrix
     * @return float determinant of a
     */
    static function determinant(array $a): float
    {
        return $a[0] * $a[3] - $a[2] * $a[1];
    }

    /**
     * Multiplies two mat2's
     *
     * @param array out the receiving matrix
     * @param array a the first operand
     * @param array b the second operand
     * @return array out
     */
    static function multiply(array &$out, array $a, array $b): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        $out[0] = $a0 * $b0 + $a1 * $b2;
        $out[1] = $a0 * $b1 + $a1 * $b3;
        $out[2] = $a2 * $b0 + $a3 * $b2;
        $out[3] = $a2 * $b1 + $a3 * $b3;
        return $out;
    }

    /**
     * Alias for Mat2::multiply
     * @see Mat2::multiply
     */
    static function mul(array &$out, array $a, array $b): array
    {
        return self::multiply($out, $a, $b);
    }


    /**
     * Rotates a mat2 by the given angle
     *
     * @param array out the receiving matrix
     * @param array a the matrix to rotate
     * @param float rad the angle to rotate the matrix by
     * @return array out
     */
    static function rotate(array &$out, array $a, float $rad): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $s = sin($rad);
        $c = cos($rad);
        $out[0] = $a0 * $c + $a1 * $s;
        $out[1] = $a0 * -$s + $a1 * $c;
        $out[2] = $a2 * $c + $a3 * $s;
        $out[3] = $a2 * -$s + $a3 * $c;
        return $out;
    }

    /**
     * Scales the mat2 by the dimensions in the given vec2
     *
     * @param array out the receiving matrix
     * @param array a the matrix to rotate
     * @param array v the vec2 to scale the matrix by
     * @return array out
     **/
    static function scale(array &$out, array $a, array $v): array
    {
        $a0 = $a[0];
        $a1 = $a[1];
        $a2 = $a[2];
        $a3 = $a[3];
        $v0 = $v[0];
        $v1 = $v[1];
        $out[0] = $a0 * $v0;
        $out[1] = $a1 * $v1;
        $out[2] = $a2 * $v0;
        $out[3] = $a3 * $v1;
        return $out;
    }

    /**
     * Creates a matrix from a given angle
     * This is equivalent to (but much faster than):
     *
     *     mat2::identity(dest);
     *     mat2::rotate(dest, dest, rad);
     *
     * @param array out mat2 receiving operation result
     * @param float rad the angle to rotate the matrix by
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
        return $out;
    }

    /**
     * Creates a matrix from a vector scaling
     * This is equivalent to (but much faster than):
     *
     *     mat2::identity(dest);
     *     mat2::scale(dest, dest, vec);
     *
     * @param array out mat2 receiving operation result
     * @param array v Scaling vector
     * @return array out
     */
    static function fromScaling(array &$out, array $v): array
    {
        $out[0] = $v[0];
        $out[1] = 0;
        $out[2] = 0;
        $out[3] = $v[1];
        return $out;
    }

    /**
     * Returns a string representation of a mat2
     *
     * @param array a matrix to represent as a string
     * @return string string representation of the matrix
     */
    static function str(array $a): string
    {
        return "mat2(" . $a[0] . ", " . $a[1] . ", " . $a[2] . ", " . $a[3] . ")";
    }

    /**
     * Returns Frobenius norm of a mat2
     *
     * @param array a the matrix to calculate Frobenius norm of
     * @return float Frobenius norm
     */
    static function frob(array $a): float
    {
        return sqrt($a[0] * $a[0] + $a[1] * $a[1] + $a[2] * $a[2] + $a[3] * $a[3]);
    }

    /**
     * Returns L, D and U matrices (Lower triangular, Diagonal and Upper triangular) by factorizing the input matrix
     * @param array $L the lower triangular matrix
     * @param array $D the diagonal matrix
     * @param array $U the upper triangular matrix
     * @param array $a the input matrix to factorize
     * @return array [L,D,U] matrices
     */
    static function LDU(array &$L, array &$D, array &$U, array $a): array
    {
        $L[2] = $a[2] / $a[0];
        $U[0] = $a[0];
        $U[1] = $a[1];
        $U[3] = $a[3] - $L[2] * $U[1];
        return [$L, $D, $U];
    }

    /**
     * Adds two mat2's
     *
     * @param array out the receiving matrix
     * @param array a the first operand
     * @param array b the second operand
     * @return array out
     */
    static function add(array &$out, array $a, array $b): array
    {
        $out[0] = $a[0] + $b[0];
        $out[1] = $a[1] + $b[1];
        $out[2] = $a[2] + $b[2];
        $out[3] = $a[3] + $b[3];
        return $out;
    }

    /**
     * Subtracts matrix b from matrix a
     *
     * @param array out the receiving matrix
     * @param array a the first operand
     * @param array b the second operand
     * @return array out
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
     * Alias for Mat2::subtract
     * @see Mat2::subtract
     */
    static function sub(array &$out, array $a, array $b): array
    {
        return self::subtract($out, $a, $b);
    }


    /**
     * Returns whether or not the matrices have exactly the same elements in the same position (when compared with ===)
     * @param array $a The first matrix.
     * @param array $b The second matrix.
     * @return bool True if the matrices are equal, false otherwise.
     */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1] && $a[2] === $b[2] && $a[3] === $b[3];
    }

    /**
     * Returns whether or not the matrices have approximately the same elements in the same position.
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
        $b0 = $b[0];
        $b1 = $b[1];
        $b2 = $b[2];
        $b3 = $b[3];
        return abs($a0 - $b0) <= glMatrix::EPSILON * max(1.0, abs($a0), abs($b0)) &&
            abs($a1 - $b1) <= glMatrix::EPSILON * max(1.0, abs($a1), abs($b1)) &&
            abs($a2 - $b2) <= glMatrix::EPSILON * max(1.0, abs($a2), abs($b2)) &&
            abs($a3 - $b3) <= glMatrix::EPSILON * max(1.0, abs($a3), abs($b3));
    }

    /**
     * Multiply each element of the matrix by a scalar.
     *
     * @param array out the receiving matrix
     * @param array a the matrix to scale
     * @param float b amount to scale the matrix's elements by
     * @return array out
     */
    static function multiplyScalar(array &$out, array $a, float $b): array
    {
        $out[0] = $a[0] * $b;
        $out[1] = $a[1] * $b;
        $out[2] = $a[2] * $b;
        $out[3] = $a[3] * $b;
        return $out;
    }

    /**
     * Adds two mat2's after multiplying each element of the second operand by a scalar value.
     *
     * @param array out the receiving vector
     * @param array a the first operand
     * @param array b the second operand
     * @param float scale the amount to scale b's elements by before adding
     * @return array out
     */
    static function multiplyScalarAndAdd(array &$out, array $a, array $b, float $scale): array
    {
        $out[0] = $a[0] + ($b[0] * $scale);
        $out[1] = $a[1] + ($b[1] * $scale);
        $out[2] = $a[2] + ($b[2] * $scale);
        $out[3] = $a[3] + ($b[3] * $scale);
        return $out;
    }
}
