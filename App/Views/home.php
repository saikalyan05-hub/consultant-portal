<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staffing Portal - No More Solo Job Hunting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #0d6efd;
            --dark-bg: #0b0e14;
            --accent-color: #3d8bff;
        }
        body { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .navbar { background: white; border-bottom: 1px solid #eee; padding: 1rem 2rem; }
        .hero-section { padding: 80px 0; background: linear-gradient(180deg, #fff 0%, #f8f9ff 100%); text-align: center; }
        .hero-title { font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 1.5rem; }
        .hero-title span { color: var(--primary-color); }
        .hero-subtitle { font-size: 1.25rem; color: #666; max-width: 700px; margin: 0 auto 2rem; }
        .btn-hero { padding: 12px 32px; font-weight: 600; font-size: 1.1rem; border-radius: 50px; }

        .stats-section { padding: 60px 0; border-top: 1px solid #eee; }
        .stat-card { text-align: center; padding: 20px; }
        .stat-number { font-size: 2.5rem; font-weight: 700; color: #333; margin-bottom: 5px; }
        .stat-label { color: #888; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; }

        .feature-section { padding: 100px 0; background: white; }
        .feature-card { border: none; border-radius: 20px; transition: transform 0.3s ease; background: #fdfdfd; overflow: hidden; height: 100%; border: 1px solid #f0f0f0; }
        .feature-card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.05); }
        .feature-body { padding: 40px; }
        .feature-icon { font-size: 2rem; color: var(--primary-color); margin-bottom: 20px; }
        .feature-title { font-weight: 700; margin-bottom: 15px; }

        .testimonial-section { background: #f8f9ff; padding: 100px 0; }
        .testimonial-card { background: white; padding: 30px; border-radius: 15px; height: 100%; border: 1px solid #eee; }
        .quote-icon { color: var(--primary-color); font-size: 1.5rem; margin-bottom: 15px; }

        .footer { background: #0b0e14; color: #888; padding: 80px 0 40px; }
        .footer h5 { color: white; font-weight: 700; margin-bottom: 25px; }
        .footer-link { color: #888; text-decoration: none; display: block; margin-bottom: 10px; transition: color 0.2s; }
        .footer-link:hover { color: white; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">STAFFING<span class="text-primary">PORTAL</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#">AI Agent</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Resume AI</a></li>
                <li class="nav-item"><a class="nav-link" href="#">For Employers</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About Us</a></li>
            </ul>
            <div class="d-flex gap-2">
                <a href="/auth/login" class="btn btn-outline-primary px-4 rounded-pill">Sign In</a>
                <a href="#" class="btn btn-primary px-4 rounded-pill">Join Now</a>
            </div>
        </div>
    </div>
</nav>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">No More Solo Job Hunting<br>Do it with <span>AI</span></h1>
        <p class="hero-subtitle">Get matched jobs, autofill applications, tailored resume, and recommended insider connections in less than 1 min!</p>
        <div class="d-flex justify-content-center gap-3">
            <button class="btn btn-primary btn-hero">Try For Free</button>
        </div>
    </div>
</section>

<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-6 stat-card">
                <div class="stat-number">1,250,000</div>
                <div class="stat-label">Trusted Users</div>
            </div>
            <div class="col-md-3 col-6 stat-card">
                <div class="stat-number">3x</div>
                <div class="stat-label">Interviews Landed</div>
            </div>
            <div class="col-md-3 col-6 stat-card">
                <div class="stat-number">80%</div>
                <div class="stat-label">Time Saved</div>
            </div>
            <div class="col-md-3 col-6 stat-card">
                <div class="stat-number">No. 1</div>
                <div class="stat-label">Choice</div>
            </div>
        </div>
    </div>
</section>

<section class="feature-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">No.1 AI Job Hunting Platform</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-body">
                        <i class="bi bi-bullseye feature-icon"></i>
                        <h4 class="feature-title">Personalized AI Job Matches</h4>
                        <p class="text-muted">See jobs you’re truly qualified for, matched to your real skills, with no fake listings and early alerts.</p>
                        <a href="#" class="btn btn-outline-primary rounded-pill mt-3">Find My Matches</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-body">
                        <i class="bi bi-cursor-fill feature-icon"></i>
                        <h4 class="feature-title">1-Click Application Autofill</h4>
                        <p class="text-muted">Apply to hundreds of jobs daily across all major ATS platforms. Skip repetitive data entry.</p>
                        <a href="#" class="btn btn-outline-primary rounded-pill mt-3">Start Autofilling</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-body">
                        <i class="bi bi-file-earmark-person feature-icon"></i>
                        <h4 class="feature-title">Job Specific Tailored Resume</h4>
                        <p class="text-muted">Get a perfectly tailored, professional resume that passes ATS and highlights your strengths.</p>
                        <a href="#" class="btn btn-outline-primary rounded-pill mt-3">Upgrade My Resume</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="testimonial-section">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">1,250,000+ Happy Users</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="mb-4">"I am able to find more relevant jobs faster, since using Staffing Portal I have tripled my interview rate."</p>
                    <div class="d-flex align-items-center">
                        <div class="ms-0">
                            <h6 class="mb-0 fw-bold">Fred H.</h6>
                            <small class="text-muted">Senior Software Engineer</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="mb-4">"Thanks to this platform I’ve landed a few interviews and accepted an offer within 1 week of interviewing!!"</p>
                    <div class="d-flex align-items-center">
                        <div class="ms-0">
                            <h6 class="mb-0 fw-bold">Tracy C.</h6>
                            <small class="text-muted">Sr. Digital Marketing Manager</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <i class="bi bi-quote quote-icon"></i>
                    <p class="mb-4">"You must check out Staffing Portal. It has been saving me hours in my job search! I’m blown away."</p>
                    <div class="d-flex align-items-center">
                        <div class="ms-0">
                            <h6 class="mb-0 fw-bold">Tyler S.</h6>
                            <small class="text-muted">Instructional Designer</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Frequently Asked Questions</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                How is Staffing Portal different from other job platforms?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Our AI-driven platform doesn't just list jobs; it matches you based on deep skill analysis and automates the tedious parts of the application process.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item border-bottom">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Is my personal information secure?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Yes, we use AES-256 encryption and strict access controls to ensure your data and documents are only visible to authorized recruiters and managers.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h4 class="text-white fw-bold mb-4">STAFFING<span class="text-primary">PORTAL</span></h4>
                <p>Modernizing the job search with AI-driven matches and streamlined applications.</p>
                <div class="d-flex gap-3 fs-4 mt-4">
                    <i class="bi bi-linkedin"></i>
                    <i class="bi bi-twitter"></i>
                    <i class="bi bi-instagram"></i>
                    <i class="bi bi-facebook"></i>
                </div>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Features</h5>
                <a href="#" class="footer-link">Resume AI</a>
                <a href="#" class="footer-link">AI Job Match</a>
                <a href="#" class="footer-link">Job Autofill</a>
            </div>
            <div class="col-md-2 mb-4">
                <h5>Related Tools</h5>
                <a href="#" class="footer-link">Cover Letter Gen</a>
                <a href="#" class="footer-link">Job Tracker</a>
                <a href="#" class="footer-link">AI Resume Helper</a>
            </div>
            <div class="col-md-4 mb-4 text-md-end">
                <h5>Join our newsletter</h5>
                <div class="input-group mb-3 rounded-pill overflow-hidden border-0">
                    <input type="text" class="form-control border-0 px-4" placeholder="Email address">
                    <button class="btn btn-primary px-4" type="button">Join</button>
                </div>
            </div>
        </div>
        <hr class="mt-5 border-secondary">
        <div class="text-center mt-4">
            <small>© 2024 Staffing Portal. All rights reserved.</small>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
