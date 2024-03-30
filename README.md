App Name: WorkFlow

Description:
The job board application is a platform designed to facilitate the job search and recruitment process. It provides distinct user roles, including administrators, job seekers, and job posters, each with specific functionalities and access levels.

Developer Skill: Advance Beginner

Backend Framework: Laravel 10

Frontend: HTML, CSS, Bootstrap, Blade ,JavaScript

User Roles:
Admin:
The administrator role has complete control over the application.
Responsibilities include managing user accounts and roles, ensuring security, and overseeing overall functionality.
Admins can view and edit user profiles and job listings.

Job Seeker:
Job seekers are individuals actively looking for job opportunities.
They can register, log in, and create user profiles.
Job seekers can browse and search for job listings.
They can submit job applications, track their status, and receive notifications.
Profile updates include adding skills, educational background, and other relevant information.

Job Poster:
Job posters represent companies or organizations looking to hire employees.
They can register, log in, and create user profiles.
Job posters can create detailed job listings, specifying job titles, descriptions, salaries, and work arrangements.
They can review and manage job applications received from job seekers.
Database Structure:

Users Table:
Stores user information, including name, email, contact number, password, and role.
Includes timestamps for user creation and updates.

Roles Table:
Defines user roles, such as admin, job seeker, and job poster.
Keeps track of role names and timestamps.

Employers Table:
Stores information about employers and their organizations.
Includes fields for company name, description, services, and timestamps.
Links to user profiles for authentication.

Jobs Table:
Contains job listings posted by employers.
Includes job titles, descriptions, salaries, work types (e.g., onsite, hybrid, WFH), and locations.
Timestamps are used to track job creation and updates.

Applications Table:
Tracks job applications submitted by job seekers.
Records the status of each application (pending, rejected, withdrawn, hired), application date, and timestamps.

JobSeekers Table:
Stores job seeker profiles, including resume information, skills, education details, and timestamps.
Links to user profiles for authentication.

Models and Relationships:

User Model (User.php):
Belongs To: Role
Has One: Employer
Has One: JobSeeker
Has Many: Posted Jobs
Has Many: Job Applications

Role Model (Role.php):
Has One: Users

Employer Model (Employer.php):
Belongs To: User
Has One: Posted Job

Job Model (Job.php):
Belongs To: Poster (User)
Belongs To: Employer
Has Many: Job Applications

Application Model (Application.php):
Belongs To: Job
Belongs To: Job Seeker (User)

JobSeeker Model (JobSeeker.php):
Belongs To: User

Key Features:

Authentication and Authorization:
Users can register and log in securely.
Role-based access control ensures that users have appropriate permissions.

Job Posting:
Job posters can create and manage detailed job listings.
Jobs are associated with the poster's user account.
Key job details are provided, such as title, description, salary, and work type.

Job Search and Application:
Job seekers can search for and view job listings.
They can apply for jobs by submitting applications.
Application statuses (e.g., pending, accepted, rejected) are tracked.

User Dashboard:
Users have personalized dashboards displaying relevant information.
Job seekers can monitor their applications and statuses.
Job posters can manage their job listings and review applications.

Notifications:
Users receive notifications regarding application updates.
Admins receive notifications related to user and role management.

User Profiles:
Users can enhance their profiles with additional details, such as skills and educational history.
Job seekers can showcase their qualifications and experiences.
