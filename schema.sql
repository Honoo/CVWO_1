CREATE TABLE users (
  userID INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(20),
  email VARCHAR(30),
  password VARCHAR(255),
  PRIMARY KEY  (userID)
);

CREATE TABLE posts (
  postID INT NOT NULL AUTO_INCREMENT,
  date_created TIMESTAMP,
  title VARCHAR(255),
  content TEXT,
  userID INT,
  PRIMARY KEY  (postID)
);

ALTER TABLE posts ADD CONSTRAINT posts_fk1 FOREIGN KEY (userID) REFERENCES Users(userID);