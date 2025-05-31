<?php
include "header.php";
include "sidebar.php";
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>

  <section class="section dashboard">
    <div class="row">
      <div class="col-12">
        <div class="card welcome-card mb-4">
          <div class="card-body welcome-body">
            <div class="welcome-content">
              <div class="icon-circle primary-circle">
                <i class="bi bi-heart-pulse-fill display-4"></i>
              </div>
              <h2 class="welcome-title">Laguna Provincial Health Office</h2>
              <h3 class="welcome-subtitle">Record Management System</h3>
              <p class="welcome-text">
                Welcome to our new improved and streamlined system designed to unify and simplify health record management across the Province of Laguna.
              </p>
            </div>
          </div>
        </div>

        <div class="card mb-4">
          <div class="card-header">
            <h3 class="card-title">New System Integrations</h3>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <div class="col-md-4">
                <div class="feature-box">
                  <div class="feature-icon primary-bg-circle">
                    <i class="bi bi-moon-stars-fill fs-2"></i>
                  </div>
                  <h4 class="feature-title">Dark Mode</h4>
                  <p class="feature-text">
                    Reduce eye strain with an elegant dark palette for extended usage.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="feature-box">
                  <div class="feature-icon success-bg-circle">
                    <i class="bi bi-robot fs-2"></i>
                  </div>
                  <h4 class="feature-title">AI Assistant</h4>
                  <p class="feature-text">
                    Get instant help from our intelligent chatbot for features and docs.
                  </p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="feature-box">
                  <div class="feature-icon info-bg-circle">
                    <i class="bi bi-bar-chart-line-fill fs-2"></i>
                  </div>
                  <h4 class="feature-title">Advanced Analytics</h4>
                  <p class="feature-text">
                    Interactive data insights and visual tools for informed decisions.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card team-card mb-4">
          <div class="card-header">
            <h3 class="card-title text-center">Development Team</h3>
          </div>
          <div class="card-body">
            <div class="row g-4">
              <div class="col-sm-6 col-md-6">
                <div class="team-member-card">
                  <div class="member-icon primary-bg">
                    <i class="bi bi-person-badge-fill fs-3"></i>
                  </div>
                  <div class="member-info">
                    <h5 class="member-name">Erl Teodemar D. Sofer</h5>
                    <div class="member-badges">
                      <span class="badge badge-role bg-primary">Project Lead</span>
                      <span class="badge badge-role bg-danger">Full-stack Developer</span>
                      <span class="badge badge-role bg-info">Documentation Owner</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-md-6">
                <div class="team-member-card">
                  <div class="member-icon success-bg">
                    <i class="bi bi-robot fs-3"></i>
                  </div>
                  <div class="member-info">
                    <h5 class="member-name">Nixon E. Coronado</h5>
                    <div class="member-badges">
                      <span class="badge badge-role bg-success">Chatbot Developer</span>
                      <span class="badge badge-role bg-warning text-dark">Quality Assurance</span>
                      <span class="badge badge-role bg-info">PPT Documentation</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-md-6">
                <div class="team-member-card">
                  <div class="member-icon info-bg">
                    <i class="bi bi-file-earmark-text-fill fs-3"></i>
                  </div>
                  <div class="member-info">
                    <h5 class="member-name">Riana Alexis C. Bagalso</h5>
                    <div class="member-badges">
                      <span class="badge badge-role bg-info">SRS Documentation</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-6 col-md-6">
                <div class="team-member-card">
                  <div class="member-icon warning-bg">
                    <i class="bi bi-bug-fill fs-3"></i>
                  </div>
                  <div class="member-info">
                    <h5 class="member-name">Testing Team</h5>
                    <div class="member-badges">
                      <span class="badge badge-role bg-secondary">Tester</span>
                    </div>
                    <div class="tester-list">
                      <p class="tester-item"><strong>Jhon Carlo F. Ledesma</strong></p>
                      <p class="tester-item"><strong>Kyla V. Orellano</strong></p>
                      <p class="tester-item"><strong>Alyssa Mae D. Alcantara</strong></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<style>
  :root {
    --transition-speed: 0.3s;
    --bg-color: #f8f9fc;
    --card-bg: #ffffff;
    --text-color: #2f2f2f;
    --subtext-color: #6c757d;
    --border-color: #e5e7eb;
    --primary-color: #4f46e5;
    --primary-bg-light: rgba(79, 70, 229, 0.1);
    --success-color: #10b981;
    --success-bg-light: rgba(16, 185, 129, 0.1);
    --info-color: #3b82f6;
    --info-bg-light: rgba(59, 130, 246, 0.1);
    --warning-color: #f59e0b;
    --warning-bg-light: rgba(245, 158, 11, 0.1);
    --border-radius: 1rem;
    --box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
  }

  .dark-mode {
    --bg-color: #181a1b;
    --card-bg: #242526;
    --text-color: #e4e6eb;
    --subtext-color: #b0b3b8;
    --border-color: #3a3b3c;
  }

  body {
    background-color: var(--bg-color);
    color: var(--text-color);
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    transition: background-color var(--transition-speed), color var(--transition-speed);
  }

  .pagetitle {
    margin-bottom: 2rem;
  }

  .pagetitle h1 {
    font-size: 1.75rem;
    margin-bottom: 0.5rem;
  }

  .breadcrumb .breadcrumb-item + .breadcrumb-item::before {
    color: var(--subtext-color);
  }

  .breadcrumb a {
    color: var(--subtext-color);
  }

  .breadcrumb .breadcrumb-item.active {
    color: var(--text-color);
  }

  .card {
    background: var(--card-bg);
    border: none;
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    transition: background var(--transition-speed), box-shadow var(--transition-speed);
    overflow: hidden;
  }

  .card + .card {
    margin-top: 1.5rem;
  }

  .card-header {
    padding: 1rem 1.5rem;
    background-color: var(--primary-bg-light);
    border-bottom: 1px solid var(--border-color);
    transition: background-color var(--transition-speed), border-color var(--transition-speed);
  }

  .dark-mode .card-header {
    background-color: var(--border-color);
  }

  .card-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-color);
    text-align: center;
  }

  .card-body {
    padding: 1.5rem;
  }

  .welcome-card {
    margin-bottom: 2rem;
  }

  .welcome-body {
    padding: 3rem;
    background: linear-gradient(135deg, var(--bg-color), rgba(238, 242, 255, 0.6));
    text-align: center;
    transition: background var(--transition-speed);
  }

  .welcome-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
  }

  .icon-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .primary-circle {
    background-color: var(--primary-bg-light);
    color: var(--primary-color);
  }

  .welcome-title {
    font-size: 2.25rem;
    font-weight: 700;
    margin: 0;
  }

  .welcome-subtitle {
    font-size: 1.5rem;
    color: var(--primary-color);
    margin: 0;
  }

  .welcome-text {
    font-size: 1rem;
    color: var(--subtext-color);
    max-width: 700px;
    margin: 0 auto;
  }

  .features-card {
    border-left: 4px solid var(--primary-color);
    margin-bottom: 2rem;
  }

  .feature-box {
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 1.5rem;
    text-align: center;
    transition: background var(--transition-speed), box-shadow var(--transition-speed);
    height: 100%;
  }

  .feature-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
  }

  .primary-bg-circle {
    background-color: var(--primary-bg-light);
    color: var(--primary-color);
  }

  .success-bg-circle {
    background-color: var(--success-bg-light);
    color: var(--success-color);
  }

  .info-bg-circle {
    background-color: var(--info-bg-light);
    color: var(--info-color);
  }

  .feature-title {
    margin: 0.5rem 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
  }

  .feature-text {
    margin: 0;
    font-size: 0.875rem;
    color: var(--subtext-color);
  }

  .team-card {
    margin-bottom: 2rem;
  }

  .team-member-card {
    display: flex;
    background: var(--card-bg);
    border-radius: var(--border-radius);
    box-shadow: var(--box-shadow);
    padding: 1.5rem;
    gap: 1rem;
    transition: background var(--transition-speed), box-shadow var(--transition-speed);
    height: 100%;
  }

  .member-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .primary-bg {
    background-color: var(--primary-bg-light);
    color: var(--primary-color);
  }

  .success-bg {
    background-color: var(--success-bg-light);
    color: var(--success-color);
  }

  .info-bg {
    background-color: var(--info-bg-light);
    color: var(--info-color);
  }

  .warning-bg {
    background-color: var(--warning-bg-light);
    color: var(--warning-color);
  }

  .member-info {
    flex: 1;
  }

  .member-name {
    margin: 0 0 0.25rem;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-color);
  }

  .member-badges {
    margin-bottom: 0.5rem;
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }

  .badge-role {
    font-size: 0.75rem;
    padding: 0.4rem 0.8rem;
    border-radius: 0.5rem;
    background-color: var(--border-color);
    color: var(--text-color);
  }

  .tester-list {
    font-size: 0.875rem;
    color: var(--subtext-color);
    margin-top: 0.5rem;
  }

  .tester-item {
    margin: 0.25rem 0;
  }

  @media (max-width: 767px) {
    .welcome-body {
      padding: 2rem;
    }

    .member-icon,
    .feature-icon {
      width: 60px;
      height: 60px;
    }
  }
</style>

<?php
include "footer.php";
?>
