<?php

require 'class.RandomUserAgent.php';

$rua = new RandomUserAgent();

echo '<pre>';
for ($i = 0; $i < 100; ++$i) {
	echo $rua->getUserAgent() . "\n";
}
echo '</pre>';
