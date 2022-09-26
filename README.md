> **Warning**
> This package is under development

# Laravel Report To PDF

## Installation

### Laravel
Require this package in your `composer.json` or install it by running:

```
composer require jeanfprado/laravel-report
```
## Basic Usage
To use Laravel Report you need create Report class as command:

```
php artisan make:report UsersReport --view=reports.users-report
```
It is created the report class with a view.


```php
<?php

namespace App\Reports;

use App\Models\User;
use Jeanfprado\LaravelReport\Report;

class UserReport extends Report
{
    protected $view = 'reports.user-report';

    public function toArray()
    {
        return [
            'users ' => User::all();
        ];
    }
}
```

and view 

```html
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Report</title>

<head>
  <style>
    table {
      font-family: Verdana, Tahoma, sans-serif;
      border-collapse: collapse;
      width: 100%;
      font-size: 10px
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }

    p {
      font-size: 12px;
    }

    .header {
      clear: both;
      display: table;
    }
  </style>
</head>

<body>

  <div class="header">
    <p>Report</p>
  </div>

  <table>
    <th>Name</th>
    <th>Email</th>
    </tr>
    @foreach($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
    </tr>
    @endforeach
  </table>

</body>

</html>
```
