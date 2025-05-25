
# Folder structure
quiz-system/
├── index.php                 # Home page
├── login.php                 # User login page
├── register.php              # User registration page
├── logout.php                # Logout and destroy session
├── quiz.php                  # Quiz interface (pulls questions from DB)
├── submit.php                # Handles quiz submission and scoring
├── result.php                # Displays result to the user
├── config.php                # Database connection and session start
├── css/
│   └── style.css             # Styling for all pages
├── admin/
│   ├── admin_login.php       # Admin login page
│   ├── dashboard.php         # Admin dashboard (home)
│   ├── edit_questions.php    # Edit existing Question (home)
│   ├── add_question.php      # Add new quiz question
│   └── view_questions.php    # View, edit, and delete questions
└── user/
    └── history.php           # Shows past quiz scores for logged-in users


## 📦 Features

### 👨‍🎓 Users
- Register and log in
- Take quizzes
- View score immediately after submission
- View quiz history

### 👩‍💼 Admin
- Log in with hardcoded credentials (can be improved)
- Add new quiz questions
- View, edit, or delete existing questions

---

## 🛠️ Installation & Setup

### 1. Install XAMPP
Download and install from [https://www.apachefriends.org](https://www.apachefriends.org)

### 2. Start Services
Open **XAMPP Control Panel** and start:
- Apache
- MySQL

### 3. Add Project to `htdocs`
Copy this folder to:
