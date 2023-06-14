# protect-db
## easily take database backup no need to worry taking manual database backup everyday



## Features
- Database Backup Easily by command & route & schedule

<img src="https://miro.medium.com/max/945/1*hT0650uAynINJMeIftDj-g.pnghttps://scrnli.com/files/u4jhhdU8ZG3dMA" alt="crud" width="100%" height="400px"/>

## Installation

protect-db requires [PHP](https://php.net/) v7+ to run.

Install the dependencies and devDependencies and start the server.

```sh
composer require pranthokumar/protect-db
```

## How To Work
``
route---- /protect-db
comm ---- php artisan protect-db:protect
config---- weakly setup


PROTECT_DB_ROUTE_PREFIX=protect
PROTECT_DB_TIME='weekly'
PROTECT_DB_BACKUP=true

``

`
1.model= Your Already Created Model Name
`
`
2.option=api (If You Want Api Crud)
`
## License

MIT

**Free Software, Prantho Kumar Yeah!**
