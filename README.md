# prueba_grupoaxo

# to initialize the project need to run in the root project

docker-compose up -d

## then api is ready and mysql database is created

### now run the migrations to create the new tables

php artisan migrate

### uncomment the lines 34 to 36 to activate the save method to the average operation in database

## to test the api send a POST request from postman with this

{
    "numbers": [
        5,
        2,
        1        
    ]
}

### is an array with 3 numbers and te response will be something like

{
    "success": true,
    "data": {
        "addition": 8,
        "average": 2.6666666666666665
    },
    "message": "Results"
}

### in the process check the table average in column resultaverage to check the saved data

### and that all

## thnak you
