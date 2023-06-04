CREATE TABLE employee (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(25),
    lastname VARCHAR(25),
    email VARCHAR(50) NOT NULL UNIQUE,
    mobile VARCHAR(20),
    street VARCHAR(50),
    housenumber VARCHAR(10),
    postalcode VARCHAR(7),
    city VARCHAR(25),
    birthdate DATE,
    gender VARCHAR(6),    
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);