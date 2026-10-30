<p align="center">
  <img src=".github/banner.svg" alt="Leenplaats – spullen lenen en reserveren" width="100%">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10-FF2D20?logo=laravel&logoColor=white" alt="Laravel 10">
  <img src="https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=white" alt="PHP 8.1+">
  <img src="https://img.shields.io/badge/SQLite-003B57?logo=sqlite&logoColor=white" alt="SQLite">
  <img src="https://img.shields.io/badge/status-in%20ontwikkeling-2f6f5e" alt="Status: in ontwikkeling">
</p>

# Leenplaats

Leenplaats is een webapp waar mensen spullen aan elkaar kunnen uitlenen. Je zet iets online (een boormachine, een tent, een spelcomputer) en een ander kan het voor een paar dagen reserveren.

Ik bouw het met **Laravel**. In dit project leer ik hoe MVC, migraties en Eloquent-modellen in de praktijk samenwerken.

## Wat er al staat

- **Productoverzicht** op de homepage: alle spullen met hun prijs per dag, of ze vrij zijn, en de komende reserveringen met de naam van wie het leent.
- **Producten**: naam, beschrijving, prijs en of het product beschikbaar is.
- **Reserveringen**: koppelen een product aan een gebruiker, met een begin- en einddatum. Wordt een product of gebruiker verwijderd, dan verdwijnen de reserveringen ook.
- **Relaties in Eloquent**: een product heeft reserveringen, een reservering hoort bij een product en een gebruiker.
- **API**: `GET /api/producten` geeft alle producten als JSON, met `POST /api/producten` voeg je er een toe.
- **Seeders** met voorbeelddata: 4 gebruikers, 8 producten en 6 reserveringen.

## Wat er nog komt

- [ ] Inloggen en registreren
- [ ] Zelf een product toevoegen via de site
- [ ] Een product reserveren voor een periode
- [ ] Een overzicht van je eigen reserveringen

## Zelf draaien

Je hebt PHP 8.1+ en Composer nodig. Een database hoef je niet in te stellen: Leenplaats gebruikt **SQLite**, een bestand in `database/database.sqlite`.

```bash
git clone https://github.com/ParisAngelopoulos/leenplaats.git
cd leenplaats
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

`migrate --seed` maakt het databasebestand aan en vult het met voorbeelddata. De site draait dan op http://localhost:8000. De testaccounts (`paris@voorbeeld.nl`, `sanne@voorbeeld.nl`, `daan@voorbeeld.nl` en `lisa@voorbeeld.nl`) hebben allemaal het wachtwoord `welkom123`. Wil je opnieuw beginnen, dan zet `php artisan migrate:fresh --seed` alles terug.

## Mappen

| Map | Wat erin staat |
| --- | --- |
| `app/Models` | `Product`, `Reservation` en `User` |
| `app/Http/Controllers` | `ProductController` |
| `database/seeders` | Voorbeelddata voor gebruikers, producten en reserveringen |
| `resources/views/producten.blade.php` | Het productoverzicht |
| `database/migrations` | De tabellen voor producten en reserveringen |
| `routes/web.php` | De routes van de site |

---

Gemaakt door **Paris Angelopoulos**, web developer in opleiding · [GitHub](https://github.com/ParisAngelopoulos) · [parisangelopoulos@gmail.com](mailto:parisangelopoulos@gmail.com)
