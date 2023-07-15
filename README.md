## Task Description
We have three providers that make transfers using a phone number,
You have examples of the structure of the data sent,
We need to read and make some filter operations on them to get the result.

DataProviderW data is stored in [DataProviderW.json]
DataProviderX data is stored in [DataProviderX.json]
DataProviderY data is stored in [DataProviderY.json]

* DataProviderW schema is
  {
  amount:500.00,
  currency:'EGP',
  phone: 00201134567890,
  status: 'done',
  created_at: '2021-03-29 09:36:11',
  id: 12345678
  }
  We have three status for DataProviderW
  paid which will have status done
  pending which will have status wait
  reject which will have status nope

* DataProviderX schema is
  {
  transactionAmount:200,
  Currency:'USD',
  senderPhone:00201234567890,
  transactionStatus:1,
  transactionDate: '2021-03-29 09:36:11',
  transactionIdentification: 'd3d29d70-1d25-11e3-8591-034165a3a613'
  }
  we have three status for DataProviderX
  paid which will have status 1
  pending which will have status 2
  reject which will have status 3

* DataProviderY schema is
  {
  amount:300,
  currency:'EGP',
  phone: 00201034567890,
  status:100,
  created_at: '2021-03-29 09:36:11',
  id: '4fc2-a8d1'
  }
  we have three status for DataProviderY
  paid which will have status 100
  pending which will have status 200
  reject which will have status 300

The wireframe contains of a header and navigation bar for the main categories, then a wide slider to
navigate the Adv. products at the top of the page. The 4 remaining sections then should be
implemented as the following:

## Development Stack:
- PHP Lumen (Micro-Framework By Laravel).
- Programing language PHP 8.2

## Installation

### Step 1.
- Begin by cloning this repository to your machine
```
git clone `repo url` 
```

- Install dependencies
```
composer install
```

### Step 2
- To start the server, run the command below
```
php -S localhost:8000 -t public or php -S 127.0.0.1:8000 -t public
```
## Application Route
```
http://127.0.0.1:8000/api/transactaions        `and you can add filtration as you want`
```
## Author
- ibrahim khalaf
