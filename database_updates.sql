-- Multi-Business Support Database Migration
-- This script adds business_id columns to all relevant tables and creates the businesses table
-- Execute this against the domus_users database

-- Create the businesses table
CREATE TABLE IF NOT EXISTS businesses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    address VARCHAR(500),
    phone VARCHAR(20),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default business (for existing data migration)
INSERT IGNORE INTO businesses (id, name, address, phone, email) 
VALUES (1, 'Default Business', '', '', '');

-- Add business_id column to users table
ALTER TABLE users ADD COLUMN business_id INT DEFAULT 1 AFTER id;
ALTER TABLE users ADD CONSTRAINT fk_users_business FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
CREATE INDEX idx_users_business_id ON users(business_id);

-- Add business_id column to tickets table
ALTER TABLE tickets ADD COLUMN business_id INT DEFAULT 1 AFTER id;
ALTER TABLE tickets ADD CONSTRAINT fk_tickets_business FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
CREATE INDEX idx_tickets_business_id ON tickets(business_id);
CREATE INDEX idx_tickets_business_status ON tickets(business_id, status);

-- Add business_id column to login_logs table (if exists)
ALTER TABLE login_logs ADD COLUMN business_id INT DEFAULT 1 AFTER id;
ALTER TABLE login_logs ADD CONSTRAINT fk_login_logs_business FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
CREATE INDEX idx_login_logs_business_id ON login_logs(business_id);

-- Add business_id column to ticket_notes table (if exists)
ALTER TABLE ticket_notes ADD COLUMN business_id INT DEFAULT 1 AFTER id;
ALTER TABLE ticket_notes ADD CONSTRAINT fk_ticket_notes_business FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
CREATE INDEX idx_ticket_notes_business_id ON ticket_notes(business_id);
