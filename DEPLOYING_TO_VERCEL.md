# Deploying AddressBook on Vercel

## Before you deploy

This project uses PHP endpoints and MySQL. Vercel runs the PHP endpoints through the community-maintained `vercel-php` runtime; it is not an official Vercel PHP runtime.

1. Create a hosted MySQL database that accepts connections from your deployment provider.
2. Import the project's database schema/SQL dump into that database. Ensure the `contacts` table and its columns match the queries in the PHP files.
3. In Vercel, import this GitHub repository as a project.
4. Add these Environment Variables for **Production**, **Preview**, and **Development** as appropriate:
   - `DB_HOST`: database hostname
   - `DB_USER`: database username
   - `DB_PASS`: database password
   - `DB_NAME`: database name (defaults to `addressbook`)
5. Deploy and test listing, adding, editing, and deleting contacts.

## Notes

- Do not commit database credentials.
- The existing `config/config.php` reads the DB variables above.
- If the database provider requires TLS/SSL or IP allow-listing, follow its connection instructions.
- This is a deployment configuration, not a guarantee that the app has been runtime-tested on Vercel. Check the Vercel build and function logs after deploying.
