CREATE DATABASE SqlBD;

CREATE TABLE uploaded_text
(
    ID          int AUTO_INCREMENT PRIMARY KEY,
    content     text,
    date        date,
    words_count int
);
CREATE TABLE word
(
    ID      int AUTO_INCREMENT PRIMARY KEY,
    text_id int,
    word    text,
    count   int,
    FOREIGN KEY (text_id) REFERENCES uploaded_text (ID)
);
