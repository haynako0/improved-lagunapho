# **Laguna PHO MAIP Records Management System**

---

## **Project Description**

---

The Laguna PHO Medical Assistance Indigent Program (MAIP) Records Management System is a web-based platform developed to streamline the management of medical assistance records for indigent individuals in Laguna province, Philippines.

## **Features Added / Enhanced**

---

- Dark mode for comfort when using it in low-light conditions.
- A dedicated specialized analytics page to view and track patient-related information with insights.
- Chatbot assistant that helps users explore the system by providing step-by-step instructions.
- Bug fixes and improvements to backend to improve quality of life.

## **Technologies Used**

---

### **Backend Technologies**

- PHP - Modern language features and performance improvements
- MySQL - Primary data storage with InnoDB engine
- Python - Powers the chatbot logic (PyTorch).
- Flask - Serves the chatbot as a web API.

### **Frontend Technologies**
- HTML5 – Defines page structure.
- CSS3 – Styles and layouts.
- Bootstrap – Responsive UI framework.
- JavaScript – Adds interactivity.
- jQuery – Simplifies DOM and AJAX.
- Chart.js – Renders charts and graphs.

## **Installation Instructions**

---

1. Clone Repository

```bash
git clone https://github.com/haynako0/improved-lagunapho.git
```

2. Put files into respective directories.
3. Activate the virtual environment in the chatbot directory

```bash
source venv/Scripts/activate
```

4. Access the python shell and install chatbot requirements

```bash
pip install flask_cors
```

5. Open XAMPP Control Panel and start Apache and MySQL
6. In the website directory, copy the contents from the lpho_db.sql into the localhost/phpmyadmin

## **How To Use/Run the Project**
---

1. In the website directory, run the open_system batch file to ensure that the website and the chatbot runs simultaneously.
2. Open the website through localhost/lagunapho
3. Access an admin account (Email: kylekuzma1803@gmail.com Password: password) or a coordinator account (e.g. Email: santacruzcoor@gmail.com Password: password)

## **Demo Video Link**
---

https://drive.google.com/file/d/10co2rYlvByX_yo1eRmMbVYCBvYvocE3F/view?usp=sharing

## **Folder Structure Description**

---

### **chatbotproject**
| Folder                 | Description                                                                                               |
| ---------------------- | --------------------------------------------------------------------------------------------------------- |
| `.idea/`               | Project settings folder for JetBrains IDEs
| `.qodo/`               | A deployment or configuration tool .                           |
| `.venv/`    | Python virtual environment folders                                         |
| `__pycache__/`         | Stores compiled Python files for optimization.                                            |                       |
| `static/`              | Used in Flask app to hold static files                                        |
| `templates/`           | Used in Flask/Jinja2 for HTML templates.            |

| File            | Type     | Description                                                                     |
| --------------- | -------- | ------------------------------------------------------------------------------- |
| `app.py`        | Python   | The main Flask application entry point                      |
| `chat.py`       | Python   | Serves as an interface script.              |
| `data.pth`      | PTH      | PyTorch model checkpoint file (trained neural network).                         |
| `intents.json`  | JSON     | Stores predefined intents, patterns, and responses for the chatbot.             |
| `model.py`      | Python   | Defines the neural network model architecture (likely using PyTorch).           |
| `nltk_utils.py` | Python   | Helper functions for text preprocessing (tokenization, stemming, bag-of-words). |
| `nocons.vbs`    | VBScript | Launches the app silently .                    |
| `start.bat`     | Batch    | Launches the application .                |
| `train.py`      | Python   | Trains the chatbot model using `intents.json`, saves to `data.pth`.             |

---

### **lagunapho**
| Folder      | Description                                                                                              |
| ----------- | -------------------------------------------------------------------------------------------------------- |
| `assets/`   | Contains static files such as CSS, JavaScript, images, fonts, etc., used by the frontend.                |
| `data/`     | Used for storing temporary or processed data in `.json` or `.txt` formats.            |
| `db/`       | LHolds database schema files |
| `includes/` | Contains reusable PHP components such as headers, footers, or shared functions (modular approach).       |
| `login/`    | Contains scripts and UI related to user login functionality.                                             |
| `upload/`   | Stores files uploaded by users (images, documents, etc.).                                                |
| `users/`    | Contains scripts or user profile pages, also includes user-specific data or management tools.  |

| File                    | Type  | Description                                                                                   |
| ----------------------- | ----- | --------------------------------------------------------------------------------------------- |
| `.gitignore`            | Git   | Specifies files/folders Git should ignore (e.g., `vendor/`, `*.log`, `*.env`).                |
| `connection.php`        | PHP   | Handles the database connection logic (MySQLi or PDO).                                        |
| `index.php`             | PHP   | The main entry point of the website (home page or dashboard).                                 |
| `logout.php`            | PHP   | Destroys user sessions and logs the user out.                                                 |
| `open_system.bat`       | Batch | Ensures that the website and the chatbot runs simultaneously                 |
| `READ ME` / `README.md` | Text  | Contains project documentation or instructions  |


## **Contributors**

---

- **Sofer, Erl Teodemar D.** - Project Lead, Full-Stack Developer, Documentation Owner
- **Coronado, Nixon E.** - Chatbot Developer, Quality Assurance, PPT Documentation
- **Bagalso, Riana Alexis D.** - SRS Documentation
- **Alcantara, Alyssa Mae D.** - Tester
- **Ledesma, Jhon Carlo F.** - Tester
- **Orellano, Kyla V.** - Tester
