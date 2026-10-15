# Grinds Booking Admin System

**Author:** Isabelle Lynch
**Module:** Server-Side Web Development (2026)

An admin portal for a grinds (tuition) school, built with PHP and MySQL. Staff sign in to manage tutors, students and subjects, build a weekly class timetable for each room and semester, and book students into classes. The dashboard shows revenue and booking figures.

---

## Features

| Page | What it does |
|------|-------------|
| **Login** | Email and password sign-in for admin staff (passwords stored with `password_hash`) |
| **Dashboard** | This year's revenue compared with last year, bookings this year, active tutor and student counts, and the timetable. Click a class to book a student; **+ New Staff Member** adds another admin. |
| **Tutors** | Searchable table. Add, edit and remove tutors, each with a subject and a pay rate (SNR / JNR / NEW); click a tutor's status to switch it between Active and Inactive. |
| **Students** | Searchable table. Add, edit and remove students, and switch them between Active and Inactive. |
| **Schedule** | Weekly timetable (Monday to Friday, 9:00–17:00) per room and semester, moved through with the arrow buttons. Click a class to book a student, or **+ New Class** to add one. |
| **Subjects** | Searchable list of subjects showing how many tutors teach each. Add new subjects or remove unused ones. |

**Rules the system enforces**
- **Students and bookings:**
  - A class can't take more students than its room holds.
  - A student can't book the same class twice.
  - Inactive students can't be booked.
- **Timetable:**
  - A room or a tutor can't have two classes at the same time.
  - A class's tutor must teach the chosen subject.
- **Add Class form:** choosing a subject lists only its tutors, choosing a room lists only days with free slots, and choosing a day lists only free times.
- **Removing records:**
  - A tutor who has classes on the schedule can't be deleted; set them to Inactive instead.
  - A subject that tutors teach can't be deleted.
- **Validation:**
  - Names may contain letters (including fadas), spaces, apostrophes and dashes, so Seán, Siobhán and O'Brien are all accepted.
  - Emails must be valid and unique.
  - Phone numbers must contain 9–15 digits.
  - Admin passwords need 8+ characters with upper and lower case, a number and a symbol.

---

## Setup

### Requirements
- PHP 8.0 or later (8.1+ recommended), with the `pdo_mysql` extension
- MySQL or MariaDB
- The easiest option is **XAMPP**, which includes all of these. MAMP, WAMP or Laragon work too.

### 1. Get the code into your web folder
Copy the project folder into XAMPP's `htdocs` folder, e.g. `C:\xampp\htdocs\ServerSide-Project-2026`. Any folder name works.

### 2. Create the database
1. Start **Apache** and **MySQL** from the XAMPP control panel.
2. Open <http://localhost/phpmyadmin>, go to the **Import** tab, choose `database/grindbookingsys.sql` and click **Import**.

Or from a terminal:
```bash
mysql -u root -p < database/grindbookingsys.sql
```

This creates the `grindbookingsys` database with all tables and sample data. **Importing it again resets the database**, which is handy for testing but deletes any changes.

### 3. Check the connection settings
The defaults suit XAMPP (user `root`, no password). If your MySQL is set up differently, edit the constants at the top of `database-interactions/make-connection.php`:

```php
const DB_HOST = 'localhost';
const DB_NAME = 'grindbookingsys';
const DB_USER = 'root';
const DB_PASS = '';
```

### 4. Sign in
Open <http://localhost/ServerSide-Project-2026/Login.php>, using your own folder name, and sign in with the sample admin account:

| Email | Password |
|-------|----------|
| `admin@grindsschool.ie` | `Admin123!` |

Change this password, or add your own admin from the Dashboard, before putting the site anywhere public.

**Without XAMPP:** run `php -S localhost:8000` from the project folder (MySQL still needs to be running), then open <http://localhost:8000/Login.php>.

---

## Sample data

| Table | Contents |
|-------|----------|
| Tutors | 6 tutors (one Inactive) across Maths, English, Irish, Science, Accounting and History |
| Students | 13 students (one Inactive) |
| Subjects | 9 subjects |
| Rooms | Room 1 (20 seats), Room 2 (12), Room 3 (6) |
| Classes | 8 in the current semester, plus some in the previous and next semesters |
| Bookings | This year's and last year's, so the dashboard has figures to compare. The Friday class in Room 3 is full, to show the capacity check. |

Sample classes are dated from the day the script is imported, so the **Current** semester always has classes in it.

---

## Database

| Table | Key columns |
|-------|-------------|
| `Admin` | AdminID, FirstName, Surname, Email (unique), Password (hash) |
| `TutorRates` | RateCode (SNR/JNR/NEW), HourlyRate, Description |
| `Subjects` | SubjectCode (3 letters), Description |
| `Tutors` | TutorID, FirstName, Surname, Email, PhoneNo, RateCode → TutorRates, SubjectCode → Subjects, Status (A/I) |
| `Students` | StudentID, FirstName, Surname, Email, PhoneNo, Status (A/I) |
| `Rooms` | RoomNo (1, 2, 3…), Description, Capacity |
| `Classes` | ClassID, TutorID → Tutors, Day (1 = Mon … 5 = Fri), Time (start hour 9–17), RoomNo → Rooms, SemesterNo, CurrentEnrollment |
| `Bookings` | BookingID, StudentID → Students, ClassID → Classes, BookingDate |

**Semester numbers** are the two-digit year followed by 1 (January–June) or 2 (July–December); for example, 262 is the second half of 2026. Revenue is the tutor's hourly rate for each booking.

---

## Project structure

```
├── Login.php                    Sign-in page
├── start-up.php                 Runs first on every page: session, login check, form handlers, page titles
├── Login/                       Login handling and sign-out
├── Dashboard/, Tutors/, Students/, Schedule/, Subjects/
│                                One folder per page
├── basic-page-layout/           Top bar, side navigation and layout.php (which includes both, plus the pop-up form)
├── forms/
│   ├── form-body/               The fields for each pop-up form
│   ├── form-handlers/           The PHP that validates and saves each form
│   ├── generate-form.php        The pop-up form container and messages
│   └── form-filtering.php       Returns dropdown options for the Add Class form (called by JavaScript)
├── database-interactions/       All database queries, one file per table; make-connection.php holds the settings
├── include-for-functions/       Validation and day-name helpers
├── student-tutor-table/         The shared table used on the Tutors and Students pages
├── Schedule/                    Timetable generation and semester logic
├── JavaScript/                  Opening and closing forms, the table search, and the Add Class dropdowns
├── CSS/                         All styles; colours are set as variables at the top
└── database/grindbookingsys.sql Creates the database with sample data
```

**How a form save works:**
1. The JavaScript opens the pop-up and records which form it is (`activeForm`).
2. On submit, `start-up.php` runs the page's form handlers before any HTML is sent.
3. Each handler validates the input, saves it, and redirects back with a success or error message.
4. On an error, the form reopens with the user's values kept, apart from the invalid field.

---

## Known limitations

- **Bookings can't be cancelled from the interface.** Removing a student deletes their bookings, and so also removes them from the revenue figures.
- **Forms have no CSRF tokens**, and the Active/Inactive switch is a plain link (a GET request). That's fine for coursework on a local server, but both should be protected before the site goes online.
- The "Forgot password?" and "Contact your administrator" links on the login page are placeholders.
- Refreshing the Schedule page right after using the room or semester arrows repeats the move.
- The action icons load Font Awesome from a CDN, so they need an internet connection.

---
