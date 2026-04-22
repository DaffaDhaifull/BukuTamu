@extends('Admin.layouts.layout')

@section('title', 'Dashboard')

@section('content')
  <!-- Page Header & Breadcrumbs -->
  <div class="animate-fade-in delay-1 mb-2 flex flex-col gap-1">
    <nav class="mb-1 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-stone-400">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center transition-colors hover:text-brand-600 dark:hover:text-brand-400">
        <i class="hgi-stroke hgi-home-01 text-lg"></i>
      </a>
      <i class="hgi-stroke hgi-arrow-right-01 text-sm opacity-50"></i>
      <span class="font-semibold text-slate-800 dark:text-stone-200">Dashboard</span>
    </nav>
    <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-stone-100">Dashboard Overview</h1>
    <p class="text-sm text-slate-500 dark:text-stone-400">Selamat datang! Berikut ringkasan data buku tamu.</p>
  </div>

  <!-- Stats Grid -->
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
    <!-- Stat 1: Total Tamu -->
    <div class="stat-card animate-fade-in delay-1 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
          <i class="hgi-stroke hgi-user-group text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Total Tamu</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($totalGuests) }}</p>
    </div>

    <!-- Stat 2: Tamu Hari Ini -->
    <div class="stat-card animate-fade-in delay-2 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
          <i class="hgi-stroke hgi-calendar-01 text-2xl"></i>
        </div>
        @if($todayGuests > 0)
        <span class="flex items-center gap-1 rounded-md bg-emerald-50 px-2 py-1 text-sm font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
          <i class="hgi-stroke hgi-arrow-up-right-01 text-sm"></i> {{ $todayGuests }}
        </span>
        @endif
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Tamu Hari Ini</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($todayGuests) }}</p>
    </div>

    <!-- Stat 3: Asal Sekolah -->
    <div class="stat-card animate-fade-in delay-3 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
          <i class="hgi-stroke hgi-building-06 text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Asal Sekolah</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($uniqueSchools) }}</p>
    </div>

    <!-- Stat 4: Tamu Minggu Ini -->
    <div class="stat-card animate-fade-in delay-4 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-brand-50 text-brand-600 dark:bg-brand-500/10 dark:text-brand-400">
          <i class="hgi-stroke hgi-chart-line-data-01 text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Tamu Minggu Ini</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($weekGuests) }}</p>
    </div>
  </div>

  <!-- Charts & Recent Guests -->
  <div class="animate-fade-in grid grid-cols-1 gap-6 opacity-0 lg:grid-cols-3" style="animation-delay: 0.5s">
    <!-- Bar Chart: Tamu per Hari -->
    <div class="flex cursor-default flex-col rounded-2xl bg-white p-6 shadow-card lg:col-span-2 dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark">
      <div class="mb-6 flex items-center justify-between">
        <div>
          <h2 class="text-lg font-bold text-slate-800 dark:text-stone-100">Tamu 7 Hari Terakhir</h2>
          <p class="text-sm font-medium text-slate-500 dark:text-stone-400">
            Jumlah tamu yang datang per hari
          </p>
        </div>
      </div>

      <!-- Chart -->
      <div class="relative mt-4 flex min-h-[250px] flex-1 items-end gap-3 pt-10">
        <!-- Bars -->
        <div class="group relative z-10 flex h-full flex-1 items-end justify-between gap-3 pb-8">
          @foreach($dailyGuests as $day)
          <div class="flex flex-1 flex-col items-center gap-2">
            <span class="text-xs font-bold text-slate-600 dark:text-stone-300">{{ $day['count'] }}</span>
            <div
              class="w-full rounded-t-lg bg-gradient-to-t from-brand-600 to-brand-400 transition-all duration-500 hover:from-brand-700 hover:to-brand-500 dark:from-brand-500 dark:to-brand-300"
              style="height: {{ $maxDaily > 0 ? max(($day['count'] / $maxDaily) * 100, 4) : 4 }}%; min-height: 8px;"
            ></div>
            <span class="text-xs font-semibold text-slate-500 dark:text-stone-400">{{ $day['label'] }}</span>
          </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- Recent Guests Widget -->
    <div class="flex flex-col rounded-2xl bg-white p-6 shadow-card dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark">
      <div class="mb-6 flex items-center justify-between">
        <h2 class="text-lg font-bold text-slate-800 dark:text-stone-100">Tamu Terbaru</h2>
        <a href="{{ route('admin.guests.index') }}" class="text-sm font-semibold text-brand-600 transition-colors hover:text-brand-800 dark:text-brand-400 dark:hover:text-brand-300">
          Lihat semua
        </a>
      </div>

      <div class="flex-1 space-y-5">
        @forelse($recentGuests as $guest)
        <div class="-mx-2 flex cursor-pointer items-center gap-4 rounded-xl p-2 transition-colors hover:bg-slate-50 dark:hover:bg-dark-hover">
          <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full border border-slate-200 bg-brand-100 text-sm font-bold text-brand-700 dark:border-transparent dark:bg-brand-500/20 dark:text-brand-400">
            {{ strtoupper(substr($guest->name, 0, 2)) }}
          </div>
          <div class="flex-1 min-w-0">
            <h4 class="text-sm font-bold text-slate-800 dark:text-stone-200 truncate">{{ $guest->name }}</h4>
            <p class="text-xs font-medium text-slate-500 dark:text-stone-400 truncate">{{ $guest->school }}</p>
          </div>
          <span class="text-xs font-bold text-slate-400 dark:text-stone-500 whitespace-nowrap">{{ $guest->created_at->diffForHumans(null, true, true) }}</span>
        </div>
        @empty
        <div class="flex flex-col items-center justify-center py-8 text-center">
          <i class="hgi-stroke hgi-user-group text-4xl text-slate-300 dark:text-stone-600 mb-3"></i>
          <p class="text-sm font-medium text-slate-400 dark:text-stone-500">Belum ada tamu terdaftar</p>
        </div>
        @endforelse
      </div>

      <a href="{{ route('admin.guests.index') }}" class="mt-4 block w-full cursor-pointer rounded-xl border border-slate-200 py-2.5 text-center text-sm font-semibold text-slate-600 transition-all hover:border-slate-300 hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:border-stone-600 dark:hover:bg-dark-hover">
        Lihat Semua Tamu
      </a>
    </div>
  </div>
@endsection
