step 1: clone 2 project
step 2: open project adminend in terminal
step 3: enter 'composer update' in terminal
step 4: open project userend in terminal
step 5: enter 'composer update' in terminal
step 6: open .env file in project adminend
step 7: enter following commands in adminend project
    1. php artisan key:generate
    2. php artisan migrate
    3. php artisan passport:install
    4. php artisan storage:link
    5. php artisan serve
step 8: setup database configuration
step 9: open .env file in project userend
step 10: add 'PUBLIC_URL' with adminend project url (Eg: PUBLIC_URL=http://localhost:8000)
step 11: enter php artisan serve command