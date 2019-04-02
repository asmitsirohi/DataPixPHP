# DataPixPHP
Data (text) to image processing php class

* Understanding pixels using Php GD
* Created only for experimental use
* Works On True Colour Images
* Images can be easily get damaged on any type of compression
* Speed of encoding or decoding depends upon the data size
* It generated linear strip of pixels with data encoded in them
* Stores 4 Characters In 1 Pixel

You may convert small images into encoded pixels by reading them using file_get_contents("image.jpg") functions and pass them data to encode function of that class.  
Decoding also works the same but you need to write decoded data back to image file using file_put_contents("image.jpg",$decoded_data) function.

## Usage

### Encoding
```php
  include('DataPixPHP.php');
  $data="This string will be encoded!";
  $dataPixPHP=new DataPixPHP();
  $image=$dataPixPHP->encode($data);
  var_dump("Data written in file named: ".$image);
```

### Decoding
```php
  include('DataPixPHP.php');
  $image_path="path/to/image/image.png";
  $dataPixPHP=new DataPixPHP();
  $data=$dataPixPHP->decode($image_path);
  var_dump("Decoded Data: ".$data);
```

> __See demo file for example and usage__
