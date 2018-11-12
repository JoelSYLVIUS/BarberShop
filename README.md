# BarberShop

A small website intended for a barber Shop. It will be showing off hairdressers, haircuts et clients will be able to make appointments.

## Get started

```
git clone https://github.com/JoelSYLVIUS/BarberShop.git
```

```
composer install
```

### Prerequisites

Once composer install is done, create a database and fill the line 16 in the .env file at the root of the project according to your infos :

```
DATABASE_URL=mysql://user:mdp@127.0.0.1:8889/Nomdevotrebase
```
Now that the db is created and the .env filled, use the following command which will create tables and entities from the project : 

```
php bin/console d:s:u --dump-sql --force 
```
Then use this one :
```
php bin/console s:r
```
It's done you can start to code !!

## Authors

* **Joël SYLVIUS** - *Project leader* 

Here is the list of all the collaborators : 

Rudy LANTOARIJAONA

Yann NOUVE

Antoine LUCAS

## Licence

NO LICENCE FOR THE MOMENT

## Special Mentions

* Thanks to Justine to be always here in our different examples

