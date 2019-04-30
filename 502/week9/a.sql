CREATE TABLE guestbook
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    name varchar (128) NOT NULL,
    password varchar (256) NOT NULL,
    email varchar (256) NOT NULL,
    url varchar (256) NOT NULL,
    comments text NOT NULL,
    updated_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    UNIQUE (name)
);