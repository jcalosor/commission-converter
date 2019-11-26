# commission-converter

## Introduction

Only accepts .csv file formats, and only reads values with constraints to the following structure:
```
operation_date, identification, person_type, operation_amount, operation_currency
```
see sample.csv in `public/` directory for references
### Installation

Run
```
composer install
```

### Usage
1. Upload / Paste your .csv file in the `public/` directory.
2. Go to your terminal and execute the commission script with the csv file as first parameter.


```
./bin/commission persons.csv
```

Upon successful execution, the commissions will be printed out like so:
````
3.60
3.00
3.00
0.60
5.00
3.00
0.30
50.00
3.00
0.90
0.30
9000.00
````
