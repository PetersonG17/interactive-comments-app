# Running Locally

## Database Migrations

1. Exec into docker php container: `docker-compose exec php bash`
2. Execute command to run migrations: `flyway migrate`
3. Execute command to seed data: `composer seed`