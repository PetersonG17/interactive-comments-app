CREATE TABLE IF NOT EXISTS "token_types" (
   id           INTEGER NOT NULL,
   name         VARCHAR(255) NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id)
);

INSERT INTO token_types (id, name) VALUES (1, 'access_token'), (2, 'refresh_token');