create table Employee (
	id INT AUTO_INCREMENT PRIMARY KEY,
	hr_first_name VARCHAR(255),
	hr_last_name VARCHAR(255),
	hr_email VARCHAR(255),
	password TEXT
);
INSERT INTO Employee (id, hr_first_name, hr_last_name, hr_email, password)
VALUES
  ('1', 'John', 'Doe', 'johndoe@example.com', 'hashed_password1'),
  ('2', 'Jane', 'Smith', 'janesmith@example.com', 'hashed_password2'),
  ('3', 'Michael', 'Johnson', 'michaeljohnson@example.com', 'hashed_password3'),
  ('4', 'Emily', 'Davis', 'emilydavis@example.com', 'hashed_password4'),
  ('5', 'David', 'Miller', 'davidmiller@example.com', 'hashed_password5');

create table Applicant (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	address VARCHAR(255),
	education VARCHAR(255),
	expertise VARCHAR(255),
	experience VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO Applicant (id, first_name, last_name, email, gender, address, education, expertise, experience, date_added)
VALUES
  ('1', 'John', 'Doe', 'johndoe@example.com', 'Male', '123 Main St, Anytown, CA', 'Bachelor of Science in Computer Science', 'Web Development, Python', '5 years', '2023-11-22'),
  ('2', 'Jane', 'Smith', 'janesmith@example.com', 'Female', '456 Oak St, Anytown, CA', 'Master of Business Administration', 'Project Management, Data Analysis', '3 years', '2023-12-01'),
  ('3', 'Michael', 'Johnson', 'michaeljohnson@example.com', 'Male', '789 Elm St, Anytown, CA', 'Associates Degree in Information Technology', 'Network Administration, Cybersecurity', '2 years', '2023-11-15'),
  ('4', 'Emily', 'Davis', 'emilydavis@example.com', 'Female', '101 Pine St, Anytown, CA', 'Bachelor of Arts in English', 'Technical Writing, Content Creation', '1 year', '2023-12-05'),
  ('5', 'David', 'Miller', 'davidmiller@example.com', 'Male', '202 Cedar St, Anytown, CA', 'High School Diploma', 'Customer Service, Sales', '0 years', '2023-11-28');


ALTER TABLE Applicant ADD COLUMN status ENUM('pending', 'accepted', 'rejected') DEFAULT 'pending';



ALTER TABLE Applicant ADD COLUMN accepted_by VARCHAR(255) AFTER experience;

