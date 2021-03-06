JSPushNotification
==================

JobStreet.com Push Notification Service

##Installation

Using Composer:

```
composer require jobstreet/js-push-notification 1.0.0
```

##Usage

This is the minimal example that you'll need to have:

```
require_once 'vendor/autoload.php';

$client = new JSPNClient(array(
    'applicationId' => 'YOUR_APPLICATION_ID',
    'isSandbox'     => true
));

$response = $client->publishMessage(12345, 'This is the notification message', array(
    'customParameter1' => 'parameter'
), array(
    'notificationOptions' => 'options'
));

if($response == 1) {
    echo 'Successfully publish message';
}
else {
    echo 'Failed to publish message. Error message ' . $response->error->message;
}
```

##Configuration File
You may want to create a client config file in other place. Here is the example of defining the config file:

```
define('JSPN_CONFIG_PATH', 'path/to/config.php');

require_once 'vendor/autoload.php';

$client = new JSPNClient();
```

config.php
```

return array(
    'applicationId' => 'YOUR_APPLICATION_ID',
    'isSandbox'     => true
);

```

##Documentation

More information and example are available at [JSPushNotification SDK Wiki](https://github.com/tekmin/JSPushNotification/wiki/JSPushNotification-SDK-Wiki)



