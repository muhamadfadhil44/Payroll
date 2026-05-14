<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Modern Login</title>

  <style>
    :root {
      --bg: #06070a;
      --surface: rgba(15, 23, 42, 0.95);
      --surface-soft: #0f172a;
      --border: rgba(148, 163, 184, 0.22);
      --text-primary: #e5e7eb;
      --text-secondary: #94a3b8;
      --text-muted: #64748b;
      --accent: #38bdf8;
      --accent-strong: #0ea5e9;
      --accent-light: rgba(56, 189, 248, 0.18);
      --error-bg: #311c24;
      --error-border: #7f1d1d;
      --error-text: #f8d7da;
      --radius: 26px;
      --radius-sm: 16px;
      --shadow-sm: 0 12px 28px rgba(0, 0, 0, 0.3);
      --shadow-md: 0 24px 72px rgba(0, 0, 0, 0.5);
      --transition: 240ms cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
    }

    body {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 28px;
      background: radial-gradient(circle at top, rgba(14, 165, 233, 0.12), transparent 20%),
        radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.93), transparent 35%),
        var(--bg);
      color: var(--text-primary);
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      inset: 0;
      background: radial-gradient(circle at 18% 14%, rgba(56, 189, 248, 0.15), transparent 18%),
        radial-gradient(circle at 82% 20%, rgba(148, 163, 184, 0.12), transparent 15%);
      pointer-events: none;
      z-index: 0;
    }

    .login-container {
      width: 100%;
      max-width: 500px;
      position: relative;
      z-index: 1;
    }

    .login-card {
      position: relative;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: var(--radius);
      padding: 50px 44px;
      box-shadow: var(--shadow-md);
      overflow: hidden;
      backdrop-filter: blur(14px);
      transition: var(--transition);
    }

    .login-card::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(145deg, rgba(56, 189, 248, 0.08), transparent 35%);
      pointer-events: none;
    }

    .login-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 30px 90px rgba(34, 48, 32, 0.14);
    }

    h1 {
      font-size: clamp(1.8rem, 3.5vw, 2.3rem);
      font-weight: 700;
      letter-spacing: -0.04em;
      line-height: 1.1;
      margin-bottom: 10px;
      text-align: center;
    }

    .subtitle {
      text-align: center;
      color: var(--text-secondary);
      font-size: 0.96rem;
      margin-bottom: 34px;
      line-height: 1.6;
      max-width: 82%;
      margin-left: auto;
      margin-right: auto;
    }

    .input-group {
      margin-bottom: 22px;
    }

    .input-group label {
      display: block;
      font-size: 0.92rem;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 10px;
    }

    .input-box input {
      width: 100%;
      padding: 16px 18px;
      border: 1px solid rgba(105, 119, 92, 0.18);
      border-radius: var(--radius-sm);
      background: var(--surface-soft);
      color: var(--text-primary);
      font-size: 1rem;
      transition: var(--transition);
      outline: none;
    }

    .input-box input:focus {
      border-color: var(--accent);
      background: rgba(15, 23, 42, 0.95);
      box-shadow: 0 0 0 4px var(--accent-light);
    }

    .input-box input::placeholder {
      color: var(--text-muted);
    }

    .extra {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 12px;
      margin-bottom: 28px;
      font-size: 0.9rem;
      color: var(--text-secondary);
      flex-wrap: wrap;
    }

    .extra label {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      user-select: none;
    }

    .extra input[type='checkbox'] {
      accent-color: var(--accent);
      width: 16px;
      height: 16px;
      cursor: pointer;
    }

    .extra a {
      color: var(--accent-strong);
      text-decoration: none;
      font-weight: 600;
      transition: var(--transition);
    }

    .extra a:hover {
      color: var(--accent);
    }

    .login-btn {
      width: 100%;
      padding: 16px 18px;
      border: none;
      border-radius: var(--radius-sm);
      background: var(--accent);
      color: white;
      font-size: 1rem;
      font-weight: 700;
      cursor: pointer;
      transition: var(--transition);
      box-shadow: 0 16px 32px rgba(56, 189, 248, 0.22);
    }

    .login-btn:hover {
      background: var(--accent-strong);
      transform: translateY(-1px);
    }

    .login-btn:active {
      transform: translateY(0);
    }

    .divider {
      margin: 32px 0 24px;
      display: flex;
      align-items: center;
      gap: 14px;
      color: var(--text-muted);
      font-size: 0.78rem;
      text-transform: uppercase;
      letter-spacing: 0.14em;
      font-weight: 600;
    }

    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: rgba(105, 119, 92, 0.16);
    }

    .social-login {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 12px;
    }

    .social-btn {
      padding: 14px 0;
      border-radius: var(--radius-sm);
      border: 1px solid rgba(148, 163, 184, 0.18);
      background: #111827;
      color: var(--text-primary);
      font-size: 0.92rem;
      font-weight: 600;
      cursor: pointer;
      transition: var(--transition);
    }

    .social-btn:hover {
      background: #0f172a;
      border-color: rgba(148, 163, 184, 0.28);
      transform: translateY(-1px);
    }

    .social-btn:active {
      transform: translateY(0);
    }

    .bottom-text {
      margin-top: 28px;
      text-align: center;
      color: var(--text-secondary);
      font-size: 0.92rem;
      line-height: 1.6;
    }

    .bottom-text a {
      color: var(--accent-strong);
      text-decoration: none;
      font-weight: 700;
      transition: var(--transition);
    }

    .bottom-text a:hover {
      color: var(--accent);
      text-decoration: underline;
    }

    .error-box {
      background: var(--error-bg);
      border: 1px solid var(--error-border);
      color: var(--error-text);
      padding: 14px 16px;
      border-radius: var(--radius-sm);
      margin-bottom: 20px;
      font-size: 0.9rem;
      line-height: 1.5;
    }

    @media (max-width: 520px) {
      .login-card {
        padding: 34px 24px;
      }

      h1 {
        font-size: 1.8rem;
      }

      .social-login {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>

<body>

<div class="login-container">
  <div class="login-card">

    <h1>Welcome Back</h1>
    <p class="subtitle">
      Login untuk melanjutkan ke dashboard
    </p>

    @if ($errors->any())
      @foreach ($errors->all() as $error)
        <div class="error-box">
          {{ $error }}
        </div>
      @endforeach
    @endif

    <form action="{{ route('action.login') }}" method="POST">
      @csrf

      <div class="input-group">
        <label>Email Address</label>
        <div class="input-box">
          <input 
            type="email" 
            name="email"
            placeholder="Masukkan email..."
            required
          >
        </div>
      </div>

      <div class="input-group">
        <label>Password</label>
        <div class="input-box">
          <input 
            type="password" 
            name="password"
            placeholder="Masukkan password..."
            required
          >
        </div>
      </div>

      <div class="extra">
        <label>
          <input type="checkbox">
          Remember me
        </label>

        <a href="#">Forgot Password?</a>
      </div>

      <button class="login-btn" type="submit">
        Sign In
      </button>
    </form>

    <div class="divider">
      atau lanjut dengan
    </div>

    <div class="social-login">
      <button class="social-btn">Google</button>
      <button class="social-btn">Github</button>
    </div>

    <div class="bottom-text">
      Belum punya akun?
      <a href="#">Daftar Sekarang</a>
    </div>

  </div>
</div>

</body>
</html>