CREATE TABLE page (id BIGINT AUTO_INCREMENT, title VARCHAR(255) NOT NULL, url VARCHAR(255), meta VARCHAR(255), content TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;