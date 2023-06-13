CREATE TABLE IF NOT EXISTS "votes" (
   id      INT GENERATED ALWAYS AS IDENTITY,
   voter_id     INT NOT NULL,
   comment_id   INT NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id),
    CONSTRAINT fk_user
        FOREIGN KEY(voter_id)
            REFERENCES users(id),
    CONSTRAINT fk_comment
        FOREIGN KEY(comment_id) 
            REFERENCES comments(id)
);