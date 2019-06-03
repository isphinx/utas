DROP TABLE xinbank_user;
CREATE TABLE xinbank_user
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    username VARCHAR (128) NOT NULL,
    firstname VARCHAR (128) NOT NULL,
    surname VARCHAR (128) NOT NULL,
    password VARCHAR (256) NOT NULL,
    type INT (32) NOT NULL DEFAULT 1,
    mobile VARCHAR (32) NOT NULL,
    email VARCHAR (128) NOT NULL,
    gender VARCHAR (32) NOT NULL,
    createTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    lastTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    UNIQUE (username)
)AUTO_INCREMENT=1000;

INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('root', 'lucas', 'lee', md5('12345sphinx'), 3, '88888888', '666@me.com', 'male');
INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('abc', 'micheal', 'lee', md5('12345sphinx'), 1, '11111111', '666@qq.com', 'male');
INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('xyz', 'manson', 'lee', md5('12345sphinx'), 1, '22222222', '666@gmail.com', 'male');
/* INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('ooo', 'eminem', 'lee', md5('12345sphinx'), 1, '33333333', '666@yahoo.com', 'male');
INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('ppp', 'tyson', 'lee', md5('12345sphinx'), 1, '44444444', '666@utas.com', 'male');
INSERT INTO xinbank_user (username, firstname, surname, password, type, mobile, email, gender) 
VALUES ('ddd', 'curry', 'lee', md5('12345sphinx'), 1, '44444444', '666@utas.com', 'male'); */

DROP TABLE xinbank_account;
CREATE TABLE xinbank_account
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    userID INT (32) NOT NULL,
    BSB INT (32) NOT NULL DEFAULT 181818,
    type INT (32) NOT NULL,
    currency FLOAT (32) NOT NULL DEFAULT 100000,
    credit FLOAT (32) NOT NULL DEFAULT -1,
    createTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID),
    UNIQUE (userID, type)
)AUTO_INCREMENT=10000000;

/* INSERT INTO xinbank_account (userID, type, currency) VALUES (1, 1, 1000); */

DROP TABLE xinbank_transactions;
CREATE TABLE xinbank_transactions
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    FromaccountID INT (32) NOT NULL,
    FromBSB INT (32) NOT NULL DEFAULT 181818,
    toaccountID VARCHAR (32) NULL,
    toBSB VARCHAR (32) NULL DEFAULT 181818,
    type INT (32) NOT NULL,
    purpose VARCHAR (128) NOT NULL,
    transferTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    currency FLOAT (32) NOT NULL,
    currencytype VARCHAR (32) NOT NULL DEFAULT 'AUD',
    PRIMARY KEY (ID)
)AUTO_INCREMENT=10000;

/* INSERT INTO xinbank_transactions (accountID, userID, currency) VALUES (1,1, 100); */

DROP TABLE xinbank_messages;
CREATE TABLE xinbank_messages
(
    ID INT (32) NOT NULL AUTO_INCREMENT,
    userID INT (32) NOT NULL,
    messagefrom VARCHAR (128) NOT NULL,
    receivedTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    content VARCHAR (256) NOT NULL,
    isRead INT (8) NOT NULL DEFAULT 0,
    PRIMARY KEY (ID)
);


/* INSERT INTO xinbank_messages (userID, from, receivedTime, content, isRead)
 VALUES (1, "xin bank", "Welcome you to join Xin Bank."); */