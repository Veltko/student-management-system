# Student Management System using PHP

## Overview

The Student Management System is a web application built using PHP and MySQL for database connectivity. It is hosted on Apache XAMPP servers. This system provides functionalities for managing student records and user authentication.

## Features

### Login Page

The login page includes fields for username, password, and an option for password recovery. Upon successful login, a session is created.

![Login Page](https://imgur.com/07CUUQM.png "Login Page")

### Dashboard

The dashboard displays all student records with options to delete and edit each record. Pagination is implemented for ease of navigation. From the dashboard, users can navigate to add records, manage users, and log out.

![Dashboard](https://imgur.com/AmW7Q3D.png "Dashboard")

### Edit Student

Users can edit student information directly, and the changes are saved in the MySQL database.

![Edit Student](https://imgur.com/Aucd5EB.png)

### Add Record

Users can add new student records, and the information is automatically updated in the MySQL database.

![Add Record](https://imgur.com/i5XBut0.png)

### Manage Users

Accessible only to admins, this section displays a list of users/admins who can access the management website.

![Manage Users](https://imgur.com/qbCKDFw.png)

### Logout

The logout option terminates the session, redirecting users back to the login page.

## Installation

To set up the project locally, follow these steps:

1. Clone this repository:
```git clone https://github.com/abhie7/student-management-system.git```
2. Set up XAMPP or a similar environment to host the PHP files and MySQL database.
3. Import the database schema provided in the repository into your MySQL database.

## Contribution Guidelines

If you wish to contribute to this project, follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/add-new-feature`).
3. Make your changes and commit them (`git commit -am 'Add new feature'`).
4. Push to the branch (`git push origin feature/add-new-feature`).
5. Create a pull request.

## License

This project is licensed under the [MIT License](LICENSE).

## Contact

For inquiries or feedback, please [email me](mailto:abhirajchaudhuri@gmail.com).
