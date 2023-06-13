CREATE TABLE IF NOT EXISTS "comments" (
   id   INT GENERATED ALWAYS AS IDENTITY,
   author_id    INT NOT NULL,
   content      TEXT NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id),
   CONSTRAINT fk_user
        FOREIGN KEY(author_id) 
            REFERENCES users(id)
);