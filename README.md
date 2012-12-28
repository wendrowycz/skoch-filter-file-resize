Skoch_Filter_File_Resize
========================

Resize utility for the Zend Framework
-------------------------------------

Installation
------------

* Download the folder library/Skoch from github and add it to your library files
* Add `autoloaderNamespaces[] = "Skoch_"` to your `application.ini`


Basic Usage
-----------

You can add the filter to your `Zend_Form_Element_File` instance.

```php
$photo->addFilter(new Skoch_Filter_File_Resize(array(
    'width' => 200,
    'height' => 300,
    'keepRatio' => true,
)));
```

Options / Arguments
-------------------
You may specify different options for the Resize Filter:

* width: The maximum width of the resized image
* height: The maximum height of the resized image
* keepRatio: Keep the aspect ratio and do not resize to both width and height (usually expected).
* keepSmaller: Do not resize if the image is already smaller than the given sizes.
* directory: Set a directory to store the thumbnail in. If nothing is given, the normal image will be overwritten.
* adapter: The adapter to use for resizing. You may specify a string or an instance of an adapter.
