<?php 


namespace rasteiner\glMatrix;

trait Vec4OrQuat {
    /**
     * Dot product of two quaternions / vec4
     * 
     * @param array {quat|vec4} a the first operand
     * @param array {quat|vec4} b the second operand
     */
    static function dot(array $a, array $b): float
    {
        return $a[0] * $b[0] + $a[1] * $b[1] + $a[2] * $b[2] + $a[3] * $b[3];
    }
  /**
   * Creates a new quat/vec4 initialized with values from an existing quaternion / vec4
   *
   * @param array input to clone
   * @return array a new quaternion
   */
  static function clone(array $a): array
  {
    return [$a[0], $a[1], $a[2], $a[3]];
  }
  
  /**
   * Creates a new quat/vec4 initialized with the given values
   *
   * @param float $x X component
   * @param float $y Y component
   * @param float $z Z component
   * @param float $w W component
   * @return array a new quaternion / vec4
   */
    static function fromValues(float $x, float $y, float $z, float $w): array {
        return [$x, $y, $z, $w];
    }

  
  /**
   * Copy the values from one quat / vec4 to another
   *
   * @param array {quat|vec4} out the receiving quaternion
   * @param array {quat|vec4} a the source quaternion
   * @return array {quat|vec4} out
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
   * Set the components of a quat / vec4 to the given values
   *
   * @param array {quat|vec4} out the receiving quaternion
   * @param float $x X component
   * @param float $y Y component
   * @param float $z Z component
   * @param float $w W component
   * @return array {quat|vec4} out
   */
    static function set(array &$out, float $x, float $y, float $z, float $w): array
    {
        $out[0] = $x;
        $out[1] = $y;
        $out[2] = $z;
        $out[3] = $w;
        return $out;
    }
  
    /**
     * Adds two quat's / vec4's
     *
     * @param array {quat|vec4} out the receiving quaternion
     * @param array {quat|vec4} a the first operand
     * @param array {quat|vec4} b the second operand
     * 
     * @return array {quat|vec4} out
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
   * Scales a quat / vec4 by a scalar number
   *
   * @param array {quat|vec4} out the receiving vector
   * @param array {quat|vec4} a the vector to scale
   * @param float $b amount to scale the vector by
   * 
   * @return array {quat|vec4} out
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
   * Performs a linear interpolation between two quat's / vec4's
   *
   * @param array {quat|vec4} out the receiving quaternion
   * @param array {quat|vec4} a the first operand
   * @param array {quat|vec4} b the second operand
   * @param float $t interpolation amount between the two inputs
   * 
   * @return array {quat|vec4} out
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
   * Calculates the length of a quat / vec4
   * 
   * @param array {quat|vec4} a vector to calculate length of
   * 
   * @return float length of a
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
     * Calculates the squared length of a quat / vec4
     *
     * @param array {quat|vec4} a vector to calculate squared length of
     * 
     * @return float squared length of a
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
   * Normalize a quat / vec4
   *
   * @param array {quat|vec4} out the receiving quaternion
   * @param array {quat|vec4} a quaternion to normalize
   * 
   * @return array {quat|vec4} out
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
        $out[0] = $x * $len;
        $out[1] = $y * $len;
        $out[2] = $z * $len;
        $out[3] = $w * $len;
        return $out;
    }

  
  /**
   * Returns whether or not the quaternions / vec4's have exactly the same elements in the same position (when compared with ===)
   *
   * @param array {quat|vec4} a The first quaternion / vec4.
   * @param array {quat|vec4} b The second quaternion / vec4.
   * 
   * @return bool True if the vectors are equal, false otherwise.
   */
    static function exactEquals(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1] && $a[2] === $b[2] && $a[3] === $b[3];
    }
}

