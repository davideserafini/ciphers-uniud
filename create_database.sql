CREATE TABLE IF NOT EXISTS user_roles(
	id					SMALLINT unsigned auto_increment PRIMARY KEY,
	name				VARCHAR(50) UNIQUE,
	manage_other_users	TINYINT(1) NOT NULL,
	is_default_role		TINYINT(1) NOT NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS  ci_sessions (
	session_id VARCHAR(40) DEFAULT '0' NOT NULL PRIMARY KEY,
	ip_address VARCHAR(45) DEFAULT '0' NOT NULL,
	user_agent VARCHAR(120) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,
	INDEX `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS users(
	id				MEDIUMINT unsigned auto_increment PRIMARY KEY,
	email			VARCHAR(255) NOT NULL,
	password		CHAR(70) NOT NULL,
	first_name		VARCHAR(50),
	last_name		VARCHAR(50),
	role			SMALLINT unsigned,
	FOREIGN KEY (role) 
		REFERENCES user_roles(id)
		ON UPDATE CASCADE
		ON DELETE SET NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO user_roles(name, manage_other_users, is_default_role) VALUES('admin', 1, 0), ('user', 0, 1);