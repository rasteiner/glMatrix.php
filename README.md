# glMatrix.php
A PHP port of the popular javascript glMatrix library. You can find the [original here](https://github.com/toji/gl-matrix) and [here](https://glmatrix.net).

## Install
```bash
composer require rasteiner/glmatrix.php
```

## Example

```php
<?php

use rasteiner\glMatrix\glMatrix;
use rasteiner\glMatrix\Mat4;
use rasteiner\glMatrix\Vec3;
use rasteiner\glMatrix\Vec4;

require_once 'vendor/autoload.php';


$animationMode = isset($_GET['animate']);

// vertices for a 1x1x1 cube centered at the origin
$vertices = [
  [-0.5, -0.5, -0.5],
  [0.5, -0.5, -0.5],
  [0.5, 0.5, -0.5],
  [-0.5, 0.5, -0.5],
  [-0.5, -0.5, 0.5],
  [0.5, -0.5, 0.5],
  [0.5, 0.5, 0.5],
  [-0.5, 0.5, 0.5],
];

// indices for the 12 triangles that compose the cube
$indices = [
  [0, 1, 2],
  [0, 2, 3],
  [1, 5, 6],
  [1, 6, 2],
  [5, 4, 7],
  [5, 7, 6],
  [4, 0, 3],
  [4, 3, 7],
  [3, 2, 6],
  [3, 6, 7],
  [4, 5, 1],
  [4, 1, 0],
];

// create a new canvas
$width = 600;
$height = 400;
$canvas = imagecreatetruecolor($width, $height);
imageantialias($canvas, true);

// fill the canvas with a white background
$bgColor = imagecolorallocate($canvas, 255, 255, 255);
imagefill($canvas, 0, 0, $bgColor);


// create a new projection matrix
$projection = Mat4::create();
Mat4::perspective($projection, 45, $width / $height, 0.1, 100);

// create a new model view matrix
$eye = [0, 2, 5];
$target = [0, 0, 0];
$up = [0, 1, 0];
$modelView = Mat4::create();

Mat4::lookAt($modelView, $eye, $target, $up);
Mat4::scale($modelView, $modelView, [1.5, 1.5, 1.5]);

// animate the cube
if($animationMode) {
  $t = glMatrix::toRadian(microtime(true) * 10);
  Mat4::translate($modelView, $modelView, [sin($t), 0, 0]);
  Mat4::rotateY($modelView, $modelView, $t);
} else {
  Mat4::rotateY($modelView, $modelView, glMatrix::toRadian(-30));
}

// model view projection matrix
$mvp = Mat4::create();
Mat4::multiply($mvp, $projection, $modelView);

// transform the vertices
$transformedVertices = [];
foreach ($vertices as $vertex) {
  $transformedVertex = Vec4::create();
  Vec4::transformMat4($transformedVertex, [...$vertex, 1], $mvp);
  $transformedVertices[] = $transformedVertex;
}

$strokeColor = imagecolorallocate($canvas, 30, 30, 30);
$_ = [];

foreach ($indices as $index) {
  $v1 = $transformedVertices[$index[0]];
  $v2 = $transformedVertices[$index[1]];
  $v3 = $transformedVertices[$index[2]];

  // get normals for the triangle
  $a = Vec3::create(); Vec3::subtract($a, $v2, $v1);
  $b = Vec3::create(); Vec3::subtract($b, $v3, $v1);
  $n = Vec3::create(); Vec3::cross($n, $a, $b);
  Vec3::normalize($n, $n);

  // backface culling, $v1 is in view space: ignore "P"
  $dot = Vec3::dot($n, $v1);
  if ($dot >= 0) {
    continue;
  }

  $ambient = 0.2;
  $lightPos = [1, 3, 0]; // since this is not transformed, it's relative to the camera
  $lightColor = [1, 1, 1];
  
  // color is just the normal
  $color = Vec3::clone($n);
  Vec3::scaleAndAdd($color, [0.5, 0.5, 0.5], $color, 0.5);

  // ... multiplied by the dot product of the normal with the light direction + ambient
  $lightDir = Vec3::create(); 
  Vec3::subtract($lightDir, $lightPos, $v1);
  Vec3::normalize($lightDir, $lightDir);
  $diffuse = max(0, $ambient + Vec3::dot($lightDir, $n));

  Vec3::multiply($color, $color, $lightColor);
  Vec3::scale($color, $color, $diffuse);
  Vec3::min($color, $color, [1, 1, 1]);  // cap at 1
  
  $fillColor = imagecolorallocate($canvas, 
    round($color[0] * 255),
    round($color[1] * 255),
    round($color[2] * 255)
  );

  // perspective division, X
  $x1 = $v1[0] / $v1[3] + 0.5;
  $x2 = $v2[0] / $v2[3] + 0.5;
  $x3 = $v3[0] / $v3[3] + 0.5;

  // perspective division Y, y is inverted in php gd
  $y1 = -$v1[1] / $v1[3] + 0.5; 
  $y2 = -$v2[1] / $v2[3] + 0.5;
  $y3 = -$v3[1] / $v3[3] + 0.5;
  
  // scale the vertices to the canvas size
  $x1 *= $width;
  $x2 *= $width;
  $x3 *= $width;
  $y1 *= $height;
  $y2 *= $height;
  $y3 *= $height;

  // draw the triangle
  imagefilledpolygon($canvas, [$x1, $y1, $x2, $y2, $x3, $y3], $fillColor);

  // draw wireframe
  imageline($canvas, (int)$x1, (int)$y1, (int)$x2, (int)$y2, $strokeColor);
  imageline($canvas, (int)$x2, (int)$y2, (int)$x3, (int)$y3, $strokeColor);
  imageline($canvas, (int)$x3, (int)$y3, (int)$x1, (int)$y1, $strokeColor);
}

if($animationMode) {
  imagestring($canvas, 5, 10, 10, 
    'Keep refreshing to witness amazing animation possibilities...', $strokeColor);
}

imagejpeg($canvas);
```

This script should produce the following image:

![a rendered shaded cube with its wireframe](example.jpg)
