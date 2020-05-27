# Inline Editing functionality within Backpack
A very rough proof of concept demo to get inline editing working in a [Laravel Backpack](https://github.com/Laravel-Backpack/CRUD) Crud panel list page.

## Please do not use this as-is!
- There is no validation / checking ^_^
- Error responses look hilarious on the front-end as a stack trace is just printed within the single table cell
- UI isn't ideal - lots of edge cases;

In general - this is a basic proof-of-concept. Ideally, this whole thing would be done properly in a nice package with some custom columns and a custom operation.

## How it works

- The x-editable js and css files are added in to the backpack base config, so are available on every Crud page (not ideal!) 
- There are 3 custom columns, which initialise as editable elements on page load.
- The editable elements point to an /editable route that's linked to an editable() function on the TestCrudController. This function figures out what model and value should be updated, then updates it. 

## To Setup Demo locally:

1. clone repo;
2. default Laravel setup stuff:
   - add .env file with db info
   - setup db (sqlite fine for demo)
   - `composer install`
   - `npm i`
3. Backpack install: `php artisan backpack:install`
4. Use custom function to deploy x-editable css / js assets: `php artisan deploy:editable`

5. Run demo: 
- make account
- to to /admin/test to see test Crud Panel
- add an entry
- edit the entry directly in the list view table :-)

