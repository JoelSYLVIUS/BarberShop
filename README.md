# BarberShop

Petit site pour mettre en avant un barber Shop. On y présentera les coiffeurs, les coupes et les clients auron la possibilité de réservé leurs passage au barber.

## Bien débuter

```
git clone https://github.com/JoelSYLVIUS/BarberShop.git
```

```
compose install
```

### Prérequis

Une fois le compose install terminer créer si ce n'est pas déjà fait un bdd dans mysql et compléter la ligne 16 du fichier env à la racine suivant avec vos infos: 
```
DATABASE_URL=mysql://user:mdp@127.0.0.1:8889/Nomdevotrebase
```
Une fois la bdd créer et le fichier configurer, taper la commande suivante qui va créer les tables des entités existant dans le projet:
```

php bin/console d:s:u --dump-sql --force 

```
Une fois la commande exécuter et terminer:
```

php bin/console s:r

```
Et voilà vous pouvez commencer à coder et faire évoluer le projet !!

## Auteurs

* **Joël SYLVIUS** - *Chef de projet* 

Vous pouvez retrouver une liste complète de tous nos qui ont participe à la construction de l'application : 

Rudy LANTOARIJAONA

Yann NOUVE

Antoine LUCAS

## License

Pas de licence pour le moment
## Mentions spéciales

* Merci à Justine d'être toujours présente dans nos différents exemples
