CREATE TABLE IF NOT EXISTS "user" (
   user_id      SERIAL PRIMARY KEY,
   email        VARCHAR(50) NOT NULL,
   first_name   VARCHAR(30) NOT NULL,
   last_name    VARCHAR(30) NOT NULL,
   password     VARCHAR(255) NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);