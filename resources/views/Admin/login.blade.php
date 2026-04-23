<!doctype html>
<html lang="id" style="font-size: 104%">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login — Buku Tamu SMK TI Pembangunan</title>
    <meta name="description" content="Login halaman admin buku tamu Open House SMK TI Pembangunan." />
    <link rel="icon" href="/favicon.ico" />

    <!-- Hugeicons Free Icon Font -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Fonts: Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/assets/js/tailwind-config.js"></script>
    <style type="text/tailwindcss">
@layer utilities {
  @keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(20px, -30px) scale(1.05); }
    66% { transform: translate(-15px, 15px) scale(0.97); }
  }
  .animate-blob { animation: blob 8s ease-in-out infinite; }
  .delay-2000 { animation-delay: 2s; }
  .delay-4000 { animation-delay: 4s; }

  @keyframes fade-up {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .fade-up { opacity: 0; animation: fade-up 0.6s ease-out forwards; }
  .delay-200 { animation-delay: 0.2s; }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
  }
  .animate-float { animation: float 4s ease-in-out infinite; }

  .gradient-text {
    background: linear-gradient(135deg, #2563eb 0%, #7c3aed 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .hero-glow {
    background: radial-gradient(ellipse 80% 50% at 50% -10%, rgba(37, 99, 235, 0.12), transparent);
  }
}
</style>
  </head>
  <body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased selection:bg-brand-100 selection:text-brand-900 dark:bg-dark-bg dark:text-stone-50">

    <!-- Background Effects -->
    <div class="hero-glow fixed inset-0 pointer-events-none"></div>
    <div class="animate-blob pointer-events-none fixed -left-32 top-20 h-96 w-96 rounded-full bg-brand-100 opacity-60 blur-3xl dark:opacity-20"></div>
    <div class="animate-blob delay-2000 pointer-events-none fixed right-0 top-10 h-80 w-80 rounded-full bg-purple-100 opacity-50 blur-3xl dark:opacity-15"></div>
    <div class="animate-blob delay-4000 pointer-events-none fixed bottom-0 left-1/2 h-64 w-64 -translate-x-1/2 rounded-full bg-sky-100 opacity-40 blur-3xl dark:opacity-10"></div>

    <div class="relative flex min-h-screen flex-col items-center justify-center px-4 py-12">
      <!-- Logo & Header -->
      <div class="mb-8 text-center fade-up">
        <div class="mb-6 flex justify-center">
          <div class="animate-float rounded-2xl bg-white p-3 shadow-lg dark:bg-dark-card">
            <img src="/assets/svg/logo.svg" alt="Buku Tamu" class="h-12 w-12" />
          </div>
        </div>
        <h1 class="text-4xl font-bold tracking-tight text-slate-900 sm:text-5xl dark:text-stone-100">
          Admin <span class="gradient-text">Login</span>
        </h1>
        <p class="mt-3 text-lg text-slate-500 dark:text-stone-400">
          SMK TI Pembangunan Open House
        </p>
      </div>

      <!-- Form Card -->
      <div class="fade-up delay-200 w-full max-w-md">
        <div class="rounded-2xl border border-slate-200/50 bg-white p-8 shadow-xl dark:border-transparent dark:bg-dark-card">
          <div class="mb-6">
            <h2 class="text-xl font-bold text-slate-800 dark:text-stone-100">Selamat Datang Kembali</h2>
            <p class="mt-1 text-sm text-slate-500 dark:text-stone-400">Silakan login untuk mengelola buku tamu.</p>
          </div>

          <!-- Validation Errors -->
          @if($errors->any())
          <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 dark:border-red-500/20 dark:bg-red-500/10">
            <div class="flex items-start gap-3">
              <i class="hgi-stroke hgi-alert-circle text-xl text-red-600 dark:text-red-400 mt-0.5"></i>
              <div>
                <p class="text-sm font-semibold text-red-700 dark:text-red-300">Mohon perbaiki kesalahan berikut:</p>
                <ul class="mt-1 list-disc pl-4 text-sm text-red-600 dark:text-red-400">
                  @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
          @endif

          <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <div class="space-y-5">
              <!-- Email Field -->
              <div>
                <label for="email" class="mb-1.5 flex items-center gap-1 text-sm font-semibold text-slate-700 dark:text-stone-300">
                  <i class="hgi-stroke hgi-mail-01 text-lg text-slate-400"></i>
                  Email Admin
                </label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  required
                  autofocus
                  placeholder="admin@admin.com"
                  class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200"
                />
              </div>

              <!-- Password Field -->
              <div>
                <label for="password" class="mb-1.5 flex items-center gap-1 text-sm font-semibold text-slate-700 dark:text-stone-300">
                  <i class="hgi-stroke hgi-lock-password text-lg text-slate-400"></i>
                  Password
                </label>
                <input
                  type="password"
                  id="password"
                  name="password"
                  required
                  placeholder="••••••••"
                  class="h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200"
                />
              </div>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              class="mt-8 flex w-full items-center justify-center gap-2 rounded-xl bg-brand-600 py-3 text-sm font-semibold text-white shadow-lg shadow-brand-500/25 transition-all hover:bg-brand-700 hover:shadow-xl hover:shadow-brand-500/30 active:scale-[0.98]"
            >
              <i class="hgi-stroke hgi-login-03 text-lg"></i>
              Login
            </button>
          </form>
        </div>
      </div>
    </div>

    <!-- Theme detection -->
    <script>
      if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
      }
    </script>
  </body>
</html>
