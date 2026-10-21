# AddressBook

A responsive contact-management application built with PHP, MySQL, jQuery, and Foundation. It provides a simple interface for saving, searching, editing, and deleting contact records.

**Repository:** https://github.com/mbakr0/addressbook

## Features

- View saved contacts in an organized table.
- Search contacts from the main page.
- Add, edit, and delete contact records without a full-page reload.
- Store contact details including names, email, phone, address, city, state, ZIP/postal code, group, and notes.
- Validate required names and email format on the server.
- Use parameterized PDO queries for contact data operations.
- Automatically create the `contacts` table if it does not exist.
- Responsive interface with modal forms, loading states, and empty states.

## Technology stack

- **Backend:** PHP 8+ and PDO
- **Database:** MySQL-compatible database (including TiDB Cloud)
- **Frontend:** HTML, CSS, JavaScript, jQuery
- **UI framework:** Foundation
- **Hosting configuration:** Vercel PHP runtime

## Project structure

```text
index.php                  Main application page
contacts.php               Returns the contacts list
add_contact.php            Creates a contact (POST)
edit_contact.php           Updates a contact (POST)
delete_contact.php         Deletes a contact (POST)
api/index.php              Vercel entry point and endpoint allowlist
config/config.php          Environment-based database configuration
core/init.php              Shared bootstrap and class autoloading
libraries/Database.php     PDO connection, query helpers, schema setup
css/                       Foundation and application styles
js/app.js                  Search, modal, and AJAX interactions
vercel.json                Vercel routes and runtime configuration
.env.example               Example local environment variables
```

## Requirements

- PHP 8+ with PDO MySQL enabled
- A MySQL-compatible database
- Composer is not required by the current application

## Run locally

1. Install PHP and MySQL (or start Apache/MySQL in XAMPP).
2. Clone this repository and open its directory.
3. Create a database named `addressbook`, or choose another database and update `DB_NAME`.
4. Copy `.env.example` to your local environment configuration method and set your database values. The PHP built-in server does not automatically load a `.env` file, so export the variables in your terminal or configure them in Apache/PHP.
5. From the repository root, start PHP:

   ```bash
   php -S 127.0.0.1:8000
   ```

6. Open http://127.0.0.1:8000.

On the first database connection, the application creates the `contacts` table if needed. The database user needs permission to create the table during initial setup, as well as permission to select, insert, update, and delete contact records.

## Environment variables

See `.env.example` for the variable names used by the application:

- `DB_HOST` — database hostname
- `DB_USER` — database username
- `DB_PASS` — database password
- `DB_NAME` — database/schema name
- `DB_SSL_CA` — optional CA certificate path for database TLS

Configure production secrets in the hosting provider's environment settings. Never commit actual credentials.

## Deployment

The repository includes a Vercel PHP entry point and route configuration. Set the database environment variables in Vercel and ensure the database allows connections from the deployment environment. For hosted databases that require TLS, configure the correct CA certificate and keep certificate verification enabled.

After deployment, test contact listing, creation, editing, deletion, and database connectivity in the live environment.

## Security notes

- The application currently has no user authentication or per-user access control. Do not use it to store private or sensitive contact information on a publicly accessible deployment without adding authentication and authorization.
- Keep database credentials out of source control.
- Use HTTPS in production and restrict database network access where possible.
- The application uses prepared statements for contact queries and escapes contact values when rendering HTML.

## License

No license is specified in this repository. Contact the repository owner before redistributing the project.
