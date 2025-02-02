

## Setup

1) clone project
2) cp .env.example .env and add db info
3) php artisan key:generate
4) php artisan migrate:fresh --seed
## Database optimizations
foreign keys , primary keys
Indexed client created_at for daterange filters
Indexed payments client_id and created_at for future date range filters filters by client
Eager loaded when necessary to avoid n+1 problem
constraints and cascade deletes for database clean data

## Additional features you implemented

Utilized service and repository pattern - organizing code effectively based on responsibility
Crud components instead of reusing same code in multiple blades.
pagination
