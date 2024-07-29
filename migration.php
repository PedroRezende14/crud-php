<?php
$host = 'db';
$db = 'postgres';
$user = 'postgres';
$pass = '123456';

$dsn = "pgsql:host=$host;dbname=$db";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    // Set the charset
    $pdo->exec("SET NAMES 'utf8'");

    $sql = "
    DO \$\$
    BEGIN
        IF NOT EXISTS (SELECT 1 FROM pg_tables WHERE schemaname = 'public' AND tablename = 'pessoa') THEN
            CREATE TABLE pessoa (
                id SERIAL PRIMARY KEY,
                nome VARCHAR(255) NOT NULL,
                cpf VARCHAR(11) NOT NULL
            );
        END IF;

        IF NOT EXISTS (SELECT 1 FROM pg_tables WHERE schemaname = 'public' AND tablename = 'contatos') THEN
            CREATE TABLE contatos (
                id SERIAL PRIMARY KEY,
                tipo VARCHAR(10) NOT NULL CHECK (tipo IN ('celular', 'email')),
                descricao VARCHAR(255) NOT NULL,
                pessoaid INT,
                FOREIGN KEY (pessoaid) REFERENCES pessoa(id) ON DELETE CASCADE
            );
        END IF;
    END
    \$\$;
    ";

    $pdo->exec($sql);
    echo "Tables created successfully.";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
