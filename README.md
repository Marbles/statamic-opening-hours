# An add-on to set up and display opening hours

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

With this Opening Hours add-on you can define the opening hours of your business in a settings panel. The add-on provides numerous tags to display or check the opening hours.
A set of opening hours is created by passing in a regular schedule, and a list of exceptions.

**This add-on requires >= PHP7.0**

![Screenshot](http://i.imgur.com/GaMOnDR.png)

## Installation

Download or clone the repository, rename the folder to `OpeningHours` then copy the folder to your site's `Addons` directory, then refresh the add-ons to install the dependencies.

``` bash
php please addons:refresh
```

## Usage

The add-on provides numerous tags, the base tag is `{{ opening_hours }}` but always requires a parameter.

#### `{{ opening_hours:forWeek }}`

Returns days with their opening hours.

```html
<ul>
    {{ opening_hours:forWeek }}
        <li><strong>Monday</strong></li>
        {{ monday }}
            <li>{{ from }} - {{ to }}</li>
        {{ /monday }}

        <li><strong>Tuesday</strong></li>
        {{ tuesday }}
            <li>{{ from }} - {{ to }}</li>
        {{ /tuesday }}

        <li><strong>Wednesday</strong></li>
        {{ wednesday }}
            <li>{{ from }} - {{ to }}</li>
        {{ /wednesday }}
        
        ... 
        

    {{ /opening_hours:forWeek }}
</ul>
```

#### `{{ opening_hours:forDay day="" }}`

Returns the opening hours for a specific day

```html
<ul>
    <li><strong>Monday</strong></li>
    {{ opening_hours:forDay day="monday" }}
        <li>{{ from }} - {{ to }}</li>
    {{ /opening_hours:forDay }}
</ul>
```

#### `{{ opening_hours:forDate date="" }}`

Returns the opening hours for a specific date. It looks for exceptions on that day, otherwise it returns the regular opening hours.

```html
<ul>
    {{ opening_hours:forDate date="2017-05-25" }}
        <li>{{ from }} - {{ to }}</li>
    {{ /opening_hours:forDate }}
</ul>
```

#### `{{ opening_hours:exceptions }}`

Returns a list of all the exceptions.

```html
<ul>
    {{ opening_hours:exceptions }}
        <li><strong>{{ date }}</strong></li>
        <ul>
            {{ hours }}
                <li>{{ from }} - {{ to }}</li>
            {{ /hours }}
        </ul>
    {{ /opening_hours:exceptions }}
</ul>
```

#### `{{ opening_hours:isOpenOn day="" }}`

Checks if the business is open on a day in the regular schedule.

```html
{{ opening_hours:isOpenOn day="monday" }}
    <p>Yes</p>
{{ /opening_hours:isOpenOn }}
```

#### `{{ opening_hours:isClosedOn day="" }}`

Checks if the business is closed on a day in the regular schedule.

```html
{{ opening_hours:isClosedOn day="sunday" }}
    <p>Yes</p>
{{ /opening_hours:isClosedOn }}
```

#### `{{ opening_hours:isOpenAt date="" }}`

Checks if the business is open on a specific day, at a specific time.

```html
{{ opening_hours:isOpenAt date="2017-05-25 09:30" }}
    <p>Yes</p>
{{ /opening_hours:isOpenAt }}
```

#### `{{ opening_hours:isClosedAt date="" }}`

Checks if the business is closed on a specific day, at a specific time.

```html
{{ opening_hours:isClosedAt date="2017-05-25 22:30" }}
    <p>Yes</p>
{{ /opening_hours:isClosedAt }}
```

#### `{{ opening_hours::isOpen }}`

Checks if the business is open right now.

```html
{{ opening_hours:isOpen }}
    <p>Open</p>
{{ /opening_hours:isOpen }}
```

#### `{{ opening_hours:isClosed }}`

Checks if the business is closed right now.

```html
{{ opening_hours:isClosed }}
    <p>Closed</p>
{{ /opening_hours:isClosed }}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email rias@marbles.be instead of using the issue tracker.

## Credits

Special thanks to Spatie for making their [Opening Hours package](https://github.com/spatie/opening-hours)

- [Rias Van der Veken](https://github.com/rias500)
- [All Contributors](../../contributors)

## About Marbles
Marbles is a digital communication agency based in Antwerp, Belgium. Learn more about us [on our website](https://www.marbles.be).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.