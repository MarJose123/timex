![timex-logo](https://user-images.githubusercontent.com/2136612/202689778-eb013a03-b0fa-4c0e-941c-7d999c09fd6f.jpeg)


## TiMEX - calendar plugin for [filament](https://github.com/filamentphp/filament)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/buildix/timex.svg?style=flat-square)](https://packagist.org/packages/buildix/timex)
[![Total Downloads](https://img.shields.io/packagist/dt/buildix/timex.svg?style=flat-square)](https://packagist.org/packages/buildix/timex)


<img width="1865" alt="TiMEX-Main" src="https://user-images.githubusercontent.com/2136612/206989777-fe169c5b-147a-450a-bd98-2df67eda8989.png">

|   |  |   |
| ------------- | ------------- | ------------- |
| <img width="582" alt="Снимок экрана 2022-12-12 в 10 45 08" src="https://user-images.githubusercontent.com/2136612/206991069-3a8f8d49-f421-49df-a4b8-2a681a6b4a9d.png">  | <img width="582" alt="Снимок экрана 2022-12-12 в 10 45 13" src="https://user-images.githubusercontent.com/2136612/206991086-8ce8adf3-9519-431e-a145-acb5a4d4f309.png">  | <img width="582" alt="Снимок экрана 2022-12-12 в 10 45 32" src="https://user-images.githubusercontent.com/2136612/206991096-d063dc90-ba2e-479b-b3c6-1a0b467c2ea2.png">  |

## Installation

You can install the package via composer:

```bash
composer require buildix/timex
```

After your fresh installation, you may install all neccessary assets via the following command:

```bash
php artisan timex:install
```
<hr>
<details><summary>Publishing vendor assets</summary>
You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="timex-migrations"
php artisan migrate
```

**If you're upgrading from 1.0.3 > 1.0.4 make sure to alter your database table to include `participants` column:**
```
php artisan make:migration add_participants_to_timex_table --table=timex-events
```

In your newly created migration file add the following:

```php
Schema::create('timex-events', function ($table) {
        $table->json("participants")->nullable();
    });
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="timex-config"
```
</details>
<br>
<details><summary>TiMEX Config</summary>
<p>

#### This is the contents of the published config file:

```php
return [
    /*
    |--------------------------------------------------------------------------
    | TiMEX Icon set
    |--------------------------------------------------------------------------
    |
    | Don't change that prefix, otherwise icon set will not work.
    |
    */

    'prefix' => 'timex',

    /*
    |--------------------------------------------------------------------------
    | TiMEX Mini widget
    |--------------------------------------------------------------------------
    |
    | You can disable or enable individually widgets or entirely the whole view.
    |
    */

    'mini' => [
        'isMiniCalendarEnabled' => true,
        'isDayViewHidden' => false,
        'isNextMeetingViewHidden' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | TiMEX Calendar configurations
    |--------------------------------------------------------------------------
    |
    | Change according to your locale.
    |
    */

    'week' => [
        'start' => Carbon::MONDAY,
        'end' =>  Carbon::SUNDAY
    ],

    'dayName' => 'minDayName', // minDayName or dayName or shortDayName

    /*
    |--------------------------------------------------------------------------
    | TiMEX Resources & Pages
    |--------------------------------------------------------------------------
    |
    | By default TiMEX out of box will work, just make sure you make migration.
    | But you can also make your own Model and Filament resource and update config accordingly
    |
    */

    'pages' => [
        'timex' => \Buildix\Timex\Pages\Timex::class,
        'slug' => 'timex',
        'group' => 'timex',
        'shouldRegisterNavigation' => true,
        'modalWidth' => 'xl',
        'icon' => [
            'static' => true,
            'timex' => 'timex-timex',
            'day' => 'timex-day-'
        ],
        'label' => [
            'navigation' => [
                'static' => false,
                'format' => 'dddd, D MMM',
            ],
            'breadcrumbs' => [
                'static' => false,
                'format' => 'dddd, D MMM',
            ],
            'title' => [
              'static' => false,
              'format' => 'dddd, D MMM',
            ],
        ],
        'buttons' => [
            'hideYearNavigation' => false,
            'today' => [
                'static' => false,
                'format' => 'D MMM'
            ],
            'outlined' => true,
            'icons' => [
                'previousYear' => 'heroicon-o-chevron-double-left',
                'nextYear' => 'heroicon-o-chevron-double-right',
                'previousMonth' => 'heroicon-o-chevron-left',
                'nextMonth' => 'heroicon-o-chevron-right',
                'createEvent' => 'heroicon-o-plus'
            ],
        ],
    ],

    'resources' => [
        'event' => \Buildix\Timex\Resources\EventResource::class,
        'icon' => 'heroicon-o-calendar',
        'slug' => 'timex-events',
        'shouldRegisterNavigation' => true,
    ],
    'models' => [
        'event' => \Buildix\Timex\Models\Event::class,
        'users' => [
            'model' => \App\Models\User::class,
            'name' => 'name',
            'id' => 'id',
        ],
    ],
    'tables' => [
        'event' => [
            'name' => 'timex_events',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | TiMEX Event categories
    |--------------------------------------------------------------------------
    |
    | Categories names are used to define colors & icons.
    | Each represents default tailwind colors.
    | You may change as you wish, just make sure your color have -500 / -600 and etc variants
    | You may also go for a custom Category model to define your labels, colors and icons
    |
    */

    'categories' => [
            'isModelEnabled' => true,
    /*
    |--------------------------------------------------------------------------
    | Category Model
    |--------------------------------------------------------------------------
    |
    | You can define your custom Category model.
    | Minimum and default columns in your DB should be: id, value, icon, color.
    |
    |
    */
            'model' => [
                'class' => \App\Models\Category::class, // \App\Models\Category::class
                'key' => 'id', // "id" is a DB column - you can change by any primary key
                'value' => 'value', // "value" is a DB column - it used for Select options and displays on Resource page
                'icon' => 'icon', // "icon" is a DB column - define here any heroicon- icon
                'color' => 'color', // "color" is a DB column - default tailwindcss colors names like: primary / secondary / danger
            ],
        /*
        |--------------------------------------------------------------------------
        | Default TiMEX Categories
        |--------------------------------------------------------------------------
        */
            'labels' => [
                'primary' => 'Primary category',
                'secondary' => 'Secondary category',
                'danger' => 'Danger category',
                'success' => 'Success category',
            ],
            'icons' => [
                'primary' => 'heroicon-o-clipboard',
                'secondary' => 'heroicon-o-bookmark',
                'danger' => 'heroicon-o-flag',
                'success' => 'heroicon-o-badge-check',
            ],
            'colors' => [
                'primary' => 'primary',
                'secondary' => 'secondary',
                'danger' => 'danger',
                'success' => 'success',
            ],
    ],

];
```

</p>
</details>
<hr>

## Usage

After your fresh installation, TiMEX calendar is working out of the box (make sure to run migration) and start managing your time.

### EventItem

You can use out of the box method to supply your calendar with your events from the Eloquent model, or via overriding function

```php
getEvents(): array {
    return [
        \Buildix\Timex\Events\EventItem::make('id')
        ->subject('Your subject goes here')
        ->body('Body - long text of your event')
        ->color('primary') // secondary / danger / success
        ->category('primary') // secondary / danger / success
        ->start(today())
        ->end(today())
        ->startTime(now()),
        \Buildix\Timex\Events\EventItem::make('id')
        //
    ];
}
```

### Event resource

<img width="1865" alt="TiMEX-Resource" src="https://user-images.githubusercontent.com/2136612/206990201-4f36d7f9-55fd-4b89-b4e4-dec7846943e3.png">
<img width="1865" alt="TiMEX-Resource-edit" src="https://user-images.githubusercontent.com/2136612/206990224-8396061a-b439-4b12-a724-ac73402b587b.png">



By default TiMEX register `EventResource` to your navigation panel, if you would like to disable it, simply set `shouldRegisterNavigation` to `false` in TiMEX config:
Also, you can change slug, icon, and the Filament resource itself

```php
'resources' => [
    //
    'shouldRegisterNavigation' => false,
],
```
#### Event custom table name

You may change from default `timex_events` table name by changing config:

```php
'tables' => [
    'event' => [
        'name' => 'your_custom_table_name',
],
```

#### Event category model

You may create a custom category model, and define the class and main key table values in config with `isModelEnabled` set to `true`:

```php
'model' => [
    'class' => '', // \App\Models\Category::class
    'key' => 'id', // "id" is a DB column - you can change by any primary key
    'value' => 'value', // "value" is a DB column - it used for Select options and displays on Resource page
    'icon' => 'icon', // "icon" is a DB column - define here any heroicon- icon
    'color' => 'color', // "color" is a DB column - default tailwindcss colors names like: primary / secondary / danger
],
```
#### User model

TiMEX uses default User model `\App\Models\User::class`

You may change the class to your preferences and define which columns will be used for ID and name:

```php
'users' => [
            'model' => \App\Models\User::class,
            'name' => 'name',
            'id' => 'id',
        ],
```

### TiMEX Page

Package comes with pre-installed Filament page with all necessary configurations. 
If you need to change label naming, slug, navigation group, etc, go ahead to TiMEX config. 

<img width="1865" alt="TiMEX-Page1" src="https://user-images.githubusercontent.com/2136612/206990428-ea9267b5-d13d-4a14-9db0-45ffdbf32012.png">
<img width="1865" alt="TiMEX-Page2" src="https://user-images.githubusercontent.com/2136612/206990449-f95a9fea-7382-478d-ba42-810ae10145c9.png">



### Dynamic icon set & labels
<img width="1015" alt="timex-icons" src="https://user-images.githubusercontent.com/2136612/203330528-a8cbc30f-26dd-4fd2-a2fc-87a9ae106fd8.png">


TiMEX comes with two custom icons:
1. First one is static, represents TiMEX branding
2. The other is totally custom dynamic icon set for each day

You may change navigation icon from static to dynamic, simply changing TiMEX config `timex.icon.static` to `false`:

```php
'icon' => [
    'static' => false,
    //
],
```

You may change navigation label, title, breadcrumbs from dynamic to static string, which you can translate to any language you want by changing config properties:

```php
// timex.php

'label' => [
    'navigation' => [
        'static' => true,
        //
    ],
    'breadcrumbs' => [
        'static' => true,
        //
    ],
    'title' => [
        'static' => true,
        //
    ],
],
'buttons' => [
    'today' => [
        'static' => true,
        //
    ],
],

// resources/lang/en/timex.php

'labels' => [
    'navigation' => 'TiMEX',
    'breadcrumbs' => 'TiMEX',
    'title' => 'TiMEX',
    'today' => 'Today',
],

```

### Start & End of week

You may change how the calendar renders your week according to your locale. In order to make week start on Sunday, change TiMEX config accordingly:

```php
'week' => [
    'start' => \Carbon\Carbon::MONDAY,
    'end' =>  \Carbon\Carbon::SUNDAY
],
```

### Day names in Calendar view

You may change the names of weekdays on your calendar by changing TiMEX config `dayName` to 3 options:

```php
'dayName' => 'minDayName', // Mo .. Su
//
'dayName' => 'shortDayName', // Mon ... Sun
//
'dayName' => 'dayName', // Monday ... Sunday
```

To change Carbon locale, make sure to update your `app.php` locale settings.

## Demo

[![buildix-timex demo](https://img.youtube.com/vi/ojtwJvEU-RI/0.jpg)](https://www.youtube.com/watch?v=ojtwJvEU-RI)

## Credits

- [mikrosmile](https://github.com/mikrosmile)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
