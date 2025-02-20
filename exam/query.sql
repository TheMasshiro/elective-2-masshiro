CREATE TABLE IF NOT EXISTS bills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    meter_number INTEGER NOT NULL,
    address VARCHAR(510) NOT NULL,
    unit INT NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    due_date DATE NOT NULL,
    bill_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
