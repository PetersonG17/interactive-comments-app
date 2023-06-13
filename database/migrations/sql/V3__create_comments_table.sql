CREATE TABLE IF NOT EXISTS "comments" (
   id           UUID NOT NULL,
   author_id    UUID NOT NULL,
   content      TEXT NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id),
   CONSTRAINT fk_user
        FOREIGN KEY(author_id) 
            REFERENCES users(id)
);