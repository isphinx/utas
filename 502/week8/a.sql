
CREATE TABLE user_w8
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    username varchar (128) NOT NULL,
    password varchar (256) NOT NULL,
    access INT (11),
    PRIMARY KEY (ID),
    UNIQUE (username)
);

use utas;
CREATE TABLE access_w8
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    access_type varchar (256) NOT NULL,
    PRIMARY KEY (ID)
);