

CREATE TABLE IF NOT EXISTS dnd_login (
	login_id INT AUTO_INCREMENT,
	login_username VARCHAR(255) NOT NULL,
    login_password VARCHAR(255) NOT NULL,
    login_email VARCHAR(255) NOT NULL,
    login_last DATETIME,
    PRIMARY KEY (login_id)
);