# Technical Documentation
## Laguna Provincial Health Office: Record Management System

### Version: 1.0
### Date: 2025
### Technical Team and Document Owner: Erl Teodemar D. Sofer

---

## 1. System Overview and Architecture

### 1.1 System Architecture
The Laguna PHO Record Management System follows a traditional three-layered web application architecture:

**Presentation Layer:**
- Responsive UI built with HTML5, CSS3, and JavaScript
- Bootstrap-based design for uniform look and feel
- User-role dependent navigation system

**Application Layer:**
- PHP-based backend with procedural logic
- Flask and Python-based chatbot integration
- Flask-CORS for chatbot-website communication

**Data Layer:**
- MySQL database for storing patient and medical assistance records
- Basic indexing for performance

### 1.2 Technology Stack

**Frontend Technologies:**
- HTML5 for structure
- CSS3 with Bootstrap for styling
- JavaScript for interactivity

**Backend Technologies:**
- PHP
- Python with Flask for chatbot
- Flask-CORS for cross-origin requests

**Database:**
- MySQL
- Structured schema for patient and aid tracking

**Development Tools:**
- XAMPP local server environment
- Apache 2.4.58 for testing

---

## 2. Summary of Enhancements and Rationale

### 2.1 System Feature Additions

**User Interface Enhancements:**
- Added toggleable Dark Mode UI
- Introduced persistent utility button across pages
- Integrated FAQ-based chatbot using Flask

### 2.2 Performance Optimizations

**Database Improvements:**
- Indexed key patient and transaction fields
- Optimized query performance through structure normalization

**Load Handling:**
- Verified stable concurrent access using ApacheBench
- Achieved 329 requests/sec under 10 concurrent connections

---

## 3. Updated UI/UX Improvements

**Interface Adjustments:**
- Dark mode toggle added for visual comfort
- Welcome screen and navigation optimized for clarity

---

## 4. Testing Approach and Results

### 4.1 Testing Strategy

**Tools Used:**
- ApacheBench for load testing
- Core Web Vitals (LCP, CLS, INP) via browser inspection

**Test Methodology:**
1. Load Testing – Server concurrency and request handling
2. Web Vitals – User experience metrics validation

### 4.2 Test Results Summary

**ApacheBench Load Test:**
- Total Requests: 100
- Concurrency Level: 10
- Requests per Second: 329.04
- Avg Time per Request: 30.39 ms
- Transfer Rate: 1755.42 KB/sec
- Failed Requests: 0

**Core Web Vitals:**
- LCP: 1.66 s (Good)
- CLS: 0.01 (Good)
- INP: 16 ms (Good)
- LCP Element: `p.welcome-text`
- INP Trigger: Keyboard interaction

### 4.3 Test Environment Configuration

**Environment:**
- Localhost via XAMPP stack
- Apache 2.4.58
- PHP 8.x
- MySQL 8.x

---

## 5. Technologies and Frameworks Used

### 5.1 Core Technologies

**Frontend Stack:**
- HTML5 / CSS3 / Bootstrap
- JavaScript (no Node.js used)

**Backend:**
- PHP 8.x
- Python with Flask (for chatbot)
- Flask-CORS (for frontend-bot communication)

**Database Technology:**
- MySQL (standard engine)

### 5.2 Development Tools and Practices

**Local Server:**
- XAMPP stack

**Testing Tools:**
- ApacheBench for performance
- Chrome DevTools for Web Vitals

---

## 6. Developer Notes / Installation Instructions

### 6.1 System Requirements

**Minimum Server Specs:**
- CPU: 2 cores @ 2.4 GHz
- RAM: 4 GB (8 GB recommended)
- Storage: Minimum 10 GB

**Software Dependencies:**
```bash
PHP >= 8.2.12
MySQL >= 8.2.12
Apache >= 2.4.58
Python >= 3.13.3
Flask >= 3.1.1
flask-cors >= 6.0.0
```

### 6.2 Installation Process

```bash
# Clone or copy project files to htdocs directory
cd /xampp/htdocs/
# Place PHP and Python source files accordingly
# Start Apache and MySQL services via XAMPP
```

### 6.3 Chatbot Setup

```bash
# Navigate to chatbot directory
cd chatbot/
# Install Flask and CORS
pip install flask flask-cors
# Run chatbot
python app.py
```

---

## 7. Conclusion

The Laguna PHO Record Management System is a customized solution designed to streamline the management of medical assistance records. It introduces key user experience improvements such as Dark Mode and a chatbot, while also demonstrating acceptable performance and stability under concurrent access. While some modern development practices were not employed (e.g., Composer, PSR standards, PHPUnit), the system remains a functional and responsive tool for its intended use.

---

**Document Maintenance:**

- **Last Updated**: May 31, 2025  
- **Next Review**: N/A  
- **Document Owner**: Erl Teodemar D. Sofer  
- **Approval Status**: In Use
