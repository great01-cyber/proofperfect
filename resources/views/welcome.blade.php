<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ProofPerfect — Free Student Proofreading by Ujah John</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  :root {
    --ink: #1a1208;
    --cream: #faf6ee;
    --gold: #c9952a;
    --gold-light: #f0d898;
    --rust: #b84c2a;
    --sage: #4a6741;
    --paper: #f2ead8;
  }
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }
  body { font-family: 'DM Sans', sans-serif; background: var(--cream); color: var(--ink); overflow-x: hidden; }
  body::before {
    content: ''; position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none; z-index: 999; opacity: 0.5;
  }
  header { display: flex; justify-content: space-between; align-items: center; padding: 1.4rem 5%; border-bottom: 1px solid rgba(201,149,42,0.3); background: var(--cream); position: sticky; top: 0; z-index: 100; backdrop-filter: blur(8px); }
  .logo { font-family: 'Playfair Display', serif; font-size: 1.5rem; font-weight: 900; color: var(--ink); letter-spacing: -0.02em; }
  .logo span { color: var(--gold); }
  nav a { text-decoration: none; color: var(--ink); font-size: 0.88rem; font-weight: 500; margin-left: 2rem; letter-spacing: 0.03em; transition: color 0.2s; }
  nav a:hover { color: var(--gold); }
  .hero { min-height: 92vh; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; padding: 4rem 5% 3rem; position: relative; overflow: hidden; }
  .hero::before { content: ''; position: absolute; width: 700px; height: 700px; border-radius: 50%; background: radial-gradient(circle, rgba(201,149,42,0.12) 0%, transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); pointer-events: none; }
  .hero-tag { display: inline-block; background: var(--gold); color: white; font-size: 0.72rem; font-weight: 500; letter-spacing: 0.15em; text-transform: uppercase; padding: 0.35rem 1rem; border-radius: 2px; margin-bottom: 1.8rem; animation: fadeUp 0.6s ease both; }
  .hero h1 { font-family: 'Playfair Display', serif; font-size: clamp(2.8rem, 6vw, 5.5rem); font-weight: 900; line-height: 1.05; letter-spacing: -0.02em; max-width: 900px; animation: fadeUp 0.7s 0.1s ease both; }
  .hero h1 em { font-style: italic; color: var(--gold); }
  .author-banner { margin: 2.2rem 0 1.2rem; animation: fadeUp 0.7s 0.2s ease both; }
  .author-banner p { font-size: 0.8rem; letter-spacing: 0.12em; text-transform: uppercase; color: #888; margin-bottom: 0.4rem; }
  .author-name { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3.2rem); font-weight: 700; color: var(--ink); letter-spacing: 0.04em; position: relative; display: inline-block; }
  .author-name::after { content: ''; position: absolute; bottom: -6px; left: 0; right: 0; height: 3px; background: linear-gradient(90deg, var(--gold), var(--rust)); border-radius: 2px; }
  .hero-sub { font-size: 1.05rem; color: #666; max-width: 560px; line-height: 1.7; margin: 1.8rem auto 2.5rem; font-weight: 300; animation: fadeUp 0.7s 0.3s ease both; }
  .hero-cta { animation: fadeUp 0.7s 0.4s ease both; }
  .btn-primary { display: inline-block; background: var(--ink); color: var(--cream); padding: 1rem 2.5rem; font-size: 0.9rem; font-weight: 500; letter-spacing: 0.04em; text-decoration: none; border: none; cursor: pointer; transition: background 0.25s, transform 0.2s; font-family: 'DM Sans', sans-serif; }
  .btn-primary:hover { background: var(--gold); transform: translateY(-2px); }
  .btn-outline { display: inline-block; border: 1.5px solid var(--ink); color: var(--ink); padding: 1rem 2.5rem; font-size: 0.9rem; font-weight: 500; letter-spacing: 0.04em; text-decoration: none; background: transparent; cursor: pointer; margin-left: 1rem; transition: all 0.25s; font-family: 'DM Sans', sans-serif; }
  .btn-outline:hover { background: var(--ink); color: var(--cream); }
  .divider { width: 60px; height: 2px; background: var(--gold); margin: 0 auto 2rem; }
  .section-header { text-align: center; margin-bottom: 4rem; }
  .section-header h2 { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; letter-spacing: -0.02em; margin-bottom: 1rem; }
  .section-header p { color: #666; max-width: 560px; margin: 0 auto; line-height: 1.7; font-weight: 300; }
  .about { padding: 6rem 5%; background: var(--paper); }
  .about-inner { max-width: 960px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start; }
  .about-text h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 700; margin-bottom: 1.2rem; line-height: 1.2; }
  .about-text h2 em { font-style: italic; color: var(--gold); }
  .about-text p { font-size: 0.95rem; color: #555; line-height: 1.8; font-weight: 300; margin-bottom: 1rem; }
  .mission-box { border-left: 3px solid var(--gold); padding: 1rem 1.4rem; background: var(--cream); margin: 1.5rem 0; font-size: 0.95rem; line-height: 1.7; color: var(--ink); font-style: italic; font-family: 'Playfair Display', serif; }
  .credentials { display: flex; flex-direction: column; gap: 1.2rem; }
  .cred-item { background: var(--cream); border: 1px solid rgba(201,149,42,0.2); padding: 1.4rem 1.6rem; position: relative; overflow: hidden; transition: box-shadow 0.2s; }
  .cred-item:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.06); }
  .cred-item::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: linear-gradient(180deg, var(--gold), var(--rust)); }
  .cred-icon { font-size: 1.4rem; margin-bottom: 0.5rem; }
  .cred-item h4 { font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 700; margin-bottom: 0.25rem; }
  .cred-item p { font-size: 0.82rem; color: #777; line-height: 1.5; font-weight: 300; }
  .services { padding: 6rem 5%; }
  .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; max-width: 1100px; margin: 0 auto; }
  .card { background: var(--paper); border: 1px solid rgba(201,149,42,0.2); padding: 2.5rem 2rem; position: relative; transition: transform 0.25s, box-shadow 0.25s; overflow: hidden; }
  .card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 3px; background: linear-gradient(90deg, var(--gold), var(--rust)); transform: scaleX(0); transform-origin: left; transition: transform 0.3s; }
  .card:hover { transform: translateY(-5px); box-shadow: 0 20px 60px rgba(0,0,0,0.08); }
  .card:hover::before { transform: scaleX(1); }
  .card-icon { font-size: 2rem; margin-bottom: 1.2rem; }
  .card h3 { font-family: 'Playfair Display', serif; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.8rem; }
  .card p { font-size: 0.88rem; color: #666; line-height: 1.7; font-weight: 300; }
  .how-it-works { background: var(--ink); color: var(--cream); padding: 6rem 5%; text-align: center; }
  .how-it-works h2 { font-family: 'Playfair Display', serif; font-size: clamp(2rem, 4vw, 3rem); margin-bottom: 0.8rem; color: var(--gold-light); }
  .how-it-works > p { color: #aaa; max-width: 500px; margin: 0 auto 4rem; font-weight: 300; }
  .steps { display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap; max-width: 1000px; margin: 0 auto; }
  .step { flex: 1; min-width: 150px; max-width: 190px; }
  .step-num { width: 56px; height: 56px; border-radius: 50%; border: 2px solid var(--gold); display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: var(--gold); margin: 0 auto 1.2rem; }
  .step h4 { font-family: 'Playfair Display', serif; font-size: 1rem; margin-bottom: 0.5rem; color: var(--cream); }
  .step p { font-size: 0.82rem; color: #888; line-height: 1.6; font-weight: 300; }
  .confidentiality { background: linear-gradient(135deg, #1a3a2a 0%, #2a4a1a 100%); color: var(--cream); padding: 5rem 5%; text-align: center; }
  .conf-inner { max-width: 760px; margin: 0 auto; }
  .conf-badge { display: inline-block; border: 1.5px solid rgba(144,200,100,0.5); padding: 0.3rem 1rem; font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; color: #a0e080; border-radius: 2px; margin-bottom: 1.5rem; }
  .confidentiality h2 { font-family: 'Playfair Display', serif; font-size: clamp(1.6rem, 3vw, 2.4rem); font-weight: 700; margin-bottom: 1.2rem; color: #e8f5d8; }
  .confidentiality p { font-size: 0.97rem; color: #b0c8a0; line-height: 1.9; font-weight: 300; margin-bottom: 0.9rem; }
  .conf-points { display: flex; justify-content: center; gap: 1.4rem; flex-wrap: wrap; margin-top: 2.5rem; }
  .conf-point { background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); padding: 1.2rem 1.4rem; text-align: center; flex: 1; min-width: 160px; max-width: 200px; }
  .conf-point .cp-icon { font-size: 1.6rem; margin-bottom: 0.6rem; }
  .conf-point h4 { font-size: 0.88rem; font-weight: 500; color: #d0ecc0; margin-bottom: 0.3rem; }
  .conf-point p { font-size: 0.78rem; color: #8aaa78; margin: 0; }
  .submit-section { padding: 7rem 5%; max-width: 760px; margin: 0 auto; }
  .form-group { display: flex; flex-direction: column; gap: 0.4rem; margin-bottom: 1.2rem; }
  .form-group label { font-size: 0.78rem; font-weight: 500; letter-spacing: 0.08em; text-transform: uppercase; color: #555; }
  .form-group input, .form-group select, .form-group textarea { border: 1.5px solid #ddd; background: var(--cream); padding: 0.85rem 1rem; font-size: 0.92rem; font-family: 'DM Sans', sans-serif; color: var(--ink); outline: none; transition: border-color 0.2s; border-radius: 0; appearance: none; width: 100%; }
  .form-group input:focus, .form-group select:focus, .form-group textarea:focus { border-color: var(--gold); }
  .form-group textarea { min-height: 100px; resize: vertical; }
  .form-note-sm { font-size: 0.78rem; color: #999; line-height: 1.6; margin-top: 0.3rem; }
  .field-error { display: none; font-size: 0.78rem; color: #c0392b; font-weight: 500; margin-top: 0.35rem; padding: 0.3rem 0.6rem; background: #fdf0ef; border-left: 3px solid #c0392b; line-height: 1.5; }
  .field-error.visible { display: block; }
  .input-invalid { border-color: #c0392b !important; }
  .gdrive-box { background: #eef2ff; border: 1.5px solid #c5d0f0; padding: 1.8rem 2rem; margin-bottom: 1.4rem; }
  .gdrive-box h4 { font-family: 'Playfair Display', serif; font-size: 1.05rem; font-weight: 700; margin-bottom: 0.7rem; }
  .gdrive-box p { font-size: 0.86rem; color: #555; line-height: 1.7; margin-bottom: 0.8rem; }
  .gdrive-box ol { font-size: 0.84rem; color: #444; line-height: 1.9; padding-left: 1.4rem; margin-bottom: 0.8rem; }
  .gdrive-box ol li { margin-bottom: 0.2rem; }
  .copy-email-btn { display: inline-block; background: var(--ink); color: var(--cream); padding: 0.35rem 1rem; font-size: 0.8rem; border-radius: 2px; cursor: pointer; font-family: 'DM Sans', sans-serif; border: none; letter-spacing: 0.03em; }
  .copy-email-btn:hover { background: var(--gold); }
  /* ── Video embed ── */
  .gdrive-video-wrap { margin-top: 1.4rem; border-top: 1px solid #c5d0f0; padding-top: 1.2rem; }
  .gdrive-video-wrap p { font-size: 0.82rem; color: #555; margin-bottom: 0.7rem; font-weight: 500; }
  .gdrive-video-wrap p span { color: var(--gold); font-weight: 600; }
  .video-responsive { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 4px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); }
  .video-responsive iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0; }
  /* ── end video ── */
  .form-submit { margin-top: 1.8rem; text-align: center; }
  .form-note { font-size: 0.78rem; color: #aaa; margin-top: 1rem; }
  .success-msg { display: none; text-align: center; padding: 2.5rem; background: #f0faf0; border: 1px solid #a8d5a2; margin-top: 1.5rem; }
  .success-msg h3 { font-family: 'Playfair Display', serif; color: var(--sage); font-size: 1.5rem; margin-bottom: 0.6rem; }
  .success-msg p { font-size: 0.92rem; color: #555; line-height: 1.7; }
  .comments-section { padding: 6rem 5%; background: var(--paper); }
  .comments-inner { max-width: 760px; margin: 0 auto; }
  .comment-form-wrap { background: var(--cream); border: 1px solid rgba(201,149,42,0.25); padding: 2rem 2.2rem; margin-bottom: 3rem; }
  .comment-form-wrap h3 { font-family: 'Playfair Display', serif; font-size: 1.2rem; margin-bottom: 1.2rem; font-weight: 700; }
  .comment-list { display: flex; flex-direction: column; gap: 1.4rem; }
  .comment-card { background: var(--cream); border: 1px solid rgba(201,149,42,0.15); padding: 1.5rem 1.8rem; position: relative; animation: fadeUp 0.4s ease both; }
  .comment-card::before { content: ''; position: absolute; left: 0; top: 0; bottom: 0; width: 3px; background: var(--gold); }
  .comment-meta { display: flex; align-items: center; gap: 0.8rem; margin-bottom: 0.7rem; }
  .comment-avatar { width: 38px; height: 38px; border-radius: 50%; background: linear-gradient(135deg, var(--gold), var(--rust)); display: flex; align-items: center; justify-content: center; font-family: 'Playfair Display', serif; font-size: 0.9rem; font-weight: 700; color: white; flex-shrink: 0; }
  .comment-name { font-weight: 500; font-size: 0.9rem; }
  .comment-time { font-size: 0.75rem; color: #bbb; margin-left: auto; }
  .comment-text { font-size: 0.9rem; color: #444; line-height: 1.7; font-weight: 300; }
  .comments-loading { text-align: center; color: #aaa; font-size: 0.88rem; padding: 2rem 0; }
  footer { padding: 2.5rem 5%; border-top: 1px solid rgba(201,149,42,0.2); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; }
  footer .logo { font-size: 1.1rem; }
  footer p { font-size: 0.8rem; color: #999; }
  footer .credit { font-family: 'Playfair Display', serif; font-size: 0.88rem; color: var(--gold); }
  @keyframes fadeUp { from { opacity: 0; transform: translateY(24px); } to { opacity: 1; transform: translateY(0); } }
  @media (max-width: 700px) {
    .about-inner { grid-template-columns: 1fr; gap: 2.5rem; }
    .btn-outline { margin: 1rem 0 0; display: block; text-align: center; }
    nav { display: none; }
    footer { flex-direction: column; text-align: center; }
    .conf-point { max-width: 100%; }
  }
</style>
</head>
<body>

<header>
  <div class="logo">Proof<span>Perfect</span></div>
  <nav>
    <a href="#about">About Me</a>
    <a href="#services">Services</a>
    <a href="#submit">Submit</a>
    <a href="#comments">Comments</a>
  </nav>
</header>

<section class="hero">
  <div class="hero-tag">✦ Completely Free for Students</div>
  <h1>Your Words,<br><em>Improved</em> &amp; Polished</h1>
  <div class="author-banner">
    <p>Free Proofreading &amp; Guidance by</p>
    <div class="author-name">Ujah John</div>
  </div>
  <p class="hero-sub">Honest, confidential proofreading for assessments, SOPs, cover letters, and CVs. I am only here to guide.</p>
  <div class="hero-cta">
    <a href="#submit" class="btn-primary">Submit Your Document</a>
    <a href="#about" class="btn-outline">About Me</a>
  </div>
</section>

<section class="about" id="about">
  <div class="about-inner">
    <div class="about-text">
      <div class="divider" style="margin: 0 0 1.5rem 0;"></div>
      <h2>I Am <em>Here to Guide.</em></h2>
      <div class="mission-box">"I created this space because I believe every student deserves access to expert feedback. This is not a paid service. I am motivated to help students through their academic journey, as many of them struggle without proper guidance. This is my way of giving back and supporting students to improve their work, gain confidence, and achieve their academic goals."</div>
      <p>My name is Ujah John. I know what it feels like to stare at a blank page, unsure if your writing is good enough or even meets the expectation your tutors has set. I have been a student too. I understand the pressure behind every assessment, the hope packed into a Statement of Purpose, and the anxiety that comes with every job application.</p>
      <p>I worked as a Data Analyst at the <strong>University of Sheffield (Top 100 university in the world)</strong>, and later completed my <strong>Master's degree at Sheffield Hallam University</strong>. I also have years of experience in writing and academic publication — so I know what markers, admissions panels, and recruiters are actually looking for.</p>
      <p>But most importantly: I am not here to rewrite your work. I am here to help you see it more clearly — to guide you, and give you my professional insight.</p>
      <p>This service is, and always will be, <strong>completely free</strong>.</p>
    </div>
    <div class="credentials">
      <div class="cred-item"><div class="cred-icon">📊</div><h4>University of Sheffield</h4><p>Worked as a Data Analyst at the University of Sheffield — years of experience in academic research, data analysis, and professional writing.</p></div>
      <div class="cred-item"><div class="cred-icon">🎓</div><h4>MSc — Sheffield Hallam University</h4><p>Completed a Master's degree at Sheffield Hallam, giving me first-hand knowledge of what postgraduate academic writing demands.</p></div>
      <div class="cred-item"><div class="cred-icon">✍️</div><h4>Years of Writing &amp; Publication</h4><p>Extensive experience in academic writing.</p></div>
      <div class="cred-item"><div class="cred-icon">🤝</div><h4>A Guide, Not a Ghost-Writer</h4><p>I don't write your work for you. I help you see it more clearly — improving grammar, structure, clarity, and tone.</p></div>
    </div>
  </div>
</section>

<section class="services" id="services">
  <div class="section-header">
    <div class="divider"></div>
    <h2>What I Proofread</h2>
    <p>Specialised feedback for the documents that matter most in your academic and professional journey.</p>
  </div>
  <div class="cards">
    <div class="card"><div class="card-icon">📝</div><h3>Assessments</h3><p>Essays, coursework, reports, dissertations — I'll check grammar, clarity, academic tone, and logical flow so your ideas come through as powerfully as possible.</p></div>
    <div class="card"><div class="card-icon">🎓</div><h3>Statement of Purpose</h3><p>Your SOP is your first impression. I'll help it sound confident, compelling, and human — exactly what admissions panels want to see.</p></div>
    <div class="card"><div class="card-icon">✉️</div><h3>Cover Letters</h3><p>Stand out from hundreds of applicants. Your cover letter should open doors, not close them.</p></div>
    <div class="card"><div class="card-icon">📄</div><h3>CV / Résumé</h3><p>Consistency, formatting, and clarity — your CV should make recruiters focus on your achievements.</p></div>
  </div>
</section>

<section class="how-it-works" id="how">
  <h2>How It Works</h2>
  <p>Simple, transparent, and completely free for every student.</p>
  <div class="steps">
    <div class="step"><div class="step-num">1</div><h4>Your Email Only</h4><p>Just your email address — nothing else. No name, no institution, no personal data required.</p></div>
    <div class="step"><div class="step-num">2</div><h4>Share a Google Doc</h4><p>Paste a Google Docs link with Commenter access. Your document stays entirely in your control.</p></div>
    <div class="step"><div class="step-num">3</div><h4>I Review It</h4><p>I personally go through your document and leave detailed feedback directly inside the Google Doc.</p></div>
    <div class="step"><div class="step-num">4</div><h4>You Get Notified</h4><p>You'll receive an email from me within 48 hours confirming your feedback is ready to review.</p></div>
    <div class="step"><div class="step-num">5</div><h4>Submit with Confidence</h4><p>Apply the edits, revoke my access, and submit your work — polished and ready.</p></div>
  </div>
</section>

<section class="confidentiality">
  <div class="conf-inner">
    <div class="conf-badge">🔒 Transparency &amp; Confidentiality</div>
    <h2>I Know What's at Stake</h2>
    <p>I know sharing an assessment or personal statement can feel risky. You might worry about academic integrity, plagiarism flags, or whether your work might be seen by the wrong people. So let me be completely transparent:</p>
    <p><strong style="color: #d0ecc0;">I will never share, publish, reproduce, or misuse your document in any form.</strong> I review your document, leave comments, and that is where it ends.</p>
    <p>If your institution has strict submission policies, you can share a draft or earlier version. You are always in full control — you can revoke access to your Google Doc at any moment, instantly.</p>
    <p>I do this because I genuinely want to help students. Not for payment, not for credit — just to make a difference where I can.</p>
    <div class="conf-points">
      <div class="conf-point"><div class="cp-icon">🙈</div><h4>One Person Only</h4><p>Only I review your document. No team, no algorithm, no third party ever sees it.</p></div>
      <div class="conf-point"><div class="cp-icon">🔐</div><h4>Never Shared</h4><p>Your document will never be published, stored externally, or shared with anyone.</p></div>
      <div class="conf-point"><div class="cp-icon">🗑️</div><h4>You Stay in Control</h4><p>You own the Google Doc. Revoke my access at any time — with one click.</p></div>
      <div class="conf-point"><div class="cp-icon">🆓</div><h4>Always Free</h4><p>Done out of genuine care for students.</p></div>
    </div>
  </div>
</section>

<section class="submit-section" id="submit">
  <div class="section-header">
    <div class="divider"></div>
    <h2>Submit Your Document</h2>
    <p>All I need is your email and a Google Doc link.</p>
  </div>
  <form id="proofForm" onsubmit="handleSubmit(event)">
    <div class="form-group">
      <label>Your Email Address *</label>
      <input type="email" id="emailInput" placeholder="you@university.edu" required>
      <span class="form-note-sm">This is the only personal information I collect. I'll use it solely to send you your feedback. Nothing else.</span>
      <span class="field-error" id="err-email"></span>
    </div>
    <div class="form-group">
      <label>Document Type</label>
      <select id="docType">
        <option value="" disabled selected>What are you submitting?</option>
        <option>Assessment / Essay / Coursework</option>
        <option>Statement of Purpose (SOP)</option>
        <option>Cover Letter</option>
        <option>CV / Résumé</option>
        <option>Other</option>
      </select>
      <span class="field-error" id="err-doctype"></span>
    </div>
    <div class="gdrive-box">
      <h4>🔗 How to Share Your Google Doc With Me</h4>
      <p>Please share your document as a Google Doc. This way you stay in full control — you can revoke my access at any time with one click.</p>
      <ol>
        <li>Open your Google Doc and click <strong>Share</strong> (top-right corner)</li>
        <li>Under "General access", choose <strong>"Anyone with the link"</strong></li>
        <li>Set the role to <strong>Commenter</strong> (not Editor — this protects your content)</li>
        <li>Copy the link and paste it in the field below</li>
        <li>Also add my email directly so I receive access: <button type="button" class="copy-email-btn" onclick="copyEmail(this)">greatujah088@gmail.com — click to copy</button></li>
      </ol>
      <p style="font-size:0.8rem; color:#777; margin-top:0.6rem;"><em>Commenter access means I can leave feedback but cannot edit, delete, or download your document.</em></p>

      <!-- ── YouTube video: visual walkthrough ── -->
      <div class="gdrive-video-wrap">
        <p>🎬 <span>Watch:</span> See exactly how to find the Share button and set Commenter access</p>
        <div class="video-responsive">
          <iframe
            src="https://www.youtube.com/embed/Snhwbgawkko"
            title="How to share your Google Doc with Commenter access"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
          </iframe>
        </div>
      </div>
      <!-- ── end video ── -->

    </div>
    <div class="form-group">
      <label>Google Doc Link *</label>
      <input type="url" id="docLink" placeholder="https://docs.google.com/document/d/..." required>
      <span class="form-note-sm">Make sure sharing is set to "Commenter" before pasting the link here.</span>
      <span class="field-error" id="err-doclink"></span>
    </div>
    <div class="form-group">
      <label>Anything specific you'd like me to focus on? (optional)</label>
      <textarea placeholder="e.g. Please check my grammar and academic tone. I'm applying for an MSc at UCL and I'm worried about my introduction..."></textarea>
    </div>
    <div class="form-submit">
      <button type="submit" class="btn-primary">Send for Proofreading →</button>
      <p class="form-note">100% free.</p>
    </div>
  </form>
  <div class="success-msg" id="successMsg">
    <h3>✓ Submission Received!</h3>
    <p>Thank you for trusting me with your work. I'll review your document personally and get feedback to your email within <strong>48 hours</strong>. You've got this — good luck! 🎓</p>
  </div>
</section>

<section class="comments-section" id="comments">
  <div class="section-header">
    <div class="divider"></div>
    <h2>Student Comments</h2>
    <p>What students are saying. Your words might be the encouragement another student needs to take the leap.</p>
  </div>
  <div class="comments-inner">
    <div class="comment-form-wrap">
      <h3>✏️ Leave a Comment</h3>
      <div class="form-group">
        <label>Your Comment *</label>
        <textarea id="commentText" placeholder="Share your experience, encouragement, or thoughts..." style="min-height: 90px;"></textarea>
      </div>
      <button type="button" class="btn-primary" id="postBtn" onclick="postComment()" style="padding: 0.85rem 2rem; font-size: 0.88rem;">Post Comment</button>
    </div>
    <!-- Comments loaded from DB appear here -->
    <div class="comment-list" id="commentList">
      <p class="comments-loading">Loading comments...</p>
    </div>
  </div>
</section>

<footer>
  <div class="logo">Proof<span>Perfect</span></div>
  <p class="credit">by Ujah John — Here to Guide</p>
  <p>© 2025 ProofPerfect. Free. Always.</p>
</footer>

<script>
  const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  function esc(s) {
    return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  function formatDate(dateStr) {
    return new Date(dateStr).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' });
  }

  function buildCard(comment) {
    const card = document.createElement('div');
    card.className = 'comment-card';
    card.innerHTML = `
      <div class="comment-meta">
        <div class="comment-avatar">A</div>
        <span class="comment-name">Anonymous</span>
        <span class="comment-time">${formatDate(comment.created_at)}</span>
      </div>
      <div class="comment-text">${esc(comment.body)}</div>
    `;
    return card;
  }

  // Load all comments from the database on page load
  async function loadComments() {
    const list = document.getElementById('commentList');
    try {
      const res = await fetch('/comments', { headers: { 'Accept': 'application/json' } });
      const comments = await res.json();
      list.innerHTML = '';
      if (comments.length === 0) {
        list.innerHTML = '<p class="comments-loading">No comments yet — be the first!</p>';
        return;
      }
      comments.forEach(c => list.appendChild(buildCard(c)));
    } catch (err) {
      list.innerHTML = '<p class="comments-loading">Could not load comments.</p>';
    }
  }

  // Save a new comment to the database, then show it instantly
  async function postComment() {
    const textEl = document.getElementById('commentText');
    const btn = document.getElementById('postBtn');
    const text = textEl.value.trim();
    if (!text) { textEl.focus(); return; }

    btn.textContent = 'Posting...';
    btn.disabled = true;

    try {
      const res = await fetch('/comments', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': CSRF,
        },
        body: JSON.stringify({ body: text }),
      });

      if (!res.ok) throw new Error('Server error');
      const data = await res.json();

      const list = document.getElementById('commentList');
      const placeholder = list.querySelector('.comments-loading');
      if (placeholder) placeholder.remove();

      const card = buildCard(data.comment);
      list.insertBefore(card, list.firstChild);
      textEl.value = '';
      card.scrollIntoView({ behavior: 'smooth', block: 'center' });
    } catch (err) {
      alert('Sorry, your comment could not be posted. Please try again.');
    } finally {
      btn.textContent = 'Post Comment';
      btn.disabled = false;
    }
  }

  function copyEmail(btn) {
    navigator.clipboard.writeText('greatujah088@gmail.com').then(() => {
      btn.textContent = '✓ Copied to clipboard!';
      setTimeout(() => { btn.textContent = 'greatujah088@gmail.com — click to copy'; }, 2500);
    });
  }

  function showError(id, msg) {
    const el = document.getElementById(id);
    if (!el) return;
    el.textContent = msg;
    el.classList.add('visible');
    // highlight the associated input/select
    const input = el.previousElementSibling?.tagName === 'SPAN'
      ? el.previousElementSibling.previousElementSibling
      : el.previousElementSibling;
    if (input && (input.tagName === 'INPUT' || input.tagName === 'SELECT')) {
      input.classList.add('input-invalid');
    }
  }

  function clearErrors() {
    document.querySelectorAll('.field-error').forEach(el => {
      el.textContent = '';
      el.classList.remove('visible');
    });
    document.querySelectorAll('.input-invalid').forEach(el => el.classList.remove('input-invalid'));
  }

  async function handleSubmit(e) {
    e.preventDefault();
    clearErrors();

    const email    = document.getElementById('emailInput').value.trim();
    const docType  = document.getElementById('docType').value;
    const docLink  = document.getElementById('docLink').value.trim();

    let hasError = false;

    if (!email) {
      showError('err-email', '⚠ Please enter your email address so I can send your feedback back to you.');
      hasError = true;
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
      showError('err-email', '⚠ That email address doesn\'t look right — please double-check it (e.g. you@university.edu).');
      hasError = true;
    }

    if (!docType) {
      showError('err-doctype', '⚠ Please select what type of document you\'re submitting — this helps me give you more relevant feedback.');
      hasError = true;
    }

    if (!docLink) {
      showError('err-doclink', '⚠ Please paste your Google Doc link. Follow the steps above to copy it — make sure sharing is set to Commenter first.');
      hasError = true;
    } else if (!docLink.includes('docs.google.com')) {
      showError('err-doclink', '⚠ This doesn\'t look like a Google Docs link. It should start with https://docs.google.com/document/d/... — please go back and copy the link from your Google Doc.');
      hasError = true;
    }

    if (hasError) {
      // Scroll to the first visible error
      const first = document.querySelector('.field-error.visible');
      if (first) first.scrollIntoView({ behavior: 'smooth', block: 'center' });
      return;
    }

    const res = await fetch('/submit', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
      body: JSON.stringify({
        email:           email,
        document_type:   docType,
        google_doc_link: docLink,
        focus_notes:     document.querySelector('textarea').value,
      }),
    });
    if (!res.ok) { console.log(await res.text()); return; }
    const data = await res.json();
    if (data.success) {
      document.getElementById('proofForm').style.display = 'none';
      document.getElementById('successMsg').style.display = 'block';
    }
  }

  document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
      e.preventDefault();
      const t = document.querySelector(a.getAttribute('href'));
      if (t) t.scrollIntoView({ behavior: 'smooth' });
    });
  });

  // Clear individual field errors as soon as the user corrects them
  ['emailInput','docType','docLink'].forEach(id => {
    const el = document.getElementById(id);
    if (!el) return;
    el.addEventListener(el.tagName === 'SELECT' ? 'change' : 'input', () => {
      el.classList.remove('input-invalid');
      const errId = { emailInput: 'err-email', docType: 'err-doctype', docLink: 'err-doclink' }[id];
      const errEl = document.getElementById(errId);
      if (errEl) { errEl.textContent = ''; errEl.classList.remove('visible'); }
    });
  });

  loadComments();
</script>
</body>
</html>
