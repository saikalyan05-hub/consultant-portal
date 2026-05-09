-- Staffing Portal MySQL Schema

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- Roles Table
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Default Roles
INSERT INTO `roles` (`name`, `description`) VALUES
('Super Admin', 'Full system access'),
('Manager', 'Management and analytics access'),
('Recruiter', 'Consultant and job submission management'),
('Consultant', 'Profile and document management');

-- Users Table
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_verified` tinyint(1) DEFAULT 0,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Invite Links Table
CREATE TABLE IF NOT EXISTS `invite_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL UNIQUE,
  `expires_at` timestamp NOT NULL,
  `used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`sender_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Consultants Table
CREATE TABLE IF NOT EXISTS `consultants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `skills` text,
  `experience_years` int(11),
  `location` varchar(100),
  `linkedin_url` varchar(255),
  `education` text,
  `work_authorization_status` varchar(50),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Resumes Table
CREATE TABLE IF NOT EXISTS `resumes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultant_id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `is_default` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`consultant_id`) REFERENCES `consultants`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Work Authorization Documents Table
CREATE TABLE IF NOT EXISTS `work_authorization_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consultant_id` int(11) NOT NULL,
  `document_type` varchar(100) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `expiry_date` date NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`consultant_id`) REFERENCES `consultants`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Job Submissions Table
CREATE TABLE IF NOT EXISTS `job_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recruiter_id` int(11) NOT NULL,
  `consultant_id` int(11) NOT NULL,
  `resume_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `vendor_name` varchar(100),
  `job_title` varchar(100) NOT NULL,
  `location` varchar(100),
  `rate` varchar(50),
  `status` enum('Submitted', 'Interview Scheduled', 'Selected', 'Rejected', 'On Hold') DEFAULT 'Submitted',
  `notes` text,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`recruiter_id`) REFERENCES `users`(`id`),
  FOREIGN KEY (`consultant_id`) REFERENCES `consultants`(`id`),
  FOREIGN KEY (`resume_id`) REFERENCES `resumes`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Interviews Table
CREATE TABLE IF NOT EXISTS `interviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `submission_id` int(11) NOT NULL,
  `interview_date` datetime NOT NULL,
  `interview_type` varchar(50),
  `feedback` text,
  `status` enum('Scheduled', 'Completed', 'Cancelled') DEFAULT 'Scheduled',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`submission_id`) REFERENCES `job_submissions`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Notifications Table
CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(50),
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Audit Logs Table
CREATE TABLE IF NOT EXISTS `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11),
  `action` varchar(255) NOT NULL,
  `details` text,
  `ip_address` varchar(45),
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password Resets Table
CREATE TABLE IF NOT EXISTS `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Email Verifications Table
CREATE TABLE IF NOT EXISTS `email_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `otp_code` varchar(6) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
