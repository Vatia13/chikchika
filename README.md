# chikchika

Chikchika is Laravel Twitter clone, In this project I`m using mysql database and mailtrap for mails localhost, but you can chose your own database driver and mailserver inside and setup inside .env file

## Installation

#### 1. Install Composer Dependencies

```bash
composer install
```

#### 2. Environment variables .env

In project directory make copy of .env.example file and rename it to .env
or simply use command:

```bash
cp .env.example .env
```

#### 3. Migrate database

```bash
php artisan migrate
```

The optional command if u want to seed some factory data from seeders you can run 
```bash
php artisan db:seed
```

#### 4. Optional - Install npm packages

In case if you want to track realtime changes in project install npm packages

```bash
npm install
```

## Run Project

#### 1. Run localhost server

```bash
php artisan serve
```

#### 2. Optional - compile project

The project is builded already with command:

```bash
npm run build
```

but in case if u can't see some frontend html you can always re run a command above or run

```bash
php artisan dev
```

to watch realtime changes