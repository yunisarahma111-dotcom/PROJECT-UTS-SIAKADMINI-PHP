CREATE TABLE users (

    id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(100),

    password_hash VARCHAR(100),

    role VARCHAR(20)

);

INSERT INTO users(
    username,
    password_hash,
    role
)

VALUES(
    'admin',
    '12345',
    'admin'
);

CREATE TABLE dosen (

    id INT AUTO_INCREMENT PRIMARY KEY,

    nidn VARCHAR(50),

    nama VARCHAR(100),

    email VARCHAR(100),

    program_studi VARCHAR(100),

    foto VARCHAR(255),

    status VARCHAR(20),

    deleted_at TIMESTAMP NULL

);