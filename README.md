# Lark notifications channel for Laravel

This package makes it easy to send Lark using the Laravel notification system. Supports 5.5+, 6.x, 7.x and 8.x.

## Contents

- [Installation](#installation)
- [Usage](#usage)
	- [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require yajianguo/lark-notification-channel
```

## Usage

Now you can use the channel in your `via()` method inside the notification:

``` php
use NotificationChannels\Lark\LarkChannel;
use NotificationChannels\Lark\LarkMessage;
use Illuminate\Notifications\Notification;

class ProjectCreated extends Notification
{
    public function via($notifiable)
    {
        return [LarkChannel::class];
    }

    public function toLark($notifiable)
    {
        return LarkMessage::create()
            ->data([
               'payload' => [
                   'lark' => 'data'
               ]
            ])
            ->userAgent("Custom-User-Agent")
            ->header('X-Custom', 'Custom-Header');
    }
}
```

In order to let your Notification know which URL should receive the Lark data, add the `routeNotificationForLark` method to your Notifiable model.

This method needs to return the URL where the notification Lark will receive a POST request.

```php
public function routeNotificationForLark()
{
    return 'http://requestb.in/1234x';
}
```

### Available methods

- `data('')`: Accepts a JSON-encodable value for the Lark body.
- `query('')`: Accepts an associative array of query string values to add to the request.
- `userAgent('')`: Accepts a string value for the Lark user agent.
- `header($name, $value)`: Sets additional headers to send with the POST Lark.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Security

If you discover any security related issues, please email a@a.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [yajianguo Pociot](https://github.com/yajianguo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
