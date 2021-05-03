
## About This Test Task

This is a shopping cart which each product can have multiple price, for example the base price for product A is 50$ but if you buy 3 of them they cost 130$ and even we can have multiple discount just on different numbers for one Product as shown below:


<table>
<th>Product A</th>
<tr><td>1</td><td>50$</td></tr>
<tr>><td>3</td><td>130$</td></tr>
<tr><td>8</td><td>400$</td></tr>
</table>

and extend this to have multiple products like A,B,C which each user can add to their cart.

i extended the example to have a syntax for this pricing,  in the future that we can implement multiple parser that can understand it.
we could use a greedy algorithm for calculating the total price of the cart i preferred a bottom up approach and handling a json is more fun and like to keep things simple this way we also made our queries much less , with one query we get all the price combination also we can extend this part to make it more fun and make a parser alongside the CoR to have a discount as follows -> if you buy product A with 2 of Product B you will get Product C for Free this also can be implemented in this approach which i had in mind. sure we need to implement some other helper classed to achieve such complexity but we don't need to change any classed(Open Close Principle), also each class only has one Responsibility at the moment because the parser was simple i did not try to decouple the SpecialPriceCalculator class but that is something which needs to be considered.

## Installing 

everything is Dockerized out of the box thanks to laravel-sail just run:

```
git clone https://github.com/AhmadzadehHazhir/test

cd test 

./vendor/bin/sail up

http://localhost/api

```


## Using Postman To Test The API

```
you can import [/test-task.postman_collection.json](test-task.postman_collection.json) file into postman and check the routes
be aware some routes need authentication
```

## What Have Been Used
* [ Php 8.0.3 ]

* [ Laravel 8 ]

* [ MySql 8 ]

* [ MailHog ]

* [ MeiliSearch ] --> installed it but did not use it!

* [ Laravel Sanctum as the Authentication Layer ]

## What To Be Aware OF

Add a layer of Repository to the basic Laravel eloquent which it was new for me to use laravel in such way ,
Add Services Directory which all the logic of the app has been handled in here and we have a very thin layer of Controllers
The Database Consists of 3 Tables {users, user_cart, products} and the default tables of laravel sanctum such as {personal_access_tokens, password_resets}

The structure of the app is as follows:


```
app
├── Http
│   └── Controllers
│   |    ├── Auth (consists of our authentication layer which is laravel sanctum very thin controller structure)
│   |    ├── Cart
│   |    |── Products
│   |    
│   ├── Requests (All The Requests Have Validations no invalidated requests almost)
|   |
|   ├── Services (a fancy name which says our logic stands here)
|   |     └── Auth
|   |     └── Cart
|   |     └── Money (we can implement this class so our platform can be used with multiple Currencies , did not it)
|   |
|   ├── Traits (consists of some helper traits)
|   |
|   |
|   ├── Models (consists the relations of the objects) 
|   |
|   |
|   ├── Provider (registered RepositoryServiceProvider in here)
|   |
|   |
|   ├── Repository (contain repositories which they are leveraging Laravel Eloquent)
|
├── routes (api.php includes all the routes) 
|
|
└── Rules (wrote a StrongPassword Rule To be Added on top of registration validation)
```

## For Future Development

Write Unit Test For All Classes specially cart
already wrote some Feature Test on the Authentication Part (i did not use any boilerplate) just using sanctum to handle token generation which was fun but maybe Oauth2 makes sense more in an API 
Used Bunch of Auth::user() but i think those can be refactored int the future.
    

## Running Tests
```
./vendor/bin/sail artisan test 

at the moment there are only LoginTest And RegistrationTest But plan to go for 80% coverage of the application

did not use any factories but we can do that also
```


## Special Thanks 

To those who work in Devolon and The team who came up with such a good test i had fun to be honest.
I have to admit i learned a lot about different patterns during this test task , thanks to those who trusted me and gave me a chance to learn. implemented a CoR pattern on the special_price_rule which i think made it a little bit future proof as i mentioned before. i could have gone with something like a decorator but it did not seem to be very helpful. even strategy could have been applied wanted to keep it simple i used CoR because it can be extended easily in this situation also if one Calculator/Parser couldn't handle a specific syntax for our special_prices we can easily add another class to the chain.



## Security Vulnerabilities

You Probably wanna to go with php 8.0.5 because 8.0.3 has some security vulnaribilities 

## License

The This is an open-sourced software licensed under the [MIT license]
