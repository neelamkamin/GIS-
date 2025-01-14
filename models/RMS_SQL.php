<?php
//CREATE MYSQL OR MARIA_DB DATABASE WITH NAME 'rms_db' for RMS Project
/* SQL TO CREATE TABLE articles, COPY BELOW QUERY AND RUN IN MARIA_DB  */

"CREATE TABLE articles (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id VARCHAR(100) NOT NULL,
title VARCHAR(100) NOT NULL,
body TEXT NOT NULL,
remark TEXT,
category VARCHAR(25) NOT NULL,
reported_at VARCHAR(25),
cost DOUBLE NOT NULL,
exp DOUBLE,
FY VARCHAR(30) NOT NULL

)";

/*COPY BELOW QUERY AND RUN THIS IN MARIA_DB */

//FOR CREATING TABLE users

 "CREATE TABLE users (
e_no INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
id VARCHAR(30) NOT NULL,
u_name VARCHAR(50) NOT NULL,
pass VARCHAR(20) NOT NULL,
role VARCHAR(12) NOT NULL,
Mobile_no VARCHAR(12) NOT NULL,
email_id VARCHAR(30) NOT NULL

)";

//FOR CREATING TABLE task_db
"CREATE TABLE task_db (
t_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
task TEXT NOT NULL,
user_id VARCHAR(50) NOT NULL,
assign_by VARCHAR(50) NOT NULL,
task_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";

//FOR CREATING TABLE reply_db
"CREATE TABLE reply_db (
r_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
reply TEXT NOT NULL,
reply_by VARCHAR(50) NOT NULL,
reply_to VARCHAR(50) NOT NULL,
task_id INT(11) NOT NULL,
reply_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";


?>
