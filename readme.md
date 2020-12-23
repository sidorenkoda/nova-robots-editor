# Nova Robots.txt Editor

This Laravel Nova Tool gives your admins the ability to edit the robots.txt file from within the Nova control panel.

## Installation

`composer require sidorenkoda/nova-robots-editor`

Add the following to your tools array in the `app/Providers/NovaServiceProvider`:

```php
	public function tools()
	{
		return [
			// ...
			new Sidorenkoda\NovaRobotsEditor\NovaRobotsEditor(),
		];
	}
```

Robot icon made by [Smashicons](https://www.flaticon.com/authors/smashicons) from [www.flaticon.com](https://www.flaticon.com/)