CREATE TABLE IF NOT EXISTS 'users' (
  'user_key' char(8) NOT NULL PRIMARY KEY,
  'username' varchar(30) NOT NULL UNIQUE,
  'pwd' varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'sessions' (
  'sid' varchar(40) NOT NULL PRIMARY KEY,
  'expiry' int(10) unsigned NOT NULL,
  'data' text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS 'autologin' (
  'user_key' CHAR(8)    NOT NULL,
  'token'    CHAR(22)   NOT NULL,
  'create'   TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  'data'     TEXT,
  'used'     TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY ('user_key', 'token')
) ENGINE=InnoDB DEFAULT CHARSET=utf8;