# RandomUserAgent

Randomly generate browser user agent that looks valid. Generated as Windows, Linux, and Mac OS platforms. With 6 common desktop browsers: Firefox, Google Chrome, Safari, Internet Explorer, and Edge.



## Usage

### Getting Started

> \$rua= new RandomUserAgent( );

```php
// Include core RandomUserAgent library
require 'class.RandomUserAgent.php';

// Initialize RandomUserAgent object
$rua = new RandomUserAgent();
```



### Get Random User Agent

Gets a randomly generated user agent.

> **string** \$rua->getUserAgent( );

```php
echo $rua->getUserAgent();

// Mozilla/5.0 (Windows NT 5.1; rv:48.4) Gecko/20120101 Firefox/48.4
```
