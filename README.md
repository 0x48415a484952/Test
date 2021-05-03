
## About This Test Task

This is a shopping cart which each product can have multiple price, for example the base price for product A is 50$ but if you buy 3 of them they cost 130$ and even we can have multiple discount just on different numbers for one Product as shown below:

Buy 1 Of A : 50$
Buy 3 of A : 130$
Buy 8 of A : 400$

and extend this to have multiple products like A,B,C which each user can add to their cart.

i extended the example to have a syntax in the future that we can implement multiple parser that can understand it.

we could use a greedy algorithm for calculating the total price of the cart i preferred a bottom up approach and handling a json is more fun and like to keep things simple this way we also made are queries much less with one query we get all the price combination also we can extend this part to make it more fun and make a parser alongside the CoR to have a discount as follows -> if you buy product A with 2 of Product B you will get Product C for Free this also can be implemented in this approach which i had in mind. sure we need to implement some other helper classed to achieve such complexity but we don't need to change any classed(Open Close Principle), also each class only has one Responsibility at the moment because the parser was simple i did not try to decouple the SpecialPriceCalculator class but that is something which needs to be considered.

## What Have Been Used
Php 8.0.3

Laravel 8

MySql 8

MailHog

Meilisearch -> did not use it just installed it out of curiosity 

Laravel Sanctum as the Authentication Layer

## What To Be Aware OF
Add a layer of Repository to the basic Laravel eloquent which it was new for me to use laravel in such way ,

Add Services Directory which all the logic of the app has been handled in there and we have a very thin layer of Controllers

The Database Consists of 3 Tables {usres, user_cart, products} and the default tables of laravel sanctum such as {personal_access_tokens, password_resets}

The Structre of the app is as follows:
app-->
    Http--->
        Controllers--->

            -Auth(consistis of our authentication layer which is laravel sanctum)

            -Cart(all controllers that handle each route related to cart like adding products be aware one of the routes accepts Json Route::Post)

            -Products

        Requests--> All The Requests Have Validations no invalidated requests almost

        Services--> a fancy name which says our logic stands here
            -Auth
            -Cart
            -Money(was going to implement a money class that also makes out system future proof so we can manage to extend the website to work with different currencies of the world ) DID NOT USE IT FOR THE MEAN TIME
            -SpecialPriceCalculator (implemented with a mind of CoR maybe need some refactoring but it has been monkey tested so far)

        Traits--> consists of some helper traits


        Models--> consists the relations of the objects

        Provider--> created RepositoryServiceProvider in here if you don't want to use a Repository you may need to disable it and remove all the references to those inside Services classes

        Repositories--> contain repositories which they are leveraging Laravel Eloquent

        used argon2id as the hashing algorithm for the users

        routes--> api.php includes all the routes which are grouped in 3 different aspects {authentication routes, products route, cart routes}

        All the controllers are single action which are called by their class name i tried to be consistent so all the methods are named action but the classes are very understandable.

        Rules-->wrote a StrongPassword Rule To be Added on top of registeration validation

## For Future Development

Write Unit Test For All Classes specially cart
already wrote some Feature Test on the Authentication Part (i did not use any boilerplate) just using sanctum to handle token generation which was fun but maybe Oauth2 makes sense more in an API 
Used Bunch of Auth::user() but i think those can be refactored int the future.
    

## Running Tests

./vendor/bin/sail artisan test 

at the moment there are only LoginTest And RegistrationTest But plan to go for 80% coverage of the application

did not use any factories but we can do that also

## Installing 

everything is Dockerized out of the box thanks to laravel-sail just run:

git clone https://github.com/AhmadzadehHazhir/test

cd test 

./vendor/bin/sail up

## Special Thanks 

To those who work in Devolon and The team who came up with such a good test i had fun to be honest.
I have to admit i learned a lot about different patterns during this test task , thanks to those who trusted me and gave me a chance to learn. implemented a CoR pattern on the special_price_rule which i think made it a little bit future proof as i mentioned before. i could have gone with something like a decorator but it did not seem to be very helpful. even strategy could have been applied wanted to keep it simple i used CoR because it can be extended easily in this situation also if one Calculator/Parser couldn't handle a specific syntax for our special_prices we can easily add another class to the chain.



## Security Vulnerabilities

You Probably wanna to go with php 8.0.5 because 8.0.3 has some security vulnaribilities 

## License

The This is an open-sourced software licensed under the [MIT license]
