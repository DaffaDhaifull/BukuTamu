<!doctype html>
<html lang="id" style="font-size: 104%">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Buku Tamu SMK TI Pembangunan</title>
    <link rel="icon" href="/favicon.ico" />

    <!-- Hugeicons Free Icon Font -->
    <link rel="stylesheet" href="https://cdn.hugeicons.com/font/hgi-stroke-rounded.css" />

    <!-- Google Fonts: Figtree -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Figtree:ital,wght@0,300..900;1,300..900&display=swap"
      rel="stylesheet"
    />

    <!-- Tailwind CSS (CDN Config & Engine) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/assets/js/tailwind-config.js"></script>
    <style type="text/tailwindcss">
@layer utilities {
  .glass-panel {
    @apply border border-white/40 bg-white/80 shadow-soft backdrop-blur-md dark:border-transparent dark:bg-dark-card/80;
  }

  .sidebar-link {
    @apply flex cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 font-medium text-slate-600 transition-all duration-200 hover:bg-slate-100 hover:text-brand-600 dark:text-stone-400 dark:hover:bg-dark-hover dark:hover:text-brand-400;
  }

  .sidebar-link.active {
    @apply bg-brand-50 font-semibold text-brand-600 dark:bg-brand-500/10 dark:text-brand-400;
  }

  .stat-card {
    @apply cursor-pointer rounded-2xl bg-white p-6 shadow-card transition-all duration-300 hover:-translate-y-1 hover:shadow-soft dark:bg-dark-card dark:shadow-soft-dark dark:border dark:border-transparent;
  }

  /* Modal transitions */
  .modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    inset: 0;
    z-index: 50 !important;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(4px);
    transition: opacity 0.2s ease, visibility 0.2s ease;
  }
  .modal.modal-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }
  .modal.modal-hidden .modal-dialog {
    transform: scale(0.95) translateY(8px);
  }
  .modal.modal-visible {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
  }
  .modal.modal-visible .modal-dialog {
    transform: scale(1) translateY(0);
  }
  .modal.modal-closing {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
  }
  .modal.modal-closing .modal-dialog {
    transform: scale(0.95) translateY(8px);
  }
  .modal-dialog {
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
  }

  /* Subtle Entrance Animations */
  @keyframes fade-in-up {
    from {
      opacity: 0;
      transform: translateY(10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fade-in {
    animation: fade-in-up 0.5s ease-out forwards;
  }

  .delay-1 { animation-delay: 0.1s; }
  .delay-2 { animation-delay: 0.2s; }
  .delay-3 { animation-delay: 0.3s; }
  .delay-4 { animation-delay: 0.4s; }

  /* Collapsed Sidebar Rules */
  aside.w-20 { align-items: center; }
  aside.w-20 .p-6 {
    padding-left: 0 !important;
    padding-right: 0 !important;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  aside.w-20 .mb-10 {
    margin-bottom: 2rem;
    justify-content: center;
    padding: 0;
  }
  aside.w-20 .mb-10 img { margin: 0; }
  aside.w-20 .flex-col.gap-8 {
    gap: 1.5rem;
    width: 100%;
    align-items: center;
  }
  aside.w-20 .space-y-2 {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  aside.w-20 .sidebar-link {
    width: 3rem !important;
    height: 3rem !important;
    padding: 0 !important;
    justify-content: center !important;
    align-items: center !important;
    margin: 0 auto;
  }
  aside.w-20 .sidebar-link i {
    font-size: 1.25rem !important;
    margin: 0 !important;
  }
  aside.w-20 .sidebar-link .sidebar-text { display: none !important; }
  aside.w-20 .new-badge { display: none !important; }
  aside.w-20 .mt-auto {
    width: 100%;
    display: flex;
    justify-content: center;
  }
  aside.w-20 .mt-auto > div {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 0 0 2rem 0 !important;
  }
  aside.w-20 [data-dropdown-toggle] {
    width: 3rem !important;
    height: 3rem !important;
    padding: 0 !important;
    justify-content: center !important;
    border: none !important;
    background: transparent !important;
    margin: 0 auto;
  }
  aside.w-20 [data-dropdown-toggle] .flex-1 { display: none !important; }
  aside.w-20 [data-dropdown-toggle] > i { display: none !important; }
  aside.w-20 #profileDropdown {
    left: 50% !important;
    transform: translateX(-50%) translateY(0.5rem) !important;
    width: 12rem !important;
    bottom: 100% !important;
  }
}

  /* RESPONSIVE UTILITIES */
  @media (max-width: 767px) {
    aside {
      position: fixed !important;
      top: 0;
      left: 0;
      height: 100vh !important;
      z-index: 50 !important;
      transform: translateX(-100%);
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 4px 0 24px rgba(0,0,0,0.12);
    }
    aside.translate-x-0 {
      transform: translateX(0) !important;
    }
    main {
      width: 100vw !important;
      max-width: 100vw !important;
      flex: 1 1 100% !important;
    }
    .content-scroll {
      padding: 1rem !important;
    }
  }

  @media (max-width: 639px) {
    .modal { padding: 0; align-items: flex-end; }
    .modal-dialog {
      width: 100% !important;
      max-width: 100% !important;
      max-height: 90vh;
      overflow-y: auto;
      border-radius: 1.25rem 1.25rem 0 0 !important;
    }
  }

  /* Sidebar Collapse Gaps & Dividers */
  aside.w-20 .flex.flex-col.gap-8 { gap: 0.25rem !important; }
  aside.w-20 .sidebar-text { display: none !important; }
  aside.w-20 .space-y-2 { space-y: 0 !important; }
  aside.w-20 .space-y-2 > * + * { margin-top: 0.125rem !important; }
  .sidebar-divider { display: none; margin: 0 auto; }
  aside.w-20 .sidebar-divider {
    display: block;
    padding: 0 !important;
    margin: 0.25rem auto !important;
  }

</style>
    @yield('styles')
  </head>
  <body
    class="flex h-dvh w-full overflow-hidden bg-slate-50 font-sans text-slate-900 selection:bg-brand-100 selection:text-brand-900 dark:bg-dark-bg dark:text-stone-50 dark:selection:bg-brand-900/30 dark:selection:text-brand-100"
  >
    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="z-10 flex w-80 shrink-0 flex-col justify-between bg-white transition-all duration-300 ease-in-out dark:border-r dark:border-transparent dark:bg-dark-bg">
      <div class="p-6">
        <!-- Logo area -->
        <div class="mb-10 flex cursor-pointer items-center gap-3 px-2">
          <img
            src="/assets/svg/logo.svg"
            alt="SMK TI Pembangunan Logo"
            class="h-8 w-8 drop-shadow-sm transition-transform duration-300 hover:-translate-y-1"
          />
          <span class="sidebar-text text-xl font-extrabold tracking-tight text-slate-800 transition-opacity duration-300 whitespace-nowrap overflow-hidden dark:text-stone-100">SMK TI <span class="text-brand-600 dark:text-brand-500">Pembangunan</span></span>
        </div>

        <!-- Nav Links -->
        <div class="flex flex-col gap-8">
          <div class="space-y-2">
            <p class="sidebar-text mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
              Overview
            </p>
            <i class="hgi-stroke hgi-more-horizontal sidebar-divider text-xl text-slate-400 transition-opacity duration-300 dark:text-stone-500"></i>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
              <i class="hgi-stroke hgi-home-01 text-lg"></i>
              <span class="sidebar-text transition-opacity duration-300 whitespace-nowrap overflow-hidden">Dashboard</span>
            </a>
          </div>

          <div class="space-y-2">
            <p class="sidebar-text mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
              Data
            </p>
            <i class="hgi-stroke hgi-more-horizontal sidebar-divider text-xl text-slate-400 transition-opacity duration-300 dark:text-stone-500"></i>
            <a href="{{ route('admin.guests.index') }}" class="sidebar-link {{ request()->routeIs('admin.guests.*') ? 'active' : '' }}">
              <i class="hgi-stroke hgi-user-multiple text-lg"></i>
              <span class="sidebar-text transition-opacity duration-300 whitespace-nowrap overflow-hidden">Kelola Tamu</span>
            </a>
            <a href="{{ route('admin.reports') }}" class="sidebar-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
              <i class="hgi-stroke hgi-file-01 text-lg"></i>
              <span class="sidebar-text transition-opacity duration-300 whitespace-nowrap overflow-hidden">Laporan</span>
            </a>
          </div>

          <div class="space-y-2">
            <p class="sidebar-text mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-slate-400 transition-opacity duration-300 whitespace-nowrap overflow-hidden">
              Quick Access
            </p>
            <i class="hgi-stroke hgi-more-horizontal sidebar-divider text-xl text-slate-400 transition-opacity duration-300 dark:text-stone-500"></i>
            <a href="{{ route('guestbook.form') }}" target="_blank" class="sidebar-link">
              <i class="hgi-stroke hgi-link-square-01 text-lg"></i>
              <span class="sidebar-text transition-opacity duration-300 whitespace-nowrap overflow-hidden">Form Tamu</span>
              <span class="new-badge ml-auto rounded-full bg-brand-100 px-2 py-0.5 text-[10px] font-bold text-brand-700 transition-opacity duration-300 whitespace-nowrap overflow-hidden dark:bg-brand-500/20 dark:text-brand-300">LINK</span>
            </a>
          </div>
        </div>
      </div>

      <!-- Sidebar footer -->
      <div class="mt-auto p-6 pb-8">
        <div class="relative cursor-pointer">
          <div
            data-dropdown-toggle="profileDropdown"
            class="-mx-3 flex items-center gap-3 rounded-xl border border-transparent p-3 transition-all hover:border-slate-100 hover:bg-slate-50 dark:hover:border-transparent dark:hover:bg-dark-card"
          >
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-brand-100 text-sm font-bold text-brand-700 shadow-sm dark:border-transparent dark:bg-brand-500/20 dark:text-brand-400">
              {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 2)) }}
            </div>
            <div class="flex flex-1 flex-col">
              <span class="text-sm font-bold text-slate-700 dark:text-stone-200">{{ Auth::user()->name ?? 'Administrator' }}</span>
              <span class="text-[13px] text-slate-400 dark:text-stone-500">Buku Tamu Admin</span>
            </div>
            <i class="hgi-stroke hgi-arrow-up-01 text-slate-400 dark:text-stone-500"></i>
          </div>

          <!-- Dropdown Menu -->
          <div
            id="profileDropdown"
            class="dropdown-menu invisible absolute bottom-full left-0 z-50 mb-2 w-full translate-y-2 transform overflow-hidden rounded-xl border border-slate-100 bg-white opacity-0 shadow-xl transition-all duration-200 dark:border-transparent dark:bg-dark-card"
          >
            <div class="space-y-1 p-2">
              <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button
                  type="submit"
                  class="flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-red-600 transition-colors hover:bg-red-50 hover:text-red-700 dark:text-red-400 dark:hover:bg-red-500/10"
                >
                  <i class="hgi-stroke hgi-logout-01 text-lg"></i>
                  <span class="sidebar-text transition-opacity duration-300 whitespace-nowrap overflow-hidden">Logout</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </aside>

    <!-- Main Workspace -->
    <main class="relative flex h-screen flex-1 flex-col overflow-hidden">
      <!-- Floating shapes background effect -->
      <div
        class="animate-blob pointer-events-none absolute right-0 top-0 -m-32 h-96 w-96 rounded-full bg-brand-100 opacity-50 mix-blend-multiply blur-3xl filter"
      ></div>
      <div
        class="animate-blob delay-2000 pointer-events-none absolute right-48 top-0 -m-32 h-96 w-96 rounded-full bg-purple-100 opacity-50 mix-blend-multiply blur-3xl filter"
      ></div>

      <!-- Top Header -->
      <header
        class="z-20 mx-3 mt-4 flex min-h-14 shrink-0 items-center justify-between rounded-2xl border border-slate-100 bg-white px-4 shadow-sm sm:mx-6 sm:mt-6 sm:min-h-16 sm:px-6 md:mx-10 dark:border-transparent dark:bg-dark-card"
      >
        <!-- Sidebar Toggle -->
        <div class="flex items-center">
          <button
            class="mobile-menu-toggle rounded-lg text-slate-500 transition-colors hover:bg-slate-100 dark:text-stone-400 dark:hover:bg-dark-hover"
          >
            <i class="hgi-stroke hgi-menu-05 text-xl"></i>
          </button>
        </div>

        <!-- Header Actions -->
        <div class="flex items-center gap-5">
          <div class="hidden h-6 w-px bg-slate-200 sm:block dark:bg-stone-700"></div>

          <!-- Theme Toggle -->
          <button class="theme-toggle-btn cursor-pointer p-1 text-slate-500 transition-colors hover:text-slate-800 dark:text-stone-400 dark:hover:text-stone-200">
            <i class="hgi-stroke hgi-moon-02 text-2xl dark:hidden"></i>
            <i class="hgi-stroke hgi-sun-03 text-2xl hidden dark:block"></i>
          </button>
        </div>
      </header>

      <!-- Scrollable Content -->
      <div class="content-scroll z-10 flex-1 overflow-y-auto p-4 sm:p-6 sm:px-10">
        <div class="mx-auto space-y-6">
          @yield('content')
        </div>
      </div>
    </main>

    <!-- Global App Script -->
    <script src="/assets/js/app.js"></script>
    @yield('scripts')
    @stack('modals')

    <!-- Page Transition Loader -->
    <div id="pageLoader" class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-slate-50/80 backdrop-blur-sm opacity-0 pointer-events-none transition-opacity duration-300 dark:bg-dark-bg/80">
      <div class="relative flex h-16 w-16 items-center justify-center">
        <div class="absolute h-full w-full rounded-full border-4 border-slate-200 dark:border-stone-800"></div>
        <div class="absolute h-full w-full rounded-full border-4 border-brand-500 border-t-transparent animate-spin"></div>
        <img src="/assets/svg/logo.svg" class="h-6 w-6 animate-pulse" alt="Loading" />
      </div>
      <p class="mt-4 text-sm font-semibold text-slate-500 dark:text-stone-400">Memuat...</p>
    </div>
    <script>
      window.addEventListener('beforeunload', () => {
        const loader = document.getElementById('pageLoader');
        if (loader) {
          loader.classList.remove('opacity-0', 'pointer-events-none');
        }
      });
      // Handle pages shown from bfcache
      window.addEventListener('pageshow', (e) => {
        if (e.persisted) {
          const loader = document.getElementById('pageLoader');
          if (loader) loader.classList.add('opacity-0', 'pointer-events-none');
        }
      });
    </script>
  </body>
</html>
