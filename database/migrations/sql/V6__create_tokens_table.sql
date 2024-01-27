CREATE TABLE IF NOT EXISTS "tokens" (
   user_id      UUID NOT NULL,
   token        TEXT NOT NULL,
   type_id      INTEGER NOT NULL,
   expires_at   TIMESTAMP NOT NULL,
   created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY(user_id),
    CONSTRAINT fk_user
        FOREIGN KEY(user_id)
            REFERENCES users(id),
    CONSTRAINT fk_token_type
        FOREIGN KEY(type_id)
            REFERENCES token_types(id)
);

CREATE INDEX IF NOT EXISTS idx_tokens_token ON tokens(token);
CREATE INDEX IF NOT EXISTS idx_tokens_type_id ON tokens(type_id);