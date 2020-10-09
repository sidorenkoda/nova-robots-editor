# Nova Robots.txt Editor

This Laravel Nova Tool gives your admins the ability to edit the robots.txt file from within the Nova control panel.

## Installation

`composer require razorcreations/nova-robots-editor`

Add the following to your tools array in the `app/Providers/NovaServiceProvider`:

```php
	public function tools()
	{
		return [
			// ...
			new Razorcreations\NovaRobotsEditor\NovaRobotsEditor(),
		];
	}
```