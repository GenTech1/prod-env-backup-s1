-- Domus.com Multi-Business Database Updates
-- Run these SQL commands to add business support

-- Create businesses table
CREATE TABLE IF NOT EXISTS businesses (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    address TEXT,
    phone VARCHAR(20),
    email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Add business_id to users table
ALTER TABLE users ADD COLUMN business_id INT DEFAULT NULL AFTER id;
ALTER TABLE users ADD FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
ALTER TABLE users ADD INDEX idx_business_user (business_id, id);

-- Add business_id to tickets table
ALTER TABLE tickets ADD COLUMN business_id INT DEFAULT NULL AFTER id;
ALTER TABLE tickets ADD FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;
ALTER TABLE tickets ADD INDEX idx_business_ticket (business_id, status);

-- Add business_id to login_logs table
ALTER TABLE login_logs ADD COLUMN business_id INT DEFAULT NULL AFTER id;
ALTER TABLE login_logs ADD FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;

-- Add business_id to ticket_notes table if it exists
ALTER TABLE ticket_notes ADD COLUMN business_id INT DEFAULT NULL AFTER id;
ALTER TABLE ticket_notes ADD FOREIGN KEY (business_id) REFERENCES businesses(id) ON DELETE CASCADE;

-- Insert a default business if needed (for testing)
INSERT INTO businesses (name, address, email) VALUES ('Default Business', '123 Main St', 'info@business.local') ON DUPLICATE KEY UPDATE id=id;

-- Check that the changes were made
SELECT 'Database updates completed successfully!' as status;
