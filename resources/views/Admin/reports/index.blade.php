@extends('Admin.layouts.layout')

@section('title', 'Laporan')

@section('styles')
<style>
  @media print {
    aside, header, .no-print, footer { display: none !important; }
    main { width: 100% !important; max-width: 100% !important; }
    .content-scroll { padding: 0 !important; }
    .print-table { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
    body { background: white !important; }
  }
</style>
@endsection

@section('content')
  <!-- Page Header & Breadcrumbs -->
  <div class="animate-fade-in delay-1 mb-2 flex flex-col gap-1">
    <nav class="mb-1 flex items-center gap-2 text-sm font-medium text-slate-500 dark:text-stone-400">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center transition-colors hover:text-brand-600 dark:hover:text-brand-400">
        <i class="hgi-stroke hgi-home-01 text-lg"></i>
      </a>
      <i class="hgi-stroke hgi-arrow-right-01 text-sm opacity-50"></i>
      <span class="font-semibold text-slate-800 dark:text-stone-200">Laporan</span>
    </nav>
    <div class="mt-1 flex flex-wrap items-start justify-between gap-3">
      <div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-stone-100">Laporan Tamu</h1>
        <p class="text-sm text-slate-500 dark:text-stone-400">Rekap seluruh data tamu yang berkunjung.</p>
      </div>
      <a
        href="{{ route('admin.reports.pdf', request()->query()) }}"
        class="no-print flex h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 text-sm font-semibold text-slate-600 shadow-sm transition-all hover:bg-slate-50 hover:text-slate-900 active:scale-95 dark:border-transparent dark:bg-dark-card dark:text-stone-300 dark:hover:bg-dark-hover"
      >
        <i class="hgi-stroke hgi-printer text-lg"></i>
        <span>Unduh PDF</span>
      </a>
    </div>
  </div>

  <!-- Date Filter -->
  <div class="no-print animate-fade-in delay-2 rounded-2xl bg-white p-6 shadow-card dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark">
    <form method="GET" action="{{ route('admin.reports') }}" class="flex flex-wrap items-end gap-4">
      <div class="flex-1 min-w-[180px]">
        <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Dari Tanggal</label>
        <input type="date" name="date_from" value="{{ $dateFrom }}"
          class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
      </div>
      <div class="flex-1 min-w-[180px]">
        <label class="mb-1.5 block text-sm font-semibold text-slate-700 dark:text-stone-300">Sampai Tanggal</label>
        <input type="date" name="date_to" value="{{ $dateTo }}"
          class="h-10 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm text-slate-700 shadow-sm transition-all focus:outline-none focus:ring-2 focus:ring-brand-500 dark:border-transparent dark:bg-dark-hover dark:text-stone-200" />
      </div>
      <div class="flex items-center gap-2">
        <button type="submit" class="flex h-10 items-center gap-2 rounded-xl bg-brand-600 px-4 text-sm font-semibold text-white shadow-md shadow-brand-500/20 transition-all hover:bg-brand-700 active:scale-95">
          <i class="hgi-stroke hgi-filter-vertical text-lg"></i>
          Filter
        </button>
        @if($dateFrom || $dateTo)
        <a href="{{ route('admin.reports') }}" class="flex h-10 items-center gap-2 rounded-xl border border-slate-200 px-4 text-sm font-semibold text-slate-600 transition-all hover:bg-slate-50 dark:border-transparent dark:text-stone-300 dark:hover:bg-dark-hover">
          <i class="hgi-stroke hgi-cancel-01 text-lg"></i>
          Reset
        </a>
        @endif
      </div>
    </form>
  </div>

  <!-- Stats Summary -->
  <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
    <div class="stat-card animate-fade-in delay-2 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
          <i class="hgi-stroke hgi-user-group text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Total Tamu</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($totalGuests) }}</p>
    </div>

    <div class="stat-card animate-fade-in delay-3 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
          <i class="hgi-stroke hgi-building-06 text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Asal Sekolah</h3>
      <p class="text-3xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100">{{ number_format($uniqueSchools) }}</p>
    </div>

    <div class="stat-card animate-fade-in delay-4 opacity-0">
      <div class="mb-4 flex items-start justify-between">
        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
          <i class="hgi-stroke hgi-chart-bar-line text-2xl"></i>
        </div>
      </div>
      <h3 class="mb-1 text-sm font-semibold text-slate-500 dark:text-stone-400">Sekolah Terbanyak</h3>
      <p class="text-xl font-extrabold tracking-tight text-slate-800 dark:text-stone-100 truncate">{{ $topSchools->keys()->first() ?? '-' }}</p>
      @if($topSchools->isNotEmpty())
      <p class="text-sm font-medium text-emerald-600 dark:text-emerald-400">{{ $topSchools->first() }} tamu</p>
      @endif
    </div>
  </div>

  <!-- Top Schools -->
  @if($topSchools->isNotEmpty())
  <div class="animate-fade-in rounded-2xl bg-white p-6 shadow-card dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark" style="animation-delay: 0.5s">
    <h2 class="mb-4 text-lg font-bold text-slate-800 dark:text-stone-100">Top 5 Sekolah</h2>
    <div class="space-y-3">
      @foreach($topSchools as $school => $count)
      <div class="flex items-center gap-4">
        <div class="flex-1 min-w-0">
          <div class="flex items-center justify-between mb-1">
            <span class="text-sm font-semibold text-slate-700 dark:text-stone-300 truncate">{{ $school }}</span>
            <span class="text-sm font-bold text-brand-600 dark:text-brand-400 ml-2">{{ $count }}</span>
          </div>
          <div class="h-2 w-full rounded-full bg-slate-100 dark:bg-dark-hover overflow-hidden">
            <div class="h-full rounded-full bg-gradient-to-r from-brand-500 to-brand-400 transition-all duration-500" style="width: {{ $totalGuests > 0 ? ($count / $totalGuests) * 100 : 0 }}%"></div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @endif

  <!-- Full Guest Table -->
  <div class="print-table animate-fade-in overflow-hidden rounded-2xl bg-white shadow-card dark:bg-dark-card dark:border dark:border-transparent dark:shadow-soft-dark" style="animation-delay: 0.6s">
    <div class="flex items-center justify-between border-b border-slate-100 bg-white p-6 dark:border-transparent dark:bg-dark-card">
      <h2 class="text-lg font-bold text-slate-800 dark:text-stone-100">Daftar Lengkap Tamu</h2>
      <span class="text-sm font-medium text-slate-500 dark:text-stone-400">{{ number_format($totalGuests) }} data</span>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse text-left">
        <thead>
          <tr class="border-b border-slate-100 bg-white text-xs font-semibold uppercase tracking-wider text-slate-500 dark:border-transparent dark:bg-dark-card/50 dark:text-stone-400">
            <th class="px-6 py-4">No</th>
            <th class="px-6 py-4">Nama</th>
            <th class="px-6 py-4">Asal Sekolah</th>
            <th class="px-6 py-4">No. HP</th>
            <th class="px-6 py-4">Waktu Kunjungan</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 dark:divide-stone-800">
          @forelse($guests as $index => $guest)
          <tr class="group bg-white transition-colors hover:bg-slate-50 dark:bg-dark-card dark:hover:bg-dark-hover">
            <td class="px-6 py-4">
              <span class="text-sm font-medium text-slate-600 dark:text-stone-400">{{ $index + 1 }}</span>
            </td>
            <td class="px-6 py-4">
              <div class="flex items-center gap-3">
                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-brand-100 text-xs font-bold text-brand-700 dark:bg-brand-500/20 dark:text-brand-400">
                  {{ strtoupper(substr($guest->name, 0, 2)) }}
                </div>
                <span class="text-sm font-bold text-slate-800 dark:text-stone-200">{{ $guest->name }}</span>
              </div>
            </td>
            <td class="px-6 py-4">
              <span class="text-sm font-medium text-slate-700 dark:text-stone-300">{{ $guest->school }}</span>
            </td>
            <td class="px-6 py-4">
              <span class="text-sm text-slate-600 dark:text-stone-400">{{ $guest->phone_number ?? '-' }}</span>
            </td>
            <td class="px-6 py-4">
              <div class="text-sm text-slate-700 dark:text-stone-300">{{ $guest->created_at->format('d M Y, H:i') }}</div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="5" class="px-6 py-16 text-center">
              <div class="flex flex-col items-center">
                <i class="hgi-stroke hgi-file-01 text-5xl text-slate-300 dark:text-stone-600 mb-4"></i>
                <p class="text-lg font-semibold text-slate-400 dark:text-stone-500">Tidak ada data tamu</p>
                <p class="mt-1 text-sm text-slate-400 dark:text-stone-500">Ubah filter tanggal atau tambahkan tamu terlebih dahulu</p>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
@endsection
