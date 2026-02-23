<a id="readme-top"></a>

# Red List Display

Applicazione Laravel per consultare sistemi, nazioni, valutazioni e dettaglio specie usando le API IUCN Red List v4  
([IUCN Red List API](https://api.iucnredlist.org/help))

## Indice

1. [Requisiti](#requisiti)
2. [Setup locale](#setup-locale)
3. [Avvio progetto](#avvio-progetto)
4. [Licenza](#licenza)
5. [Contatti](#contatti)

---

## Requisiti

- PHP 8.2.12+
- Composer 2.8.10+
- Node.js 22+ e npm
- Database supportato da Laravel (MySQL/MariaDB o SQLite)
- API Key IUCN Red List v4: [https://api.iucnredlist.org/](https://api.iucnredlist.org/)

---

## Setup locale

1. Clona il repository e apri la cartella del progetto.

2. Installa le dipendenze backend:

```bash
composer install
```

3. Installa le dipendenze frontend:

```bash
npm install
```

4. Crea il file `.env`:

- Linux/macOS
```bash
cp .env.example .env
```

- Windows PowerShell
```pwsh
Copy-Item .env.example .env
```

5. Genera la chiave applicativa:

```bash
php artisan key:generate
```

6. Configura il database nel file `.env` (`DB_*`).

7. Inserisci la chiave API IUCN nel file `.env`:

```env
IUCN_API_KEY=la_tua_api_key
```

8. Esegui le migrazioni:

```bash
php artisan migrate
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Avvio progetto

Avvia in due terminali separati:

1. Server Laravel

```bash
php artisan serve
```

2. Build assets in sviluppo

```bash
npm run dev
```

Apri poi l'URL mostrato da Laravel (tipicamente `http://127.0.0.1:8000`).

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Licenza

Distribuito con licenza Unlicense. Vedi `LICENSE.txt` per maggiori informazioni.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

---

## Contatti

Mattia Mannucci - mannuccimattia@gmail.com

Project Link: [https://github.com/mannuccimattia/iucn-rl-display](https://github.com/mannuccimattia/iucn-rl-display)

<p align="right">(<a href="#readme-top">back to top</a>)</p>
