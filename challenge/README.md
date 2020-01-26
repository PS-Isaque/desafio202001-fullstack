# Address Services Module

This is the service module responsible for all addresses management

## Install the Application

Clone this repo and run docker with command bellow

    docker-compose up -d
    
Generate the database
    
    .\vendor\bin\phinx migrate
    
To run the application suit tests

	./vendor/bin/phpunit


## API

### Create Address

    path: localhost/api/v1/address/create
    verb: POST
    params: { 
                'street': String (required),
                'number': String (required, only numbers),
                'complement': String,
                'neighborhood': String (required),
                'city': String (required),
                'state': String (required, 2 digits),
                'zipcode' String (required, only numbers) 
            }
            
### Update Address

    path: localhost/api/v1/address/update/:id
    verb: PATCH
    params: { 
                'street': String (required),
                'number': String (required, only numbers),
                'complement': String,
                'neighborhood': String (required),
                'city': String (required),
                'state': String (required, 2 digits),
                'zipcode' String (required, only numbers) 
            }
              
### Get Address

    path: localhost/api/v1/address/:id
    verb: GET

### List Addresses

    path: localhost/api/v1/address/all
    verb: GET
    
### Delete Address

    path: localhost/api/v1/address/:id
    verb: DELETE      

