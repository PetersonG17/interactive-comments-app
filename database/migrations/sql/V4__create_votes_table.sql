CREATE TABLE IF NOT EXISTS "votes" (
   id           UUID NOT NULL,
   voter_id     UUID NOT NULL,
   comment_id   UUID NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(id),
    CONSTRAINT fk_user
        FOREIGN KEY(voter_id)
            REFERENCES users(id),
    CONSTRAINT fk_comment
        FOREIGN KEY(comment_id) 
            REFERENCES comments(id)
);