USE students_db;

RENAME TABLE class_12 TO passed_out;
RENAME TABLE class_11 TO class_12;
RENAME TABLE class_10 TO class_11;
RENAME TABLE class_9 TO class_10;
RENAME TABLE class_8 TO class_9;
RENAME TABLE class_7 TO class_8;
RENAME TABLE class_6 TO class_7;

CREATE TABLE class_6
(name VARCHAR(30),
dob DATE,
admission_no VARCHAR(7) primary key,
class INTEGER,
father_name VARCHAR(30),
mother_name VARCHAR(30),
address VARCHAR(90),
locality VARCHAR(5),
category  VARCHAR(7),
mobile VARCHAR(10),
email VARCHAR(30),
gender VARCHAR(6),
image VARCHAR(26));